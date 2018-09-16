<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
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
			'NAME' => GetMessage('MYMAILRU_ACCOUNTS_NAME'),
			'IS_ENABLE' => GetMessage('MYMAILRU_IS_ENABLE'),
			'PAGE_ID' => GetMessage('MYMAILRU_PAGE_ID'),
			'ACCESS_TOKEN' => GetMessage('MYMAILRU_ACCESS_TOKEN'),
		);
	}

	static function ChangeRow(&$row)
	{
		if(empty($row))
			return;
		
		$row->AddInputField("NAME", array("size"=>20));
		$row->AddInputField("PAGE_ID", array("size"=>20));
		$row->AddInputField("ACCESS_TOKEN", array("size"=>20));
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
				'MYMAILRU_PHOTO' => 'DETAIL_PICTURE',
				'MYMAILRU_MESSAGE' => GetMessage('MYMAILRU_MESSAGE_DEFAULT'),
				'MYMAILRU_UTM_SOURCE' => 'mymailru',
			);
		}
		foreach($arValues as $k=>$v)
		{
			if(isset($_POST[$k]))
				if(empty($_POST[$k]) && $k != 'MYMAILRU_MESSAGE')
					unset($_POST[$k]);
		}
		$arPostParams = array(
			'TABS' => array(
				'MYMAILRU_TAB' => array(
					'NAME' => GetMessage('MYMAILRU_TAB_NAME'),
					'TITLE' => GetMessage('MYMAILRU_TAB_TITLE')
				)
			),
			'PARAMS' => array(
				'MYMAILRU_PHOTO' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('POST_MYMAILRU_PHOTO'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['MYMAILRU_PHOTO'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1011,
					'HELP' => GetMessage('POST_MYMAILRU_PHOTO_HELP'),
				),
				'MYMAILRU_PHOTO_OTHER' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('POST_MYMAILRU_PHOTO_OTHER'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['MYMAILRU_PHOTO_OTHER'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1020,
					'HELP' => GetMessage('POST_MYMAILRU_PHOTOS_HELP'),
				),
				'MYMAILRU_MESSAGE' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('POST_MYMAILRU_MESSAGE'),
					'TYPE' => 'TEXTAREA',
					'VALUE' => $arValues['MYMAILRU_MESSAGE'],
					'CHOISE' => 'SIMPLE',
					'VALUES' => $values,
					'SORT' => 1050,
					'HELP' => GetMessage('POST_MYMAILRU_MESSAGE_HELP'),
				),
				'MYMAILRU_PUBLICATION_MODE' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('MYMAILRU_PUBLICATION_MODE'),
					'TYPE' => 'LIST',
					'VALUES' => array(
						// 'update' => GetMessage('MYMAILRU_PUBLICATION_MODE_UPDATE'),
						// 'del_add' => GetMessage('MYMAILRU_PUBLICATION_MODE_DEL_ADD'),
						'none' => GetMessage('MYMAILRU_PUBLICATION_MODE_NONE'),
					),
					'VALUE' => $arValues['MYMAILRU_PUBLICATION_MODE'],
					'HELP' => GetMessage('MYMAILRU_PUBLICATION_MODE_HELP'),
					'SORT' => 160,
				),
				'MYMAILRU_UTM_SOURCE' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('UTM_SOURCE'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['MYMAILRU_UTM_SOURCE'],
					'SORT' => 3000,
					'HELP' => GetMessage('UTM_SOURCE_HELP')
				),
				'MYMAILRU_UTM_MEDIUM' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('UTM_MEDIUM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['MYMAILRU_UTM_SOURCE'],
					'SORT' => 3010,
					'HELP' => GetMessage('UTM_MEDIUM_HELP')
				),
				'MYMAILRU_UTM_CAMPAIGN' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('UTM_CAMPAIGN'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['MYMAILRU_UTM_SOURCE'],
					'SORT' => 3020,
					'HELP' => GetMessage('UTM_CAMPAIGN_HELP')
				),
				'MYMAILRU_UTM_TERM' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('UTM_TERM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['MYMAILRU_UTM_SOURCE'],
					'SORT' => 3030,
					'HELP' => GetMessage('UTM_TERM_HELP')
				),
				'MYMAILRU_UTM_CONTENT' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('UTM_CONTENT'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['MYMAILRU_UTM_SOURCE'],
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
				'NAME' => 'Autoposting to MyMailru ['.Func::GetNextIdDB().']',
				'IS_ENABLE' => 'Y',
			);
		}
		$pagesValue = self::getPagesValue($arValues['CLIENT_ID'],$arValues['CLIENT_SECRET'],$arValues['ACCESS_TOKEN'],$arValues['REFRESH_TOKEN'],$arValues['EXPIRES_IN']);
		$arModuleParams = array(
			'TAB_CONTROL_POSTFIX' => 'mymailru',
			'FORM' => array(
				'PARAMS' => array(
					'ID' => $index,
				),
				'TYPE' => array('WITH_PARAMS', 'NOT_DEFAULT'),
			),
			'TABS' => array(
				'MYMAILRU_TAB' => array(
					'NAME' => GetMessage('MYMAILRU_TAB_NAME'),
					'TITLE' => GetMessage('MYMAILRU_TAB_TITLE')
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
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('MYMAILRU_ACCOUNTS_NAME'),
					'VALUE' => $arValues['NAME'],
					'TYPE' => 'STRING',
					'REQUIRED' => 'Y',
					'SORT' => 100,
				),
				'IS_ENABLE' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('MYMAILRU_IS_ENABLE'),
					'VALUE' => $arValues['IS_ENABLE'],
					'TYPE' => 'CHECKBOX',
					'SORT' => 150,
				),
				'PAGE_ID' => array(
					'TAB' => 'MYMAILRU_TAB',
					'TYPE' => 'LIST',
					'NAME' => GetMessage('MYMAILRU_PAGE_ID'),
					'DESCRIPTION' => GetMessage('MYMAILRU_PAGE_ID_DESCRIPTION'),
					'VALUE' => $arValues['PAGE_ID'],
					'VALUES' => $pagesValue ?: array('' => ($arValues['ACCESS_TOKEN'] ? GetMessage('MYMAILRU_ACCESS_TOKEN_FAILED') : GetMessage('MYMAILRU_LOGIN_BEFORE'))),
					'SORT' => 250,
				),
				'ACCESS_TOKEN' => array(
					'TAB' => 'MYMAILRU_TAB',
					'NAME' => GetMessage('MYMAILRU_ACCESS_TOKEN'),
					'VALUE' => $arValues['ACCESS_TOKEN'],
					'TYPE' => 'STRING',
					'PLACEHOLDER' => GetMessage('MYMAILRU_ACCESS_TOKEN_PLACEHOLDER'),
				),
				'CLIENT_ID' => array(
					'TAB' => 'MYMAILRU_TAB',
					'VALUE' => $arValues['CLIENT_ID'],
					'TYPE' => 'HIDDEN',
				),
				'CLIENT_SECRET' => array(
					'TAB' => 'MYMAILRU_TAB',
					'VALUE' => $arValues['CLIENT_SECRET'],
					'TYPE' => 'HIDDEN',
				),
				'EXPIRES_IN' => array(
					'TAB' => 'MYMAILRU_TAB',
					'VALUE' => $arValues['EXPIRES_IN'],
					'TYPE' => 'HIDDEN',
				),
				'REFRESH_TOKEN' => array(
					'TAB' => 'MYMAILRU_TAB',
					'VALUE' => $arValues['REFRESH_TOKEN'],
					'TYPE' => 'HIDDEN',
				),
			)
		);

		$cont = '<div onclick="vch_autopostingplus_mymailru_get_token(this)" class="voptions-add-button">'
				.GetMessage('MYMAILRU_GET_ACCESS_TOKEN')
			.'</div>';
		$arModuleParams['PARAMS']['USER_INFO_AREA'] = array(
			'TAB' => 'MYMAILRU_TAB',
			'NAME' => '',
			'TYPE' => 'CUSTOM',
			'HTML' => $cont,
			'SORT' => 500,
		);
		$hlp = PostingFunc::vettich_service('get_url', 'url=autoposting.mymailru.video_help');
		if(!empty($hlp['url']))
		{
			$arModuleParams['TABS']['MYMAILRU_TAB_VIDEO'] = array(
				'NAME' => GetMessage('MYMAILRU_TAB_VIDEO_NAME'),
				'TITLE' => GetMessage('MYMAILRU_TAB_VIDEO_TITLE')
			);
			$arModuleParams['PARAMS']['video_help'] = array(
				'TAB' => 'MYMAILRU_TAB_VIDEO',
				'TYPE' => 'NOTE',
				'TEXT' => PostingFunc::get_youtube_frame($hlp['url']),
			);
		}

		// global $arIncludeJS;
		// $arIncludeJS[] = '/bitrix/js/vettich.autopostingplus/mymailru_option.js';

		return $arModuleParams;
	}

	function getPagesValue($client_id, $client_secret, $access_token, $refresh_token, $expires_in)
	{
		global $APPLICATION;
		if(empty($access_token))
			return false;

		$pages = \Vettich\AutopostingPlus\Posts\mymailru\Posting::GetPages($client_id, $client_secret, $access_token, $refresh_token, $expires_in);
		foreach($pages as $id=>$page)
			$pages[$id] = $APPLICATION->ConvertCharset($page, "UTF-8", SITE_CHARSET);

		return $pages;
	}
}
