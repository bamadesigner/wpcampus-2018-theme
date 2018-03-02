<?php

function wpcampus_2018_print_header() {

	?>
	<div class="wpc-container">header</div>
	<?php

	/*// Print the header menu.
	wp_nav_menu( array(
		'theme_location'    => 'primary',
		'container'         => false,
		'menu_id'           => 'wpc-2018-main-menu',
		'menu_class'        => 'wpc-menu',
	));*/

	/*if ( function_exists( 'wpcampus_print_social_media_icons' ) ) {
		wpcampus_print_social_media_icons();
	}*/
}
add_action( 'wpc_add_to_header', 'wpcampus_2018_print_header', 10 );
