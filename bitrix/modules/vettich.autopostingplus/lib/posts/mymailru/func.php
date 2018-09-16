<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
use Vettich\Autoposting\PostsBase\FuncBase;

IncludeModuleLangFile(__FILE__);

class Func extends FuncBase
{
	const DBTABLE = '\Vettich\AutopostingPlus\Posts\mymailru\DBTable';
	const DBOPTIONTABLE = '\Vettich\AutopostingPlus\Posts\mymailru\DBOptionTable';
	const ACCPREFIX = 'MYMAILRU';

	// static function get_name()
	// {
	// 	return 'MyMailRu';
	// }

	static function getBaseDir()
	{
		return dirname(__DIR__);
	}
}
