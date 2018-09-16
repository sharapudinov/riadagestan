<?
namespace Vettich\AutopostingPlus;
use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class DBCategoryTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autopostingplus_category';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\BooleanField('ACTIVE', array('values' => array('N', 'Y'))),
			new Entity\IntegerField('ELEM_COUNT', array('default_value' => 0)),
			new Entity\IntegerField('NEXT_ELEM', array('default_value' => 0)),
			new Entity\IntegerField('PREV_ELEM', array('default_value' => 0)),
			new Entity\IntegerField('TOTAL_COUNT', array('default_value' => 0)),
			new Entity\StringField('IBLOCK_TYPE'),
			new Entity\IntegerField('IBLOCK_ID'),
			new Entity\StringField('NAME'),
			new Entity\TextField('SUBCATEGORIES', array('serialized' => true, 'default_value' => '')),
			new Entity\IntegerField('PREV_SUBCATEGORY', array('default_value' => '')),
			new Entity\StringField('TYPE'),
			new Entity\StringField('TYPE2'),
			new Entity\StringField('SORT'),
			new Entity\BooleanField('ADD_TO_QUEUE', array('values' => array('N', 'Y'))),
			new Entity\IntegerField('PUBLICATION_ID'),
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
		);
	}

	public static function OnBeforeAdd(Entity\Event $event)
	{
		$result = new Entity\EventResult;
		$result->modifyFields(array('LAST_MODIFIED' => new Type\DateTime()));

		return $result;
	}

	public static function OnBeforeUpdate(Entity\Event $event)
	{
		$result = new Entity\EventResult;
		$result->modifyFields(array('LAST_MODIFIED' => new Type\DateTime()));

		$data = $event->getParameter('fields');
		if(isset($data['PREV_SUBCATEGORY']) && empty($data['PREV_SUBCATEGORY']))
			$result->unsetField('PREV_SUBCATEGORY');
		return $result;
	}
}
