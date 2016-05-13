jQuery(document).ready(function(){

	jQuery("#exercise_f").hide();
	jQuery("#activity_f").hide();


	if(jQuery(window).width() < 880){
		//mettere le icone
		jQuery("#ex_h_a").empty();
		jQuery("#act_h_a").text("<?php _e('Exercises', 'pressbooks');?>");
	}
	if(jQuery(window).width() < 600){
		jQuery("#exercise_h").hide();
		jQuery("#activity_h").hide();
		jQuery("#exercise_f").show();
		jQuery("#activity_f").show();
	}



});