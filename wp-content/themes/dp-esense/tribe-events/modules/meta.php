<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );

$meta_column_count = 1;
if (tribe_has_organizer()) $meta_column_count = $meta_column_count +1;
if (tribe_has_venue()) $meta_column_count = $meta_column_count +1;
$metacolumn_class= ' metacolumn_width_'.$meta_column_count;
// Check for skeleton mode (no outer wrappers per section)
$not_skeleton = ! apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, get_the_ID() );

// Do we want to group venue meta separately?
$set_venue_apart = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, get_the_ID() );
?>


<?php
do_action( 'tribe_events_single_event_meta_primary_section_start' );
	echo '<div class="tribe-events-meta-group-gmap">';
	tribe_get_template_part( 'modules/meta/map' );
	echo '</div>';
?>
<div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
<div class="<?php echo esc_attr($metacolumn_class) ?>">
<?php tribe_get_template_part( 'modules/meta/details' ); ?>
</div>
<?php if ( tribe_has_organizer() ) { ?>
<div class="<?php echo esc_attr($metacolumn_class) ?>">
<?php tribe_get_template_part( 'modules/meta/organizer' ); ?>
</div>
<?php } ?>
<?php if ( tribe_has_venue() ) { ?>
<div class="<?php echo esc_attr($metacolumn_class) ?>">
<?php tribe_get_template_part( 'modules/meta/venue' ); ?>
</div>
<?php } ?>
</div>
<?php
do_action( 'tribe_events_single_event_meta_primary_section_end' );
do_action( 'tribe_events_single_meta_after' );
?>