<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="muser">
<div class="bx_form">
<h3>Авторизация</h3>
</div>
<div  class="bx_form2">
<?if($arResult["FORM_TYPE"] == "login"):?>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>
<a href="#" class="asd asdf">закрыть</a><br/>
<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />

	<label class="labelform"><span><?=GetMessage("AUTH_LOGIN")?></span><br/>
	<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" class="bx_form_text"/></label><br/>
	<label class="labelform"><span><?=GetMessage("AUTH_PASSWORD")?></span><br/>
	<input type="password" name="USER_PASSWORD" maxlength="50" size="17" class="bx_form_text"/></label>
	<br/>
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?endif?>
			
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
		
<label class="labelform"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /><span><?echo GetMessage("AUTH_REMEMBER_SHORT")?></span></label><br/>
		
<?endif?>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>		
		<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="bx_form_btn"/>	
</form>
<div class="hrefform">
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>		
	<noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br />		
<?endif?>
	<noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
</div>
	
<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>

<?
//if($arResult["FORM_TYPE"] == "login")
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				<?=$arResult["USER_LOGIN"]?><br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" class="bx_form_btn"/>
			</td>
		</tr>
	</table>
</form>
<?endif?>
</div>
<div class="bx_form3"></div>
</div>