<?php if( !is_single() ){?>
	
	</div><!-- #content -->

<?php } ?>
<?php if( !is_front_page() ){ //if it's not the front-page of the website?> 

	<?php get_sidebar(); //show the sidebar in the page?>

	</div><!-- #wrap -->
	<div class="push"></div>
	
	</div><!-- .wrapper for sitting footer at the bottom of the page -->
<?php } ?>

<!-- Create the footer -->
<div class="footer">
	<div class="inner">
		<?php if (get_option('blog_public') == '1' || is_user_logged_in()): //control if the user is logged ?>
			<?php if (is_page() || is_home( ) ): //control if the page is the home page or another page?>
			
			<!-- Setting the footer table for showing metadata in the Cover book page-->
				<table  class="footer-table">
				<tr>
					<td><?php _e('Book Name', 'pressbooks'); ?>:</td>
					<td><?php bloginfo('name'); ?></td>
				</tr>
				<!-- Show Book Info metadata -->
				<?php global $metakeys; ?>
       			 <?php $metadata = pb_get_book_information(); //Gets the Book informations ?>
				<?php foreach ($metakeys as $key => $val): ?>
				<?php if ( isset( $metakeys[$key] ) && ! empty( $val ) ): ?>
				<tr>
					<!-- Printing metadata -->
					<td><?php _e($metakeys[$key], 'pressbooks'); ?>:</td>
					<td><?php if ( 'pb_publication_date' == $key ) { $val = date_i18n( 'F j, Y', absint( $val ) );  } echo $val; ?></td>
				<?php endif; ?>
				<?php endforeach; ?>
				</tr>
				<?php
				// Show Copyright
				echo '<tr><td>' . __( 'Copyright', 'pressbooks' ) . ':</td><td>';
				echo ( ! empty( $metadata['pb_copyright_year'] ) ) ? $metadata['pb_copyright_year'] : date( 'Y' );
				if ( ! empty( $metadata['pb_copyright_holder'] ) ) echo ' ' . __( 'by ', 'pressbooks' ) . ' ' . $metadata['pb_copyright_holder'] . '. ';
				echo "</td></tr>\n";
				print_book_information_fields();
				?>

				</table>
			<?php endif; ?>
		
			<?php
			// avoid a fatal PHP call for those instances that don't have the latest
			// version of PB
			// @TODO remove this logic, eventually
			if ( function_exists( 'pressbooks_copyright_license' ) ) {
				echo pressbooks_copyright_license();
			}
			?>
		
		<?php endif; ?>

		<!-- Gets the value of Exercises and Activities link and, if not null, shows them as a button in the footer for responsive layout -->
    	<?php 
		$pm_CR = Pressbooks_Metadata_Chapter_Resources::get_instance(); //get an instance of the class
        $meta = $pm_CR->get_current_metadata_flat();
        /* Get Exercises and Activities link value from Chapter Resources Metadata in order to create the buttons*/
        foreach ( $meta as $key=>$elt ) { 
            if($elt->get_name()==='Exercises'){
            	$ex_link=$elt->get_value();
                $pos = strpos($ex_link, 'http://');
                if($pos===false){                 
                    $ex_link='http://'.$ex_link;
                }
            }
            if($elt->get_name()==='Activities'){
            	$act_link = $elt->get_value();
            	$pos = strpos($act_link, 'http://');
            	if($pos===false){
            		$act_link = 'http://'.$act_link;
            	}
            }        
        } ?>

        <!-- footer buttons container -->
		<div class="f-container">
	    	<?php if($ex_link != null){	?>
	    		<!-- Exercises button -->
		    	<div id="exercise_f" class="exercise-footer">
		    		<a target="_blank" id="ex_f_a" class="level" href='<?php echo $ex_link; ?>'><?php _e('Exercises', 'pressbooks');?></a>
		    	</div>
	    	<?php  }	
	    	if($act_link != null){	?>
	    		<!-- Activities button -->	
		    	<div id="activity_f" class="activity-footer">
		    		<a target="_blank" id="act_f_a" class="level" href='<?php echo $act_link; ?>'><?php _e('Activities', 'pressbooks');?></a>
		    	</div>		
			<?php  }	?>

		    <?php if ( @array_filter( get_option( 'pressbooks_ecommerce_links' ) ) ) : ?>
			    <!-- Download button -->
			    <div id="download-f" class="buy-f">
					<a target="_blank" id="dwn-h-f" href="<?php echo get_option('home'); ?>/buy" class="button-red-f"><?php _e('Download', 'pressbooks'); ?></a>
				</div>
			<?php endif; ?>	
		</div>

		<!-- Custom footer link-->
		<p class="cie-name">
			<?php 
				$url = get_site_url();
				$pieces = parse_url($url);
				$hostname = $pieces['host'];
				preg_match ("/\.([^\/]+)/", $hostname, $domain_only);
				$host =  'http://'.$domain_only[1]; 

			_e('<a target="_blank" href="'.$host.'">Insolently powered by WordPress', 'pressbooks');?>
		</p>
	</div><!-- #inner -->
</div><!-- #footer -->
</span><!-- schema.org -->
<?php wp_footer(); ?>
</body>
</html>
