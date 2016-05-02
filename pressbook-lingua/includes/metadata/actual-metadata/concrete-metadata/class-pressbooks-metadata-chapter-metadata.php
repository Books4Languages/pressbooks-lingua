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
 * @author     julienCXX <software@chmodplusx.eu>
 */
class Pressbooks_Metadata_Chapter_Metadata extends Pressbooks_Metadata_Plugin_Metadata {

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
		$chap_meta = new Pressbooks_Metadata_Meta_Box(
			'Chapter Metadata', '',
			'chapter-metadata2',true );
		$chap_meta->add_post_type( 'chapter' );

		$chap_meta->add_field( new Pressbooks_Metadata_Url_Field(
			'Questions and answers',
			'The URL of a forum/discussion about this page.',
			'discussion_url', '', '', '', false,
			'http://site.com/' ) );

		$chap_meta->add_field( new Pressbooks_Metadata_Url_Field(
			'Media 1',
			'The URL of a video/audio about this lesson.',
			'media1_url', '', '', '', false,
			'http://site.com/' ) );

		$chap_meta->add_field( new Pressbooks_Metadata_Url_Field(
			'Media 2',
			'The URL of a video/audio about this lesson.',
			'media2_url', '', '', '', false,
			'http://site.com/' ) );

		$chap_meta->add_field( new Pressbooks_Metadata_Number_Field(
			'Class Learning Time (minutes)',
			'', 'time_required', '', '', 0, false, 0 ) );

        $chap_meta->add_field( new Pressbooks_Metadata_Text_Field( 
        	'Main Descriptor:',
        	'Custom descriptor of the lecture: professor profile, related websites',
        	'desc1', '', '', '', 
        	false, 'descriptor', 'custom2' ) );

        $chap_meta->add_field( new Pressbooks_Metadata_Text_Field( 
        	'Secondary Descriptor',
			'Custom descriptor of the lecture: professor profile, related websites',
			'desc2', '', '', '', 
			false, 'descriptor','custom1' ) );

		// Built-in fields (from WordPress)
		$chap_meta->add_field( new Pressbooks_Metadata_Creation_Date_Field(
			'Created on' ) );

		$chap_meta->add_field( new Pressbooks_Metadata_Modification_Date_Field(
			'Last modified on' ) );

		$this->add_component( $chap_meta );

	}

	/**
	 * Returns the class instance	 *
	 * @since  0.1
	 * @return Pressbooks_Metadata_Book_Metadata The class instance.
	 */
	public static function get_instance() {

		if ( NULL == Pressbooks_Metadata_Chapter_Metadata::$instance ) {
			Pressbooks_Metadata_Chapter_Metadata::$instance
				= new Pressbooks_Metadata_Chapter_Metadata();
		}
		return Pressbooks_Metadata_Chapter_Metadata::$instance;

	}

	/**
	 * Prints the HTML code of chapter metadata for the public part of
	 * the book.
	 *
	 * @since 0.1
	 */
	public function print_chapter_metadata_fields() {

			$pm_BM = get_metada_fields();
			$meta = $pm_BM->get_current_metadata_flat();
		    foreach ( $meta as $key=>$elt ) {      
			  	if($elt->get_name()==='Questions and Answers URL'){
	                if($elt->get_value() !== '0'){
	                	$QandAURL=$elt->get_value();
		                $pos = strpos($QandAURL, 'http://');
		                if($pos===false){                 
		                    $QandAURL='http://'.$QandAURL;
		                }
	            	}
	            }
	            if($elt->get_name()==='Class Learning Time (hours)'){
	                if($elt->get_value()!== '0'){
	                	$learning_time=$elt->get_value();
	                }
	            }            
			}
            
            global $post;
            if($post->post_type!='chapter'){

	            echo '<table class="metadata_questtions_answers">';
	            echo '<tr id="lb_toc"><td>'.
	                '<a href="'.site_url().'/table-of-contents/'.'"> >>Table of Contents<< </a></td></tr>';
	            /* if any value is set for $QandAURL or $learning_time a table row is created, otherwise print*/
	            if(isset($QandAURL)){
	                echo '<tr id="lb_discussion_url"><td style="padding:1em;">Questions and Answers Book</td><td style="font-size:1em;">'.
	                '<a style="font-size:1em; color:blue;" href="'.$QandAURL.'">'.str_replace("http://", '', $QandAURL).'</a></td></tr>';
	        	}
	            if(isset($learning_time)){
	                echo '<tr id="lb_time_required"><td style="padding:1em;">Class Learning Time (minutes)</td><td style="font-size:1em;">'.($learning_time?$learning_time:0).'</td></tr>';
	        	}
	            echo '</table>';
	            
	            return;
       		}
       		
            global $wpdb;
            $table_name=$wpdb->prefix.'postmeta';
            $meta = $wpdb->get_results("SELECT meta_key,meta_value FROM $table_name WHERE post_id='$post->ID' ORDER BY meta_id DESC",ARRAY_A);
            $meta_keys=array('lb_discussion_url'=>'Questions and Answers','lb_time_required'=>'Class Learning Time (minutes)',
            	'lb_custom_input1'=>'Main Descriptor','lb_custom_input2'=>'Secondary Descriptor');

		?><table class="metadata_questtions_answers"><?php
		   	echo '<tr id="lb_toc"><td style="text-align:center"><a href="'.site_url().'/table-of-contents/'.'"> >>Table of Contents<< </a></td></tr>'; 
        	echo '<tr id="lb_discussion_url"><td style="padding:1em;">Questions and Answers Book</td><td style="font-size:1em;">'.
	                '<a style="font-size:1em; color:blue;" href="'.$QandAURL.'">'.str_replace("http://", '', $QandAURL).'</a></td></tr>'; 
		foreach ( $meta as $row ) {
            if(array_key_exists( $row['meta_key'] , $meta_keys )){  
				?><tr id="<?php echo $row['meta_key'];?>"><td><?php echo $meta_keys[$row['meta_key']]; ?></td><?php
				?><td><?php
                   unset($meta_keys[$row['meta_key']]);
                   array_values($meta_keys);
                    if($row['meta_key'] === 'lb_discussion_url' || $row['meta_key'] === 'lb_media1' || $row['meta_key'] === 'lb_media2'){              
						$pos = strpos($row['meta_value'], 'http://');    
						if($pos===false){                                      
						  echo '<a style="font-size:1em; color:blue;" href="'.'http://'.$row['meta_value'].'">'.$row['meta_value'].'</a>';                       
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

