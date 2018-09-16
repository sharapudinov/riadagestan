<?
namespace Vettich\AutopostingPlus\Posts\instagram;
use Bitrix\Main\Entity;

class DBTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_instagram';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('NAME'),
			new Entity\StringField('IS_ENABLE'),
			new Entity\StringField('LOGIN'),
			new Entity\StringField('PASSWORD'),
		);
	}
}
