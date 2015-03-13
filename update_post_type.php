<?php
$posts = $wpdb->get_results( 
	"
	SELECT ID, post_date from $wpdb->posts WHERE post_type = 'future_events'
	
	"
	);
if ( $posts )
{
	foreach ( $posts as $post )
	{	
		
		$post_time = $post->post_date ;
		$post_id = $post->ID ;
		if (time() > strtotime($post_time)){
			echo '<H1>ITS IN THE PAST</h1>'.$post_id  ;
			$wpdb->update( 
				$wpdb->posts , 
				array( 
		'post_type' => 'past_events',	// string
		), 
				array( 'ID' =>$post_id )
				);
		}
		else{
			
			//echo $post_id . 'future post<br>';
		}
	}
}

$posts = $wpdb->get_results( 
	"
	SELECT ID, post_date from $wpdb->posts WHERE post_type = 'past_events'
	
	"
	);
if ( $posts )
{
	foreach ( $posts as $post )
	{	
		$post_time = $post->post_date ;
		$post_id = $post->ID ;
		if (time() < strtotime($post_time)){
			$wpdb->update( 
				$wpdb->posts , 
				array( 
		'post_type' => 'future_events',	// string
		
		), 
				array( 'ID' =>$post_id )
				
				);
		}
		else{
			
		}
		
		
	}
}

