<?
namespace Vettich\AutopostingPlus\Posts\googleplus;
use Vettich\Autoposting\PostingOption;
use Vettich\Autoposting\PostingFunc;

IncludeModuleLangFile(__FILE__);

class Option extends \Vettich\Autoposting\PostsBase\OptionBase
{
	static $dbTable = Func::DBTABLE;
	static $dbOptionTable = Func::DBOPTIONTABLE;
	static $accPrefix = Func::ACCPREFIX;

	static function GetFields()
	{
		return array(
			'ID' => 'ID',
			'NAME' => GetMessage('GOOGLEPLUS_ACCOUNTS_NAME'),
			'IS_ENABLE' => GetMessage('GOOGLEPLUS_IS_ENABLE'),
			'EMAIL' => GetMessage('GOOGLEPLUS_EMAIL'),
			'PAGE_ID' => GetMessage('GOOGLEPLUS_PAGE_ID'),
		);
	}

	static function ChangeRow(&$row)
	{
		if(empty($row))
			return;
		
		$row->AddInputField("NAME", array("size"=>20));
		$row->AddViewField('IS_ENABLE', $row->arRes['IS_ENABLE'] == 'Y' ? GetMessage('YES') : GetMessage('NO'));
		$row->AddCheckField('IS_ENABLE');
	}

	static function GetArModuleParamsPosts($index, $iblock_id=false)
	{
		$arProps = PostingOption::getProps();
		if(!$iblock_id)
			$iblock_id = PostingOption::GetByID($index, 'IBLOCK_ID');
		$values = $arProps[$iblock_id] ?: $arProps['none'];
		$arValues = Func::GetValues($index, Func::DBOPTIONTABLE);
		if(empty($arValues))
		{
			$arValues = array(
				'GOOGLEPLUS_PUBLISH_DATE' => '',
				'GOOGLEPLUS_PHOTOS' => '',
				'GOOGLEPLUS_PHOTO' => 'DETAIL_PICTURE',
				'GOOGLEPLUS_LINK' => 'DETAIL_PAGE_URL',
				'GOOGLEPLUS_MESSAGE' => GetMessage('GOOGLEPLUS_MESSAGE_DEFAULT'),
				'GOOGLEPLUS_UTM_SOURCE' => 'googleplus',
			);
		}
		foreach($arValues as $k=>$v)
		{
			if(isset($_POST[$k]))
				if(empty($_POST[$k]) && $k != 'GOOGLEPLUS_MESSAGE')
					unset($_POST[$k]);
		}
		$arPostParams = array(
			'TABS' => array(
				'GOOGLEPLUS_TAB' => array(
					'NAME' => GetMessage('GOOGLEPLUS_TAB_NAME'),
					'TITLE' => GetMessage('GOOGLEPLUS_TAB_TITLE')
				)
			),
			'PARAMS' => array(
/*				'GOOGLEPLUS_PHOTO' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('POST_GOOGLEPLUS_PHOTO'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['GOOGLEPLUS_PHOTO'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1011,
					'HELP' => GetMessage('POST_GOOGLEPLUS_PHOTO_HELP'),
				),
				'GOOGLEPLUS_PHOTOS' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('POST_GOOGLEPLUS_PHOTOS'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['GOOGLEPLUS_PHOTOS'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1020,
					'HELP' => GetMessage('POST_GOOGLEPLUS_PHOTOS_HELP'),
				),*/
				'GOOGLEPLUS_LINK' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('POST_GOOGLEPLUS_LINK'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['GOOGLEPLUS_LINK'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1030,
					'HELP' => GetMessage('POST_GOOGLEPLUS_LINK_HELP'),
				),
				'GOOGLEPLUS_MESSAGE' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('POST_GOOGLEPLUS_MESSAGE'),
					'TYPE' => 'TEXTAREA',
					'VALUE' => $arValues['GOOGLEPLUS_MESSAGE'],
					'CHOISE' => 'SIMPLE',
					'VALUES' => $values,
					'SORT' => 1050,
					'HELP' => GetMessage('POST_GOOGLEPLUS_MESSAGE_HELP'),
				),
				'GOOGLEPLUS_PUBLICATION_MODE' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('GOOGLEPLUS_PUBLICATION_MODE'),
					'TYPE' => 'LIST',
					'VALUES' => array(
						'update' => GetMessage('GOOGLEPLUS_PUBLICATION_MODE_UPDATE'),
						'del_add' => GetMessage('GOOGLEPLUS_PUBLICATION_MODE_DEL_ADD'),
						'none' => GetMessage('GOOGLEPLUS_PUBLICATION_MODE_NONE'),
					),
					'VALUE' => $arValues['GOOGLEPLUS_PUBLICATION_MODE'],
					'HELP' => GetMessage('GOOGLEPLUS_PUBLICATION_MODE_HELP'),
					'SORT' => 160,
				),
				'GOOGLEPLUS_UTM_SOURCE' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('UTM_SOURCE'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['GOOGLEPLUS_UTM_SOURCE'],
					'SORT' => 3000,
					'HELP' => GetMessage('UTM_SOURCE_HELP')
				),
				'GOOGLEPLUS_UTM_MEDIUM' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('UTM_MEDIUM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['GOOGLEPLUS_UTM_MEDIUM'],
					'SORT' => 3010,
					'HELP' => GetMessage('UTM_MEDIUM_HELP')
				),
				'GOOGLEPLUS_UTM_CAMPAIGN' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('UTM_CAMPAIGN'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['GOOGLEPLUS_UTM_CAMPAIGN'],
					'SORT' => 3020,
					'HELP' => GetMessage('UTM_CAMPAIGN_HELP')
				),
				'GOOGLEPLUS_UTM_TERM' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('UTM_TERM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['GOOGLEPLUS_UTM_TERM'],
					'SORT' => 3030,
					'HELP' => GetMessage('UTM_TERM_HELP')
				),
				'GOOGLEPLUS_UTM_CONTENT' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('UTM_CONTENT'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['GOOGLEPLUS_UTM_CONTENT'],
					'SORT' => 3040,
					'HELP' => GetMessage('UTM_CONTENT_HELP')
				),
			),
		);

