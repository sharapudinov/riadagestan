<?
/**
 * Основной класс модуля. Хранит в себе все необходимые процедуры
 * @author Aleksandras Ostroumovas (info@shopolia.com)
 * @link http://www.shopolia.com/
 * @version 1.0.0
 * @todo 
 */
 
global $APPLICATION, $MESS, $DBType;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	"shopolia.images",
	array(
		"CShopoliaImagesProperty" => "classes/".$DBType."/CShopoliaImagesProperty.php", // Различные хэндлеры модуля
	)
);