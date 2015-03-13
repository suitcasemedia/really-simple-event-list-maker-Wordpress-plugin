<?php


add_action( 'post_submitbox_misc_actions', 'date_instructions' );
//add_fitler('post_submitbox_misc_actions', 'hello');



function date_instructions() {
	global $post;
	if (get_post_type($post) == 'future_events' ||  get_post_type($post) == 'past_events') {
		echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';
		echo '<h2>Please specify the time and event of the date here</h2>' ;
		echo '<strong>Only events in the future will be visible on the Calendar Page/ booking system</strong>' ;
		echo '</div>';

		
		
	} ;

}