		return $arPostParams;
	}

	static function GetArModuleParams($index)
	{
		$arValues = Func::GetValues($index);
		if(empty($arValues))
		{
			$arValues = array(
				'NAME' => 'Autoposting to Google+ ['.Func::GetNextIdDB().']',
				'IS_ENABLE' => 'Y',
				'IS_GROUP_PUBLISH' => 'N',
				'GROUP_PUBLISH' => 'Y',
				'GROUP_ID_STD' => 'Y',
			);
		}
		$pagesValue = self::getPagesValue($arValues['EMAIL'], $arValues['PASS']);
		$arModuleParams = array(
			'TAB_CONTROL_POSTFIX' => 'googleplus',
			'FORM' => array(
				'PARAMS' => array(
					'ID' => $index,
				),
				'TYPE' => array('WITH_PARAMS', 'NOT_DEFAULT'),
			),
			'TABS' => array(
				'GOOGLEPLUS_TAB' => array(
					'NAME' => GetMessage('GOOGLEPLUS_TAB_NAME'),
					'TITLE' => GetMessage('GOOGLEPLUS_TAB_TITLE')
				)
			),
			'BUTTONS' => array(
				'SAVE' => array(
					'NAME' => GetMessage('SAVE_BUTTON'),
				),
				'APPLY' => array(
					'NAME' => GetMessage('APPLY_BUTTON'),
				),
				'RESTORE_DEFAULTS' => array(
					'ENABLE' => 'N',
				)
			),
			'PARAMS' => array(
				'NAME' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('GOOGLEPLUS_ACCOUNTS_NAME'),
					'DESCRIPTION' => GetMessage('GOOGLEPLUS_ACCOUNTS_NAME_DESCRIPTION'),
					'VALUE' => $arValues['NAME'],
					'TYPE' => 'STRING',
					'REQUIRED' => 'Y',
					'SORT' => 100,
				),
				'IS_ENABLE' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('GOOGLEPLUS_IS_ENABLE'),
					'VALUE' => $arValues['IS_ENABLE'],
					'TYPE' => 'CHECKBOX',
					'SORT' => 150,
				),
				'PROFILE_ID' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'VALUE' => $arValues['PROFILE_ID'],
					'TYPE' => 'HIDDEN',
					'SORT' => 151,
				),
				'PAGE_ID' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'TYPE' => 'LIST',
					'NAME' => GetMessage('PAGE_ID'),
					'DESCRIPTION' => GetMessage('PAGE_ID_DESCRIPTION'),
					'VALUE' => $arValues['PAGE_ID'],
					'VALUES' => $pagesValue ?: array('' => GetMessage('GOOGLEPLUS_LOGIN_BEFORE')),
					'SORT' => 250,
				),
				'EMAIL' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('GOOGLEPLUS_ACCOUNTS_EMAIL'),
					'VALUE' => $arValues['EMAIL'],
					'TYPE' => 'STRING',
				),
				'PASS' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'NAME' => GetMessage('GOOGLEPLUS_ACCOUNTS_PASS'),
					'VALUE' => $arValues['PASS'],
					'TYPE' => 'PASSWORD',
				),
				'BETA_DESC' => array(
					'TAB' => 'GOOGLEPLUS_TAB',
					'TYPE' => 'NOTE',
					'TEXT' => GetMessage('GOOGLEPLUS_BETA_DESC'),
					'SORT' => 1000,
				),
			)
		);

		$content = '';
		if(!empty($arValues['EMAIL']) && !empty($arValues['PASS']))
			$content = $pagesValue
				? GetMessage('GOOGLEPLUS_JS_LOGIN_SUCCESS')
				: GetMessage('GOOGLEPLUS_JS_LOGIN_FAIL');
		$gplus_info = 
			'<script>'
				.'var GOOGLEPLUS_JS_EMAIL_EMPTY = '.\VOptions::_json_encode(GetMessage('GOOGLEPLUS_JS_EMAIL_EMPTY')).';'
				.'var GOOGLEPLUS_JS_PASS_EMPTY = '.\VOptions::_json_encode(GetMessage('GOOGLEPLUS_JS_PASS_EMPTY')).';'
				.'var GOOGLEPLUS_JS_LOGIN_SUCCESS = '.\VOptions::_json_encode(GetMessage('GOOGLEPLUS_JS_LOGIN_SUCCESS')).';'
				.'var GOOGLEPLUS_JS_LOGIN_FAIL = '.\VOptions::_json_encode(GetMessage('GOOGLEPLUS_JS_LOGIN_FAIL')).';'
				.'var GOOGLEPLUS_JS_PLS_WAIT = '.\VOptions::_json_encode(GetMessage('GOOGLEPLUS_JS_PLS_WAIT')).';'
			.'</script>'
			.'<div onclick="vch_autopostingplus_gplus_login(\'vch_autopostingplus_gplus_login_content\')" class="voptions-add-button">'
				.GetMessage('VCH_GPLUS_LOGIN')
			.'</div>'
			.'<div id="vch_autopostingplus_gplus_login_content" style="margin-top:10px;padding-left:20px;font-weight: bold;">'
				.$content
			.'<div>';

		$arModuleParams['PARAMS']['USER_INFO_AREA'] = array(
			'TAB' => 'GOOGLEPLUS_TAB',
			'NAME' => '',
			'TYPE' => 'CUSTOM',
			'HTML' => $gplus_info,
			'SORT' => 500,
		);

		$hlp = PostingFunc::vettich_service('get_url', 'url=autoposting.googleplus.video_help');
		if(!empty($hlp['url']))
		{
			$arModuleParams['TABS']['GOOGLEPLUS_TAB_VIDEO'] = array(
				'NAME' => GetMessage('GOOGLEPLUS_TAB_VIDEO_NAME'),
				'TITLE' => GetMessage('GOOGLEPLUS_TAB_VIDEO_TITLE')
			);
			$arModuleParams['PARAMS']['video_help'] = array(
				'TAB' => 'GOOGLEPLUS_TAB_VIDEO',
				'TYPE' => 'NOTE',
				'TEXT' => PostingFunc::get_youtube_frame($hlp['url']),
			);
		}

		global $arIncludeJS;
		$arIncludeJS[] = '/bitrix/js/vettich.autopostingplus/googleplus_options.js';

		return $arModuleParams;
	}

	function getPagesValue($email, $pass)
	{
		if(empty($email) or empty($pass))
			return false;
		$profileID = Posting::is_login_correct($email, $pass);
		if(!$profileID)
			return false;
		$result = array('p'.$profileID => 'Profile ['.$profileID.']');
		$pages = Posting::get_pages();
		foreach($pages as $page)
		{
			$prefix = 'c';
			if(!empty($page[2]))
				$prefix = $page[2];
			$page[1] = $GLOBALS['APPLICATION']->ConvertCharset($page[1], "UTF-8", SITE_CHARSET);
			$result[$prefix.$page[0]] = $page[1] .' ['.$page[0].']';
		}
		return $result;
	}
}
