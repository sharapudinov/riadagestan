<?
namespace Vettich\AutopostingPlus\Posts\googleplus;
use Vettich\Autoposting\PostingFunc;
use Vettich\Autoposting\PostingLogs;

IncludeModuleLangFile(__FILE__);

class Posting extends \Vettich\Autoposting\Posting
{
	const COOKIE = 'googleplus';
	static private $COOKIE = '';

	const GPLUS_PROFILE = 1;
	const GPLUS_BPAGE = 2;
	const GPLUS_CPAGE = 3;

	/**
	* Публикует запись в Google+
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

		if(\COption::GetOptionString(PostingFunc::module_id(), 'is_googleplus_enable', false) != 'Y')
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

			self::$COOKIE = self::COOKIE.'_'.$arAccount['EMAIL'];
			$is_init = false;
			if(self::init($arAccount['EMAIL'], $arAccount['PASS']))
			{
				$is_init = true;
				$post_data = array();

				if(($type == 'delete' or $type == 'edit')
					&& $arAccount['GOOGLEPLUS_PUBLICATION_MODE'] == 'none')
					continue;

				if(empty($arAccount['GOOGLEPLUS_PUBLICATION_MODE']))
					$arAccount['GOOGLEPLUS_PUBLICATION_MODE'] = 'update';

				if($type == 'delete'
					or ($type == 'edit' && $arAccount['GOOGLEPLUS_PUBLICATION_MODE'] == 'del_add'))
				{
					if(!empty($post_id))
					{
					}
				}

				if($type != 'delete')
				{
					$post_data['text'] = parent::replaceMacros($arAccount['GOOGLEPLUS_MESSAGE'], $arFields, $arSite, $arPost);
					$post_data['text'] = strip_tags($post_data['text']);
					$post_data['text'] = $APPLICATION->ConvertCharset($post_data['text'], SITE_CHARSET, "UTF-8");
					$post_data['text'] = trim(html_entity_decode($post_data['text']));

/*					if($arAccount['GOOGLEPLUS_PHOTO'] != '' && $arAccount['GOOGLEPLUS_PHOTO'] != 'none')
					{
						$res = self::attach_photo($arAccount['GOOGLEPLUS_PHOTO'], $arFields, $arAccount, $arPost);
						if(!empty($res))
							$post_data['attachments'] = $res;
					}
					if($arAccount['GOOGLEPLUS_PHOTOS'] != $arAccount['GOOGLEPLUS_PHOTO']
						&& $arAccount['GOOGLEPLUS_PHOTOS'] != ''
						&& $arAccount['GOOGLEPLUS_PHOTOS'] != 'none')
					{
						$res = self::attach_photo($arAccount['GOOGLEPLUS_PHOTOS'], $arFields, $arAccount, $arPost);
						if(!empty($res))
							$post_data['attachments'] = array_merge((array)$post_data['attachments'], $res);
					}
					if(count($post_data['attachments']) > 10)
						array_splice($post_data['attachments'], 10);
*/

					if($arAccount['GOOGLEPLUS_LINK'] != '' && $arAccount['GOOGLEPLUS_LINK'] != 'none')
					{
						$res = self::getLinkFromProperty($arAccount['GOOGLEPLUS_LINK'], $arFields, $arPost, $arSite);
						if(!empty($res))
						{
							$post_data['attach']['url'] = $res;
						}
					}

