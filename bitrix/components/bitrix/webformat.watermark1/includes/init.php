<?php
if(CModule::IncludeModule('webformat.watermark1')){
	AddEventHandler('iblock', 'OnAfterIBlockElementAdd', Array('WebformatWatermark1Utils', 'CreateWatermark'));
	AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', Array('WebformatWatermark1Utils', 'CreateWatermark'));
}