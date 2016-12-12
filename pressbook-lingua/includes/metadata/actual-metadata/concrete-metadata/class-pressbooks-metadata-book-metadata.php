<?php

/**
 * Most of the book metadata included/used by this plugin.
 *
 * @since      0.1
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/includes/metadata/actual-metadata/concrete-metadata
 */

require_once plugin_dir_path( __FILE__ )
. '../class-pressbooks-metadata-plugin-metadata.php';


/**
 * Most of the book metadata included/used by this plugin.
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/includes/metadata/actual-metadata/concrete-metadata
 * @author     julienCXX <software@chmodplusx.eu>
 */


class Pressbooks_Metadata_Book_Metadata extends Pressbooks_Metadata_Plugin_Metadata {

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
                        
		// Preexisting meta-box
		$g_b_info = new Pressbooks_Metadata_Meta_Box(
			'General Educational Information', '',
			'general-educational-information', true );
		$g_b_info->add_post_type( 'metadata' );

		// create the language field
		$g_b_info->add_field( new Pressbooks_Metadata_Language_List_Field(
			'Target language', 'The language this book is about',
			'target_language' ) );

		// create the level list field
		$g_b_info->add_field( new Pressbooks_Metadata_List_Field( 'Level',
			'The language level the book is about', 'level', '',
			'', 'none', array(
				'none' => 'None',
				'a1' => 'A1',
				'a2' => 'A2',
				'b1' => 'B1',
				'b2' => 'B2',
				'c1' => 'C1',
				'c2' => 'C2'
			) ) );

		/* The Common European Framework of Reference for Languages
		 * (itemprop = educationalAlignment)
		 * not used for now */

		// create the learning resource type list field
		$g_b_info->add_field( new Pressbooks_Metadata_List_Field(
			'Learning Resource Type',
			'The kind of resource this book represents',
			'learning_resource_type', '', '', 'course',
			array(
				'course' => 'Course',
				'exam' => 'Examination',
				'exercise' => 'Exercise',
                                'descriptor' => 'Descriptor'
			), 'learningResourceType' ) );

		// create the interactivity type field
		$g_b_info->add_field( new Pressbooks_Metadata_List_Field(
			'Interactivity Type',
			'The interactivity type of this book',
			'interactivity_type', '', '', 'expositive',
			array(
				'active' => 'Active',
				'expositive' => 'Expositive',
				'mixed' => 'Mixed'
			), 'interactivityType' ) );

		//create age range field as a list
		$g_b_info->add_field( new Pressbooks_Metadata_List_Field( 'Age Range',
			'The target age of this book',
			'age_range', '', '', '18',
			array(
				'18' => 'Adults',
				'17' => '17-18 years',
				'16' => '16-17 years',
				'15' => '15-16 years',
				'14' => '14-15 years',
				'13' => '13-14 years',
				'12' => '12-13 years',
				'11' => '11-12 years',
				'10' => '10-11 years',
				'9' => '9-10 years',
				'8' => '8-9 years',
				'7' => '7-8 years',
				'6' => '6-7 years',
				'5' => '5-3 years'
			), 'typicalAgeRange' ) );
                $g_b_info->add_field( new Pressbooks_Metadata_List_Field( 'Content Type',
			'Type of content',
			'content_type', '', '', '1',
			array   ('1' => 'Course',
				'6' => 'Extra Content',
				'5' => 'Texts and Functions',
				'4' => 'Phonetics and Spelling',
				'3' => 'Grammar',
				'2' => 'Vocabulary'
				
			), ' additionalType' ) );

        //create class learning time as number field
		$g_b_info->add_field( new Pressbooks_Metadata_Number_Field(
			'Class Learning Time (hours)', '',
			'time_required', '', '', 0, false, 0 ) );

		//create age range as text field
		$g_b_info->add_field( new Pressbooks_Metadata_Text_Field( 'License URL',
			'You can add a link contains detailed description of the License of your book', 'rights_url', '', '', '', false, 'http://site.com/',
			'license' ) );

		//create bibliography as text field
		$g_b_info->add_field( new Pressbooks_Metadata_Url_Field(
			'Bibliography URL',
			'The URL of a website/book this book is inspirated of',
			'bibliography_url',
			'', '', '', false, 'http://site.com/',
			'isBasedOnUrl' ) ); // TODO: there can be multiple URLs

