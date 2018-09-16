<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$arJsParams = array(
    'id' => $arParams['ID'],
    'useCaptcha' => $arResult["use_captcha"] === true,
    'userId' => $arResult['userID'],
    'useConsent' => $arParams['USER_CONSENT'] == 'Y',
    'blockId' => 'comments_'.$arParams['ID'],
    'formId' => $component->createPostFormId(),
    'commentsId' => 'comments_items_'.$arParams['ID'],
    'commentErrorId' => 'comments_error_'.$arParams['ID'],
    'commentMessageId' => 'comments_message_'.$arParams['ID'],
    'commentErrorMessageId' => 'comments_error_message_id'.$arParams['ID'],
    'fatalErrorId' => 'comments_fatal_'.$arParams['ID'],
    'entityId' => $arParams['ENTITY_XML_ID'],
    'entity' => array(
        'id' => $arParams['ID'],
        'type' => 'BG',
        'xmlId' => $arParams['ENTITY_XML_ID'],
        'logId' => $arParams['LOG_ID']
    ),
);

$ajaxPath = $templateFolder.'/ajax.php';

$arParams['IBLOCK_ID'] = $iblockId = (isset($_REQUEST['IBLOCK_ID']) && is_string($_REQUEST['IBLOCK_ID']) ? (int)$_REQUEST['IBLOCK_ID'] : 0);
$arParams['ELEMENT_ID'] = $elementId = (isset($_REQUEST['ELEMENT_ID']) && is_string($_REQUEST['ELEMENT_ID']) ? (int)$_REQUEST['ELEMENT_ID'] : 0);

if($arResult["is_ajax_post"] != "Y") {
?><div id="<?=$arJsParams['blockId']?>"><?
} else {
    $APPLICATION->RestartBuffer();
}
?>

