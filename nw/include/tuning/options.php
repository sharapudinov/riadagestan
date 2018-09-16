<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'TABS' => array(
        'TAB_MAIN' => array(
            'NAME' => Loc::getMessage('RS.TAB.TAB_MAIN'),
        )
    ),
    'PARAMETERS' => array(
        'COLOR_CONTROL' => array(
            'TAB' => 'TAB_MAIN',
            'TYPE' => 'TITLE',
            'NAME' => Loc::getMessage('RS.TITLE.COLOR_CONTROL'),
            'GRID_SIZE' => 12,
        ),
        'COLOR_1_1' => array(
            'TAB' => 'TAB_MAIN',
            'TYPE' => 'COLORPICKER',
            'NAME' => Loc::getMessage('RS.COLOR_1'),
            'CONTROL_ID' => 'color1',
            'CONTROL_NAME' => 'color1',
            'GRID_SIZE' => 12,
            'CSS_CLASS' => '',
            'ATTR' => '',
            'MULTIPLE' => 'Y',
            'VALUES' => array(
                'COLOR_1_1' => array(
                    'NAME' => Loc::getMessage('RS.COLOR_1_1'),
                    'CONTROL_ID' => 'color1',
                    'CONTROL_NAME' => 'color1',
                    'HTML_VALUE' => '0098f7',
                    'DEFAULT' => '0098f7',
                    'MACROS' => 'COLOR_1_1',
                ),
                'COLOR_1_2' => array(
                    'NAME' => Loc::getMessage('RS.COLOR_1_2'),
                    'CONTROL_ID' => 'color2',
                    'CONTROL_NAME' => 'color2',
                    'HTML_VALUE' => 'f8f9fa',
                    'DEFAULT' => 'f8f9fa',
                    'MACROS' => 'COLOR_1_2',
                ),
            ),
            'SETS' => array(
                'NAME' => Loc::getMessage('RS.GOPRO.SETS'),
                'VALUES' => array(
                    'SET_1' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_1',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#F44336',
                        'VALUES' => array(
                            'COLOR_1_1' => 'F44336',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_2' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_2',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#E91E63',
                        'VALUES' => array(
                            'COLOR_1_1' => 'E91E63',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_3' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_3',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#9C27B0',
                        'VALUES' => array(
                            'COLOR_1_1' => '9C27B0',
                            'COLOR_1_2' => 'efddf2',
                        ),
                    ),
                    'SET_4' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_4',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#673AB7',
                        'VALUES' => array(
                            'COLOR_1_1' => '673AB7',
                            'COLOR_1_2' => 'e7e0e6',
                        ),
                    ),
                    'SET_5' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_5',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#3F51B5',
                        'VALUES' => array(
                            'COLOR_1_1' => '3F51B5',
                            'COLOR_1_2' => 'ccd7e6',
                        ),
                    ),
                    'SET_8' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_6',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#2196F3',
                        'VALUES' => array(
                            'COLOR_1_1' => '2196F3',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_6' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_7',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#03A9F4',
                        'VALUES' => array(
                            'COLOR_1_1' => '03A9F4',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_7' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_8',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#00BCD4',
                        'VALUES' => array(
                            'COLOR_1_1' => '00BCD4',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_9' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_9',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#009688',
                        'VALUES' => array(
                            'COLOR_1_1' => '009688',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_10' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_10',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#4CAF50',
                        'VALUES' => array(
                            'COLOR_1_1' => '4CAF50',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_11' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_11',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#8BC34A',
                        'VALUES' => array(
                            'COLOR_1_1' => '8BC34A',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_12' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_12',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#CDDC39',
                        'VALUES' => array(
                            'COLOR_1_1' => 'CDDC39',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_13' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_13',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#FFEB3B',
                        'VALUES' => array(
                            'COLOR_1_1' => 'FFEB3B',
                            'COLOR_1_2' => '222222',
                        ),
                    ),
                    'SET_14' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_14',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#FFC107',
                        'VALUES' => array(
                            'COLOR_1_1' => 'FFC107',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_15' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_15',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#FF9800',
                        'VALUES' => array(
                            'COLOR_1_1' => 'FF9800',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_16' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_16',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#FF5722',
                        'VALUES' => array(
                            'COLOR_1_1' => 'FF5722',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_17' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_17',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#795548',
                        'VALUES' => array(
                            'COLOR_1_1' => '795548',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    ),
                    'SET_18' => array(
                        'NAME' => '',
                        'CONTROL_ID' => 'color_18',
                        'CONTROL_NAME' => '',
                        'BACKGROUND' => '#607D8B',
                        'VALUES' => array(
                            'COLOR_1_1' => '607D8B',
                            'COLOR_1_2' => 'ffffff',
                        ),
                    )
                ),
            )
        ),


    ),
);
