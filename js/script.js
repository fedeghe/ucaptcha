function setting(){
	document.getElementById('sampleframe').src ='';
	document.getElementById('sampleframe').src = 'samples/settingpanel.php';
	document.getElementById('sampleframe').style.display = 'block';
}


function op(filen){
	document.getElementById('sampleframe').src ='';
	document.getElementById('sampleframe').src = 'samples/sample.php?n='+filen+'&x='+Math.random();
	document.getElementById('sampleframe').style.display = 'block';
}

function highlight(obj){
	var a_els = document.getElementsByTagName('a');
	for(var i = 0, l=a_els.length; i<l; i++ ){
		a_els[i].style.fontWeight='normal';	
	}
	obj.style.fontWeight='bold';
}

jQuery(function(){
	
	
	jQuery('ul li ul li span').bind('click',function(){
		jQuery('ul li ul li span.whi2').removeClass('whi2');
		jQuery(this).addClass('whi2');
	});
	
	jQuery('li.first_lev>span').bind('click',
		function(){
			jQuery('li.first_lev>span').removeClass('whi');
			
			jQuery(this).addClass('whi');		
			
			var t = jQuery(this).parent().find('ul.inner_hidd');
			var tmp = jQuery(t[0]);
			
			if(tmp.css('display')!='block'){
				jQuery('ul.inner_hidd').slideUp();
				tmp.slideToggle();
			}else{
				tmp.slideUp();
			}
		}
	);
	
	jQuery('li.second_lev>span').bind('click',function(){
		var name = jQuery(this).parent().attr('alt');
		jQuery('#sampleframe').attr('src', '');
		jQuery('#sampleframe').attr('src', 'samples/sample.php?n='+name+'&x='+Math.random() );
		jQuery('#sampleframe').css('display', 'block');
	});
	
	
	var show_api = false;
	jQuery('#spec_tongue').bind('click',function(){
		if(show_api){
			document.location.hash = 't';
			jQuery('#spec_tongue').html('More about setting');
			jQuery('#complete').animate({'top':'-15000px'},2000  );
			show_api = false;
		}else{
			jQuery('#spec_tongue').html('<br />Hide<br /><br />');
			jQuery('body,html').animate({scrollTop: 0}, 800);
			jQuery('#complete').animate({'top':'0px'},2000/*, function(){document.location.hash = 't';}*/ );
			
			show_api = true;
		}
		
	});
	
	
	
	
	
	var top = jQuery('#spec_tongue').offset().top - parseFloat($('#spec_tongue').css('marginTop').replace(/auto/, 0));	  
  
	jQuery(window).scroll(function (event) {
		if(window.scroller_ucaptcha)window.clearTimeout(window.scroller_ucaptcha);
		window.scroller_ucaptcha = window.setTimeout(
			function(){
				var t = 300;	  
				var y = jQuery(this).scrollTop();
				if (y + t >= top) {	  
					jQuery('#spec_tongue').animate({'top':y+t+'px'},500);
				}
			}, 500
		);

	});
	
	
});

