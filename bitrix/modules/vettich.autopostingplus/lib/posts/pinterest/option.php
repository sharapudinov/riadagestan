<?
namespace Vettich\AutopostingPlus\Posts\pinterest;
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
			'NAME' => GetMessage('PINTEREST_ACCOUNTS_NAME'),
			'IS_ENABLE' => GetMessage('PINTEREST_IS_ENABLE'),
			'PAGE_ID' => GetMessage('PINTEREST_PAGE_ID'),
			'ACCESS_TOKEN' => GetMessage('PINTEREST_ACCESS_TOKEN'),
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
				'PINTEREST_PHOTO_OTHER' => 'PREVIEW_PICTURE',
				'PINTEREST_PHOTO' => 'DETAIL_PICTURE',
				'PINTEREST_LINK' => 'DETAIL_PAGE_URL',
				'PINTEREST_MESSAGE' => GetMessage('PINTEREST_MESSAGE_DEFAULT'),
				'PINTEREST_UTM_SOURCE' => 'pinterest',
			);
		}
		foreach($arValues as $k=>$v)
		{
			if(isset($_POST[$k]))
				if(empty($_POST[$k]) && $k != 'PINTEREST_MESSAGE')
					unset($_POST[$k]);
		}
		$arPostParams = array(
			'TABS' => array(
				'PINTEREST_TAB' => array(
					'NAME' => GetMessage('PINTEREST_TAB_NAME'),
					'TITLE' => GetMessage('PINTEREST_TAB_TITLE')
				)
			),
			'PARAMS' => array(
				'PINTEREST_PHOTO' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('POST_PINTEREST_PHOTO'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['PINTEREST_PHOTO'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1011,
					'HELP' => GetMessage('POST_PINTEREST_PHOTO_HELP'),
				),
				'PINTEREST_PHOTO_OTHER' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('POST_PINTEREST_PHOTO_OTHER'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['PINTEREST_PHOTO_OTHER'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1020,
					'HELP' => GetMessage('POST_PINTEREST_PHOTOS_HELP'),
				),
				'PINTEREST_LINK' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('POST_PINTEREST_LINK'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['PINTEREST_LINK'],
					'MULTIPLE' => 'N',
					'REQUEST_VALUE_NOT_USE_IS_EMPTY' => 'Y',
					'SIZE' => 0,
					'SORT' => 1030,
					'HELP' => GetMessage('POST_PINTEREST_LINK_HELP'),
				),
				'PINTEREST_MESSAGE' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('POST_PINTEREST_MESSAGE'),
					'TYPE' => 'TEXTAREA',
					'VALUE' => $arValues['PINTEREST_MESSAGE'],
					'CHOISE' => 'SIMPLE',
					'VALUES' => $values,
					'SORT' => 1050,
					'HELP' => GetMessage('POST_PINTEREST_MESSAGE_HELP'),
				),
				'PINTEREST_PUBLICATION_MODE' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('PINTEREST_PUBLICATION_MODE'),
					'TYPE' => 'LIST',
					'VALUES' => array(
						'update' => GetMessage('PINTEREST_PUBLICATION_MODE_UPDATE'),
						'del_add' => GetMessage('PINTEREST_PUBLICATION_MODE_DEL_ADD'),
						'none' => GetMessage('PINTEREST_PUBLICATION_MODE_NONE'),
					),
					'VALUE' => $arValues['PINTEREST_PUBLICATION_MODE'],
					'HELP' => GetMessage('PINTEREST_PUBLICATION_MODE_HELP'),
					'SORT' => 160,
				),
				'PINTEREST_UTM_SOURCE' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('UTM_SOURCE'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['PINTEREST_UTM_SOURCE'],
					'SORT' => 3000,
					'HELP' => GetMessage('UTM_SOURCE_HELP')
				),
				'PINTEREST_UTM_MEDIUM' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('UTM_MEDIUM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['PINTEREST_UTM_SOURCE'],
					'SORT' => 3010,
					'HELP' => GetMessage('UTM_MEDIUM_HELP')
				),
				'PINTEREST_UTM_CAMPAIGN' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('UTM_CAMPAIGN'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['PINTEREST_UTM_SOURCE'],
					'SORT' => 3020,
					'HELP' => GetMessage('UTM_CAMPAIGN_HELP')
				),
				'PINTEREST_UTM_TERM' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('UTM_TERM'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['PINTEREST_UTM_SOURCE'],
					'SORT' => 3030,
					'HELP' => GetMessage('UTM_TERM_HELP')
				),
				'PINTEREST_UTM_CONTENT' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('UTM_CONTENT'),
					'TYPE' => 'STRING',
					'VALUE' => $arValues['PINTEREST_UTM_SOURCE'],
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
				'NAME' => 'Autoposting to Pinterest ['.Func::GetNextIdDB().']',
				'IS_ENABLE' => 'Y',
				'IS_GROUP_PUBLISH' => 'N',
				'GROUP_PUBLISH' => 'Y',
				'GROUP_ID_STD' => 'Y',
			);
		}
		$pagesValue = self::getPagesValue($arValues['ACCESS_TOKEN']);
		$arModuleParams = array(
			'TAB_CONTROL_POSTFIX' => 'pinterest',
			'FORM' => array(
				'PARAMS' => array(
					'ID' => $index,
				),
				'TYPE' => array('WITH_PARAMS', 'NOT_DEFAULT'),
			),
			'TABS' => array(
				'PINTEREST_TAB' => array(
					'NAME' => GetMessage('PINTEREST_TAB_NAME'),
					'TITLE' => GetMessage('PINTEREST_TAB_TITLE')
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
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('PINTEREST_ACCOUNTS_NAME'),
					'VALUE' => $arValues['NAME'],
					'TYPE' => 'STRING',
					'REQUIRED' => 'Y',
					'SORT' => 100,
				),
				'IS_ENABLE' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('PINTEREST_IS_ENABLE'),
					'VALUE' => $arValues['IS_ENABLE'],
					'TYPE' => 'CHECKBOX',
					'SORT' => 150,
				),
				'PAGE_ID' => array(
					'TAB' => 'PINTEREST_TAB',
					'TYPE' => 'LIST',
					'NAME' => GetMessage('PINTEREST_PAGE_ID'),
					'DESCRIPTION' => GetMessage('PINTEREST_PAGE_ID_DESCRIPTION'),
					'VALUE' => $arValues['PAGE_ID'],
					'VALUES' => $pagesValue ?: array('' => ($arValues['ACCESS_TOKEN'] ? GetMessage('PINTEREST_ACCESS_TOKEN_FAILED') : GetMessage('PINTEREST_LOGIN_BEFORE'))),
					'SORT' => 250,
				),
				'ACCESS_TOKEN' => array(
					'TAB' => 'PINTEREST_TAB',
					'NAME' => GetMessage('PINTEREST_ACCESS_TOKEN'),
					'VALUE' => $arValues['ACCESS_TOKEN'],
					'TYPE' => 'STRING',
					'PLACEHOLDER' => GetMessage('PINTEREST_ACCESS_TOKEN_PLACEHOLDER'),
				),
			)
		);

		$cont = '<div onclick="vch_autopostingplus_pinterest_get_token(this)" class="voptions-add-button">'
			.GetMessage('PINTEREST_GET_ACCESS_TOKEN')
			.'</div>';
		$arModuleParams['PARAMS']['USER_INFO_AREA'] = array(
			'TAB' => 'PINTEREST_TAB',
			'NAME' => '',
			'TYPE' => 'CUSTOM',
			'HTML' => $cont,
			'SORT' => 500,
		);
		$hlp = PostingFunc::vettich_service('get_url', 'url=autoposting.pinterest.video_help');
		if(!empty($hlp['url']))
		{
			$arModuleParams['TABS']['PINTEREST_TAB_VIDEO'] = array(
				'NAME' => GetMessage('PINTEREST_TAB_VIDEO_NAME'),
				'TITLE' => GetMessage('PINTEREST_TAB_VIDEO_TITLE')
			);
			$arModuleParams['PARAMS']['video_help'] = array(
				'TAB' => 'PINTEREST_TAB_VIDEO',
				'TYPE' => 'NOTE',
				'TEXT' => PostingFunc::get_youtube_frame($hlp['url']),
			);
		}

		// global $arIncludeJS;
		// $arIncludeJS[] = '/bitrix/js/vettich.autopostingplus/pinterest_option.js';

		return $arModuleParams;
	}

	function getPagesValue($access_token)
	{
		global $APPLICATION;
		if(empty($access_token))
			return false;

		$boards = \Vettich\AutopostingPlus\Posts\pinterest\Posting::GetBoards($access_token);
		foreach($boards as $board)
		{
			$board['name'] = $APPLICATION->ConvertCharset($board['name'], "UTF-8", SITE_CHARSET);
			$result[$board['id']] = $board['name'] .' ['. $board['id'] .']';
		}
		return $result;
	}
}
