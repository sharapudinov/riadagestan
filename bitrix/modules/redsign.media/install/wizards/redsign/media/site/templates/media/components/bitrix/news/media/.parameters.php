<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Redsign\Media\MediaTemplate;

Loc::loadMessages(__FILE__);



$arSorts = [
    "ASC" => Loc::getMessage("T_IBLOCK_DESC_ASC"),
    "DESC" => Loc::getMessage("T_IBLOCK_DESC_DESC")
];

$arSortFields = [
	"ID" => Loc::getMessage("T_IBLOCK_DESC_FID"),
	"NAME" => Loc::getMessage("T_IBLOCK_DESC_FNAME"),
	"ACTIVE_FROM" => Loc::getMessage("T_IBLOCK_DESC_FACT"),
	"SORT" => Loc::getMessage("T_IBLOCK_DESC_FSORT"),
	"TIMESTAMP_X" => Loc::getMessage("T_IBLOCK_DESC_FTSAMP")
];

if (Loader::includeModule('iblock')) {
    if ($arCurrentValues['IBLOCK_ID']) {
        $propsIterator = \Bitrix\Iblock\PropertyTable::getList([
            'filter' => [
                'IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'],
            ],
            'select' => ['ID', 'PROPERTY_TYPE', 'USER_TYPE', 'CODE', 'NAME']
        ]);

        $arPropsWithTypeElement = array();
        $arPropsWithTypeHTML = array();
		$arStringsProps = array();
        while($arProp = $propsIterator->fetch()) {
            if ($arProp['PROPERTY_TYPE'] == \Bitrix\Iblock\PropertyTable::TYPE_ELEMENT ) {
                $arPropsWithTypeElement[$arProp['CODE']] = '['.$arProp['CODE'].'] '.$arProp['NAME'];
            } elseif ($arProp['USER_TYPE'] == 'HTML') {
                $arPropsWithTypeHTML[$arProp['CODE']] = '['.$arProp['CODE'].'] '.$arProp['NAME'];
            } elseif ($arProp['PROPERTY_TYPE'] == \Bitrix\Iblock\PropertyTable::TYPE_STRING) {
				$arStringProps[$arProp['CODE']] =  '['.$arProp['CODE'].'] '.$arProp['NAME'];
			}
        }

        $arTemplateParameters['RS_LINKED_PROPS'] = [
            'PARENT' => 'DETAIL_SETTINGS',
            'NAME' => Loc::GetMessage('RS_N_PARAMETERS_LINKED_PROPS'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropsWithTypeElement,
            'MULTIPLE' => 'Y'
        ];

        $arTemplateParameters['RS_DETAIL_PROP_VIDEO'] = [
            'PARENT' => 'DETAIL_SETTINGS',
            'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_VIDEO'),
            'TYPE' => 'LIST',
            'VALUES' => array_merge(array(''), $arPropsWithTypeHTML)
        ];

		$arTemplateParameters['RS_DETAIL_PROP_SOURCES'] = [
            'PARENT' => 'DETAIL_SETTINGS',
            'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_SOURCES'),
            'TYPE' => 'LIST',
            'VALUES' => array_merge(array(''), $arStringProps)
        ];
    }
}

