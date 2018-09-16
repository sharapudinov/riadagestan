<?define("BX_CRONTAB_SUPPORT", true);?><?
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "root";
$DBPassword = "qWeDcXzAs*2016";
// $DBPassword = "ijGHGrjO";
$DBName = "sitemanager0";
$DBDebug = false;
$DBDebugToFile = false;

@set_time_limit(60);

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600000);
define("CACHED_b_option", 3600000);
define("CACHED_b_lang_domain", 3600000);
define("CACHED_b_site_template", 3600000);
define("CACHED_b_event", 3600000);
define("CACHED_b_agent", 3660000);
define("CACHED_menu", 3600000);

define("BX_TEMPORARY_FILES_DIRECTORY", "/home/bitrix/tmp/www/");
define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~BX_DIR_PERMISSIONS);
#@ini_set("memory_limit", "512M");
define("BX_DISABLE_INDEX_PAGE", true);
define("MYSQL_TABLE_TYPE", "InnoDB");
define("BX_COMPOSITE_DEBUG", false);
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
ob_start();
define("BX_USE_MYSQLI", true);
?>