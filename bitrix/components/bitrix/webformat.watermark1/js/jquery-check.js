(function(){
	var a={};
	if('$'in window&&!('fn'in $)){a.$=$;}
	if(typeof jQuery=='undefined'){
		var b=document.createElement('script');
		b.setAttribute("type","text/javascript");
		b.setAttribute("src","http://code.jquery.com/jquery-1.9.0.min.js");
		b.onload=Webformat_JqueryScriptLoadHandler;
		b.onreadystatechange=function(){
			if(this.readyState=='complete'||this.readyState=='loaded'){Webformat_JqueryScriptLoadHandler();}
		};
		document.getElementsByTagName('head')[0].appendChild(b);
	}else{$=jQuery;Webformat_DoJqueryActions();}
	function Webformat_JqueryScriptLoadHandler(){
		$=jQuery.noConflict();
		Webformat_DoJqueryActions();
	}
	function Webformat_DoJqueryActions(){
		//#AUTO_INSERTION_PLACE
		if('$'in a){$=a.$;}
	}
})();