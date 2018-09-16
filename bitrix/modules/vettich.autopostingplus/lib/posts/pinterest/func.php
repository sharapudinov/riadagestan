<?
namespace Vettich\AutopostingPlus\Posts\pinterest;
use Vettich\Autoposting\PostsBase\FuncBase;

IncludeModuleLangFile(__FILE__);

class Func extends FuncBase
{
	const DBTABLE = '\Vettich\AutopostingPlus\Posts\pinterest\DBTable';
	const DBOPTIONTABLE = '\Vettich\AutopostingPlus\Posts\pinterest\DBOptionTable';
	const ACCPREFIX = 'PINTEREST';

	static function get_name()
	{
		return 'Pinterest';
	}

	static function getBaseDir()
	{
		return dirname(__DIR__);
	}
}
