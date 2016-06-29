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
	 * Initialize the class and set its properties and fields.
	 *
	 * @since  0.1
	 */
	protected function __construct() {

		parent::__construct();

		// Preexisting meta-box
        global $post;

        //create the metabox
		$chap_resource = new Pressbooks_Metadata_Meta_Box(
			'Chapter Resources', '',
			'chapter-resources2',true );
		$chap_resource->add_post_type( 'chapter' );

		//create fields for the metabox

		//create URL field for Activities website link about the chapter
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Activities',
			'The URL of the Activities site about this lesson.',
			'activities_url', '', '', '', false,
			'http://site.com/' ) );

		//create URL field for the Video website link about the chapter
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Video 1',
			'The URL of a audio about this lesson.',
			'video1_url', '', '', '', false,
			'http://site.com/' ) );
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Video 2',
			'The URL of a audio about this lesson.',
			'video2_url', '', '', '', false,
			'http://site.com/' ) );

		//create URL field for Audio website link about the chapter
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Audio',
			'The URL of a audio about this lesson.',
			'audio_url', '', '', '', false,
			'http://site.com/' ) );

		//create URL field for Exercises website link about the chapter
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Exercises 1',
			'The URL of exercise site about this lesson.',
			'exercises1_url', '', '', '', false,
			'http://site.com/' ) );
		$chap_resource->add_field( new Pressbooks_Metadata_Url_Field(
			'Exercises 2',
			'The URL of exercise site about this lesson.',
			'exercises2_url', '', '', '', false,
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

		/*Gets the value of Youtube Channel and Book Exercises from Book Metadata and removes 'http://' from the string*/
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
		  	if($elt->get_name()==='Book Exercises'){
	            if($elt->get_value() !== '0'){
	            	$bookEx=$elt->get_value();
	                $pos = strpos($bookEx, 'http://');
	                if($pos===false){                 
	                    $bookEx='http://'.$bookEx;
	                }
	        	}
	        }             
		}
	   
	   	/*gets the value of the Youtube Channel and Book Exercises from the Book info metadata
	   	and shows it for every page different from the chapter page */
	   	global $post;
        if($post->post_type!='chapter'){

            echo '<table class="metadata_questtions_answers">';
            /* if any value is set for $YTchannel*/
            if(isset($YTchannel)){
                echo '<tr id="lb_discussion_url"><td style="padding:1em;">Youtube Channel</td><td style="font-size:1em;">'.
                '<a  target="_blank" style="font-size:1em; color:blue;" href="'.$YTchannel.'">'.str_replace("http://www.", '', $YTchannel).'</a></td></tr>';
        	}
            if(isset($bookEx)){
                echo '<tr id="lb_discussion_url"><td style="padding:1em;">Book Exercises</td><td style="font-size:1em;">'.
                '<a  target="_blank" style="font-size:1em; color:blue;" href="'.$bookEx.'">'.str_replace("http://", '', $bookEx).'</a></td></tr>';
        	}
            echo '</table>';
            
            return;
   		}
   		
   		/*Gets the chapter resources metadata from the database and prints them*/
        global $wpdb;
        $table_name=$wpdb->prefix.'postmeta';
        $meta = $wpdb->get_results("SELECT meta_key,meta_value FROM $table_name WHERE post_id='$post->ID' ORDER BY meta_id DESC",ARRAY_A);
        $meta_keys=array('lb_video1_url'=>'Video 1', 'lb_video2_url'=>'Video 2', 'lb_audio_url'=>'Audio', 'lb_exercises1_url'=>'Exercises 1', 'lb_exercises2_url'=>'Exercises 2', 'lb_activities_url'=>'Activities');

		?><table class="metadata_questtions_answers"><?php
		                       			
		foreach ( $meta as $row ) {
            if(array_key_exists( $row['meta_key'] , $meta_keys )){  
				?><tr id="<?php echo $row['meta_key'];?>"><td><?php echo $meta_keys[$row['meta_key']]; ?></td><?php
				?><td><?php
                   unset($meta_keys[$row['meta_key']]);
                   array_values($meta_keys);
                   //removes 'http://' part of the string
                    if($row['meta_key'] === 'lb_exercises1_url' || $row['meta_key'] === 'lb_exercises2_url' ||  $row['meta_key'] === 'lb_activities_url' || $row['meta_key'] === 'lb_video1_url' || $row['meta_key'] === 'lb_video2_url' ||$row['meta_key'] === 'lb_audio_url'){ 
						$pos = strpos($row['meta_value'], 'http://');    
						if($pos===false){                                      
						  echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$row['meta_value'].'">'.str_replace("www.", '', $row['meta_value']).'</a>';                       
						}else{ 
						  echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.$row['meta_value'].'">'.str_replace("http://", '', $row['meta_value']).'</a>';
						}
                    }else{
                    	echo $row['meta_value'];
                    }
            	?></td></tr><?php 
            }
		}
		?></table><?php
	}

/*	public function print_activity_field(){

        global $wpdb;
        $table_name=$wpdb->prefix.'postmeta';
        $meta = $wpdb->get_results("SELECT meta_key,meta_value FROM $table_name WHERE post_id='$post->ID' ORDER BY meta_id DESC",ARRAY_A);
        $meta_keys=array('lb_video1_url'=>'Video 1', 'lb_video2_url'=>'Video 2', 'lb_audio_url'=>'Audio', 'lb_exercises1_url'=>'Exercises 1', 'lb_exercises2_url'=>'Exercises 2', 'lb_activities_url'=>'Activities');

        foreach ( $meta as $row ) {
            if(array_key_exists( $row['meta_key'] , $meta_keys )){  
               unset($meta_keys[$row['meta_key']]);
               array_values($meta_keys);
               //removes 'http://' part of the string
                if($row['meta_key'] === 'lb_activities_url'){ 
					$pos = strpos($row['meta_value'], 'http://');    
					if($pos===false){                                      
					  $activity = 'http://'.$row['meta_value'];    
					  return $activity;                   
					}else{ 
					  $activity = 'http://'.$row['meta_value']; 
					  return $activity;
					}
                }else{
                	return null;
                }
            }
	}

	*/
}

