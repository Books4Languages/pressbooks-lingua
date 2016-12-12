<section class="second-block-wrap"> <!-- Wrapper for the second-->
	<div class="second-block clearfix">
		<div class="description-book-info">
			<?php $metadata = pb_get_book_information(); //gets book information data ?>
			<h2><?php _e('Book Description', 'pressbooks'); ?></h2>
				<?php if ( ! empty( $metadata['pb_about_unlimited'] ) ): ?>
					<p><?php
						$about_unlimited = pb_decode( $metadata['pb_about_unlimited'] );
						$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
						echo $about_unlimited; ?></p>
				<?php endif; ?>	
			<!-- Show a custom copyright description if present-->		
			<?php if ( ! empty ($metadata['pb_custom_copyright'])) : ?>
					<h2><?php _e('Copyright', 'pressbooks') ;?></h2>
					<p><?php 
						$custom_copyright = pb_decode( $metadata['pb_custom_copyright']);
						$custom_copyright = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $custom_copyright ); //replace the copyright with its regoular expression
						echo $custom_copyright;?>
					</p>
			<?php endif; ?>
			<!-- Share icons -->
			<div id="share">
			  <div id="twitter" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Tweet"></div>
			  <div id="facebook" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Like"></div>
			  <div id="googleplus" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="+1"></div>
			</div>	
		</div>
			
		<?php
			//Creates an array with the taxonomy, fields and terms of the book
			$args = $args = array(
			    'post_type' => 'back-matter',
			    'tax_query' => array(
			        array(
			            'taxonomy' => 'back-matter-type',
			            'field' => 'slug',
			            'terms' => 'about-the-author'
			        )
			    )
			); 
		?>
		<!-- Show info about the author -->
		<div class="author-book-info">
			<?php $loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
			    <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
				<?php  echo '<div class="entry-content">';
			    the_excerpt();
			    echo '</div>';
				endwhile; ?>
		</div>	
	</div><!-- end .secondary-block -->
</section> <!-- end .secondary-block --> 