<div class="l-section" id="<?=$arJsParams['commentsId']?>" style="display: none">
<?php if (count($arResult["CommentsResult"]) > 0): ?>
    <?php
    $fnShowComment = function ($arComment, $level) use ($arResult, $arParams) {
        ?>
        <div class="b-post-comment" id="comment_<?=$arParams['ID']?>_<?=$arComment['ID']?>" data-comment="<?=$arComment['ID']?>">
            <?php //\Bitrix\Main\Diag\Debug::dump($arComment);?>
            <div class="b-post-comment__meta">
                <div class="b-post-comment-author">
                    <?php
                    $sAvatarSrc = '';
                    if (isset($arComment['BlogUser']['Avatar_resized']['100_100'])) {
                        $sAvatarSrc = $arComment['BlogUser']['Avatar_resized']['100_100']['src'];
                    } else {
                        $sAvatarSrc = SITE_TEMPLATE_PATH.'/assets/images/avatar.png';
                    }
                    ?>
                    <div class="b-post-comment-author__avatar">
                        <img src="<?=$sAvatarSrc?>" alt="<?=$arComment["AuthorName"]?>">
                    </div>
                    <div class="b-post-comment-author__name">
                        <?=$arComment["AuthorName"]?>
                    </div>
                </div>
                <div class="b-meta-item">
                    <?=$arComment["DateFormated"]?>
                </div>
                <?php if(strlen($arComment["urlToDelete"])>0 && strlen($arComment["AuthorEmail"])>0): ?>
                <div class="b-meta-item">
                    (<a href="mailto:<?=$comment["AuthorEmail"]?>"><?=$arComment["AuthorEmail"]?></a>)
                </div>
                <?php endif; ?>
            </div>
            <div class="b-post-comment__content">
                <?=$arComment["TextFormated"]?>
            </div>
            <div class="b-post-comment__tools">
                <?php if(strlen($arComment["urlToShow"])>0): ?>
                    <a href="<?=$arComment["urlToShow"]."&".bitrix_sessid_get()?>&SITE_ID=<?=SITE_ID?>" onclick="" class="btn btn-secondary btn-sm" title="<?=Loc::getMessage("BPC_MES_SHOW")?>" data-toggle-comment="<?=$arComment['ID']?>"><?=Loc::getMessage("BPC_MES_SHOW")?></a>
                <?php endif; ?>
                <?php if(strlen($arComment["urlToHide"])>0): ?>
                    <a href="<?=$arComment["urlToHide"]."&".bitrix_sessid_get()?>&IBLOCK_ID=<?=$arParams['IBLOCK_ID']; ?>&ELEMENT_ID=<?=$arParams['ELEMENT_ID']; ?>&SITE_ID=<?=SITE_ID?>" onclick="" class="btn btn-secondary btn-sm" title="<?=Loc::getMessage("BPC_MES_HIDE")?>" data-toggle-comment="<?=$arComment['ID']?>"><?=Loc::getMessage("BPC_MES_HIDE")?></a>
                <?php endif; ?>
                <?php if(strlen($arComment["urlToDelete"])>0): ?>
                    <a href="<?=$arComment["urlToDelete"]."&".bitrix_sessid_get()?>&SITE_ID=<?=SITE_ID?>&IBLOCK_ID=<?=$arParams['IBLOCK_ID']; ?>&ELEMENT_ID=<?=$arParams['ELEMENT_ID']?>" onclick="" class="btn btn-secondary btn-sm" title="<?=Loc::getMessage("BPC_MES_DELETE")?>" data-delete-comment="<?=$arComment['ID']?>"><?=Loc::getMessage("BPC_MES_DELETE")?></a>
                <?php endif; ?>
                <?php if(strlen($arComment["urlToSpam"])>0): ?>
                    <br><br>
                    <a href="<?=$arComment["urlToSpam"]?>" class="btn btn-outline-secondary btn-sm" title="<?=Loc::getMessage("BPC_MES_SPAM_TITLE")?>" data-spam><?=Loc::getMessage("BPC_MES_SPAM_TITLE")?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    };

    $fnRecursiveComments = function ($arResult, $nKey) use ($arParams, $fnShowComment) {
        if (
            empty($arResult['CommentsResult'][$nKey]) ||
            !is_array($arResult['CommentsResult'][$nKey])
        ) {
            return;
        }

        $arComments = $arResult['CommentsResult'][$nKey];
        foreach ($arComments as $arComment) {
            if (!empty($arResult["Comments"][$arComment['ID']])) {
                $arComment["CAN_EDIT"] = $arResult["Comments"][$comment["ID"]]["CAN_EDIT"];
                $arComment["SHOW_AS_HIDDEN"] = $arResult["Comments"][$comment["ID"]]["SHOW_AS_HIDDEN"];
                $arComment["SHOW_SCREENNED"] = $arResult["Comments"][$comment["ID"]]["SHOW_SCREENNED"];
                $arComment["NEW"] = $arResult["Comments"][$comment["ID"]]["NEW"];
            }

            $fnShowComment($arComment, 2);
        }

    };

    if(isset($arResult["NEED_NAV"]) && $arResult["NEED_NAV"] == "Y") {
        for($i = 1; $i <= $arResult["PAGE_COUNT"]; $i++) {
            $arResult['CommentsResult'][$arResult["firstLevel"]] = $arResult["PagesComment"][$i];
            $fnRecursiveComments($arResult, $arResult["firstLevel"]);
        }
    } else {
        $fnRecursiveComments($arResult, $arResult["firstLevel"]);
    }
    ?>
<?php endif; ?>
</div>

