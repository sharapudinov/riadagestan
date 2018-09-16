<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

if(CModule::IncludeModule('vettich.autopostingplus'))
{
	$access_token = $_GET['access_token'];
	$boards = Vettich\AutopostingPlus\Posts\pinterest\Posting::GetBoards($access_token);
	$data = array('access_token' => $access_token, 'boards' => $boards);
	?>
<script type="text/javascript">
	if(window.opener)
	{
		if(window.opener.vch_autopostingplus_pinterest_callback_token(<?=json_encode($data)?>))
		{
			window.close();
		}
	}
</script>
	<?
	exit;
}
