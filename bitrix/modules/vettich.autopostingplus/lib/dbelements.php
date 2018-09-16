<?
namespace Vettich\AutopostingPlus;
use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class DBElementsTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autopostingplus_elements';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\BooleanField('ACTIVE', array('values' => array('N', 'Y'))),
			new Entity\IntegerField('ELEM_ID'),
			new Entity\IntegerField('IBLOCK_ID'),
			new Entity\StringField('TYPE'),
			new Entity\StringField('STATUS', array('default_value' => '')),
			new Entity\IntegerField('PUBLICATION_ID'),
			new Entity\DatetimeField('PUBLICATION_DATE', array('default_value' => function(){return new Type\DateTime();})),
			new Entity\ReferenceField('PUBLICATION', '\Vettich\Autoposting\DB', array(
				'=this.PUBLICATION_ID' => 'ref.ID',
			)),
			new Entity\ReferenceField('OPTION', '\Vettich\AutopostingPlus\DBOption', array(
				'=this.PUBLICATION_ID' => 'ref.ID',
			)),
			new Entity\DatetimeField('LAST_MODIFIED', array(
				'default_value' => function () {
					return new Type\DateTime();
				}
			)),
			new Entity\TextField('ACCOUNT_VK',           array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_VKGOODS',      array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_FACEBOOK',     array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_TWITTER',      array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_ODNOKLASSNIKI',array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_INSTAGRAM',    array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_GOOGLEPLUS',   array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_LINKEDIN',     array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_LIVEJOURNAL',  array('serialized'=>true, 'default_value' => '')),
			new Entity\TextField('ACCOUNT_PINTEREST',    array('serialized'=>true,'column_name'=>'ACCOUNT_RESERVE1', 'default_value' => '')),
			new Entity\TextField('ACCOUNT_MYMAILRU',     array('serialized'=>true,'column_name'=>'ACCOUNT_RESERVE2', 'default_value' => '')),
			new Entity\TextField('ACCOUNT_RESERVE3', array('default_value' => '')),
			new Entity\TextField('ACCOUNT_RESERVE4', array('default_value' => '')),
		);
	}
}
