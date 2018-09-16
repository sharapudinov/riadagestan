<?
namespace Vettich\AutopostingPlus\Posts\pinterest;
use Bitrix\Main\Entity;

class DBTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_pinterest';
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
			new Entity\StringField('PAGE_ID'),
			new Entity\StringField('ACCESS_TOKEN'),
		);
	}
}
