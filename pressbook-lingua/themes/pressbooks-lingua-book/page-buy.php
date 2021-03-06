<?php get_header(); //wordpress header?>
<!-- Check permissions for blogging -->
<?php if (get_option('blog_public') == '1' || (get_option('blog_public') == '0' && current_user_can_for_blog($blog_id, 'read'))): ?>
           <div id="post-<?php the_ID(); ?>" <?php post_class('buy-page'); ?>>
		     <h2 class="page-title"><?php _e('Buy the Book', 'pressbooks'); ?></h2>
		     
		     <?php $urls = get_option('pressbooks_ecommerce_links'); //get ecommerce links ?>
		     
		     <?php foreach ($urls as $key => $url): ?>
		       <?php if (empty($url)): ?>
		         <?php unset($urls[$key]);?>
		       <?php endif; ?>
		     <?php endforeach; ?>
		     <?php if (empty($urls)): ?>
		       <p><?php _e('It\'s coming!', 'pressbooks'); ?></p>
		     <?php else: ?>
		     
			 <p><?php printf( __( 'You can buy <a href="%1$s">%2$s</a> by following any of the links below:', 'pressbooks' ), get_bloginfo( 'url' ), get_bloginfo( 'name' ) ); ?></p>
			 			 
			 <ul class="buy-book">
<!--            ON-LINGUA BUY LINK AND LOGO                            -->                             
                <?php  $url_parts=explode('/', site_url());  //explodes the url dividing the parts by '7'
                       $count_1=count($url_parts); //counts the parts of the url
                       unset($url_parts[$count_1-1]); //unset the last part from the url           
                       array_values($url_parts); //creates a new array of the parts
                       //creates the url by concatenating the url parts with the string
                       $url_onlingua=implode('/', $url_parts).'/wp-content/plugins/pressbooks-lingua/themes/pressbooks-lingua-book/images/pb-lingua.png';
                ?>  
                <!-- On-Lingua buy link -->    
               <li class="buy-onlingua"><a target="_blank" href="http://books.on-lingua.com/" class="bookstore-logo-link logo"><img src="<?php echo $url_onlingua; ?>" alt="pb-lingua-logo" title="On-lingua"/></a><?php printf( __('Purchase on  <a href="http://on-lingua.com/buy">on-lingua.com</a>', 'pressbooks'), $urls['onlingua']); ?></li>
<!--            END ON-LINGUA LOGO--> 
  
			<!-- Amazon buy Link -->  
               <?php if (isset($urls['amazon']) && $urls['amazon']): ?>
			   <li class="buy-amazon"><a target="_blank" href="<?php print $urls['amazon']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo('template_directory'); ?>/images/amazon.png" width="100" height="20" alt="amazon-logo" title="Amazon"/></a><?php printf( __('Purchase on  <a href="%1$s">amazon.com</a>', 'pressbooks'), $urls['amazon']); ?></li>
         <?php endif; ?>              
			  
                           
                           	  
        <!-- If set, show the others ecommerce links --> 
        <!-- O'Reilly -->                  
         <?php if (isset($urls['oreilly']) && $urls['oreilly']): ?>
			   <li class="buy-oreilly"><a target="_blank" href="<?php print $urls['oreilly']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo('template_directory'); ?>/images/oreilly.png" width="100" height="18" alt="oreilly-logo" title="Oreilly"/></a><?php printf( __('Purchase on  <a href="%1$s">oreilly.com</a>', 'pressbooks'), $urls['oreilly']); ?></li>
         <?php endif; ?>
		<!-- Barnes and Noble-->
			   <?php if (isset($urls['barnesandnoble']) && $urls['barnesandnoble']): ?>
			   <li class="buy-barnes-and-noble"><a target="_blank" href="<?php print $urls['barnesandnoble']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo('template_directory'); ?>/images/barnes-and-noble.png" width="100" height="16" alt="barnes-and-noble-logo" title="Barnes &amp; Noble"/></a><?php printf( __('Purchase on  <a href="%1$s">barnesandnoble.com</a>', 'pressbooks'), $urls['barnesandnoble']); ?></li>
         <?php endif; ?>
		  <!-- Kobo --> 
			   <?php if (isset($urls['kobo']) && $urls['kobo']): ?>
			   <li class="buy-kobo"><a target="_blank" href="<?php print $urls['kobo']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo('template_directory'); ?>/images/kobo.png" width="54" height="29" alt="kobo-logo" title="Kobo"/></a><?php printf( __('Purchase on  <a href="%1$s">kobobooks.com</a>', 'pressbooks'), $urls['kobo']); ?></li>
         <?php endif; ?>
		<!-- iBooks -->	   
			   <?php if (isset($urls['ibooks']) && $urls['ibooks']): ?>
			   <li class="buy-ibooks"><a target="_blank" href="<?php print $urls['ibooks']; ?>" class="bookstore-logo-link logo"><img src="<?php bloginfo('template_directory'); ?>/images/ibooks.png" width="34" height="34" alt="ibooks-logo" title="iBook"/></a><?php printf( __('Purchase on  <a href="%1$s">apple.com</a>', 'pressbooks'), $urls['ibooks']); ?></li>
         <?php endif; ?>
		<!-- Other Service -->	   
			   <?php if (isset($urls['otherservice']) && $urls['otherservice']): ?>
			   <li class="buy-other"><a target="_blank" href="<?php print $urls['otherservice']; ?>" class="bookstore-other-link logo"><?php _e('Elsewhere', 'pressbooks'); ?></a><?php _e('Purchase here:', 'pressbooks'); ?> <a href="<?php print $urls['otherservice']; ?>"><?php print $urls['otherservice']; ?></a></li>
         <?php endif; ?>
         </ul>
         
      <?php endif; ?>
	</div><!-- end .post -->		 
<?php else: ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
