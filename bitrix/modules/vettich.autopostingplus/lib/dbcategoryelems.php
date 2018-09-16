<?
namespace Vettich\AutopostingPlus;
use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class DBCategoryElemsTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autopostingplus_category_elems';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\IntegerField('ELEM_ID'),
			new Entity\IntegerField('CATEGORY_ID'),
			// new Entity\ReferenceField('ELEMENT', '\Vettich\AutopostingPlus\DBIBlockElement', array(
			// 	'this.ELEM_ID' => 'ref.ID'
			// ), 'INNER'),
		);
	}
}
