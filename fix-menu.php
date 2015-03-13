<?php 
// this is to fix an issue where by the blog page shows as the active link when a person is viewing a future event
function roots_cpt_active_menu($menu) {
	$post_type = get_post_type();
	if($post_type == 'future_events') {
		$menu = str_replace('active', '', $menu);
	}
	else{
		return $menu;
	}
}
add_filter('nav_menu_css_class', 'roots_cpt_active_menu');