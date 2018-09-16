$(function(){
	$('button[name="webformat_watermark1_image_button"]').click(function(e){
		e.preventDefault();
		WebformatShowFileDialog({submitFuncName:'WebformatWatermark1ImageButtonListener'});
	});

	$('button[name="webformat_watermark1_text_button"]').click(function(e){
		e.preventDefault();
		WebformatShowFileDialog({
			submitFuncName: 'WebformatWatermark1TextButtonListener',
			fileFilter: 'ttf'
		});
	});

	window.WebformatShowFileDialog = function(params){
		if (!params){params = {};}
		var UserConfig ={
			site : '',
			path : '/',
			view : "list",
			sort : "type",
			sort_order : "asc"
		};

		var oConfig = {
			submitFuncName : '',
			select : 'F',
			operation: 'O',
			showUploadTab : true,
			showAddToMenuTab : false,
			site : '',
			path : '/',
			lang : 'ru',
			fileFilter : 'jpg,jpeg,png,gif',
			allowAllFiles : false,
			saveConfig : true,
			sessid: phpVars.bitrix_sessid,
			checkChildren: true,
			genThumb: true,
			zIndex: 2500
		};

		if(window.oBXFileDialog && window.oBXFileDialog.UserConfig){
			UserConfig = oBXFileDialog.UserConfig;
			oConfig.path = UserConfig.path;
			oConfig.site = UserConfig.site;
		}
		for(var paramName in params){oConfig[paramName] = params[paramName];}


		oBXFileDialog = new BXFileDialog();
		oBXFileDialog.Open(oConfig, UserConfig);
	};

	function WebformatWatermark1ProcessPath(filename, path){
		path = jsUtils.trim(path);
		path = path.replace(/\\/ig,"/");
		path = path.replace(/\/\//ig,"/");
		if (path.substr(path.length-1) == "/"){path = path.substr(0, path.length-1);}
		return (path + '/' + filename).replace(/\/\//ig, '/');
	}

	window.WebformatWatermark1ImageButtonListener = function(filename, path, site, title, menu){
		full = WebformatWatermark1ProcessPath(filename, path);
		$('input[name="webformat_watermark1[filter][file]"]').val(full);
	};
	window.WebformatWatermark1TextButtonListener = function(filename, path, site, title, menu){
		full = WebformatWatermark1ProcessPath(filename, path);
		$('input[name="webformat_watermark1[filter][font]"]').val(full);
	};

	$('input[name="webformat_watermark1[filter][type]"]').change(function(e){
		var radio = $('input[name="webformat_watermark1[filter][type]"]:checked');
		$('tbody[class^="webformat_watermark1_"]').hide().filter('[class="webformat_watermark1_' + radio.val() + '"]').show();
		if(radio.val() == 'image'){ $('.adm-workarea-wrap .coefficient-comment').show();
		}else{$('.adm-workarea-wrap .coefficient-comment').hide();}
	});
	$('input[name="webformat_watermark1[filter][type]"]:checked').trigger('change');
});
