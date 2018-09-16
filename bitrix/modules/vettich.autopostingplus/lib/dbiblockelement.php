<?
namespace Vettich\AutopostingPlus;
use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class DBIBlockElementTable extends Entity\DataManager
{
	public static function getTableName()
	{
		return 'b_iblock_element';
	}

	public static function getMap()
	{
		$map = array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\ReferenceField('CAT_ELEM', '\Vettich\AutopostingPlus\DBCategoryElems', array(
				'=this.ID' => 'ref.ELEM_ID'
			)),
			new Entity\IntegerField('IBLOCK_ID'),
			new Entity\IntegerField('IBLOCK_SECTION_ID'),
		);
		if(IsModuleInstalled('workflow'))
			$map[] = new Entity\IntegerField('WF_PARENT_ELEMENT_ID');
		return $map;
	}

	public static function OnBeforeAdd(Entity\Event $event)
	{
		return false;
	}
	public static function OnBeforeUpdate(Entity\Event $event)
	{
		return false;
	}
	public static function OnBeforeDelete(Entity\Event $event)
	{
		return false;
	}
}
