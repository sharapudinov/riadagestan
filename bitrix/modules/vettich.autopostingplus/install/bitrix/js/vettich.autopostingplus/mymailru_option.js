function vch_autopostingplus_mymailru_get_token(elem)
{
	if(!elem)
		return;

	var callback = window.location.origin + '/bitrix/admin/vettich_autopostingplus_mymailru_callback.php';
	var url = 'http://vettich.ru/service/social/mymailru/get_token?callback=' + encodeURIComponent(callback);
	width = 800;
	height = 600;
	window.open(url, 'VOptionsPinterestToken', 'location=yes,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',left=' + ((window.innerWidth - width)/2) + ',top=' + ((window.innerHeight - height)/2));
}

function vch_autopostingplus_mymailru_callback_token(data)
{
	$('#ACCESS_TOKEN').val(data['access_token']);
	$('#REFRESH_TOKEN').val(data['refresh_token']);
	$('#CLIENT_ID').val(data['client_id']);
	$('#CLIENT_SECRET').val(data['client_secret']);
	$('#EXPIRES_IN').val(data['expires_in']);

	if(!!data['pages'])
	{
		var page_id_values = '';
		$.each(data['pages'], function(i, v){
			page_id_values += '<option value="' + i + '">' + v + '</option>';
		});
		if(page_id_values.length)
		{
			$('#PAGE_ID').html(page_id_values);
		}
		else
		{
			$('#PAGE_ID').html('<option value="">Unknown error</option>');
		}
	}

	return true;
}
