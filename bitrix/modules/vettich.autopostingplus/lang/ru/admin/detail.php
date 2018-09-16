<?

$MESS['vettich.autopostingplus_detail_back'] = 'Назад';
$MESS['vettich.autopostingplus_detail_delete'] = 'Удалить';
$MESS['vettich.autopostingplus_detail_delete_confirm'] = 'Вы действительно хотите удалить запись из очереди?';
$MESS['SAVE_BUTTON'] = 'Сохранить';
$MESS['APPLY_BUTTON'] = 'Применить';
$MESS['vettich.autopostingplus_detail_tab1'] = 'Элемент очереди';
$MESS['vettich.autopostingplus_detail_tab1_title'] = 'Просмотр и редактирование';
$MESS['vettich.autopostingplus_detail_ACTIVE'] = 'Активность';
$MESS['vettich.autopostingplus_detail_ELEM'] = 'Элемент';
$MESS['vettich.autopostingplus_detail_IBLOCK'] = 'Инфоблок';
$MESS['vettich.autopostingplus_detail_TYPE'] = 'Операция';
$MESS['vettich.autopostingplus_detail_STATUS'] = 'Статус';
$MESS['vettich.autopostingplus_detail_ELEM_NOT_FOUND'] = '[#ID#] Не найден';
$MESS['vettich.autopostingplus_detail_STATUS_READY'] = 'Готов к выполнению';
$MESS['vettich.autopostingplus_detail_STATUS_OK'] = 'Выполнено';
$MESS['vettich.autopostingplus_detail_PUBLICATION_ID'] = 'Публикация';
$MESS['vettich.autopostingplus_detail_LAST_MODIFIED'] = 'Последний раз был изменен';
$MESS['vettich.autopostingplus_detail_PUBLICATION_DATE'] = 'Операция будет выполнена в';
$MESS['autopostingplus_detail_PUBLICATION_DATE_OK'] = '--:--';
$MESS['vettich.autopostingplus_detail_post_id_empty'] = 'Поста не существует';
$MESS['vettich.autopostingplus_detail_ACCOUNTS_TITLE'] = 'Список опубликованных постов в соц. сетях';
$MESS['vettich.autopostingplus_detail_TYPE_ADD'] = 'Публикация';
$MESS['vettich.autopostingplus_detail_TYPE_EDIT'] = 'Изменение';
$MESS['vettich.autopostingplus_detail_TYPE_DELETE'] = 'Удаление';
$MESS['vettich.autopostingplus_detail_title'] = 'Детальный просмотр элемента';
$MESS['vettich.autopostingplus_detail_TYPE_HELP'] = 'Тип выполняемой операции';
$MESS['vettich.autopostingplus_detail_STATUS_HELP'] = 'Статус выполнения операции';
$MESS['vettich.autopostingplus_detail_PUBLICATION_DATE_HELP'] = 'Время когда будет выполнена операция';
$MESS['vettich.autopostingplus_detail_description'] = 'Есть три типа операций над элементом в очереди:
<ul>
	<li>Публикация - постинг нового элемента очереди в соц. сети</li>
	<li>Изменение - происходит обновление постов в соц. сетях (или его добавление, в случае если он ранее не был опубликован).</li>
	<li>Удаление - выполняется удаление опубликованных постов в соц. сетях</li>
</ul>
В данный момент Изменение и Удаление постов не поддерживается для соц. сети Одноклассники, так как, к сожалению, в api одноклассников нету такой возможности. (Данные операции для этой соц. сети просто игнорируются)<br>
<br>
Для каждой операции предусмотрено два типа статуса:
<ul>
	<li>Готов к выполнению - операция еще не выполнялась, но готова к выполнению</li>
	<li>Выполнено - операция выполнилась</li>
</ul>
В случае если публикация в какую то соц. сеть не прошла, элемент можно будет опубликовать вручную в списке элементов инфоблока.
';
