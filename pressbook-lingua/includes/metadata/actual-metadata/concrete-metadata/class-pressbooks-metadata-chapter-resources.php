<?php

/**
 * Most of the chapter metadata included/used by this plugin.
 *
 * @since      0.1
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/includes/metadata/actual-metadata/concrete-metadata
 */

require_once plugin_dir_path( __FILE__ )
. '../class-pressbooks-metadata-plugin-metadata.php';

/**
 * Most of the chapter metadata included/used by this plugin.
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/includes/metadata/actual-metadata/concrete-metadata
 * @author     Monica Gondolini <monica.gondolini@gmail.com>
 */
class Pressbooks_Metadata_Chapter_Resources extends Pressbooks_Metadata_Plugin_Metadata {

	/**
	 * The class instance.
	 *
	 * @since  0.1
	 * @access private
	 * @var    Pressbooks_Metadata_Plugin_Metadata $instance The class instance.
	 */
	private static $instance = NULL;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since  0.1
	 */
	protected function __construct() {

		parent::__construct();

		// Preexisting meta-box
        global $post;

		$chap_resource = new Pressbooks_Metadata_Meta_Box(
			'Chapter Resources', '',
			'chapter-resources2',true );
		$chap_resource->add_post_type( 'chapter' );

		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Exercises',
			'The URL of exercise site about this lesson.',
			'exercise_url', '', '', '', false,
			'http://site.com/' ) );

		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Audio',
			'The URL of a audio about this lesson.',
			'audio_url', '', '', '', false,
			'http://site.com/' ) );

		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Video',
			'The URL of a audio about this lesson.',
			'video_url', '', '', '', false,
			'http://site.com/' ) );
		$this->add_component($chap_resource);
	}

	/**
	 * Returns the class instance	 *
	 * @since  0.1
	 * @return Pressbooks_Metadata_Book_Metadata The class instance.
	 */
	public static function get_instance() {

		if ( NULL == Pressbooks_Metadata_Chapter_Resources::$instance ) {
			Pressbooks_Metadata_Chapter_Resources::$instance
				= new Pressbooks_Metadata_Chapter_Resources();
		}
		return Pressbooks_Metadata_Chapter_Resources::$instance;

	}

	/**
	 * Prints the HTML code of chapter metadata for the public part of
	 * the book.
	 *
	 * @since 0.1
	 */
	public function print_chapter_resources_fields(){

			$pm_BM = get_metada_fields();
			$meta = $pm_BM->get_current_metadata_flat();
		   
            global $post;
            if($post->post_type!='chapter'){
			    foreach ( $meta as $key=>$elt ) {      
				  	if($elt->get_name()==='Youtube Channel'){
		                if($elt->get_value() !== '0'){
		                	$YTchannel=$elt->get_value();
			                $pos = strpos($YTchannel, 'http://');
			                if($pos===false){                 
			                    $YTchannel='http://'.$YTchannel;
			                }
		            	}
		            }           
				}

	            echo '<table class="metadata_questtions_answers">';
	            /* if any value is set for $YTchannel*/
	            if(isset($YTchannel)){
	                echo '<tr id="lb_discussion_url"><td style="padding:1em;">Questions and Answers Book</td><td style="font-size:1em;">'.
	                '<a style="font-size:1em; color:blue;" href="'.$YTchannel.'">'.str_replace("http://www.youtube.com/", '', $YTchannel).'</a></td></tr>';
	        	}
	            echo '</table>';
	            
	            return;
       		}
       		
            global $wpdb;
            $table_name=$wpdb->prefix.'postmeta';
            $meta = $wpdb->get_results("SELECT meta_key,meta_value FROM $table_name WHERE post_id='$post->ID' ORDER BY meta_id DESC",ARRAY_A);
            $meta_keys=array('lb_exercises_url'=>'Exercises', 'lb_video_url'=>'Video', 'lb_audio_url'=>'Audio');

		?><table class="metadata_questtions_answers"><?php
		         			
		foreach ( $meta as $row ) {
            if(array_key_exists( $row['meta_key'] , $meta_keys )){  
				?><tr id="<?php echo $row['meta_key'];?>"><td><?php echo $meta_keys[$row['meta_key']]; ?></td><?php
				?><td><?php
                   unset($meta_keys[$row['meta_key']]);
                   array_values($meta_keys);
                    if($row['meta_key'] === 'lb_exercises_url' || $row['meta_key'] === 'lb_video_url' || $row['meta_key'] === 'lb_audio_url'){ 
						$pos = strpos($row['meta_value'], 'http://');    
						if($pos===false){                                      
						  echo '<a style="font-size:1em; color:blue;" href="'.'http://'.$row['meta_value'].'">'.str_replace("www.", '', $row['meta_value']).'</a>';                       
						}else{ 
						  echo '<a style="font-size:1em; color:blue;" href="'.$row['meta_value'].'">'.str_replace("http://", '', $row['meta_value']).'</a>';
						}
                    }else{
                    	echo $row['meta_value'];
                    }
            	?></td></tr><?php 
            }
		}
		?></table><?php
	}
}

