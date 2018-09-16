<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");

// $APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
	// "CACHE_TYPE" => "A",
	// "CACHE_TIME" => "36000000",
	// "SET_TITLE" => "Y",
	// "LEVEL"	=>	"3",
	// "COL_NUM"	=>	"2",
	// "SHOW_DESCRIPTION" => "Y"
	// ),
	// false
// );
?>
<style>
.article_404 {
margin: 40px 150px 100px;
}
.clear {
clear: both;
font-size: 0;
line-height: 0;
}
.article_header {
min-height: auto;
height: 80px;
}
font: bold 34px/38px Arial,Helvetica,sans-serif;
color: #000;
}
margin: 30px 0;
font-size: 16px;
</style>
<div class="article_404"><div class="clear"></div><div class="article_header"><h1 class="article_header_title">
                        Ошибка 404
                    </h1></div><p>К сожалению, страница, которую вы запрашиваете, не существует.</p><p><a href="mailto:rian-error@rian.ru">Сообщить об ошибке</a> команде разработчиков сайта.</p>
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>