<?php 

/*
	Plugin Name: Super simple event list system 
	Plugin URI: http://suitcasemedia.co.uk
	Description: SImple event system for listing events developed for quartet of nations.
	Author: jimmy
	Version: 0.1
	Author URI: http://suitcasemedia.co.uk
	
 */
/**
* 
*/


//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'do_output_buffer');
function do_output_buffer() {
	ob_start();
}

//==========================================================================================================================================

// Data base stuff only works if put here for some unknown reason

//==========================================================================================================================================
global $sales_db_version;
$sales_db_version = "1.0";
/**************************************************************************************************************************

*****************************************************************************************************************************/
//==========================================================================================================================================
// Create custom post types
//==========================================================================================================================================
class Central_Street_Events_Post_Type 
{
	
	function __construct()
	{
		# code...

		$this->register_future_event_post_type();
		$this->register_past_event_post_type();

		

		$this->metaboxes();
	}

	function register_future_event_post_type(){
		$args = array(
			

			'labels' => array(

				'name' => 'Future Events',
				'singular_name' => 'Future Event',
				'add_new' => 'Add Future Event',
				'add_new_item' => 'Add New Future Event',
				'edit_item' => 'Edit Future Event',
				'add_new_item' => 'Add New Future Event',
				'view_item' => 'View Future Event',
				'new_item_name' => 'Add New Future Event',
				'view_item' => 'View Future Event',
				'search_items' => 'Search Future Events',
				'not_found' => 'Future Event Not Found',
				'not_found_in_trash' => 'Future Event Not Found in Trash'
				),


			'query_var' => 'Future Events',
			'rewrite' => array(
				'slug' => 'events'

				) ,
			'has_archive' => true,
			'public' => true,
			'menu_position' => 4,
			'menu_icon' => 'dashicons-calendar',

			'supports' => array(
				'title',
				'editor'
			//'thumbnail'

				)


			);
		register_post_type('future_events', $args);
	}
	function register_past_event_post_type(){
		$args = array(
			

			'labels' => array(

				'name' => 'Past Events',
				'singular_name' => 'Past Event',
				'add_new' => 'Add Past Event',
				'add_new_item' => 'Add New Past Event',
				'edit_item' => 'Edit Past Event',
				'add_new_item' => 'Add New Past Event',
				'view_item' => 'View Past Event',
				'new_item_name' => 'Add New Past Event',
				'view_item' => 'View Past Event',
				'search_items' => 'Search Past Events',
				'not_found' => 'Future Event Not Found',
				'not_found_in_trash' => 'Past Event Not Found in Trash'
				),


			'query_var' => 'Past Events',
			'rewrite' => array(
				'slug' => 'Past Events'

				) ,
			'public' => true,-
			'menu_position' => 5,
			'menu_icon' => 'dashicons-calendar',
			'supports' => array(
				'title',
				'editor'
				),


			);
		register_post_type('past_events', $args);
	}



//==========================================================================================================================================

// Create custom taxonomies

//==========================================================================================================================================

//==========================================================================================================================================

// Create custom metaboxes

//==========================================================================================================================================
	public function metaboxes(){
		add_action('add_meta_boxes', function() {
				//css id, title, cb function, page or post type associated with , priority level, callback function arguments to pass
			add_meta_box('venue','venue','event_venue', 'future_events' );
			add_meta_box('venue','venue','event_venue', 'past_events' );

			add_meta_box('End time','End time','endtime', 'future_events','side','high' );
			add_meta_box('End time','End time','endtime', 'past_events' );


		});




		function event_venue($post) {
			$venue = get_post_meta($post->ID ,'venue' ,true);
			?>
			<p>
				<label for="venue">venue: </label>
				<input type="text" class="widefat" name="venue" id="venue" value="<?php echo esc_attr($venue)
				; ?>" />

			</p>

			<?php

		}

		add_action('save_post', function($id){
			if (isset($_POST['venue'])){

				update_post_meta(
					$id,
					'venue',
					strip_tags($_POST['venue'])
					);
			}
		});

		function endtime($post) {
			$endtime = get_post_meta($post->ID ,'end-time' ,true);
			?>
			<p>
				<label for="end-time">Event end time: </label>
				<input type="text" class="widefat" name="end-time" id="end-time" value="<?php echo esc_attr($endtime)
				; ?>" />

			</p>

			<?php

		}

		add_action('save_post', function($id){
			if (isset($_POST['end-time'])){

				update_post_meta(
					$id,
					'end-time',
					strip_tags($_POST['end-time'])
					);
			}
		});
	}
}


    //==========================================================================================================================================

//INitialise the plugin and include all the other files

//==========================================================================================================================================

   // add_action('init', 'setup_future_hook');

add_action('init' , function(){

	new Central_Street_Events_Post_Type();

		include dirname(__FILE__) . '/booking-calendar-shortcode.php' ; // this creates shortcode outputs the stuff onto the wordpress calendar page
		include dirname(__FILE__) . '/customise-publish-metabox.php' ;  // this makes it possible to put course end time when you publish a post
		include dirname(__FILE__) . '/future-post.php' ; //this makes all future posts in future events published instead of hidden
		include dirname(__FILE__) . '/fix-menu.php' ; // this stops blog showing up as active when viewing single events
		include dirname(__FILE__) . '/filter-single-post-template.php' ; // this means that the individual events pages piggy back off of single.php in the themw
		include dirname(__FILE__) . '/update_post_type.php' ; // remove outdated posts

	});




