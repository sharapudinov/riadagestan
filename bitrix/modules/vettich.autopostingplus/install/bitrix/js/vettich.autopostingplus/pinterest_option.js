function vch_autopostingplus_pinterest_get_token(elem)
{
	if(!elem)
		return;

	var callback = window.location.origin + '/bitrix/admin/vettich_autopostingplus_pinterest_callback.php';
	var url = 'http://vettich.ru/service/social/pinterest/get?callback=' + callback;
	width = 800;
	height = 600;
	window.open(url, 'VOptionsPinterestToken', 'location=yes,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',left=' + ((window.innerWidth - width)/2) + ',top=' + ((window.innerHeight - height)/2));
}

function vch_autopostingplus_pinterest_callback_token(data)
{
	d = data;
	$('#ACCESS_TOKEN').val(data['access_token']);

	var page_id_values = '';
	$.each(data['boards'], function(i, v){
		page_id_values += '<option value="' + v['id'] + '">' + v['name'] + ' [' + v['id'] + ']</option>';
	})
	if(page_id_values.length)
	{
		$('#PAGE_ID').html(page_id_values);
	}
	else
	{
		$('#PAGE_ID').html('<option value="">Create a Board in Pinterest</option>');
	}

	return true;
}
