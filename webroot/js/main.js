(function($){
	$(document).ready(function() {

		$('a').tooltip({
			'placement':'top',
		});
		$('#profil-picture img').popover({
			'placement':'right',
			'trigger'  :'hover'
		});

		//$('#top-content').hide();
		$('.open').click(function(){
			if($('#top-content').is(':visible')){
				$('.open i').removeClass('icon-double-angle-up');
				$('.open i').addClass('icon-double-angle-down');
				$('#top-content').slideUp();	
			}else{
				$('.open i').removeClass('icon-double-angle-down');
				$('.open i').addClass('icon-double-angle-up');
				$('#top-content').slideDown();				
			}
		});

		$('#contact').validationEngine();

		//stickElement('#side-bar-right');
		stickElement('#side-bar-left',65,10);

        $(window).resize(function() {
        	stickElement('#side-bar-left',65,10);
        	//stickElement('#side-bar-right',65,10);
        });

        function stickElement(element,topPAd,margTop){
        	var $sidebar   = $(element), 
	        $window    = $(window),
	        offset     = $sidebar.offset(),
	        topPadding = topPAd;
        	var width 	   = $(window).width();

        	//console.log(width);
	        if($window.width() > 992){
	        	//console.log('ok');
			    $window.stop().scroll(function() {
			        if ($window.scrollTop() > offset.top) {
			            $sidebar.stop().animate({
			                marginTop: $window.scrollTop() - offset.top + topPadding
			            });
			        } else {
			            $sidebar.stop().animate({
			                marginTop: margTop
			            });
			        }
			    });
			}

			if($window.width() < 992){
				
				$window.stop().scroll(function() {
			        if ($window.scrollTop() > offset.top) {
			        	console.log('1');
			            $sidebar.stop().animate({});
			        } else {
			        	console.log('2');
			            $sidebar.stop(true,true).animate({});
			        }
			    });
			}
        }
        
	});

})(jQuery)
