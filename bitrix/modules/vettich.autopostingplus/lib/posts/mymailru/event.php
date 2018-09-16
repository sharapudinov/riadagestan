<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
use Vettich\Autoposting\PostsBase\EventBase;

class Event extends EventBase
{
	static $namespace = __NAMESPACE__;
	static $dbTable = Func::DBTABLE;
	static $dbOptionTable = Func::DBOPTIONTABLE;
}
