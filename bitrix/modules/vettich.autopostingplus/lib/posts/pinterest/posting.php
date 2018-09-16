<?
namespace Vettich\AutopostingPlus\Posts\pinterest;
use Vettich\Autoposting\PostingFunc;
use Vettich\Autoposting\PostingLogs;

IncludeModuleLangFile(__FILE__);

class Posting extends \Vettich\Autoposting\Posting
{
	const COOKIE = 'pinterest';
	static private $COOKIE = '';

	function method($path, $params, $is_post=false, $custom_request=false)
	{
		if(empty($path))
			return false;

		if(!empty($params) && !$is_post)
		{
			$path .= (strpos($path, '?') !== false ? '&' : '?') . (is_array($params) ? http_build_query($params) : $params);
			unset($params);
		}

		$pinterest_api_url = 'https://api.pinterest.com';
		$adparams = array(
			'user_agent' => false,
			'timeout' => 60,
		);
		if($custom_request)
		{
			$adparams['CUSTOM_REQUEST'] = $custom_request;
			$adparams['enctype'] = PostingFunc::CURL_ENCTYPE_APPLICATION;
		}

		if(empty($params))
			$ret = PostingFunc::curl_post($pinterest_api_url.$path, array(), $adparams);
		else
			$ret = PostingFunc::curl_post($pinterest_api_url.$path, $params, $adparams);
		return json_decode($ret, true);
	}

