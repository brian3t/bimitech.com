<?php
/**
 *
 * The template for displaying search form
 *
 **/
 
 
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s"><?php esc_attr__( 'Search', 'dp-esense' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php echo esc_html_e( 'Search', 'dp-esense' ); ?>" value="<?php echo wp_kses(get_search_query(), null); ?>" />
	
	<input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'dp-esense' ); ?>" />
</form>