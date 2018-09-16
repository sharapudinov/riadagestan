var vch_autopostingplus_gplus_login = function(content_id)
{
	var email = $('#EMAIL').val();
	var pass = $('#PASS').val();
	if(!email)
	{
		alert(GOOGLEPLUS_JS_EMAIL_EMPTY);
		return;
	}
	if(!pass)
	{
		alert(GOOGLEPLUS_JS_PASS_EMPTY);
		return;
	}

	var url = '/bitrix/admin/vettich_autopostingplus_gplus_method.php';
	var method = 'check_login';
	var show = BX.showWait('adm-workarea');
	$('#'+content_id).html(GOOGLEPLUS_JS_PLS_WAIT);
	var full_url = url + '?method=' + method + '&email=' + email + '&pass=' + pass;
	$.getJSON(
		full_url,
		function(data)
		{
			BX.closeWait('adm-workarea', show);
			console.log(data);
			if(!!data)
			{
				$('#'+content_id).html(GOOGLEPLUS_JS_LOGIN_SUCCESS);
				$('#PROFILE_ID').val(data[0]);
				var page_id_values = '<option value="p' + data[0] + '">Profile [' + data[0] + ']</option>';
				for(var i=0; i<data[1].length; i++)
				{
					var prefix = 'c';
					if(data[1][i].length >= 3)
						prefix = data[1][i][2];
					page_id_values += '<option value="' + prefix + data[1][i][0] + '">' + data[1][i][1] + ' [' + data[1][i][0] + ']</option>';
				}
				console.log(page_id_values);
				$('#PAGE_ID').html(page_id_values);
			}
			else
			{
				$('#'+content_id).html(GOOGLEPLUS_JS_LOGIN_FAIL);
			}
		}
	)
	.fail(function(){
		BX.closeWait('adm-workarea', show);
		$('#'+content_id).html('Error get json');
	});
}