jQuery(document).ready(function(){

	/* Table of contents pop-up */	
	jQuery('#toc').hide();
	jQuery(document).on('click', '.toc-btn a, #toc a.close', function() {
		if(jQuery('#toc').css('display') == 'none') {
			jQuery('.toc-btn a').addClass('tabbed');
			jQuery('.toc-btn').addClass('bg-color');
			jQuery('#toc').toggle({ duration:200 });
			return false;
		} else {
			jQuery('.toc-btn a').removeClass('tabbed');
			jQuery('.toc-btn').removeClass('bg-color');
			jQuery('#toc').toggle({ duration:100 });
			return false;
		}
	});
	
	/* Page button pop-up */
	jQuery('#page-info').hide();
	jQuery(document).on('click', '.page-info-btn a, #page-info a.close', function(){
		if(jQuery('#page-info').css('display') == 'none'){
			jQuery('.page-info-btn a').addClass('tabbed');
			jQuery('.page-info-btn').addClass('bg-color');
			jQuery('#page-info').toggle({ duration:200 });
			return false;
		}else{ 
			jQuery('.page-info-btn a').removeClass('tabbed');
			jQuery('.page-info-btn').removeClass('bg-color');
			jQuery('#page-info').toggle({ duration:100 });
			return false;
		}
	});

	/* Resources button pop-up */
	jQuery('#resource').hide();
	jQuery(document).on('click', '.resource-btn a, #resource a.close', function(){
		if(jQuery('#resource').css('display') == 'none'){
			jQuery('.resource-btn a').addClass('tabbed');
			jQuery('.resource-btn').addClass('bg-color');
			jQuery('#resource').toggle({ duration:200 });
			return false;
		}else{ 
			jQuery('.resource-btn a').removeClass('tabbed');
			jQuery('.resource-btn').removeClass('bg-color');
			jQuery('#resource').toggle({ duration:100 });
			return false;
		}
	});

});


