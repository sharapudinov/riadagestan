<?
namespace Vettich\AutopostingPlus\Posts\mymailru;
use Bitrix\Main\Entity;

class DBOptionTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autoposting_posts_mymailru_option_v2';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('MYMAILRU_PUBLICATION_MODE'),
			new Entity\StringField('MYMAILRU_PHOTO'),
			new Entity\StringField('MYMAILRU_PHOTO_OTHER'),
			new Entity\TextField('MYMAILRU_MESSAGE'),
			new Entity\StringField('MYMAILRU_UTM_SOURCE'),
			new Entity\StringField('MYMAILRU_UTM_MEDIUM'),
			new Entity\StringField('MYMAILRU_UTM_CAMPAIGN'),
			new Entity\StringField('MYMAILRU_UTM_TERM'),
			new Entity\StringField('MYMAILRU_UTM_CONTENT'),
		);
	}
}
