<?php
// THIS FILE - DOCUMENT_ROOT/bitrix/modules/vettich.autopostingplus/cron/agent.php
$MODULE_ROOT = dirname(__DIR__);
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname($MODULE_ROOT)));

define('NO_KEEP_STATISTIC', true); 
define('NOT_CHECK_PERMISSIONS', true); 
define('VCH_APP_CRON', true); 

set_time_limit(0); 
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); 

$agent_type = COption::GetOptionString('vettich.autoposting', 'agent_type', '');
if($agent_type == 'only_hits')
	exit;

CModule::IncludeModule('vettich.autopostingplus');
CVettichAutopostingplus::agent();
?>