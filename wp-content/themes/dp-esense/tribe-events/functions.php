<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

// Changes the text labels for Google Calendar and iCal buttons on a single event page
remove_action('tribe_events_single_event_after_the_content', array('Tribe__Events__iCal', 'single_event_links'));
add_action('tribe_events_single_event_after_the_content', 'esense_customized_tribe_single_event_links');
 
function esense_customized_tribe_single_event_links()    {
    if (is_single() && post_password_required()) {
        return;
    }
 
    echo '<div class="tribe-events-cal-links">';
	echo '<a href="' . esc_url(tribe_get_gcal_link()) . '" class="button_dp small light" title="' . esc_attr__( 'Add to Google Calendar', 'dp-esense' ) . '"><span>'. esc_attr__( 'Export the Map', 'dp-esense' ) .'</span></a>';
	echo '<a href="' . esc_url(tribe_get_single_ical_link()) . '" class="button_dp small light" title="' . esc_attr__( 'Add to Google Calendar', 'dp-esense' ) . '"><span>'. esc_attr__( 'Export to Calendar', 'dp-esense' ) .'</span></a>';
    echo '</div><!-- .tribe-events-cal-links -->';
}

remove_filter( 'tribe_events_after_footer', array( 'Tribe__Events__iCal', 'maybe_add_link' ), 10, 1  );
add_filter( 'tribe_events_after_footer', 'esense_maybe_add_link', 10, 1 );

function esense_maybe_add_link() {
		global $wp_query;
		$show_ical = apply_filters( 'tribe_events_list_show_ical_link', true );

		if ( ! $show_ical ) {
			return;
		}
		if ( tribe_is_month() && ! tribe_events_month_has_events() ) {
			return;
		}
		if ( is_single() || ! have_posts() ) {
			return;
		}

		$tec = Tribe__Events__Main::instance();

		$view = $tec->displaying;
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $wp_query->query_vars['eventDisplay'] ) ) {
			$view = $wp_query->query_vars['eventDisplay'];
		}

		switch ( strtolower( $view ) ) {
			case 'month':
				$modifier = sprintf( esc_html__( "Month's %s", 'dp-esense' ), tribe_get_event_label_plural() );
				break;
			case 'week':
				$modifier = sprintf( esc_html__( "Week's %s", 'dp-esense' ), tribe_get_event_label_plural() );
				break;
			case 'day':
				$modifier = sprintf( esc_html__( "Day's %s", 'dp-esense' ), tribe_get_event_label_plural() );
				break;
			default:
				$modifier = sprintf( esc_html__( 'Listed %s', 'dp-esense' ), tribe_get_event_label_plural() );
				break;
		}

		$text  = apply_filters( 'tribe_events_ical_export_text', esc_html__( 'Export', 'dp-esense' ) . ' ' . $modifier );
		$title = esc_html__( 'Use this to share calendar data with Google Calendar, Apple iCal and other compatible apps', 'dp-esense' );
		$ical  = '<div class="clearboth">&nbsp;</div><a title="' . $title . '" href="' . esc_url( tribe_get_ical_link() ) . '" target="_self" class="button_dp small light"><span>' . $text . '</span></a>';

		print ($ical);
	}
// EOF