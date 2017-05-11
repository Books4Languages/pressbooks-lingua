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
            }
		}
	    
	    $metadata = pb_get_book_information(); //gets book information metadata
        $level = $level? '_'.strtolower($level):''; //lowercase the level name
		     		
	?>

	<div class="log-wrap" style="left:5px; "> <!-- Home/Library -->
		<?php if(!is_single()): ?> 
		<!-- If the $post parameter is specified, this function will additionally check if the query is for one of the Posts specified.-->
			<?php 
				$url = get_site_url();
				$pieces = parse_url($url);
				$hostname = $pieces['host'];
				preg_match ("/\.([^\/]+)/", $hostname, $domain_only);
				$host =  'http://'.$domain_only[1]; 
			?>
			<a  target="_blank" href="<?php echo $host; ?>" class=""><?php _e('home', 'pressbooks'); ?></a>
			<a  <?php  echo $libraryURL? 'href="'.$libraryURL.'"' : 'href="'.$filepath.'/catalog/'.sanitize_title($metadata['pb_author']).'"' ; ?> class=""><?php _e('libary', 'pressbooks'); ?></a>
		<!-- Read now -->
    		<?php global $first_chapter; ?>
			<a  id="read_now" href="<?php global $first_chapter; echo $first_chapter; ?>" class=""><?php _e('Read Now', 'pressbooks'); ?></a>
		<?php endif; ?>
	</div>
	<!-- Login/Logout - Admin-->
	<div class="log-wrap">	
	   <?php if(!is_single()): ?>
	    	<?php if(!is_user_logged_in()): ?> <!-- if the user is not logged show the login button-->
	    	<!-- Login button -->
				<a href="<?php echo wp_login_url( get_permalink() ); ?>" class="" ><?php _e('login', 'pressbooks'); ?></a>
	   	 	<?php else: ?>
	   	 	<!-- Logout button -->
				<a href="<?php echo  wp_logout_url(); ?>" class=""><?php _e('logout', 'pressbooks'); ?></a>
				<?php if(is_super_admin() || is_user_member_of_blog()): ?> <!-- If the user is admin show the admin button -->
			<!-- Admin button -->
				<a href="<?php echo get_option('home'); ?>/wp-admin"><?php _e('Admin', 'pressbooks'); ?></a>
				<?php endif; ?>
	    	<?php endif; ?>
	    <?php endif; ?>
	</div>

	<div class="book-info">
		<!-- Book Title -->
		<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<!-- Show book info metadata
			Book-Author
			Subtitle
			metadata-->	
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
		
	<!-- Sets the image uploaded from the site -->
		<img src="<?php echo $metadata['pb_cover_image']; ?>" alt="book-cover" title="<?php bloginfo( 'name' ); ?> book cover" />
	</div>	
	<?php endif; ?>
	
	<div class="call-to-action-wrap">
		<?php global $first_chapter; ?>
		<div class="call-to-action">
			<!-- Read Button -->
			<a class="btn red" href="<?php global $first_chapter; echo $first_chapter; ?>"><span class="read-icon"></span><?php _e('Read', 'pressbooks'); ?></a>
			<?php if (@array_filter(get_option('pressbooks_ecommerce_links'))) : ?>
				<!-- Download Button -->
				<a class="btn black" href="<?php echo get_option('home'); ?>/buy"><span class="buy-icon"></span><?php _e('Download', 'pressbooks'); ?></a>				
			<?php endif; ?>	
			
		</div> <!-- end .call-to-action -->		
	</div><!--  end .call-to-action-wrap -->
					
</section> <!-- end .top-block -->