$arTemplateParameters['RS_LIST_POPULAR_IS_SHOW'] = [
    'PARENT' => 'LIST_SETTINGS',
    'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_IS_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'Y',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['RS_LIST_POPULAR_IS_SHOW'] == 'Y') {
    $arTemplateParameters['RS_LIST_POPULAR_MODE'] = [
        'PARENT' => 'LIST_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_MODE'),
        'TYPE' => 'LIST',
        'DEFAULT' => 'RS_LIST_POPULAR_MODE_1',
        'VALUES' => [
            'RS_LIST_POPULAR_MODE_1' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_MODE_1'),
            'RS_LIST_POPULAR_MODE_2' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_MODE_2'),
            'RS_LIST_POPULAR_MODE_3' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_MODE_3'),
            'RS_LIST_POPULAR_MODE_4' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_MODE_4'),
        ]
    ];

    $arTemplateParameters['RS_LIST_POPULAR_SORT_BY1'] = [
        'PARENT' => 'LIST_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_IBORD1'),
        'TYPE' => 'LIST',
        'DEFAULT' => 'SORT',
        'VALUES' => $arSortFields,
        'ADDITIONAL_VALUES' => 'Y'
    ];

    $arTemplateParameters['RS_LIST_POPULAR_SORT_ORDER1'] = [
        'PARENT' => 'LIST_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_IBBY1'),
        'TYPE' => 'LIST',
        'DEFAULT' => 'DESC',
        'VALUES' => $arSorts,
        'ADDITIONAL_VALUES' => 'Y'
    ];

    $arTemplateParameters['RS_LIST_POPULAR_SORT_BY2'] = [
        'PARENT' => 'LIST_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_IBORD2'),
        'TYPE' => 'LIST',
        'DEFAULT' => 'SORT',
        'VALUES' => $arSortFields,
        'ADDITIONAL_VALUES' => 'Y'
    ];

    $arTemplateParameters['RS_LIST_POPULAR_SORT_ORDER2'] = [
        'PARENT' => 'LIST_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_LIST_POPULAR_IBBY2'),
        'TYPE' => 'LIST',
        'DEFAULT' => 'DESC',
        'VALUES' => $arSorts,
        'ADDITIONAL_VALUES' => 'Y'
    ];
}


$arTemplateParameters['RS_DETAIL_USE_ELEMENT_NAVIGATION'] = [
    'PARENT' => 'DETAIL_SETTINGS',
    'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_USE_ELEMENT_NAVIGATION'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'Y'
];

if (Loader::includeModule('redsign.media')) {
    $arTemplateParameters['RS_DETAIL_USE_SHARE'] = [
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_USE_SHARE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'Y',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['RS_DETAIL_USE_SHARE'] == 'Y') {
        $arTemplateParameters['RS_DETAIL_SHARE_SOCIALS'] = array(
            'PARENT' => 'DETAIL_SETTINGS',
            'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_SOCIALS'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES' => MediaTemplate::getAllSocials(),
        );
    }
}

$arTemplateParameters['RS_DETAIL_USE_COMMENTS'] = [
    'PARENT' => 'DETAIL_SETTINGS',
    'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_USE_COMMENTS'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'Y',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['RS_DETAIL_USE_COMMENTS'] == 'Y') {

	$arTemplateParameters['RS_DETAIL_COMMENTS_TYPE'] = [
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_TYPE'),
		'TYPE' => 'LIST',
		'REFRESH' => 'Y',
		'VALUES' => array(
			'blog' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_TYPE_BLOG'),
			'vk' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_TYPE_VK')
		),
		'DEFAULT' => 'blog'
	];

	if ($arCurrentValues['RS_DETAIL_COMMENTS_TYPE'] == 'vk') {
		$arTemplateParameters['RS_DETAIL_COMMENTS_VK_CODE'] = [
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_VK_CODE'),
			'TYPE' => 'string',
			'DEFAULT' => ''
		];
	} else {
		$arTemplateParameters['RS_DETAIL_COMMENTS_BLOG_CODE'] = [
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_BLOG_CODE'),
			'TYPE' => 'string',
			'DEFAULT' => 'comments'
		];

		$arTemplateParameters['RS_DETAIL_COMMENTS_USE_CONSENT'] = [
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_USE_CONSENT'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
			'REFRESH' => 'Y'
		];

		if ($arCurrentValues['RS_DETAIL_COMMENTS_USE_CONSENT'] == 'Y') {
			$arAgreements = \Bitrix\Main\UserConsent\Agreement::getActiveList();
			$arTemplateParameters['RS_DETAIL_COMMENTS_CONSENT_ID'] = [
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => Loc::getMessage('RS_N_PARAMETERS_DETAIL_COMMENTS_CONSENT'),
				'TYPE' => 'LIST',
				'DEFAULT' => '-',
				'VALUES' => $arAgreements
			];
		}
	}


}
