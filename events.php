<?php

$date_now = new DateTime(); // current time date, note this cant be used with an echo $date_now needs print_r($date_now);
$stack = array(); // build an empty array to add event dates to
$single = get_option( 'single_event' );

// query for events
$args = [
	'post_type'			=> 'pending_event',
	'posts_per_page'	=> 10,
];

// run the events in a loop this doesnt print anything just builds an array
$loop = new WP_Query($args);
while ($loop->have_posts()) {
	$loop->the_post();

	// the_content(); we dont currently need the content this is once we decide which event will get run
	$meta = get_post_meta( $post->ID, 'event_date', false ); // grab the dates meta
	$data = $meta[0]; // this ends up as an array in an array it might be possible to remove this step but for now its needed

	// create variables for the date portions
	$mon = $data['start_date_m'];
	$da = $data['start_date_d'];
	$yea = $data['start_date_o'];

	// create a date with the variables as one
	$eventdate = new DateTime("$mon/$da/$yea"); // runs month / day / year 13/12/2016 
	$event_id = get_the_id();
	$stack[$event_id] = $eventdate; // add the dates as a value to the array with the ID as the key
} // while have events

asort($stack); // ascending sort is oldest to newest and doesnt alter the keys

?>
<div id="events">
<?php foreach ( $stack as $key => $value ) {
	if ($date_now < $value) {
		$title = get_post($key)->post_title; ?>
		<div class="event-wrapper">
			<!-- <p>Upcoming Events: </p> -->
			<p class="pending_event">
				<a href="<?php echo esc_url( home_url( '/?p=' ) ). $key; ?>">
					<?php echo $title; ?>
				</a>
			</p>
		</div>
		<?php

		if ($single) {
			break; // stop looping once we find something in the future -->
		}

	} // if the events in the future
} // loop of all events
?>
</div><!-- #events -->