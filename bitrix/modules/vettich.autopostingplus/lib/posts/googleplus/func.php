<?
namespace Vettich\AutopostingPlus\Posts\googleplus;
use Vettich\Autoposting\PostsBase\FuncBase;

IncludeModuleLangFile(__FILE__);

class Func extends FuncBase
{
	const DBTABLE = '\Vettich\AutopostingPlus\Posts\googleplus\DBTable';
	const DBOPTIONTABLE = '\Vettich\AutopostingPlus\Posts\googleplus\DBOptionTable';
	const ACCPREFIX = 'GOOGLEPLUS';

	static function get_name()
	{
		return 'Google+';
	}

	static function getBaseDir()
	{
		return dirname(__DIR__);
	}
}
