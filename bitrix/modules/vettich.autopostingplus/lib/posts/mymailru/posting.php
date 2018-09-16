<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
use Vettich\Autoposting\PostingFunc;
use Vettich\Autoposting\PostingLogs;

IncludeModuleLangFile(__FILE__);

class Posting extends \Vettich\Autoposting\Posting
{
	static private $client_id = '';
	static private $client_secret = '';
	static private $access_token = '';
	static private $refresh_token = '';
	static private $expires_in = '';

	function method($method, $params=array(), $is_post=false)
	{
		$params['method'] = $method;
		$params['app_id'] = self::$client_id;
		$params['session_key'] = self::$access_token;
		$params['secure'] = 1;

		$params['sig'] = self::sign_server_server($params, self::$client_secret);

		$url = 'https://www.appsmail.ru/platform/api';
		if(!$is_post)
			$ret = PostingFunc::_curl_post($url.'?'.http_build_query($params), array());
		else
			$ret = PostingFunc::_curl_post($url, $params);
		return json_decode($ret, true);
	}

	function sign_server_server(array $request_params, $secret_key) {
		ksort($request_params);
		$params = '';
		unset($request_params['img_file']);
		foreach ($request_params as $key => $value) {
			$params .= "$key=$value";
		}
		return md5($params . $secret_key);
	}

	function set_vars($client_id, $client_secret, $access_token, $refresh_token, $expires_in, $id=0)
	{
		self::$client_id = $client_id;
		self::$client_secret = $client_secret;
		self::$access_token = $access_token;
		self::$refresh_token = $refresh_token;
		self::$expires_in = $expires_in;
		if($expires_in < time())
			self::update_token($id);
	}

