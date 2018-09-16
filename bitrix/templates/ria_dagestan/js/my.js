$(document).ready(function() {
	$('.asd').click(function(){		
		if($('.muser').css('display') == "none")
		{
			$('.muser').css('display','block')
			$('.muser').animate({'opacity':'1'},500)
			
		}
		else
		{
			$('.muser').css('display','none')
			$('.muser').css('opacity','0')
		}		
	});
	if($('.bx_form2 p font').hasClass('errortext')){
		$('.muser').css('display','block')
		$('.muser').css('opacity','1')
	}

	$('.hhh1').click(function(){
			$('.tab1').show(400);
			$('.tab2').hide(400);
	})	
	$('.hhh2').click(function(){
			$('.tab2').show(400);
			$('.tab1').hide(400);
	})



	var src = $('.ria_video iframe').attr("src");
	$('.ria_video iframe').attr({"src":src+"?rel=0&hd=1&wmode=transparent"});
});
