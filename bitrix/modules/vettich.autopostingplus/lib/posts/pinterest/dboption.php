<?
namespace Vettich\AutopostingPlus\Posts\pinterest;
use Bitrix\Main\Entity;

class DBOptionTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_pinterest_option_v2';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('PINTEREST_PUBLICATION_MODE'),
			new Entity\StringField('PINTEREST_PHOTO'),
			new Entity\StringField('PINTEREST_PHOTO_OTHER'),
			new Entity\StringField('PINTEREST_LINK'),
			new Entity\TextField('PINTEREST_MESSAGE'),
			new Entity\StringField('PINTEREST_UTM_SOURCE'),
			new Entity\StringField('PINTEREST_UTM_MEDIUM'),
			new Entity\StringField('PINTEREST_UTM_CAMPAIGN'),
			new Entity\StringField('PINTEREST_UTM_TERM'),
			new Entity\StringField('PINTEREST_UTM_CONTENT'),
		);
	}
}
