<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<div class="menu_wrapper">
    <a id="touch-menu" class="mobile-menu" href="#"><i class="icon-reorder"></i>Меню</a>
    <nav>
        <? if (!empty($arResult)): ?>
            <ul class="menu">
                <?
                //$arItem[TEXT]
                //$arItem[SELECTED]
                //$arItem[DEPTH_LEVEL]
                //$arItem[LINK]
                //$arItem[ITEM_INDEX]

                $mcount_menu_item = count($arResult);
                $l1 = 0; //установка меню первого уровня
                $l2 = 0; //установка меню второго уровня
                $l3 = 0; //установка меню третьего уровня
                $item_menu = 0;
                $show_menu = 1;

                foreach ($arResult as $arItem):?>
                    <?
                    if ($arItem['DEPTH_LEVEL'] == 1):
                        if ($l3 == 1):
                            echo "</ul>";
                            $l3 = 0;
                        endif;

                        if ($l2 == 1):
                            echo "</li></ul>";
                            $l2 = 0;
                        endif;
                        if ($l1 == 1):
                            echo "</li>";
                        endif;
                        echo "<li><a href='" . $arItem["LINK"] . "'>" . $arItem["TEXT"] . "</a>";
                        $l1 = 1;
                    endif;

                    $item_menu++;
                    if ($item_menu == $mcount_menu_item):
                        if ($l2 == 1):
                            echo "</ul>";
                        endif;
                        if ($l1 == 1):
                            echo "</li>";
                        endif;
                    endif;


                    ?>
                <? endforeach ?>
            </ul>

        <? endif ?>
    </nav>
</div>
