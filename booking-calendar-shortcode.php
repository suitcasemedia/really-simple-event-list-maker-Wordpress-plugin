<?php
add_shortcode('calendar', function(){
/****************************************************************************************************************************
This the general output /view for the calendar page.
******************************************************************************************************************************/
/****************************************************************************************************************************
Second loop 
******************************************************************************************************************************/
$loop = new WP_Query(
	array(

		'post_type' => 'future_events',
		'orderby' => 'title',
			// 	'post_status' => 'future'
		)
	);
if ($loop->have_posts()){
	$dates = array();
	while ($loop->have_posts()) {
			# code...
		$loop->the_post();
		$meta = get_post_meta(get_the_id(),'');
		$object = get_post();
		$dates[] = substr($object->post_date, 0 ,-12) ;
	}
	$vals = array_count_values($dates);
	foreach ($vals as $key => $value) {
	# code...
		$date = new DateTime('2000-01-01');
		$date = date_create($key.'-'.$value.'-00');
	$output2 .= '<a href="'. site_url().'/'. get_query_var('pagename').'/?year='.$key .'">'.  date_format($date, 'F Y').' ('.$value .') </a><br> ' ; //.<br>';
}


/****************************************************************************************************************************
End of Second loop 
******************************************************************************************************************************/
if( isset($_GET['year']) == true){
	$year =  substr($_GET['year'], -7 , 4 );
	$month = substr($_GET['year'], -2 , 2);
	$loop = new WP_Query(
		array(

			'post_type' => 'future_events',
			'orderby' => 'title',
			'year'    =>  $year,
			'monthnum' => $month
			// 	'post_status' => 'future'
			)
		);
}
else {
	$loop = new WP_Query(
		array(

			'post_type' => 'future_events',
			'orderby' => 'title',
			// 	'post_status' => 'future'
			)
		);
}
if ($loop->have_posts()){
	while ($loop->have_posts()) {
			# code...
		$loop->the_post();
		$meta = get_post_meta(get_the_id(),'');
		$object = get_post();
		if($meta['end-time'][0] != ''){
			$time_text = ' - '.$meta['end-time'][0];
		}
		else{
			$time_text = '';
		}
		$booking ='<a href="'.get_the_permalink().'"> </a>';
		$tr = '<tr  href="'.get_the_permalink().'">';
		$moreinfo = '<a href="'.get_the_permalink().'">More Info </a>';;
		$output4 .= $tr;
		$output4 .='
		<td >'.substr(get_the_date(),0,-6). $time_text .'</td>';

		$output4 .=	'<td >'.get_the_title().'</td>';
		$output4 .=	'<td >'.$meta['venue'][0] .'</td>';
		$output4 .='<td >'. $moreinfo  .'</td>' ;
// end row
		$output4 .='</tr>';
	}
//end table
	$output4 .='</table>
	<script>
	jQuery(document).ready(function($) {
		$(".clickableRow").click(function() {
			window.document.location = $(this).attr("href");
		});
});</script>';


}else{
	$output4 = '';
}
$output1 = '';
}
$output3 .= '</div>
</div> <!-- /row -->
<div >
<div>
<table border="0" >
<tr>
<td>Date</td>
<td>Event</td>
<td>Venue</td>  <td></td>
</tr>
';
return $output1 .$output2 .$output3 .$output4;

});

?>