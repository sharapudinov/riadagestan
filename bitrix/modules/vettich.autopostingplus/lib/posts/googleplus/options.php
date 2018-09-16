<?
IncludeModuleLangFile(__FILE__);

$arPostParams = array(
	'TABS' => array(
		'GOOGLEPLUS_TAB' => array(
			'NAME' => GetMessage('GOOGLEPLUS_TAB_NAME'),
			'TITLE' => GetMessage('GOOGLEPLUS_TAB_TITLE')
		)
	),
	'PARAMS' => array(
		'is_googleplus_enable' => array(
			'TAB' => 'GOOGLEPLUS_TAB',
			'NAME' => GetMessage('IS_GOOGLEPLUS_ENABLE'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'googleplus_log_success' => array(
			'TAB' => 'GOOGLEPLUS_TAB',
			'NAME' => GetMessage('googleplus_log_success'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'googleplus_log_error' => array(
			'TAB' => 'GOOGLEPLUS_TAB',
			'NAME' => GetMessage('googleplus_log_error'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
	)
);