		//create Library field as text field
        $g_b_info->add_field( new Pressbooks_Metadata_Url_Field(
			'Library URL',
			'Leave empty if you want to use your default On-lingua library <b>www.on-lingua.com/YourUserName/</b>',
			'user_library_url',
			'', '', '', false, 'http://site.com/',
			'isBasedOnUrl' ) ); // TODO: there can be multiple URLs

        //create question and answers text field
    	$g_b_info->add_field( new Pressbooks_Metadata_Url_Field(
			'Questions&Answers URL',
			'Questions and answers about the book, always start with https:// or http://',
			'book_questions_url',
			'', '', '', false, 'http://site.com/',
			'isBasedOnUrl' ) ); // TODO: there can be multiple URLs

    	//create URL field for a Youtube Channel
		$g_b_info->add_field( new Pressbooks_Metadata_Url_Field(
			'Youtube Channel',
			'The URL of the Youtube channel of this book, always start with https:// or http://',
			'youtube_url', '', '', '', false,
			'http://site.com/') );
		
		//create URL field for Book Exercises website
		$g_b_info->add_field( new Pressbooks_Metadata_Url_Field(
			'Book Exercises',
			'The URL of the Exercises website of this book, always start with https:// or http://',
			'bexercise_url', '', '', '', false,
			'http://site.com/') );

		$this->add_component( $g_b_info );

	}

	/**
	 * Returns the class instance.
	 *
	 * @since  0.1
	 * @return Pressbooks_Metadata_Book_Metadata The class instance.
	 */
	public static function get_instance() {

		if ( NULL == Pressbooks_Metadata_Book_Metadata::$instance ) {
			Pressbooks_Metadata_Book_Metadata::$instance
				= new Pressbooks_Metadata_Book_Metadata();
		}
		return Pressbooks_Metadata_Book_Metadata::$instance;

	}

	/**
	 * Prints the HTML code of book metadata for the public part of
	 * the book.
	 *
	 * @since 0.1
	 */
	public function print_book_metadata_fields() {
        global $post;
        /* If the post is located in the front matter get the metadata of the book and show them. 
        If the field is an URL field, remove the 'http:// prefix'*/
        if($post->post_type=='front-matter'){
			$meta = $this->get_current_metadata_flat();
			if ( empty( $meta ) ) {
				return;
			}
            ?> <table class="metadata_questtions_answers"><?php
				foreach ( $meta as $elt ) {
					if($elt->get_name() === "Questions&Answers URL" || $elt->get_name() === "Youtube Channel" || $elt->get_name() === "Book Exercises" || $elt->get_name() === "Library URL" || $elt->get_name() === "Bibliography URL"){
						$pos = strpos($elt->get_value(), 'http://'); 
						$posa = strpos($elt->get_value(), 'https://');        
						if($pos===false){ 
							if($posa === false){
								echo '<tr><td>'.$elt->get_name().'</td>
								<td><a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$elt->get_value().'"> >>GO>> </a></td></tr>'; 
							}else{
								echo '<tr><td>'.$elt->get_name().'</td>
								<td><a target="_blank" style="font-size:1em; color:blue;" href="'.$elt->get_value().'"> >>GO>> </a></td></tr>'; 
							} 
						}else{ 
							echo '<tr><td>'.$elt->get_name().'</td>
							<td><a  target="_blank" style="font-size:1em; color:blue;" href="'.$elt->get_value().'"> >>GO>> </a></td></tr>';
						}
					}else{	
						?><tr><td><?php echo $elt->get_name(); ?>:</td><?php
						?><td><?php echo $elt; ?></td></tr><?php
					}
				}
            ?> </table><?php
        }
	}

}


/*
* Initiates the metadata groups
*/
add_action( 'custom_metadata_manager_init_metadata', function (){
    
    
    x_add_metadata_group( 'general-educational-information', 'metadata', array(
		'label' => __( 'General Educational Information', 'pressbooks' ),
		'priority' => 'high',
	) );
    // Chapter Metadata

	x_add_metadata_group( 'chapter-metadata2', 'chapter', array(
		'label' => __( 'Custom Chapter Metadata', 'pressbooks' )
	) );

	x_add_metadata_group( 'chapter-resources2', 'chapter', array(
		'label' => __( 'Chapter Resources', 'pressbooks' )
	) );


});