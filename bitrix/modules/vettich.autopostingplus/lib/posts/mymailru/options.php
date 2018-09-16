<?
IncludeModuleLangFile(__FILE__);

$arPostParams = array(
	'TABS' => array(
		'MYMAILRU_TAB' => array(
			'NAME' => GetMessage('MYMAILRU_TAB_NAME'),
			'TITLE' => GetMessage('MYMAILRU_TAB_TITLE')
		)
	),
	'PARAMS' => array(
		'is_mymailru_enable' => array(
			'TAB' => 'MYMAILRU_TAB',
			'NAME' => GetMessage('IS_MYMAILRU_ENABLE'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'mymailru_log_success' => array(
			'TAB' => 'MYMAILRU_TAB',
			'NAME' => GetMessage('mymailru_log_success'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
		'mymailru_log_error' => array(
			'TAB' => 'MYMAILRU_TAB',
			'NAME' => GetMessage('mymailru_log_error'),
			'TYPE' => 'CHECKBOX',
			// 'DEFAULT' => 'Y',
		),
	)
);
