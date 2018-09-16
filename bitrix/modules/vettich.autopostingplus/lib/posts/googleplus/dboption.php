<?
namespace Vettich\AutopostingPlus\Posts\googleplus;
use Bitrix\Main\Entity;

class DBOptionTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_googleplus_option_v2';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('GOOGLEPLUS_PUBLICATION_MODE'),
			new Entity\StringField('GOOGLEPLUS_PHOTO'),
			new Entity\StringField('GOOGLEPLUS_PHOTOS'),
			new Entity\StringField('GOOGLEPLUS_LINK'),
			new Entity\TextField('GOOGLEPLUS_MESSAGE'),
			new Entity\StringField('GOOGLEPLUS_UTM_SOURCE'),
			new Entity\StringField('GOOGLEPLUS_UTM_MEDIUM'),
			new Entity\StringField('GOOGLEPLUS_UTM_CAMPAIGN'),
			new Entity\StringField('GOOGLEPLUS_UTM_TERM'),
			new Entity\StringField('GOOGLEPLUS_UTM_CONTENT'),
		);
	}
}
