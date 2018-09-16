<?
namespace Vettich\AutopostingPlus\Posts\googleplus;
use Bitrix\Main\Entity;

class DBTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_googleplus';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('NAME'),
			new Entity\BooleanField('IS_ENABLE', array('values' => array('N', 'Y'))),
			new Entity\StringField('PROFILE_ID'),
			new Entity\StringField('PAGE_ID'),
			new Entity\StringField('EMAIL'),
			new Entity\StringField('PASS'),
		);
	}
}
