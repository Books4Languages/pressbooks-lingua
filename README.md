# pressbooks-lingua

## Description
Extended features for Pressbooks (Metadata and new child Theme)

### About

With PressBooks-Metadata for Wordpress you can add metadata in the books. Also use the template for show extra information.

We want to make the language courses more user-friendly. This is the second step.

**Because the second step for teaching is also organizing the ideas.**

### General Information
[Read general teorical information](/README-general-information.md).

#### PB-Lingua
Plugin for pressbooks

#### PB-Lingua-Book
Child theme for Luther (pressbooks-book)


## Requirements
This is a plugin for Wordpress (tested on 4.3)

This plugin uses some styles from PressBooks, thus you should have installed and
activated this plugin (tested on 2.4.5).

## Installation

1. Clone (or copy) this repository to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

## Screenshots

### Book Information in the dashboard.
![General information.](assets/GeneralInformation.png)

![Related books.](assets/RelatedBooks.png)




## Changelog
Afther version 2.0 We need to write the List of Files Revised

* PB-Lingua: Plugin for pressbooks
* PB-Lingua-Book: Child theme for Luther (pressbooks-book)

### 0.6
 * Requires Pressbooks 0.0.0
 * FEATURE:
 * ENHANCED: 
 * FIXED: 
 * UNDER THE HOOD: 
 * EDITED FILES:

### 0.5
 * Requires Pressbooks 0.0.0
 * FEATURE:
 * ENHANCED: 
 * FIXED: 
 * UNDER THE HOOD: 
 * EDITED FILES:

### 0.4
 * Requires Pressbooks 0.0.0
 * FEATURE:
 * ENHANCED: 
 * FIXED: 
 * UNDER THE HOOD: 
 * EDITED FILES:

### 0.3
 * Requires Pressbooks 0.0.0
 * FEATURE:
 * ENHANCED: 
 * FIXED: 
 * UNDER THE HOOD: 
 * EDITED FILES:

### 0.2
 * Requires Pressbooks 3.5.0
 * FEATURE:
   
   * **Chapter Resources:**  Introduced a new Chapter Metabox that provides fields for media resources and exercises
     * _Exercises_: custom link to the Exercises website about the lesson
     * _Activities_: custom link to the Activities site about the lesson 
     * _Audio_: custom URL to an audio about the lesson
     * _Video_: custom URL to a youtube video about the lesson

    * **General Educational Informations:** Added a new custom field
      * _Youtube Channel:_ link of the Youtube channel about the lectures
    
    * Added resources button in the sidebar showing Chapter Resources
    * Window responsive buttons for Activities, Exercises and Download
    
 * ENHANCED: 
   * Book title automatically converted in uppercase 
   
   * Info Button: 
     * Custom icon for each different language level 
     * Added link to the Table Of Contents and Questions And Answers of the book
     
   * **Custom Chapter Metabox** Changed Costum Input 1 and Costum Input 2 to:
     * _Main Descriptor:_ type of grammar element taught in the topic
     * _Secondary descriptor:_ type of descriptor taught in the topic
    
 * FIXED: 
 * UNDER THE HOOD: 

### 0.1.2
* New: 
  * Custom color for each language level shown in the header
* Tweak: 
  * Download button
  * Custom Header with on-lingua logo
* Fix: 
  * Facebook like button
  * Footer metadata
* Deprecated:
  * Removed author name from the header
  * Removed  `open-textbooks-style.css ` from child theme

### 0.1.1
* New: 
* Tweak: 
* Fix: our theme stylesheets now overrides the default parent theme's style


### 0.1
* Initial version.
* New child theme based on Fitzgerald, a Luther's child theme
* Custom stylesheets for every course level

* **Custom Chapter Metadata:** new custom metaboxes for the custom page chapter
  * _Questions And Answers:_ this field allows teachers to insert a custom link. 
  * _Class Learning Time (minutes):_ how long the students will need for the topic.
  * _Costum Input 1:_ hashtag 1
  * _Costum Input 2:_ hashtag 2
  
* **General Education Informations:**
  * _Target Language:_ European languages
  * _Level:_ A1, A2, B1, B2, C1, C2
  * _Learning Reasource Type:_ Course, Examination, Exercise, Descriptor
  * _Interactivity Type:_ Active, Expositive, Mixed
  * _Age range:_ 3-5, 6-7, 7-8, 8-9, 9-10, 10-11, 11-12, 12-13, 13-14, 14-15, 15-16, 16-17, 17-18 years, Adults
  * _Content Type:_ Course, Extra Content, Text and Functions, Phonetics and Spelling, Grammar, Vocaboulary
  * _Class Learning Time:_ how long the students will need for the book
  * _License URL:_ custom link to a licence
  * _Bibliography URL:_ custom link to a bibliography
  * _Library URL:_ custom link to a library
  * _Questions and Answers:_ allows teachers to insert a custom link 
  


* **Related books:** Indexing system to switch from book to book located in Unit page. Every fiel is a custom input for links or books name for the same level of language
  * _Notional Components_: Vocabulary, Grammatical Components
  * _Grammar_: Phonetics and Spelling
  * _Pragmatic Components_: Texts and Functions
  * _Cultural Component_: Cultural and Sociocultural
  * _Extra Components_: Extra Content
   
 

## Credits

Uses the [WordPress Plugin Boilerplate](http://wppb.io/).
