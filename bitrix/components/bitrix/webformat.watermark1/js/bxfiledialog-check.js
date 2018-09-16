(function() {
	if(!window.BXFileDialog){
	    var scriptTag = document.createElement('script');
	    scriptTag.setAttribute("type","text/javascript");
	    scriptTag.setAttribute("src","/bitrix/js/main/file_dialog.js?v=1357709377");
	    scriptTag.onload = Webformat_BXFileDialogDoActions;
	    scriptTag.onreadystatechange = function () { //IE
	        if(this.readyState == 'complete' || this.readyState == 'loaded'){Webformat_BXFileDialogDoActions();}
	    };
	    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(scriptTag);
	}else{Webformat_BXFileDialogDoActions();}

	function Webformat_BXFileDialogDoActions(){
		//#AUTO_INSERTION_PLACE
	}
})();