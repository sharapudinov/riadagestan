<?
namespace Vettich\AutopostingPlus;
use Vettich\Autoposting\PostingFunc;

class Func
{
	const DB_OPTION_TABLE = '\Vettich\AutopostingPlus\DBOptionTable';
	const DB_ELEMENTS_TABLE = '\Vettich\AutopostingPlus\DBElementsTable';
	const DB_CATEGORY_TABLE = '\Vettich\AutopostingPlus\DBCategoryTable';

	static function GetValues($ID, $dbtable = self::DB_OPTION_TABLE, $onPOST = true)
	{
		if($dbtable == null)
			return array();

		$arValues = array();
		if($onPOST)
		{
			$arFields = PostingFunc::GetFieldsDBTable($dbtable);
			foreach($arFields as $field)
			{
				if(isset($_POST[$field]))
				{
					$arValues[$field] = $_POST[$field];
				}
			}
			if(!empty($arValues))
				return $arValues;
		}

		if($ar = $dbtable::GetRowById($ID))
			$arValues = $ar;
		return $arValues;
	}

	static function GetTreeSectionsID($iblockID, $arSectionID, $isOnlyActive=false)
	{
		$arResult = array();
		\CModule::IncludeModule('iblock');
		$arFilter = array('ID' => $arSectionID, 'IBLOCK_ID' => $iblockID);
		if($isOnlyActive)
			$arFilter['ACTIVE'] = 'Y';
		$rs = \CIBlockSection::GetList(array(), $arFilter);
		$arMargin = array();
		while($ar = $rs->Fetch())
			$arMargin = array(
				'LEFT_MARGIN' => $ar['LEFT_MARGIN'],
				'RIGHT_MARGIN' => $ar['RIGHT_MARGIN']
			);
		if(!empty($arMargin))
		{
			// $arMargin['LOGIC'] = 'OR';
			$arMargin['IBLOCK_ID'] = $iblockID;
			$arFilter = array(
				'IBLOCK_ID' => $iblockID,
				array(
					'LOGIC' => 'OR',
					array(
						'LEFT_MARGIN' => 11,
						'RIGHT_MARGIN' => 20
					)
				)
				// $arMargin,
			);
			// \VOptions::debugg($arFilter);
			$rs = \CIBlockSection::GetTreeList($arFilter);
			while($ar = $rs->Fetch())
				$arResult[] = $ar/*['ID']*/;
		}
		return $arResult;
	}

	static function GetPosts()
	{
		return array('googleplus', 'pinterest', 'mymailru', 'instagram', 'odnoklassniki');
	}
}