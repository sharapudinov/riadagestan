<?
IncludeModuleLangFile(__FILE__);

$arPostParams = array(
	'TABS' => array(
		'PINTEREST_TAB' => array(
			'NAME' => GetMessage('PINTEREST_TAB_NAME'),
			'TITLE' => GetMessage('PINTEREST_TAB_TITLE')
		)
	),
	'PARAMS' => array(
		'is_pinterest_enable' => array(
			'TAB' => 'PINTEREST_TAB',
			'NAME' => GetMessage('IS_PINTEREST_ENABLE'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'pinterest_log_success' => array(
			'TAB' => 'PINTEREST_TAB',
			'NAME' => GetMessage('pinterest_log_success'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'pinterest_log_error' => array(
			'TAB' => 'PINTEREST_TAB',
			'NAME' => GetMessage('pinterest_log_error'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
	)
);
