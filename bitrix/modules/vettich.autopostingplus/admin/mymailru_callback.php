<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

if(CModule::IncludeModule('vettich.autopostingplus'))
{
	$access_token = $_GET['access_token'];
	$refresh_token = $_GET['refresh_token'];
	$expires_in = $_GET['expires_in'];
	$client_id = $_GET['client_id'];
	$client_secret = $_GET['client_secret'];

	$pages = Vettich\AutopostingPlus\Posts\mymailru\Posting::GetPages($client_id, $client_secret, $access_token, $refresh_token, $expires_in);
	$data = array(
		'access_token' => $access_token,
		'refresh_token' => $refresh_token,
		'expires_in' => intval($expires_in) + time(),
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'pages' => $pages
	);
	?>
<script type="text/javascript">
	if(window.opener)
	{
		if(window.opener.vch_autopostingplus_mymailru_callback_token(<?=json_encode($data)?>))
		{
			window.close();
		}
	}
</script>
	<?
	exit;
}
