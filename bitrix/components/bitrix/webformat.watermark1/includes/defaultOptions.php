<?php if(!defined("B_PROLOG_INCLUDED") || (B_PROLOG_INCLUDED !== true)){die();}
$options = array(
	'iblocks' => array(-1),
	'props' => array("DETAIL_PICTURE","PREVIEW_PICTURE","MORE_PHOTO"),
	'filter' => array(
		"type" => "image",
		"position" => "mc",
		"coefficient" => "0.3",
		"file" => "",
		"alpha_level" => "50",
		"text" => "",
		"font" => rtrim($_SERVER["DOCUMENT_ROOT"], '/')."/bitrix/modules/webformat.watermark1/fonts/opensans-condensed/opensans-condlight-webfont.ttf",
		"color" => "cccccc",
		"name" => "watermark",
		"fill" => "resize"
	)
);