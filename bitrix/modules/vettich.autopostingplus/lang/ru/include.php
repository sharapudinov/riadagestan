<?

$MESS['vettich.autopostingplus_menu_queue_text'] = 'Очередь публикаций';
$MESS['PENDING_TAB_NAME'] = 'Отложенная публикация';
$MESS['PENDING_TAB_TITLE'] = 'Настройки';
$MESS['PENDING_TAB_IS_ENABLE_AGENT'] = 'Включить очередь публикации';
$MESS['vettich.autopostingplus_menu_category_text'] = 'Категории публикаций';
$MESS['vettich.autopostingplus_menu_text'] = 'Автопубликация в социальные сети +';
$MESS['vettich.autopostingplus_menu_info_text'] = 'Информация';
$MESS['PENDING_TAB_IS_CUSTOM_AGENT'] = 'Использовать ли на хитах кастомный агент вместо битриксового?';
$MESS['NO'] = 'Нет';
$MESS['YES'] = 'Да';
$MESS['PENDING_TAB_AGENT_TYPE'] = 'Указать принудительную публикацию (на хитах, по крону, или по умолчанию)';
$MESS['PENDING_TAB_AGENT_TYPE_DEFAULT'] = 'По умолчанию';
$MESS['PENDING_TAB_AGENT_TYPE_ONLY_HITS'] = 'Только на хитах';
$MESS['PENDING_TAB_AGENT_TYPE_ONLY_CRON'] = 'Только по крону';
$MESS['PENDING_TAB_AGENT_TYPE_HELP'] = 'Можно указать, как публиковать элементы из очереди, на хитах или же по крону.
Значение По умолчанию значит, что публикация будет произведена, в соответствии настройки отдельно взятой Публикации.
Остальные значения будут задавать способ публикации принудительно, в этом случае настройки Публикации будут игнорироваться.';
$MESS['PENDING_TAB_AGENT_TYPE_CRON_NOTE_TEXT'] = 'Для публикации элементов из очереди по крону, нужно настроить крон на вашем сервере. Пропишите в крон следующее:
<br>
<b>* * * * * php #AGENT_FILE#  > /dev/null 2>&1 </b>
<br>
Эта команда позволит публиковать элементы из очереди публикаций по крону, для снятия нагрузки с посетителей сайта.';
