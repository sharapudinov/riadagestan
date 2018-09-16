<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
use Bitrix\Main\Entity;

class DBTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_mymailru';
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
			new Entity\StringField('REFRESH_TOKEN'),
			new Entity\StringField('ACCESS_TOKEN'),
			new Entity\StringField('EXPIRES_IN'),
			new Entity\StringField('CLIENT_ID'),
			new Entity\StringField('CLIENT_SECRET'),
		);
	}
}