					$post_data['page_id'] = substr($arAccount['PAGE_ID'], 1);
					$post_data['page_type'] = ($arAccount['PAGE_ID'][0] == 'b' ? 
						self::GPLUS_BPAGE
						: ($arAccount['PAGE_ID'][0] == 'c' ?
							self::GPLUS_CPAGE 
							: self::GPLUS_PROFILE));
					$post_data['profile_id'] = $arAccount['PROFILE_ID'];
					// $post_data['attach']['url'] = 'http://vettich.ru';
					// $post_data['attach']['url_title'] = 'title';
					// $post_data['attach']['url_desc'] = 'desc';
					$rs = self::gpost($post_data);
					$rs = array_shift($rs);
				}
			}

			if(!$is_init)
			{
				if(\COption::GetOptionString(PostingFunc::module_id(), 'googleplus_log_error', false) == 'Y')
				{
					$text = GetMessage('GOOGLEPLUS_ERROR_INIT',
						array(
							'#ACC_NAME#' => parent::GetUrlPostAcc('vk', $acc_id, $arAccount['NAME']),
						)
					);
					PostingLogs::addLog('googleplus', $text, 'Error');
				}
			}
			elseif(empty($rs) or $rs[0] == 'er')
			{
				if(\COption::GetOptionString(PostingFunc::module_id(), 'googleplus_log_error', false) == 'Y')
				{
					if(empty($rs))
					{
						$text = GetMessage('GOOGLEPLUS_ERROR_EMPTY',
							array(
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
							)
						);
					}
					elseif($rs[5] == 400)
					{
						$text = GetMessage('GOOGLEPLUS_ERROR_400',
							array(
								'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
								'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
								'#ID#' => $arFields['ID'],
								'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
							)
						);
					}
					else
					{
						if($type == 'delete')
							$text = GetMessage('GOOGLEPLUS_ERROR_DELETE',
								array(
									'#CODE#' => $rs[5],
									'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
									'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
									'#ID#' => $arFields['ID'],
									'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
								)
							);
						else
							$text = GetMessage('GOOGLEPLUS_ERROR',
									array(
										'#CODE#' => $rs[5],
										'#IBLOCK_ID#' => $arFields['IBLOCK_ID'],
										'#IBLOCK_TYPE#' => $arFields['IBLOCK_TYPE_ID'],
										'#ID#' => $arFields['ID'],
										'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
									)
								);

					}
					PostingLogs::addLog('googleplus', $text, 'Error');
				}
			}
			else
			{
				if(!empty($rs[1]))
				{
					$arResult[$acc_id] = array(
						'url' => $rs[1][0][0][131],
						'post_id' => substr($rs[1][0][0][131], strrpos($rs[1][0][0][131], '/') + 1),
						'profile_id' => $arAccount['PROFILE_ID'],
					);
				}
				if(\COption::GetOptionString(PostingFunc::module_id(), 'googleplus_log_success', false) == 'Y')
				{
					if($type == 'edit' && !empty($post_id))
						$text = GetMessage('GOOGLEPLUS_SUCCESS_EDIT',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]['url']),
								'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
							)
						);
					elseif($type == 'delete')
						$text = GetMessage('GOOGLEPLUS_SUCCESS_DELETE',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]['url']),
								'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
							)
						);
					else
						$text = GetMessage('GOOGLEPLUS_SUCCESS',
							array(
								'#URL#' => self::getUrlPost($arAccount, $arResult[$acc_id]['url']),
								'#ACC_NAME#' => parent::GetUrlPostAcc('googleplus', $acc_id, $arAccount['NAME']),
							)
						);
					PostingLogs::addLog('googleplus', $text, 'Success');
				}
			}
		}
		return $arResult;
	}

	function getUrlPost($arAccount, $post_id)
	{
		if(is_array($post_id))
			return $post_id['url'];
		return $post_id;
	}

	function get_val_from_txt($txt, $name, $search = 'name="#name#"', $sig_begin = 'value="', $sig_end = '">', &$start_pos=0)
	{
		$ppos = strpos($txt, str_replace('#name#', $name, $search), $start_pos);
		if($ppos === false)
			return false;
		$inp_start_pos = strpos($txt, $sig_begin, $ppos);
		if($inp_start_pos === false)
			return false;
		$inp_start_pos += strlen($sig_begin);
		$start_pos = $inp_start_pos;
		return substr(
			$txt,
			$inp_start_pos,
			strpos($txt, $sig_end, $inp_start_pos) - $inp_start_pos
		);
	}

	function get_js_var_str_from_txt($txt, $var_name)
	{
		return self::get_val_from_txt($txt, $var_name, 'var #name# =', '= \'', '\';');
	}

	function get_js_var_str_from_array($txt, $var_name)
	{
		return self::get_val_from_txt($txt, $var_name, '"#name#":', ':"', '",');
	}

	function get_profile_id_from_txt($txt)
	{
		return self::get_val_from_txt($txt, '', '"qDCSke"', ':"', '",');
	}

	function init($email, $pass)
	{
		$url = 'https://accounts.google.com';
		$res = PostingFunc::_curl_post($url, array(), self::$COOKIE);
		if(self::get_val_from_txt($res, 'GALX'))
		{
			$url = 'https://accounts.google.com/AccountLoginInfo';
			$post_data = array(
				'Page' => 'PasswordSeparationSignIn',
				'continue' => 'https://accounts.google.com/ManageAccount',
				'followup' => 'https://accounts.google.com/ManageAccount',
				'ProfileInformation' => '',
				'_utf8' => '&#9731;', // '☃',
				'bgresponse' => 'js_disabled',
				'Email' => $email,
				'signIn' => 'Next',
				'GALX' => self::get_val_from_txt($res, 'GALX'),
				'gxf' => self::get_val_from_txt($res, 'gxf'),
			);
			$res = PostingFunc::_curl_post($url, $post_data, self::$COOKIE);

			$url = 'https://accounts.google.com/ServiceLoginAuth';
			$post_data = array(
				'Page' => 'PasswordSeparationSignIn',
				'continue' => 'https://accounts.google.com/ManageAccount',
				'followup' => 'https://accounts.google.com/ManageAccount',
				'ProfileInformation' => self::get_val_from_txt($res, 'ProfileInformation'),
				'_utf8' => '&#9731;', // '☃',
				'bgresponse' => 'js_disabled',
				'Email' => $email,
				'Passwd' => $pass,
				'signIn' => 'Sign in',
				'GALX' => self::get_val_from_txt($res, 'GALX'),
				'gxf' => self::get_val_from_txt($res, 'gxf'),
			);
			$res = PostingFunc::_curl_post($url, $post_data, self::$COOKIE);

			$url = 'https://accounts.google.com';
			$res = PostingFunc::_curl_post($url, array(), self::$COOKIE);
			if(self::get_val_from_txt($res, 'GALX'))
				return false;
		}
		return self::get_profile_id_from_txt($res);
	}

	function is_login_correct($email, $pass)
	{
		self::$COOKIE = self::COOKIE.'_'.$email;
		return self::init($email, $pass);
	}

	function get_pages()
	{
		$url = 'https://plus.google.com/communities';
		$res = PostingFunc::_curl_post($url, array(), self::$COOKIE);
		$result = array();
		$pos = 0;
		while($community_id = self::get_val_from_txt($res, '', 'class="k9c mke Pic I8c RbAFad" data-comm', 'data-comm="', '">', $pos))
		{
			$community_name = self::get_val_from_txt($res, '', '[["'.$community_id, '",["', '","');
			$result[] = array($community_id, $community_name, 'c');
			$ind++;
			if($ind>100)
				break;
		}

		$url = 'https://accounts.google.com/b/0/ListAccounts?listPages=1&fwput=10&rdr=1100&mo=1&mn=1&hl=ru&origin=https://plus.google.com';
		$res1 = PostingFunc::_curl_post($url, array(), self::$COOKIE);
		$jres = self::get_val_from_txt($res1, '', "window.parent.postMessage(\n  \"", '"', '",');
		$jres = stripcslashes($jres);
		$jres = json_decode($jres, true);
		if(!empty($jres)) {
			$jres_len = count($jres[1]);
			for ($i=1; $i < $jres_len; $i++) {
				$result[] = array(
					$GLOBALS['APPLICATION']->ConvertCharset($jres[1][$i][10], "UTF-8", SITE_CHARSET),
					$GLOBALS['APPLICATION']->ConvertCharset($jres[1][$i][2], "UTF-8", SITE_CHARSET),
					'b'
				);
			}
		}
		return $result;
	}

	function gpost($params)
	{
		if($params['page_type'] == self::GPLUS_BPAGE)
			$url = 'https://plus.google.com/b/'.$params['page_id'];
		elseif($params['page_type'] == self::GPLUS_CPAGE)
			$url = 'https://plus.google.com/communities/'.$params['page_id'];
		else
			$url = 'https://plus.google.com';
		$curl_params = array(
			'cookie_type' => 1,
			'cookie_postfix' => self::$COOKIE,
			'enctype' => PostingFunc::CURL_ENCTYPE_APPLICATION,
		);
		$res1 = PostingFunc::curl_post($url, array(), $curl_params);
		$get_data = array(
			'spam' => 4,
			'soc-app' => $params['page_type'] == self::GPLUS_CPAGE ? 5 : 1,
			'cid' => 0,
			'soc-platform' => 1,
			'ozv' => self::get_js_var_str_from_txt($res1, 'OZ_buildLabel'),
			'avw' => ($params['page_type'] == self::GPLUS_BPAGE ?
				'pr:pr'
				: ($params['page_type'] == self::GPLUS_CPAGE ?
					'sq:1'
					: 'str:1')),
			'f.sid' => self::get_js_var_str_from_txt($res1, 'OZ_afsid'),
			'_reqid' => '23419',
			'rt' => 'j',
		);

		$next_post_sig = \COption::GetOptionString('vettich.autopostingplus', 'googleplus_next_post_sig', str_repeat('a', 16));
		\COption::SetOptionString('vettich.autopostingplus', 'googleplus_next_post_sig', ++$next_post_sig);

		if($params['page_type'] != self::GPLUS_BPAGE)
			$url = 'https://plus.google.com';
		$url = $url.'/_/sharebox/post/?'.http_build_query($get_data);

		$url_attach = 'null';
		if(!empty($params['attach']['url'])) {
			$urlWithoutSheme = str_replace(array('http://' ,'https://'), '', $params['attach']['url']);
			$url_attach = '[[337,336,335,0],"'.$params['attach']['url'].'",null,null,null,null,[1477158730222,"'.$params['attach']['url'].'","'.$params['attach']['url'].'",null,["synthesized-http://schema.org/WebPage"]],"'.$params['attach']['url'].'",{"40154698":["'.$params['attach']['url'].'",null,"'.$params['attach']['url_title'].'","'.$params['attach']['url_desc'].'",null,null,"//s2.googleusercontent.com/s2/favicons?domain='.$urlWithoutSheme.'",[],null,null,[],"'.$urlWithoutSheme.'",null,[],[],[],[],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,[],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,[],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,"'.$params['attach']['url'].'"]}]';
		}
		$post_data = array(
			'f.req' => ($params['page_type'] == self::GPLUS_CPAGE ?
					'['.json_encode($params['text']).',"oz:'.$params['profile_id'].'.'.$next_post_sig.'",null,null,null,null,null,null,null,false,[],null,null,null,[],null,false,null,null,null,null,null,null,null,null,null,null,null,null,false,null,null,null,null,'.$url_attach.',null,[["'.$params['page_id'].'","'.self::get_val_from_txt($res1, '', ',[[["', ',[[["', '",').'"]],[[[null,null,null,["'.$params['page_id'].'"]]]],null,null,2,null,null,null,"",null,null,null,[],[[true]],null,[]]'
					: ('['.json_encode($params['text']).',"oz:'.$params['page_id'].'.'.$next_post_sig.'",null,null,null,null,null,null,null,true,[],false,null,null,[],null,false,null,null,null,null,null,null,null,null,null,null,false,false,false,null,null,null,null,'
						.$url_attach.',null,[],[[[null,null,1]],null],null,null,2,null,null,null,"",null,null,null,[],[[true]],null,[]]')),
			'at' => self::get_val_from_txt($res1, '', '"https://csi.gstatic.com/csi"', ',"', '",'),
		);
		$res = PostingFunc::curl_post($url, $post_data, $curl_params);
		$ret = \VOptions::_json_decode(substr($res, 4), true);
		if(is_array($ret))
		{
			return array_shift($ret);
		}
		return false;
	}

	function attach_photo($sProp, $arFields, $arAccount, $arPost)
	{
		$result = array();
		$files = parent::getFilesFromProperty($sProp, $arFields);
		if(!empty($files))
		{
			$rs = self::upload_files($files, $arAccount);
			if(isset($rs['response']) && !empty($rs['response']))
				foreach($rs['response'] as $value)
				{
					$result[] = $value['id'];
				}
		}
		return $result;
	}

	function upload_files($arFilesName, $arAccount, $sFileType='photo')
	{
		if($sFileType == 'photo')
		{
			if(count($arFilesName) > 5)
			{
				$arFilesName = array_chunk($arFilesName, 5);
				$ret = array();
				foreach($arFilesName as $arr)
				{
					$ret = array_merge_recursive($ret, self::upload_files($arr, $arAccount, $sFileType));
				}
				return $ret;
			}

			$files = array();
			foreach($arFilesName as $key => $fileName)
			{
				if(count($files) >= 10)
					break;
				$files['file'.(count($files)+1)] = parent::getCurlFilename($fileName);
			}

			$params = array('access_token' => $arAccount['ACCESS_TOKEN']);
			if($arAccount['GROUP_PUBLISH'] == 'Y')
				$params['group_id'] = $arAccount['GROUP_PUBLISH_ID'];
			else
				$params['user_id'] = $arAccount['GROUP_PUBLISH_ID'];
			$dataArray = self::method('photos.getWallUploadServer', $params);

			$response = json_decode(PostingFunc::_curl_post($dataArray['response']['upload_url'], $files, false), 1);
			$response_photo = json_decode($response['photo'],1);
			if(empty($response) or empty($response_photo))
				return false;

			$data = array(
				'group_id' => $arAccount['GROUP_PUBLISH_ID'],
				'photo' => $response['photo'],
				'server' => $response['server'],
				'hash' => $response['hash'],
				'access_token' => $arAccount['ACCESS_TOKEN'],
			);
			return self::method('photos.saveWallPhoto', $data);
		}
		elseif($sFileType == 'video')
		{
			// todo
			// разобраться с отправкой видео, и реализовать...в будущем...возможно...если не передумаю
			return false;

			$data = array(
				'name' => $arFilesName['title'],
				'link' => $arFilesName['path'],
				'access_token' => $arAccount['ACCESS_TOKEN'],
			);
			return self::method('video.save', $data);
		}
	}
}