	/**
	* Публикует запись в ВКонтакте
	* 
	* @param array $arFields поля публикуемого элемента
	* @param array $arAcconts в какие аккаунты публиковать
	* @param array $arPost данные о публикации
	* @param array $arSite массив полей сайта
	* @param array $arOptionally массив дополнительных параметров
	*	например array('post_ids' => array(acc_id => post_id), 
	*		'type' => 'post|edit|delete')
	*/
	function post($arFields, $arAccounts, $arPost, $arSite, $arOptionally=array())
	{
		global $APPLICATION;
		$type = $arOptionally['type'];

		if(\COption::GetOptionString(PostingFunc::module_id(), 'is_pinterest_enable', false) != 'Y')
			return;

		if(!empty($arOptionally['post_ids']))
			$arResult = $arOptionally['post_ids'];
		else
			$arResult = array();
		foreach($arAccounts as $acc_id)
		{
			$post_id = $arResult[$acc_id];
			$arAccount = Func::GetAccountValues($acc_id, $arPost['ID']);
			if(empty($arAccount))
				continue;

			$arPost['arAccount'] = $arAccount;
			$arPost['ACCPREFIX'] = Func::ACCPREFIX;

			if($arAccount['IS_ENABLE'] != 'Y')
				continue;

			$post_data = array('access_token' => $arAccount['ACCESS_TOKEN']);

			if(($type == 'delete' or $type == 'edit')
				&& $arAccount['PINTEREST_PUBLICATION_MODE'] == 'none')
				continue;

			if(empty($arAccount['PINTEREST_PUBLICATION_MODE']))
				$arAccount['PINTEREST_PUBLICATION_MODE'] = 'update';

			if($type == 'delete'
				or ($type == 'edit' && $arAccount['PINTEREST_PUBLICATION_MODE'] == 'del_add'))
			{
				if(!empty($post_id))
				{
					$rs = self::method('/v1/pins/'.$post_id['post_id'].'/', $post_data, $is_post=false, 'DELETE');
// \VOptions::debugg($rs, 'pin_post');
				}
			}

			if($type != 'delete')
			{
				if($type == 'edit' && !empty($post_id))
				{
					if($arAccount['PINTEREST_LINK'] != '' && $arAccount['PINTEREST_LINK'] != 'none')
					{
						$res = parent::getLinkFromProperty($arAccount['PINTEREST_LINK'], $arFields, $arPost, $arSite);
						if(!empty($res))
						{
							$post_data['link'] = $res;
						}
					}
					else
						$post_data['link'] = false;

					$post_data['note'] = parent::replaceMacros($arAccount['PINTEREST_MESSAGE'], $arFields, $arSite, $arPost);
					$post_data['note'] = strip_tags($post_data['note']);
					$post_data['note'] = $APPLICATION->ConvertCharset($post_data['note'], SITE_CHARSET, "UTF-8");
					$post_data['note'] = trim(html_entity_decode($post_data['note']));

// \VOptions::debugg(array('/v1/pins/'.$post_id['post_id'].'/', $post_data, $is_post=true, 'PATCH'), 'pin_post');
					$rs = self::method('/v1/pins/'.$post_id['post_id'].'/', $post_data, $is_post=true, 'PATCH');
				}
				else
				{
					if($arAccount['PINTEREST_PHOTO'] != '' && $arAccount['PINTEREST_PHOTO'] != 'none')
					{
						$res = parent::getFilesFromProperty($arAccount['PINTEREST_PHOTO'], $arFields);
						if(!empty($res))
							$post_data['image'] = parent::getCurlFilename($res[0]);
					}
					elseif($arAccount['PINTEREST_PHOTO_OTHER'] != $arAccount['PINTEREST_PHOTO']
						&& $arAccount['PINTEREST_PHOTO_OTHER'] != ''
						&& $arAccount['PINTEREST_PHOTO_OTHER'] != 'none')
					{
						$res = parent::getFilesFromProperty($arAccount['PINTEREST_PHOTO_OTHER'], $arFields);
						if(!empty($res))
							$post_data['image'] = parent::getCurlFilename($res[0]);
					}

					if(!empty($post_data['image']))
					{
						if($arAccount['PINTEREST_LINK'] != '' && $arAccount['PINTEREST_LINK'] != 'none')
						{
							$res = parent::getLinkFromProperty($arAccount['PINTEREST_LINK'], $arFields, $arPost, $arSite);
							if(!empty($res))
							{
								$post_data['link'] = $res;
							}
						}

						$post_data['note'] = parent::replaceMacros($arAccount['PINTEREST_MESSAGE'], $arFields, $arSite, $arPost);
						$post_data['note'] = strip_tags($post_data['note']);
						$post_data['note'] = $APPLICATION->ConvertCharset($post_data['note'], SITE_CHARSET, "UTF-8");
						$post_data['note'] = trim(html_entity_decode($post_data['note']));

						$post_data['board'] = $arAccount['PAGE_ID'];
						$rs = self::method('/v1/pins/', $post_data, $is_post=true);
					}
					else
					{
						$rs['message'] = 'You need to upload an image or provide the \'image_url\' parameter';
					}
				}
			}

			if(empty($rs['data']) && $type != 'delete')
			{
				if(\COption::GetOptionString(PostingFunc::module_id(), 'pinterest_log_error', false) == 'Y')
				{
					if($type == 'delete')
						$text = GetMessage('PINTEREST_ERROR_DELETE',
							array(
								'#MESSAGE#' => $rs['message'],
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('pinterest', $acc_id, $arAccount['NAME']),
							)
						);
					else
						$text = GetMessage('PINTEREST_ERROR',
							array(
								'#MESSAGE#' => $rs['message'],
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('pinterest', $acc_id, $arAccount['NAME']),
							)
						);

					PostingLogs::addLog('pinterest', $text, 'Error');
				}
			}
			else
			{
				if(!empty($rs['data']))
				{
					$arResult[$acc_id] = array(
						'url' => $rs['data']['url'],
						'post_id' => $rs['data']['id'],
					);
				}
				if(\COption::GetOptionString(PostingFunc::module_id(), 'pinterest_log_success', false) == 'Y')
				{
					if($type == 'edit' && !empty($post_id))
						$text = GetMessage('PINTEREST_SUCCESS_EDIT',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('pinterest', $acc_id, $arAccount['NAME']),
							)
						);
					elseif($type == 'delete')
						$text = GetMessage('PINTEREST_SUCCESS_DELETE',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('pinterest', $acc_id, $arAccount['NAME']),
							)
						);
					else
						$text = GetMessage('PINTEREST_SUCCESS',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('pinterest', $acc_id, $arAccount['NAME']),
							)
						);
					PostingLogs::addLog('pinterest', $text, 'Success');
				}
			}
		}
		return $arResult;
	}

	function getUrlPost($arAccount, $arPostId)
	{
		return $arPostId['url'] ?: '';
	}

	function GetBoards($access_token = '')
	{
		if(empty($access_token))
			return array();

		$res = self::method('/v1/me/boards/', array('access_token' => $access_token));
		if(!$res['data'])
			return false;

		$result = array();
		foreach($res['data'] as $board)
		{
			$result[$board['id']] = $board;
		}
		return $result;
	}
}