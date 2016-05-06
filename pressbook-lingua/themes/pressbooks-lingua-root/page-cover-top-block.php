<section id="post-<?php the_ID(); ?>" <?php post_class( array( 'top-block', 'clearfix', 'home-post' ) ); ?>>
	
	<?php pb_get_links(false); ?>
	<?php $metadata = pb_get_book_information();?>
	<?php 

		/* Takes the site URL and creates the filepath
			Example: http://rld.on-lingua.com/vocabularya1en/
			$pathparts: http:/, /, rld.on-lingua.com/, vocabularya1en/ 
			$length: 4
			unset "vocabulary a1en" from the url
			$filepath: http://rld.on-lingua.com/ 	
		*/

		$pathparts = explode('/', site_url());
        $length = count($pathparts);
        unset($pathparts[$length-1]);
        array_values($pathparts);  
        $filepath = implode('/', $pathparts);

        //Creates an instance of PB Book Metadata and gets all the metadata it contains
        $BookMetadata = Pressbooks_Metadata_Book_Metadata::get_instance();
		$meta = $BookMetadata->get_current_metadata_flat();

        foreach($meta as $key=>$elt) {
          	if($elt->get_name()==='Level'){
                $level = $elt; //gets the level 
            }
                       
			if($elt->get_name()==='Library URL'){
                $libraryURL = $elt->get_value();
                $pos = strpos($libraryURL, 'http://');
	            if($pos === false){                 
	                $libraryURL = 'http://'.$libraryURL; //gets the library URL as a string and concats it with http:// string
	            }
            }
		}
	    
	    $metadata = pb_get_book_information();
        $level = $level? '_'.strtolower($level):'';
		     		
	?>

	<div class="log-wrap" style="left:5px; "> <!-- Home/Library -->
		<?php if(!is_single()): ?> <!-- If the $post parameter is specified, this function will additionally check if the query is for one of the Posts specified.-->
			<a href="http://on-lingua.com/" class=""><?php _e('home', 'pressbooks'); ?></a>
			<a <?php  echo $libraryURL? 'href="'.$libraryURL.'"' : 'href="'.$filepath.'/catalog/'.sanitize_title($metadata['pb_author']).'"' ; ?> class=""><?php _e('libary', 'pressbooks'); ?></a>
		<?php endif; ?>
	</div>
	<div class="log-wrap">	<!-- Login/Logout -->
	   <?php if(!is_single()): ?>
	    	<?php if(!is_user_logged_in()): ?>
	    	<!-- Login button -->
				<a href="<?php echo wp_login_url( get_permalink() ); ?>" class="" style="margin-left:10px;"><?php _e('login', 'pressbooks'); ?></a>
	   	 	<?php else: ?>
	   	 	<!-- Logout button -->
				<a href="<?php echo  wp_logout_url(); ?>" class=""><?php _e('logout', 'pressbooks'); ?></a>
				<?php if(is_super_admin() || is_user_member_of_blog()): ?>
			<!-- Admint button -->
				<a href="<?php echo get_option('home'); ?>/wp-admin"><?php _e('Admin', 'pressbooks'); ?></a>
				<?php endif; ?>
	    	<?php endif; ?>
	    <?php endif; ?>
	</div>

	<div class="book-info">
		<!-- Book Title -->
		<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
		<?php if(!empty( $metadata['pb_author'] ) ): ?>
	     	<p class="book-author"><?php echo $metadata['pb_author']; ?></p>
	     	<span class="stroke"></span>
     	<?php endif; ?>	
			
		<?php if(!empty( $metadata['pb_about_140'] ) ) : ?>
			<p class="sub-title"><?php echo $metadata['pb_about_140']; ?></p>
			<span class="detail"></span>
		<?php endif; ?>						
		
		<?php if(!empty( $metadata['pb_about_50'] ) ): ?>
			<p><?php echo pb_decode( $metadata['pb_about_50'] ); ?></p>
		<?php endif; ?>

	</div> <!-- end .book-info -->
	
	<!-- Sets the cover of the book -->
	<?php if(!empty( $metadata['pb_cover_image'] ) ): ?>
	<div class="book-cover">
		<?php
			$pathparts=explode('/', site_url());
            $length=count($pathparts);
            unset($pathparts[$length-1]);
            array_values($pathparts);  
            $filepath=implode('/', $pathparts);
                    $bookcoverpath=$filepath.'/wp-content/plugins/pressbook-lingua/themes/pressbooks-lingua-book/images/default-book-cover.jpg';
        ?>
		<img src="<?php echo $bookcoverpath; ?>" alt="book-cover" title="<?php bloginfo( 'name' ); ?> book cover" />			
	</div>	
	<?php endif; ?>
	
	<div class="call-to-action-wrap">
		<?php global $first_chapter; ?>
		<div class="call-to-action">
			<!-- Download Icon -->
			<a class="btn red" href="<?php global $first_chapter; echo $first_chapter; ?>"><span class="read-icon"></span><?php _e('Read', 'pressbooks'); ?></a>
			<?php if (@array_filter(get_option('pressbooks_ecommerce_links'))) : ?>
				<a class="btn black" href="<?php echo get_option('home'); ?>/buy"><span class="buy-icon"></span><?php _e('Download', 'pressbooks'); ?></a>				
			<?php endif; ?>	
			
		</div> <!-- end .call-to-action -->		
	</div><!--  end .call-to-action-wrap -->
					
</section> <!-- end .top-block -->