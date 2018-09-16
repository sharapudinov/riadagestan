<?
namespace Vettich\AutopostingPlus;
use Vettich\Autoposting\PostingOption;
use Vettich\Autoposting\PostingFunc;
use Vettich\Autoposting\Posting;
use Bitrix\Main\Type;

IncludeModuleLangFile(__FILE__);
class PostingOptions
{
	static function OnAfterIBlockElementUpdate($arFields)
	{
		\Vettich\Autoposting\Posting::ElementPost($arFields, 'OnAfterIBlockElementUpdate');
	}

	static function OnAfterIBlockElementDelete($arFields)
	{
		\Vettich\Autoposting\Posting::ElementPost($arFields, 'OnAfterIBlockElementDelete', array('type' => 'delete'));
	}

	static function OnBuildPostsParams($arParams)
	{
		$arModuleParams = &$arParams['arModuleParams'];

/*		$posts = Func::GetPosts();
		$_sort = 520;
		$arModuleParams['PARAMS']['account_note2'] = array(
			'TAB' => 'TAB1',
			'TEXT' => GetMessage('ACCOUNT_NOTE2_TEXT'),
			'TYPE' => 'NOTE',
			'SORT' => $_sort++,
		);
		foreach($posts as $post)
		{
			if(PostingFunc::isModule($post))
			{
				$arPost = PostingFunc::module2($post);
				if(method_exists($arPost['option'], "GetArModuleParamsPosts")
					&& method_exists($arPost['option'], "get_list")
					&& method_exists($arPost['func'], "get_name"))
				{
					$ac_id = 'ACCOUNT_'.strtoupper($post);
					$arModuleParams = array_merge_recursive($arModuleParams, $arPost['option']::GetArModuleParamsPosts($ID));
					$_vals = $arPost['option']::get_list();
					$_html = '<table width="100%"><tr><td width="30%" align="right"><b>'.$arPost['func']::get_name().':</b></td><td width="70%"><table>';
					if(empty($_vals))
					{
						$_html .= '<tr><td>'.GetMessage('VCH_ACC_EMPTY', array('#ADD_URL#'=>'vettich_autoposting_posts_edit_'.$post.'.php?lang='.LANG, '#ACC_NAME#'=>$arPost['func']::get_name())).'<td><tr>';
					}
					else
					{
						$_def_vals = (self::GetByID($ID, $ac_id));
						foreach($_vals as $k=>$v)
						{
							$checked = '';
							if(is_array($_def_vals) && in_array($k, $_def_vals))
								$checked = 'checked="checked"';
							$_html .= '<tr><td><input type="checkbox" '.$checked.' value="'.$k.'" name="'.$ac_id.'[]" id="'.$ac_id.$k.'"> <label for="'.$ac_id.$k.'">'.$v.'</label></td></tr>';
						}
					}
					$_html .= '</table></td></tr></table>';
					$arModuleParams['PARAMS'][$ac_id] = array(
						'TAB' => 'TAB1',
						'TEXT' => $_html,
						'TYPE' => 'NOTE',
						'SORT' => $_sort++,
					);
				}
			}
		}
*/
		if(isset($arModuleParams['PARAMS']['TYPE']['VALUE'])
			&& $arModuleParams['PARAMS']['TYPE']['VALUE'] != PostingFunc::DBTYPEPOSTS)
			return;

		$_sort = 1000;
		$ID = $arModuleParams['FORM']['PARAMS']['ID'];
		$arValues = Func::GetValues($ID);
		$arModuleParams['TABS']['PENDING_TAB'] = array(
			'NAME' => GetMessage('PENDING_TAB'),
			'TITLE' => GetMessage('PENDING_TAB'),
		);
		$arModuleParams['PARAMS']['PENDING_PUBLICATION'] = array(
			'TAB' => 'PENDING_TAB',
			'NAME' => GetMessage('vettich.autopostingplus_pending_publication'),
			'HELP' => GetMessage('vettich.autopostingplus_pending_publication_help'),
			'TYPE' => 'CHECKBOX',
			'REFRESH' => 'Y',
			'VALUE' => $arValues['PENDING_PUBLICATION'] ?: 'N',
			'SORT' => $_sort++,
		);
		if($arValues['PENDING_PUBLICATION'] == 'Y')
		{
			$agent_type = \COption::GetOptionString(PostingFunc::module_id(), 'agent_type', '');
			if($agent_type == '' or $agent_type == 'default')
			{
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS'] = array(
					'TAB' => 'PENDING_TAB',
					'NAME' => GetMessage('vettich.autopostingplus_pending_publication_hits'),
					'HELP' => GetMessage('vettich.autopostingplus_pending_publication_hits_help'),
					'TYPE' => 'CHECKBOX',
					'REFRESH' => 'Y',
					'VALUE' => $arValues['PENDING_PUBLICATION_HITS'] ?: 'Y',
					'SORT' => $_sort++,
				);
				if($arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS']['VALUE'] == 'Y')
				{
					// $arModuleParams['PARAMS']['PENDING_PUBLICATION_TO_ONE_SS'] = array(
					// 	'TAB' => 'PENDING_TAB',
					// 	'NAME' => 'На хитах публиковать только по в одну соц. сеть за раз',
					// 	'HELP' => 'При снятой галочке, элемент будет публиковаться сразу во все соц. сети',
					// 	// 'NAME' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_TO_ONE_SS'),
					// 	// 'HELP' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_TO_ONE_SS_HELP'),
					// 	'TYPE' => 'CHECKBOX',
					// 	'VALUE' => $arValues['PENDING_PUBLICATION_TO_ONE_SS'] ?: 'N',
					// 	'SORT' => $_sort++,
					// );
				}
				else
				{
					$file_name = dirname(__DIR__).'/cron/agent.php';
					$arModuleParams['PARAMS']['PENDING_PUBLICATION_PATH4CRON'] = array(
						'TAB' => 'PENDING_TAB',
						'NAME' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_PATH4CRON'),
						'HELP' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_PATH4CRON_HELP'),
						'DESCRIPTION' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_PATH4CRON_DESCRIPTION', array('#FILE#' => $file_name)),
						'TYPE' => 'STRING',
						'READONLY' => 'Y',
						'VALUE' => $file_name,
						'SORT' => $_sort++,
					);
				}
			}
			elseif($agent_type == 'only_hits')
			{
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS'] = array(
					'TAB' => 'PENDING_TAB',
					'TYPE' => 'HIDDEN',
					'VALUE' => $arValues['PENDING_PUBLICATION_HITS'] ?: 'Y',
				);
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS_NOTE'] = array(
					'TAB' => 'PENDING_TAB',
					'TEXT' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_HITS_NOTE_HITS'),
					'TYPE' => 'NOTE',
					'SORT' => $_sort++,
				);
			}
			elseif($agent_type == 'only_cron')
			{
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS'] = array(
					'TAB' => 'PENDING_TAB',
					'TYPE' => 'HIDDEN',
					'VALUE' => $arValues['PENDING_PUBLICATION_HITS'] ?: 'Y',
				);
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_HITS_NOTE'] = array(
					'TAB' => 'PENDING_TAB',
					'TEXT' => GetMessage('vettich.autopostingplus_PENDING_PUBLICATION_HITS_NOTE_CRON'),
					'TYPE' => 'NOTE',
					'SORT' => $_sort++,
				);
			}
			$arModuleParams['PARAMS']['PENDING_PUBLICATION_IS_INTERVAL'] = array(
				'TAB' => 'PENDING_TAB',
				'NAME' => GetMessage('vettich.autopostingplus_pending_publication_is_interval'),
				'HELP' => GetMessage('vettich.autopostingplus_pending_publication_is_interval_help'),
				'TYPE' => 'CHECKBOX',
				'REFRESH' => 'Y',
				'VALUE' => $arValues['PENDING_PUBLICATION_IS_INTERVAL'] ?: 'Y',
				'SORT' => $_sort++,
			);
			if($arModuleParams['PARAMS']['PENDING_PUBLICATION_IS_INTERVAL']['VALUE'] == 'Y')
			{
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_INTERVAL'] = array(
					'TAB' => 'PENDING_TAB',
					'NAME' => GetMessage('vettich.autopostingplus_pending_publication_interval'),
					'HELP' => GetMessage('vettich.autopostingplus_pending_publication_interval_help'),
					'TYPE' => 'NUMBER',
					'VALUE' => $arValues['PENDING_PUBLICATION_INTERVAL'] ?: 30,
					'SORT' => $_sort++,
				);
			}
			else
			{
				$arProps = PostingOption::getProps();
				if(!$iblock_id)
					$iblock_id = PostingOption::GetByID($ID, 'IBLOCK_ID');
				$values = isset($arProps[$iblock_id]) ? $arProps[$iblock_id] : $arProps['none'];
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_DATE'] = array(
					'TAB' => 'PENDING_TAB',
					'NAME' => GetMessage('vettich.autopostingplus_pending_publication_date'),
					'HELP' => GetMessage('vettich.autopostingplus_pending_publication_date_help'),
					'TYPE' => 'LIST',
					'VALUES' => $values,
					'VALUE' => $arValues['PENDING_PUBLICATION_DATE'] ?: 'DATE_ACTIVE_FROM',
					'SORT' => $_sort++,
				);
			}
			$arModuleParams['PARAMS']['PENDING_PUBLICATION_IS_PERIOD'] = array(
				'TAB' => 'PENDING_TAB',
				'NAME' => GetMessage('vettich.autopostingplus_pending_publication_is_period'),
				'HELP' => GetMessage('vettich.autopostingplus_pending_publication_is_period_help'),
				'TYPE' => 'CHECKBOX',
				'VALUE' => $arValues['PENDING_PUBLICATION_IS_PERIOD'] ?: 'N',
				'SORT' => $_sort++,
				'REFRESH' => 'Y',
			);
			if($arModuleParams['PARAMS']['PENDING_PUBLICATION_IS_PERIOD']['VALUE'] == 'Y')
			{
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_PERIOD_FROM'] = array(
					'TAB' => 'PENDING_TAB',
					'NAME' => GetMessage('vettich.autopostingplus_pending_publication_period_from'),
					'TYPE' => 'TIME',
					'VALUE' => $arValues['PENDING_PUBLICATION_PERIOD_FROM'] ?: '06:00',
					'SORT' => $_sort++,
					'DISPLAY' => 'inline',
				);
				$arModuleParams['PARAMS']['PENDING_PUBLICATION_PERIOD_TO'] = array(
					'TAB' => 'PENDING_TAB',
					'NAME' => GetMessage('vettich.autopostingplus_pending_publication_period_to'),
					'TYPE' => 'TIME',
					'VALUE' => $arValues['PENDING_PUBLICATION_PERIOD_TO'] ?: '23:00',
					'SORT' => $_sort++,
					'DISPLAY' => 'inline',
				);
			}
		}
	}

	static function OnSavePostsParams($params)
	{
		PostingOption::SaveParams($params['ID'], Func::DB_OPTION_TABLE, false);
	}

	static function OnBeforePost($params)
	{
		$arFields = $params['arFields'];
		$event = $params['event'];
		$arPost = $params['arPost'];

		$arOption = DBOptionTable::getRowById($arPost['ID']);
		if($arOption['PENDING_PUBLICATION'] != 'Y') {
			if($event == 'OnAfterIBlockElementUpdate'
				or $event == 'OnAfterIBlockElementDelete')
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		// $agent_type = \COption::GetOptionString(PostingFunc::module_id(), 'agent_type', '');
		// if($agent_type == '' or $agent_type == 'default') {
		// 	if(($event == 'eventAgentOnHit' && $arOption['PENDING_PUBLICATION_HITS'] != 'Y')
		// 		or ($event == 'eventAgentOnCron' && $arOption['PENDING_PUBLICATION_HITS'] == 'Y')) {
		// 		return false;
		// 	}
		// }

		if(!$arFields['ID'])
			return true;

		$type = '';
		if($event == 'OnAfterIblockElementAdd')
		{
			$type = 'ADD';
		}
		elseif($event == 'OnAfterIBlockElementUpdate'
			or $event == 'eventPopupIBlocksPublication'
			or $event == 'eventIBlocksPublication')
		{
			$type = 'EDIT';
		}
		elseif($event == 'OnAfterIBlockElementDelete')
		{
			$type = 'DELETE';
		}

		if(empty($type))
			return true;
		$arElem = DBElementsTable::GetRow(array('select'=>array('ID', 'TYPE', 'STATUS'), 'filter'=>array(
			'ELEM_ID' => $arFields['ID'],
			'IBLOCK_ID' => $arFields['IBLOCK_ID'],
			'PUBLICATION_ID' => $arPost['ID'],
		)));
		$elemID = $arElem['ID'];
		try{
			$pub_date = new Type\DateTime(Posting::getStringFromProperty($arOption['PENDING_PUBLICATION_DATE'], $arFields, $arSite, $arPost));
		} catch(\Exception $e) {
			$pub_date = new Type\DateTime();
		}
		if(!$elemID)
		{
			if($type != 'DELETE')
			{
				$rs = DBElementsTable::add(array(
					'ACTIVE' => 'Y',
					'ELEM_ID' => $arFields['ID'],
					'IBLOCK_ID' => $arFields['IBLOCK_ID'],
					'TYPE' => 'ADD',
					'STATUS' => 'READY',
					'PUBLICATION_DATE' => $pub_date,
					'PUBLICATION_ID' => $arPost['ID'],
				));
			}
		}
		else
		{
			if($arElem['TYPE'] == 'ADD' && $arElem['STATUS'] == 'READY')
				$type = 'ADD';
			$rs = DBElementsTable::update($elemID, array(
				'ELEM_ID' => $arFields['ID'],
				'IBLOCK_ID' => $arFields['IBLOCK_ID'],
				'TYPE' => $type,
				'STATUS' => 'READY',
				'PUBLICATION_DATE' => $pub_date,
				'PUBLICATION_ID' => $arPost['ID'],
				'LAST_MODIFIED' => new Type\DateTime(),
			));
		}
		if($rs && $rs->isSuccess())
			return false;
	}
}
