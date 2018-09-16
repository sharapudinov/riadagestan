<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

CJSCore::Init('jquery');

CModule::IncludeModule('vettich.autoposting');
CModule::IncludeModule('vettich.autopostingplus');

?>
<script type="text/javascript">
VCH_POSTS_AJAX_ENABLE = <?=COption::GetOptionString('vettich.autoposting', 'is_ajax_enable', 'Y') == 'Y'? 'true' : 'false'?>;
</script>
