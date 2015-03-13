<?php
function get_custom_post_type_template($single_template) {
     global $post;

     if ($post->post_type == 'future_events') {
          $single_template = dirname( __FILE__ ) . '/event-content-single.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_custom_post_type_template' );
?>