<div class="l-section">
    <div class="l-section__head">
        <h2 class="l-section__title"><?=Loc::getMessage('B_B_MS_ADD_COMMENT'); ?></h2>
    </div>

    <div id="<?=$arJsParams['commentErrorId']?>">
        <?php if(strlen($arResult["COMMENT_ERROR"])>0): ?>
        <div class="alert alert-danger" role="alert">
        	<?=$arResult["COMMENT_ERROR"]?>
        </div>
        <?php endif; ?>
    </div>

    <div id="<?=$arJsParams['commentMessageId']?>">
        <?php if(strlen($arResult["MESSAGE"])>0): ?>
    	<div class="alert alert-info" role="alert">
    		<?=$arResult["MESSAGE"]?>
    	</div>
        <?php endif; ?>
    </div>

    <div id="<?=$arJsParams['commentErrorMessageId']?>">
        <?php if(strlen($arResult["ERROR_MESSAGE"])>0): ?>
        <div class="alert alert-danger" role="alert">
            <?=$arResult["ERROR_MESSAGE"]?>
        </div>
        <?php endif; ?>
    </div>

    <?php if(strlen($arResult["FATAL_MESSAGE"])>0): ?>
	<div class="alert alert-danger" id="<?=$arJsParams['fatalErrorId']?>">
		<?=$arResult["FATAL_MESSAGE"]?>
	</div>
    <?php else: ?>

        <form method="POST" name="form_comment" id="<?=$component->createPostFormId()?>" action="<?=$ajaxPath;?>">
            <input type="hidden" name="parentId" id="parentId" value="">
            <input type="hidden" name="edit_id" id="edit_id" value="">
            <input type="hidden" name="act" id="act" value="add">
            <input type="hidden" name="post" value="Y">
            <input type="hidden" name="IBLOCK_ID" value="<?=$iblockId; ?>">
            <input type="hidden" name="ELEMENT_ID" value="<?=$elementId; ?>">
            <?php if(isset($_REQUEST["SITE_ID"])): ?>
                <input type="hidden" name="SITE_ID" value="<?=htmlspecialcharsbx($_REQUEST["SITE_ID"]); ?>">
            <?php endif; ?>
            <?=makeInputsFromParams($arParams["PARENT_PARAMS"]); ?>
            <?=bitrix_sessid_post();?>
            <div class="form-group">
                <textarea class="form-control" id="POST_MESSAGE" name="comment" rows="3"></textarea>
            </div>
            <?php if(empty($arResult["User"])): ?>
                <div class="form-row">
                    <div class="col-12 col-sm-6 form-group">
                        <label for="user_name"><?=Loc::getMessage("B_B_MS_NAME")?></label>
                        <input class="form-control" maxlength="255" size="30" tabindex="3" type="text" name="user_name" id="user_name" value="<?=htmlspecialcharsEx($_SESSION["blog_user_name"])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-sm-6 form-group">
                        <label for="user_name">E-mail</label>
                        <input class="form-control" maxlength="255" size="30" tabindex="4" type="text" name="user_email" id="user_email" value="<?=htmlspecialcharsEx($_SESSION["blog_user_email"])?>">
                    </div>
                </div>
            <?php endif; ?>

            <?php if($arResult["use_captcha"]===true): ?>
                <div class="form-row align-items-end">
                    <div class="col-12"><label for="captcha_word"><?=Loc::getMessage("B_B_MS_CAPTCHA_SYM")?></label></div>
                    <div class="form-group col-4 col-sm-2 js-captcha">
                        <input type="hidden" name="captcha_code" id="captcha_code" value="<?=$arResult["CaptchaCode"]?>">
                        <input type="text" size="30" name="captcha_word" id="captcha_word" value="" class="form-control"  tabindex="7">
                    </div>
                    <div class="form-group col-8 col-sm-4">
                        <div id="div_captcha">
                            <img src="" width="180" height="40" id="captcha" style="display:none;">
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($arResult['userID'] == null && $arParams['USER_CONSENT'] == 'Y'): ?>
                <?php $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    "media",
                    array(
                    "ID" => $arParams["USER_CONSENT_ID"],
                    "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                    "AUTO_SAVE" => "Y",
                    "IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
                    "ORIGIN_ID" => "sender/sub",
                    "ORIGINATOR_ID" => "",
                    "REPLACE" => array(
                    'button_caption' => Loc::getMessage("B_B_MS_SEND"),
                    'fields' => array(Loc::getMessage("B_B_MS_NAME"), 'E-mail')
                    ),
                    "SUBMIT_EVENT_NAME" => "OnUCFormCheckConsent",
                    )
                    ); ?>
                <?php endif; ?>

                <div class="row">
                    <div class="col-12">
                        <input class="btn btn-primary" tabindex="10" value="<?=Loc::getMessage("B_B_MS_SEND")?>" type="submit" name="sub-post" id="post-button">
                    </div>
                </div>
            </form>
        <?php endif; ?>
        </div>

        <script>
            if (!window.RSMediaPostComments) {
                BX.loadScript("<?=$templateFolder?>/post_comments.js", function () {
                    new RSMediaPostComments(<?=CUtil::PhpToJSObject($arJsParams);?>);
                });
            }
        </script>


<?php
if($arResult["is_ajax_post"] == "Y") {
    die();
} else {
    ?></div><?
}

function makeInputsFromParams($arParams, $name="PARAMS")
{
    $result = "";

    if(is_array($arParams))
    {
        foreach ($arParams as $key => $value)
        {
            if(substr($key, 0, 1) != "~")
            {
                $inputName = $name.'['.$key.']';

                if(is_array($value))
                    $result .= makeInputsFromParams($value, $inputName);
                else
                    $result .= '<input type="hidden" name="'.$inputName.'" value="'.$value.'">'.PHP_EOL;
            }
        }
    }

    return $result;
}
