jQuery(document).ready(function(){

	jQuery("#exercise_f").hide();
	jQuery("#activity_f").hide();
	jQuery("#download_f").hide();
	jQuery("#download_h").hide();

	if(jQuery(window).width() < 880){
		//mettere le icone
		jQuery("#ex_h_a").empty();
		jQuery("#ex_h_a").addClass('ex-img');
		jQuery("#act_h_a").empty();
		jQuery("#act_h_a").addClass('act-img');
		jQuery("#dwn_h_a").empty();
		jQuery("#dwn_h_a").addClass('dwn-img');
	}
	
	if(jQuery(window).width() < 600){
		jQuery("#exercise_h").hide();
		jQuery("#activity_h").hide();
		jQuery("#download_h").hide();
		jQuery("#exercise_f").show();
		jQuery("#activity_f").show();
		jQuery("#download_f").show();
	}



});