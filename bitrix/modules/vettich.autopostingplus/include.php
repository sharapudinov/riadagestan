<?
use Vettich\AutopostingPlus\DBElementsTable;
use Vettich\Autoposting\PostingFunc;

IncludeModuleLangFile(__FILE__);
CModule::IncludeModule('vettich.autoposting');
Class CVettichAutopostingplus 
{
	public static $isCron = null;
	function isCron()
	{
		if(self::$isCron === null) {
			self::$isCron = defined('VCH_APP_CRON') && VCH_APP_CRON == true;
		}
		return self::$isCron;
	}

	function getVersion()
	{
		$arModuleVersion = array();
		include 'install/version.php';
		if(empty($arModuleVersion['VERSION']))
			return '1.0.0';
		return $arModuleVersion['VERSION'];
	}

	function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
	{
		if($GLOBALS['APPLICATION']->GetGroupRight("main") < "R")
			return;

		$found = false;
		foreach($aModuleMenu as $k=>$v)
		{
			if($v['parent_menu'] == 'global_menu_services'
				&& $v['items_id'] == 'vettich_autoposting')
			{
				$aModuleMenu[$k]['text'] .= ' (v+. '.self::getVersion().')';
				$aModuleMenu[$k]['items'] = array();
				foreach($v['items'] as $k2=>$v2)
				{
					$aModuleMenu[$k]['items'][] = $v2;
					if($v2['items_id'] == 'vettich_autoposting_accounts')
					{
						$aModuleMenu[$k]['items'][] = array(
							"text" => GetMessage('vettich.autopostingplus_menu_queue_text'),
							'url' => '/bitrix/admin/vettich_autopostingplus_list.php',
							'more_url' => array('/bitrix/admin/vettich_autopostingplus_detail.php')
						);
						$aModuleMenu[$k]['items'][] = array(
							"text" => GetMessage('vettich.autopostingplus_menu_category_text'),
							'url' => '/bitrix/admin/vettich_autopostingplus_category_list.php',
							'more_url' => array('/bitrix/admin/vettich_autopostingplus_category_detail.php')
						);
					}
				}

				$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/css/vettich.autopostingplus/posts.css');

				$found = true;
				break;
			}
		}
		if(strpos($_SERVER['REQUEST_URI'], 'vettich'))
		{
			$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/vettich.autopostingplus/googleplus_option.js');
			$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/vettich.autopostingplus/pinterest_option.js');
			$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/vettich.autopostingplus/mymailru_option.js');
		}
		if(!$found)
		{
			$aMenu = array(
				"parent_menu"	=> "global_menu_services",
				"items_id"		=> "vettich_autoposting",
				"text"		=> GetMessage('vettich.autopostingplus_menu_text'),
				"items"			=> array(
					array(
						"text"		=> GetMessage('vettich.autopostingplus_menu_info_text'),
						"url"		=> '/bitrix/admin/vettich_autopostingplus_info.php',
					)
				),
			);

			$aModuleMenu[] = $aMenu;
		}
	}

	function OnBuildOptions($params)
	{
		$arParams = &$params['arModuleParams'];
		$arParams['TABS']['PENDING_TAB'] = array(
			'NAME' => GetMessage('PENDING_TAB_NAME'),
			'TITLE' => GetMessage('PENDING_TAB_TITLE'),
		);
		$arParams['PARAMS']['is_enable_agent'] = array(
			'TAB' => 'PENDING_TAB',
			'NAME' => GetMessage('PENDING_TAB_IS_ENABLE_AGENT'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		);
		$arParams['PARAMS']['is_custom_agent'] = array(
			'TAB' => 'PENDING_TAB',
			'NAME' => GetMessage('PENDING_TAB_IS_CUSTOM_AGENT'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			// 'VALUES' => array('N' => GetMessage('NO'), 'Y' => GetMessage('YES')),
		);
		$arParams['PARAMS']['agent_type'] = array(
			'TAB' => 'PENDING_TAB',
			'NAME' => GetMessage('PENDING_TAB_AGENT_TYPE'),
			'HELP' => GetMessage('PENDING_TAB_AGENT_TYPE_HELP'),
			'TYPE' => 'LIST',
			'DEFAULT' => 'default',
			'VALUES' => array(
				'default' => GetMessage('PENDING_TAB_AGENT_TYPE_DEFAULT'),
				'only_hits' => GetMessage('PENDING_TAB_AGENT_TYPE_ONLY_HITS'),
				'only_cron' => GetMessage('PENDING_TAB_AGENT_TYPE_ONLY_CRON'),
			),
		);
		$arParams['PARAMS']['agent_cron_type_note'] = array(
			'TAB' => 'PENDING_TAB',
			'TEXT' => GetMessage('PENDING_TAB_AGENT_TYPE_CRON_NOTE_TEXT', array(
				'#AGENT_FILE#' => __DIR__.'/cron/agent.php',
			)),
			'TYPE' => 'NOTE',
		);

		if(!empty($_POST)) {
			if($_POST['agent_type'] != 'only_cron') {
				CAgent::AddAgent('CVettichAutopostingplus::agent();', 'vettich.autopostingplus', 'N', 60);
				if($_POST['is_custom_agent'] == 'Y') {
					RegisterModuleDependences('main', 'OnPageStart', 'vettich.autopostingplus', 'CVettichAutopostingplus', 'OnPageStart');
				} else {
					UnRegisterModuleDependences('main', 'OnPageStart', 'vettich.autopostingplus', 'CVettichAutopostingplus', 'OnPageStart');
				}
			} else {
				CAgent::RemoveAgent('CVettichAutopostingplus::agent();', 'vettich.autopostingplus');
				UnRegisterModuleDependences('main', 'OnPageStart', 'vettich.autopostingplus', 'CVettichAutopostingplus', 'OnPageStart');
			}
		}
	}

	function OnPageStart()
	{
		if(\COption::GetOptionString('vettich.autoposting', 'is_custom_agent', 'N') == 'N')
			return;

		$prev_time = intval(\COption::GetOptionString('vettich.autopostingplus', 'prev_time', 0));
		if($prev_time + 60 > time())
			return;
		\COption::SetOptionString('vettich.autopostingplus', 'prev_time', time());

		self::agent('OnPageStart');
	}

	function agent($event='')
	{
		$agentName = 'CVettichAutopostingplus::agent();';
		if(\COption::GetOptionString('vettich.autoposting', 'is_enable_agent', 'Y') != 'Y'
			&& \COption::GetOptionString('vettich.autopostingplus', 'is_running_agent', 'N') == 'Y')
			return $agentName;

		\COption::SetOptionString('vettich.autopostingplus', 'is_running_agent', 'Y');
		$agent_type = COption::GetOptionString('vettich.autoposting', 'agent_type', '');
		try{
			$order = array('LAST_MODIFIED' => 'asc');
			$arSelect = array('*', 'OPT_'=>'OPTION.*');
			$arFilter = array(
				'ACTIVE' => 'Y',
				'STATUS' => 'READY',
				'TYPE' => 'DELETE',
				'OPTION.PENDING_PUBLICATION' => 'Y',
				// 'OPTION.PENDING_PUBLICATION_HITS' => self::isCron() ? 'N':'Y',
			);
			if($agent_type == '' or $agent_type == 'default')
				$arFilter['OPTION.PENDING_PUBLICATION_HITS'] = self::isCron() ? 'N':'Y';
			$arList = DBElementsTable::GetList(array(
				'filter' => $arFilter,
				'order' => $order,
				'limit' => 1,
				'select' => $arSelect,
			))->Fetch();
			if(!$arList)
			{
				$arFilter['TYPE'] = 'EDIT';
				$arList = DBElementsTable::GetList(array(
					'filter' => $arFilter,
					'order' => $order,
					'limit' => 1,
					'select' => $arSelect,
				))->Fetch();
				if(!$arList)
				{
					$arFilter['TYPE'] = 'ADD';
					$arFilter[] = array(
						'LOGIC' => 'OR',
						array(
							'OPTION.PENDING_PUBLICATION_IS_INTERVAL' => 'Y',
							'<OPTION.PENDING_PUBLICATION_NEXT_DATETIME' => new Bitrix\Main\Type\DateTime(),
						),
						array(
							'OPTION.PENDING_PUBLICATION_IS_INTERVAL' => 'N',
							'<PUBLICATION_DATE' => new Bitrix\Main\Type\DateTime(),
						)
					);
					$curDT = new Bitrix\Main\Type\DateTime();
					$curDTFormat = new \DateTime($curDT->toString());
					$curDTFormat = $curDTFormat->format('H:i');
					$arFilter[] = array(
						'LOGIC' => 'OR',
						array(
							'OPTION.PENDING_PUBLICATION_IS_PERIOD' => 'Y',
							'<OPTION.PENDING_PUBLICATION_PERIOD_FROM' => $curDTFormat,
							'>OPTION.PENDING_PUBLICATION_PERIOD_TO' => $curDTFormat,
						),
						array(
							'OPTION.PENDING_PUBLICATION_IS_PERIOD' => 'N',
						)
					);
					$arList = DBElementsTable::GetList(array(
						'filter' => $arFilter,
						'order' => $order,
						'limit' => 1,
						'select' => $arSelect,
					))->fetch();
				}
			}

			if($arList)
			{
				$elemID = $arList['ID'];
				unset($arList['ID']);
				$ar = \Vettich\Autoposting\DBTable::getRowById($arList['PUBLICATION_ID']);
				if($ar)
				{
					$_p = \Vettich\Autoposting\PostingFunc::__GetPosts();
					$posts = array();
					foreach($_p as $post)
					{
						$posts[$post]['post_ids'] = $arList['ACCOUNT_'.strtoupper($post)];
						$posts[$post]['type'] = strtolower($arList['TYPE']);
					}
					$arOptionally = array(
						'post' => $ar,
						'posts' => $posts,
						'type' => strtolower($arList['TYPE']),
					);
					$event = 'eventAgentOnHit';
					if(self::isCron())
						$event = 'eventAgentOnCron';

					$arResPost = \Vettich\Autoposting\Posting::ElementPost(
						array('ID' => $arList['ELEM_ID'], 'IBLOCK_ID' => $arList['IBLOCK_ID']),
						$event,
						$arOptionally
					);
					foreach($_p as $post)
					{
						$acc_post = array();
						if(!empty($arList['ACCOUNT_'.strtoupper($post)])
							&& !empty($arResPost[$post]))
							$acc_post = array_merge_recursive($arList['ACCOUNT_'.strtoupper($post)], $arResPost[$post]);
						elseif(!empty($arResPost[$post]))
							$acc_post = $arResPost[$post];
						elseif(!empty($arList['ACCOUNT_'.strtoupper($post)]))
							$acc_post = $arList['ACCOUNT_'.strtoupper($post)];
						$arFields['ACCOUNT_'.strtoupper($post)] = $acc_post;
					}
					$arFields['LAST_MODIFIED'] = new Bitrix\Main\Type\DateTime();
					$arFields['STATUS'] = 'OK';
					$rs = DBElementsTable::update($elemID, $arFields);
					$rs = \Vettich\AutopostingPlus\DBOptionTable::update(
						$arList['PUBLICATION_ID'],
						array('PENDING_PUBLICATION_INTERVAL' => $arList['OPT_PENDING_PUBLICATION_INTERVAL'])
					);
				}
			}
		} catch (\Exception $e) {
			\Vettich\Autoposting\PostingLogs::addLogFromException($e);
		}

		try{
			self::agent_category();
		} catch (\Exception $e) {
			\Vettich\Autoposting\PostingLogs::addLogFromException($e);
		}

		\COption::SetOptionString('vettich.autopostingplus', 'is_running_agent', 'N');
		return 'CVettichAutopostingplus::agent();';
	}

	function agent_category()
	{
		CModule::IncludeModule('iblock');
		$curDT = new Bitrix\Main\Type\DateTime();
		$curDTFormat = new \DateTime($curDT->toString());
		$curDTFormat = $curDTFormat->format('H:i');
		$arCats = Vettich\AutopostingPlus\DBCategoryTable::GetList(array(
			'select' => array('*', 'OPT_' => 'OPTION.*'/*, 'PUB_' => 'PUBLICATION.*'*/),
			'filter' => array(
				'ACTIVE' => 'Y',
				'OPTION.PENDING_PUBLICATION_IS_INTERVAL' => 'Y',
				'<OPTION.PENDING_PUBLICATION_NEXT_DATETIME' => new Bitrix\Main\Type\DateTime(),
				array(
					'LOGIC' => 'OR',
					array(
						'OPTION.PENDING_PUBLICATION_IS_PERIOD' => 'Y',
						'<OPTION.PENDING_PUBLICATION_PERIOD_FROM' => $curDTFormat,
						'>OPTION.PENDING_PUBLICATION_PERIOD_TO' => $curDTFormat,
					),
					array(
						'OPTION.PENDING_PUBLICATION_IS_PERIOD' => 'N',
					)
				)
			),
		))->fetchAll();

		foreach($arCats as $arCat)
		{
			$arCatUpdate = array();
			$arParam = array(
				'filter' => array(
					'CAT_ELEM.ELEM_ID' => false,
					'IBLOCK_ID' => $arCat['IBLOCK_ID'],
				),
				'runtime' => array(
					new Bitrix\Main\Entity\ReferenceField('CAT_ELEM', '\Vettich\AutopostingPlus\DBCategoryElems', array(
						'=this.ID' => 'ref.ELEM_ID'
					))
				)
			);
			if($arCat['TYPE2'] == 'RAND')
			{
				$arParam['order'][] = 'RAND';
				$arParam['runtime'][] = new Bitrix\Main\Entity\ExpressionField('RAND', 'RAND()');
			}
			else
			{
				if(empty($arCat['SORT']) or $arCat['SORT'] == 'none') $arCat['SORT'] = 'ID';
				if(empty($arCat['SORT_ORDER'])) $arCat['SORT_ORDER'] = 'ASC';
				$arParam['order'] = array($arCat['SORT'] => $arCat['SORT_ORDER']);
			}
			$arSubCat = self::GetSubCategoriesList($arCat, $arCatUpdate);
			if(!empty($arSubCat))
				$arParam['filter']['IBLOCK_SECTION_ID'] = $arSubCat;
			if(IsModuleInstalled('workflow'))
				$arParam['filter']['WF_PARENT_ELEMENT_ID'] = false;
			$arRow = Vettich\AutopostingPlus\DBIBlockElementTable::GetRow($arParam);

			if(!!$arRow)
			{
				$ar = \Vettich\Autoposting\DBTable::getRowById($arCat['PUBLICATION_ID']);
				if($ar)
				{
					$arOptionally = array(
						'post' => $ar,
					);
					$event = 'eventAgentOnHit';
					if(self::isCron())
						$event = 'eventAgentOnCron';

					$arResPost = \Vettich\Autoposting\Posting::ElementPost(
						array('ID' => $arRow['ID'], 'IBLOCK_ID' => $arRow['IBLOCK_ID']),
						$event,
						$arOptionally
					);

					if($arCat['ADD_TO_QUEUE'] == 'Y')
					{
						$arList = $arList = DBElementsTable::GetList(array(
							'filter' => array(
								'ELEM_ID' => $arRow['ID'],
								'IBLOCK_ID' => $arRow['IBLOCK_ID'],
								'PUBLICATION_ID' => $arCat['PUBLICATION_ID'],
							),
							'limit' => 1,
						))->Fetch();
						if(!$arList)
							$arList = array();
						foreach(\Vettich\Autoposting\PostingFunc::__GetPosts() as $post)
						{
							$acc_post = array();
							if(!empty($arList['ACCOUNT_'.strtoupper($post)])
								&& !empty($arResPost[$post]))
								$acc_post = array_merge_recursive($arList['ACCOUNT_'.strtoupper($post)], $arResPost[$post]);
							elseif(!empty($arResPost[$post]))
								$acc_post = $arResPost[$post];
							elseif(!empty($arList['ACCOUNT_'.strtoupper($post)]))
								$acc_post = $arList['ACCOUNT_'.strtoupper($post)];
							$arFields['ACCOUNT_'.strtoupper($post)] = $acc_post;
						}
						$arFields['LAST_MODIFIED'] = new Bitrix\Main\Type\DateTime();
						$arFields['STATUS'] = 'OK';
						if(empty($arList))
						{
							$arFields['TYPE'] = 'ADD';
							$arFields['ELEM_ID'] = $arRow['ID'];
							$arFields['IBLOCK_ID'] = $arRow['IBLOCK_ID'];
							$arFields['PUBLICATION_ID'] = $arCat['PUBLICATION_ID'];
							$arFields['ACTIVE'] = 'Y';
							DBElementsTable::add($arFields);
						}
						else
							DBElementsTable::update($arList['ID'], $arFields);
						\Vettich\AutopostingPlus\DBOptionTable::update(
							$arCat['PUBLICATION_ID'],
							array('PENDING_PUBLICATION_INTERVAL' => $arCat['OPT_PENDING_PUBLICATION_INTERVAL'])
						);
					}
					$arCatUpdate['ELEM_COUNT'] = $arCat['ELEM_COUNT'] + 1;
					$arCatUpdate['PREV_ELEM'] = $arRow['ID'];
					Vettich\AutopostingPlus\DBCategoryElemsTable::add(array(
						'ELEM_ID' => $arRow['ID'],
						'CATEGORY_ID' => $arCat['ID'],
					));
				}
				if(!empty($arCatUpdate))
				{
					$arCatUpdate['LAST_MODIFIED'] = $curDT;
					Vettich\AutopostingPlus\DBCategoryTable::update($arCat['ID'], $arCatUpdate);
				}
			}
		}
	}

	function GetSubCategoriesList($arCat, &$arCatUpdate)
	{
		$arResult = array();
		if(!empty($arCat['SUBCATEGORIES']))
		{
			if($arCat['TYPE'] == 'RAND')
			{
				$arSubCatIndex = rand(0, count($arCat['SUBCATEGORIES']) - 1);
			}
			else
			{
				if(empty($arCat['PREV_SUBCATEGORY']))
					$arSubCatIndex = 0;
				else
				{
					$arSubCatIndex = array_search($arCat['PREV_SUBCATEGORY'], $arCat['SUBCATEGORIES']) + 1;
					if($arSubCatIndex >= count($arCat['SUBCATEGORIES']))
						$arSubCatIndex = 0;
				}
			}
			$arSub = $arCat['SUBCATEGORIES'][$arSubCatIndex];
			$arCatUpdate['PREV_SUBCATEGORY'] = $arSub;
			$arSect = CIBlockSection::GetByID($arSub)->Fetch();
			if($arSect)
			{
				$rs = CIBlockSection::GetTreeList(array(
					'IBLOCK_ID' => $arCat['IBLOCK_ID'],
					'LEFT_MARGIN' => $arSect['LEFT_MARGIN'],
					'RIGHT_MARGIN' => $arSect['RIGHT_MARGIN']
				));
				while($ar = $rs->Fetch())
					$arResult[] = $ar['ID'];
			}
			else
			{
				unset($arCat['SUBCATEGORIES'][$arSubCatIndex]);
				$arCatUpdate['SUBCATEGORIES'] = $arCat['SUBCATEGORIES'];
				return self::GetSubCategoriesList($arCat, $arCatUpdate);
			}
		}
		return $arResult;
	}
}
