<?php
global $wpdb;

$wpdb->query(
	"
	UPDATE $wpdb->posts 
	SET post_status = 'publish'
	WHERE post_type = 'future_events'
		AND post_status = 'future'
	"
);