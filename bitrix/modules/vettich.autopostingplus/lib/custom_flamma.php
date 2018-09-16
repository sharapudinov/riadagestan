<?
namespace Vettich\AutopostingPlus;

/**
* Специально для сайта фламма.рф
* Autor: Vettich
*/
class custom_flamma
{
	
	function __construct()
	{
	}

	static public function OnAfterEpilog()
	{
		if(\COption::GetOptionString('vettich.autoposting', 'is_enable_agent', 'Y') != 'Y')
			return;
		$prev_time = intval(\COption::GetOptionString('vettich.autopostingplus', 'prev_time', 0));
		if($prev_time + 60 > time())
			return;
		\COption::SetOptionString('vettich.autopostingplus', 'prev_time', time());
		\CVettichAutopostingplus::agent();
	}
}
