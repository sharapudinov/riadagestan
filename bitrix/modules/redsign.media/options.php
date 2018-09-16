<?php
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\ModuleManager;
use \Redsign\Media\AdminUtils;
use \Redsign\Media\SVGIconsManager;

Loc::loadMessages($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/options.php');
Loc::loadMessages(__FILE__);

\Bitrix\Main\Loader::includeModule('redsign.media');

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

$moduleId = 'redsign.media';

$siteIterator = \Bitrix\Main\SiteTable::getList();
$arSites = $siteIterator->fetchAll();

$arMicrodataOptions = [
    [
        'NAME' => Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION'),
        'TYPE' => 'HEADER'
    ],
    [
        'NAME' => Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION_NAME'),
        'TYPE' => 'INPUT',
        'ID' => 'microdata_organization_name',
        'CODE' => 'MICRODATA_ORGANIZATION_NAME'
    ],
    [
        'NAME' => Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION_ADRESS'),
        'TYPE' => 'INPUT',
        'ID' => 'microdata_organization_adress',
        'CODE' => 'MICRODATA_ORGANIZATION_ADRESS'
    ],
    [
        'NAME' => Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION_TELEPHONE'),
        'TYPE' => 'INPUT',
        'ID' => 'microdata_organization_teplephone',
        'CODE' => 'MICRODATA_ORGANIZATION_TELEPHONE'
    ],
    // [
    //     'NAME' => Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION_LOGO_PATH'),
    //     'TYPE' => 'SKIP',
    //     'ID' => 'microdata_organization_logo',
    //     'CODE' => 'MICRODATA_ORGANIZATION_LOGO'
    // ],
];

if ($request->isPost() && check_bitrix_sessid()) {
    if ($request->getPost('action') && $request->getPost('action') == 'GENERATE_SVG') {
        $APPLICATION->RestartBuffer();

        $returnText = '';

        $arIconsPath = [
            '/bitrix/modules/'.$moduleId.'/assets/svg/',
            '/local/modules/'.$moduleId.'/assets/svg/'
        ];

        try {
            AdminUtils::generateSvgIcons($arIconsPath, $request->getPost('path'));
            $returnText = '<span style="color: green">'.Application::getDocumentRoot().$request->getPost('path').'</span>';

            Option::set($moduleId, $arOption['ID'], 'icons_random', \Bitrix\Main\Security\Random::getString(10), $request->getPost('siteId'));
        } catch (Exception $e) {
            $returnText = '<span style="color: red">'.Loc::getMessage('RS.MEDIA.OPTION_ICONS_GEN_ERROR').'</span>';
        }

        echo $returnText;
        die();
    }

    foreach ($arSites as $arSite) {
        foreach (array_merge([], $arMicrodataOptions) as $arOption) {
            if (!empty($arOption['CODE']) && !empty($arOption['ID'])) {
                $val = $request->getPost($arOption['CODE'].'_'.$arSite['LID']);
                Option::set($moduleId, $arOption['ID'], $request->getPost($arOption['CODE'].'_'.$arSite['LID']), $arSite['LID']);
            }
        }
    }
}

$arTabs = array();
$arTabs[] = array(
    'DIV' => 'redsign_media',
    'TAB' => Loc::getMessage('RS.MEDIA.TAB_NAME_SETTINGS'),
    'ICON' => '',
    'TITLE' => Loc::getMessage('RS.MEDIA.TAB_TITLE_SETTINGS')
);
$arTabs[] = array(
    'DIV' => 'redsign_media_microdata',
    'TAB' => Loc::getMessage('RS.MEDIA.TAB_NAME_MICRODATA'),
    'ICON' => '',
    'TITLE' => Loc::getMessage('RS.MEDIA.TAB_TITLE_MICRODATA')
);
$arTabs[] = array(
    'DIV' => 'redsign_media_icons',
    'TAB' => Loc::getMessage('RS.MEDIA.TAB_NAME_ICONS'),
    'ICON' => '',
    'TITLE' => Loc::getMessage('RS.MEDIA.TAB_TITLE_ICONS')
);
$arTabs[] = array(
    'DIV' => 'redsign_media_adv',
    'TAB' => Loc::getMessage('RS.MEDIA.TAB_NAME_ADV'),
    'ICON' => '',
    'TITLE' => Loc::getMessage('RS.MEDIA.TAB_TITLE_ADV')
);
$tabControl = new CAdminTabControl('tabControl', $arTabs);

$tabControl->Begin();
?>
<form method="post" name="rsmedia_option" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?=bitrix_sessid_post();?>
    <?php $tabControl->BeginNextTab(); ?>
    <tr>
        <td valign="top" colspan="2">
            <?php
            $tabs = AdminUtils::getSiteTabs($arSites);
            $tabSiteControl = new CAdminViewTabControl("subTabControl", $tabs);
            $tabSiteControl->Begin();
            foreach ($arSites as $arSite):
                $tabSiteControl->BeginNextTab();
            ?>
            <table width="75%" align="center">

            </table>
            <?php
            endforeach;
            $tabSiteControl->End();
            ?>
        </td>
    </tr>

    <?php $tabControl->BeginNextTab();  ?>
    <tr>
        <td valign="top" colspan="2">
            <?php
            $tabs = AdminUtils::getSiteTabs($arSites);
            $tabSiteControl = new CAdminViewTabControl("subTabControl3", $tabs);
            $tabSiteControl->Begin();

            foreach ($arSites as $arSite):
                $tabSiteControl->BeginNextTab();
            ?>
            <table width="75%" align="center">
               <?php AdminUtils::showOptions($arMicrodataOptions, $arSite); ?>
               <tr>
                   <?php $currentVal = Option::get('redsign.media', 'microdata_organization_logo_path_'.$arSite['LID'], $arSite['DIR'].'include/header/logo.png', $arSite['LID']); ?>
                   <td align="right" width="50%"><?=Loc::getMessage('RS.MEDIA.OPTIONS_MICRODATA_ORGANIZATION_LOGO_PATH')?></td>
                   <td width="50%"><input type="text" size="40" value="<?=$currentVal?>" name="microdata_organization_logo_path_<?= $arSite["LID"] ?>" id="MICRODATA_ORGANIZATION_LOGO_PATH_<?=$arSite['LID']?>"></td>
               </tr>
           </table>
            <?php
            endforeach;
            $tabSiteControl->End();
            ?>
        </td>
    </tr>

    <?php $tabControl->BeginNextTab();  ?>
    <tr>
        <td valign="top" colspan="2">
            <?php
            $tabs = AdminUtils::getSiteTabs($arSites);
            $tabSiteControl = new CAdminViewTabControl("subTabControl2", $tabs);
            $tabSiteControl->Begin();
            foreach ($arSites as $arSite):
                $tabSiteControl->BeginNextTab();
            ?>
                <input style="padding: 1.5px 5px; margin-right: 10px; margin-top: 1px;" type="text" size="15" value="<?=$arSite['DIR']?>include/icons.svg" name="SVG_SPRITES_PATH_<?= $arSite["LID"] ?>" id="SVG_SPRITES_PATH_<?=$arSite['LID']?>">
                <button class="adm-btn" onclick="event.preventDefault(); generateSvgIcons('SVG_SPRITES_PATH_<?= $arSite["LID"] ?>', '<?=$arSite["LID"]?>')"><?=Loc::getMessage('RS.MEDIA.OPTION_ICONS_GEN');?></button>
                <span style="margin-left: 10px;" id="SVG_SPRITES_PATH_<?= $arSite["LID"] ?>_MESSAGE"></span>
            <?php
            endforeach;
            $tabSiteControl->End();
            ?>
        </td>
    </tr>

	<?php $tabControl->BeginNextTab();  ?>
    <tr>
        <td valign="top" colspan="2">
            <?php
            $tabs = AdminUtils::getSiteTabs($arSites);
            $tabSiteControl = new CAdminViewTabControl("subTabControl3", $tabs);
            $tabSiteControl->Begin();
            foreach ($arSites as $arSite):
                $tabSiteControl->BeginNextTab();
				$siteId = $arSite['LID'];
            ?>
			<table width="75%" align="center">
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_before_header"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_HEADER');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/before_header.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_before_footer"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_FOOTER');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/before_footer.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_index"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_INDEX');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/index.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_sidebar_1"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_SIDEBAR_1');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/sidebar_1.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_sidebar_2"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_SIDEBAR_2');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/sidebar_2.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_sidebar_3"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_SIDEBAR_3');?></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/sidebar_3.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
			   <tr>
				   <td align="right" width="50%"><span id="rs_media_parameters_adv_detail_1"><?=Loc::getMessage('RS.MEDIA.ADV_BEFORE_DETAIL_1');?></span></span></td>
				   <td width="50%"><a class="adm-btn" href="<?=AdminUtils::getEditPublicFileLink($arSite['DIR'].'include/adv/detail_1.php', $siteId)?>" title="<?=Loc::getMessage('RS.EDIT_FILE')?>"><?=Loc::getMessage('RS.EDIT_FILE')?></a></td>
			   </tr>
		   </table>
		   <script>
		   	if (window.BXHint) {

				var bxHintParams = {
					width: 600
				};

				new BXHint(
					'<img src="/bitrix/images/redsign.media/before_header.jpg" style="max-width: 100%">',
					BX('rs_media_parameters_adv_before_header'),
					bxHintParams
				);

				new BXHint(
					'<img src="/bitrix/images/redsign.media/before_footer.jpg" style="max-width: 100%">',
					BX('rs_media_parameters_adv_before_footer'),
					bxHintParams
				);

				new BXHint(
					'<img src="/bitrix/images/redsign.media/index.jpg" style="max-width: 100%">',
					BX('rs_media_parameters_adv_index'),
					bxHintParams
				);

				new BXHint(
					'<img src="/bitrix/images/redsign.media/sidebar_1.jpg" style="max-width: 100%">',
					BX('rs_media_parameters_adv_sidebar_1'),
					bxHintParams
				);
			}
		   </script>
            <?php
            endforeach;
            $tabSiteControl->End();
            ?>
        </td>
    </tr>
<?php
$tabControl->Buttons(array());
$tabControl->End();
?>
</form>
<script>
function generateSvgIcons(inputId, siteId) {
  var path = BX(inputId).value;
  var data = {
    path: path,
    siteId: siteId,
    action: 'GENERATE_SVG',
    sessid: BX.bitrix_sessid(),
  }

  BX.ajax({
    url: '<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>',
    method: 'post',
    data: data,
    onsuccess: function (result) {
        console.log(result);
        BX(inputId + '_MESSAGE').innerHTML = result;
    }
  });
}
</script>
