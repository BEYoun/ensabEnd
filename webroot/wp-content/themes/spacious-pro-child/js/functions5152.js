jQuery(document).ready(function($){


	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 210,
		itemMargin: 5,
		asNavFor: '#slider'
	});
 
	$('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#carousel"	
	});

	/*$( "#tabs-cat-prod" ).tabs( {
		active: $('input[name=cat_prod]:checked', '#recherche-prod').attr('index')	
	});*/
	
	/*if ($('input[name=cat_prod]:checked', '#recherche-prod').attr('index') == 0)
	{
		$("#critere-article").show();
	}
	else {
		$("#critere-article").hide();
	}*/
	
	
	$(document).on('click', '.tab-cat-prod', function(e) {	
		$(this).children('input[name="cat_prod"]').attr('checked', 'checked');
		/*if ($('input[name=cat_prod]:checked', '#recherche-prod').attr('index') == 0)
		{
			$("#critere-article").show();
		}
		else {
			$("#critere-article").hide();
		}*/

	});

   /*$(".tabs li > label").on('click', tabMargin);

    function tabMargin(){
		var x = $(this).siblings(".tab-content").outerHeight(true); // use siblings here
		$(this).closest(".tabs").css('margin-bottom', x+20);
	}*/

});