	/**
	* Публикует запись в Мой Мир
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
		if(\COption::GetOptionString(PostingFunc::module_id(), 'is_mymailru_enable', false) != 'Y')
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
			if($arAccount['IS_ENABLE'] != 'Y')
				continue;

			$arPost['arAccount'] = $arAccount;
			$arPost['ACCPREFIX'] = Func::ACCPREFIX;

			self::set_vars(
				$arAccount['CLIENT_ID'],
				$arAccount['CLIENT_SECRET'],
				$arAccount['ACCESS_TOKEN'],
				$arAccount['REFRESH_TOKEN'],
				$arAccount['EXPIRES_IN'],
				$acc_id
			);
			$post_data = array();

			if(($type == 'delete' or $type == 'edit')
				&& $arAccount['MYMAILRU_PUBLICATION_MODE'] == 'none')
				continue;

			if(empty($arAccount['MYMAILRU_PUBLICATION_MODE']))
				$arAccount['MYMAILRU_PUBLICATION_MODE'] = 'update';

			if($type == 'delete'
				or ($type == 'edit' && $arAccount['MYMAILRU_PUBLICATION_MODE'] == 'del_add'))
			{
				if(!empty($post_id))
				{
				}
			}

			if($type != 'delete') {
				if($type == 'edit' && !empty($post_id)) {
				}
				else
				{
					if($arAccount['MYMAILRU_PHOTO'] != '' && $arAccount['MYMAILRU_PHOTO'] != 'none') {
						$res = self::upload_photo($arAccount['MYMAILRU_PHOTO'], $arFields, $arAccount);
						foreach ($res as $img) {
							$post_data['photo'][] = $arAccount['PAGE_ID'].':'.$img['pid'];
						}
					}
					elseif($arAccount['MYMAILRU_PHOTO_OTHER'] != $arAccount['MYMAILRU_PHOTO']
						&& $arAccount['MYMAILRU_PHOTO_OTHER'] != ''
						&& $arAccount['MYMAILRU_PHOTO_OTHER'] != 'none') {
						$res = self::upload_photo($arAccount['MYMAILRU_PHOTO_OTHER'], $arFields, $arAccount);
						foreach ($res as $img) {
							$post_data['photo'][] = $arAccount['PAGE_ID'].':'.$img['pid'];
						}
					}
					if(!empty($post_data['photo'])) {
						$post_data['photo'] = implode(',', $post_data['photo']);
					}

					$post_data['text'] = parent::replaceMacros($arAccount['MYMAILRU_MESSAGE'], $arFields, $arSite, $arPost);
					$post_data['text'] = strip_tags($post_data['text']);
					$post_data['text'] = $APPLICATION->ConvertCharset($post_data['text'], SITE_CHARSET, "UTF-8");
					$post_data['text'] = trim(html_entity_decode($post_data['text']));
					if(empty($post_data['text'])) {
						unset($post_data['text']);
					}

					$post_data['uid2'] = $arAccount['PAGE_ID'];
					$rs = self::method('multipost.send', $post_data, $is_post=true);
				}
			}
			if(empty($rs) && !empty($rs['error'])) {
				if(\COption::GetOptionString(PostingFunc::module_id(), 'mymailru_log_error', false) == 'Y') {
					if($type == 'delete')
						$text = GetMessage('MYMAILRU_ERROR_DELETE',
							array(
								'#MESSAGE#' => $rs['error']['error_msg'],
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);
					elseif (empty($rs))
						$text = GetMessage('MYMAILRU_UNKNOWN_ERROR',
							array(
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);
					else
						$text = GetMessage('MYMAILRU_ERROR',
							array(
								'#CODE#' => $rs['error']['error_code'],
								'#MESSAGE#' => $rs['error']['error_msg'],
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);

					PostingLogs::addLog('mymailru', $text, 'Error');
				}
			} else {
				if(!empty($rs['id'])) {
					$arResult[$acc_id]['id'] = $rs['id'];
					$rs2 = self::method('users.getInfo', array('uids' => $arAccount['PAGE_ID']));
					if (!empty($rs2[0]['link']))
					{
						if(isset($rs2[0]['app_count']))
						{
							$arResult[$acc_id]['url'] = $rs2[0]['link'].'micropost/'.$rs['id'].'.html';
						}
						else
						{
							$arResult[$acc_id]['url'] = $rs2[0]['link'].'multipost/'.$rs['id'].'.html';
						}
					}
				}
				if(\COption::GetOptionString(PostingFunc::module_id(), 'mymailru_log_success', false) == 'Y') {
					if($type == 'edit' && !empty($post_id))
						$text = GetMessage('MYMAILRU_SUCCESS_EDIT',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);
					elseif($type == 'delete')
						$text = GetMessage('MYMAILRU_SUCCESS_DELETE',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);
					else
						$text = GetMessage('MYMAILRU_SUCCESS',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]),
								'#ACC_NAME#' => parent::GetUrlPostAcc('mymailru', $acc_id, $arAccount['NAME']),
							)
						);
					PostingLogs::addLog('mymailru', $text, 'Success');
				}
			}
		}
		return $arResult;
	}

	function getUrlPost($arAccount, $arPostId)
	{
		return $arPostId['url'] ?: 'unknown';
	}

	function upload_photo($sProp, $arFields, $arAccount)
	{
		$result = array();
		$files = parent::getFilesFromProperty($sProp, $arFields);

		$params = array(
			'aid' => (strlen($arAccount['PAGE_ID']) >= 20 ? '_groupsphoto' : '_myphoto'),
			'uid2' => $arAccount['PAGE_ID'],
		);
		if (strlen($arAccount['PAGE_ID']) >= 20) { // группа
			$params = array(
				'aid' => '_groupsphoto',
				'uid2' => $arAccount['PAGE_ID'],
			);
		} else { // иначе профиль
			$params = array(
				'aid' => '_myphoto',
			);
		}
		foreach ($files as $file) {
			$params['img_file'] = parent::getCurlFilename($file);
			$rs = self::method('photos.upload', $params, true);
			if($rs && empty($rs['error']))
				$result[] = $rs;
		}
		return $result;
	}

	function GetPages($client_id, $client_secret, $access_token, $refresh_token, $expires_in)
	{
		if(empty($access_token) or empty($client_id) or empty($client_secret) or empty($refresh_token) or empty($expires_in))
			return array();

		self::set_vars($client_id, $client_secret, $access_token, $refresh_token, $expires_in);
		$res = self::method('users.getInfo', array());
		if(empty($res) or !empty($res['error']))
			return array();
		$result[$res[0]['uid']] = 'Profile ['.$res[0]['uid'].']';

		$res = self::method('groups.show', array('uid2'=>$res[0]['uid']));
		foreach($res['groups'] as $group)
			$result[$group['uid']] = $group['nick'].' ['.$group['uid'].']';

		return $result;
	}

	function update_token($id=0)
	{
		$data = array(
			'grant_type' => 'refresh_token',
			'client_id' => self::$client_id,
			'refresh_token' => self::$refresh_token,
			'client_secret' => self::$client_secret,
		);
		$ret = \Vettich\Autoposting\PostingFunc::_curl_post('https://appsmail.ru/oauth/token', $data);
		$ret = json_decode($ret, true);
		if(empty($ret) or !empty($ret['error']))
			return false;
		self::$access_token = $ret['access_token'];
		self::$refresh_token = $ret['refresh_token'];
		self::$expires_in = time() + intval($ret['expires_in']);
		if($id > 0) {
			try {
				$rs = DBTable::update($id, array(
					'ACCESS_TOKEN' => $ret['access_token'],
					'REFRESH_TOKEN' => $ret['refresh_token'],
					'EXPIRES_IN' => self::$expires_in,
				));
			} catch (\Exception $e) {}
		}
		return true;
	}
}