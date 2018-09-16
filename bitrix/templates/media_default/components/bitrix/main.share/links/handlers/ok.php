<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

__IncludeLang(dirname(__FILE__)."/lang/".LANGUAGE_ID."/ok.php");
$name = "ok";
$title = GetMessage("BOOKMARK_HANDLER_OK");
$icon_url_template = "
<a
	href=\"https://connect.ok.ru/offer?url=#PAGE_URL_ENCODED#&title=#PAGE_TITLE_UTF_ENCODED#\"
	onclick=\"window.open(this.href,'','toolbar=0,status=0,width=626,height=436');return false;\"
	target=\"_blank\"
	style=\"background: #ee8208\"
	class=\"ok\"
	title=\"".$title."\"
><i class=\"fa fa-odnoklassniki\"></i></a>\n";
$sort = 100;
?>
