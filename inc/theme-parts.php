<?php

/**
 * Print menu items, used for our main menu.
 */
function wpcampus_2018_print_menu( $menu_id, $menu_label, $menu_items ) {

	if ( empty( $menu_items ) ) {
		return false;
	}

	?>
	<nav class="wpc-menu <?php echo $menu_id; ?>" role="navigation" aria-label="<?php esc_attr_e( $menu_label ); ?>">
		<ul>
			<?php

			foreach ( $menu_items as $item ) :

				// Make sure we have info we need.
				if ( empty( $item['href'] ) || empty( $item['label'] ) ) :
					continue;
				endif;

				$is_current = isset( $item['current'] ) && true === $item['current'];

				$item_classes = array();

				if ( $is_current ) {
					$item_classes[] = 'current-menu-item';
				}

				?>
				<li<?php echo ! empty( $item_classes ) ? ' class="' . implode( ' ', $item_classes ) . '"' : ''; ?>>
					<a href="<?php echo $item['href']; ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>><?php echo $item['label']; ?></a>
				</li>
				<?php
			endforeach;

			?>
		</ul>
	</nav>
	<?php
}

function wpcampus_2018_print_header() {

	$wpcampus_dir = trailingslashit( get_stylesheet_directory_uri() );

	$menu1 = array(
		array(
			'href'    => '/about/',
			'label'   => __( 'About', 'wpcampus-2018' ),
			'current' => is_page( 'about' ),
		),
		array(
			'href'    => '/tickets/',
			'label'   => __( 'Tickets', 'wpcampus-2018' ),
			'current' => is_page( 'tickets' ),
		),
		array(
			'href'    => '/call-for-speakers/',
			'label'   => __( 'Speakers', 'wpcampus-2018' ),
			'current' => is_page( 'call-for-speakers' ),
		),
	);

	$menu2 = array(
		array(
			'href'    => '/attendees/',
			'label'   => __( 'Attendees', 'wpcampus-2018' ),
			'current' => is_page( 'venue' ),
		),
		array(
			'href'    => '/sponsors/',
			'label'   => __( 'Sponsors', 'wpcampus-2018' ),
			'current' => is_page( 'sponsors' ),
		),
		array(
			'href'    => '/contact/',
			'label'   => __( 'Contact', 'wpcampus-2018' ),
			'current' => is_page( 'contact' ),
		),
	);

	?>
	<div class="wpc-container" role="navigation">
		<div class="wpc-logo">
			<a href="/">
				<?php

				if ( is_front_page() ) :
					?>
					<h1 class="for-screen-reader"><?php printf( __( '%1$s 2018 Conference: Where %2$s Meets Higher Education', 'wpcampus-2018' ), 'WPCampus', 'WordPress' ); ?></h1>
					<?php
				endif;

				?>
				<img alt="<?php printf( esc_attr__( 'The %1$s 2018 conference, where %2$s meets higher education, will take place July 12-14, 2018 in St. Louis, Missouri.', 'wpcampus-2018' ), 'WPCampus', 'WordPress' ); ?>" src="<?php echo $wpcampus_dir; ?>assets/images/wpcampus-2018-logo.png">
			</a>
		</div>
		<button class="wpc-toggle-menu" data-toggle="wpc-header" aria-label="<?php _e( 'Toggle menu', 'wpcampus-2018' ); ?>">
			<div class="wpc-toggle-bar"></div>
			<div class="wpc-open-menu-label"><?php _e( 'View menu', 'wpcampus-2018' ); ?></div>
		</button>
		<?php

		wpcampus_2018_print_menu( 'wpc-menu-1', __( 'First part of primary menu', 'wpcampus-2018' ), $menu1 );

		wpcampus_2018_print_menu( 'wpc-menu-2', __( 'Second part of primary menu', 'wpcampus-2018' ), $menu2 );

		if ( function_exists( 'wpcampus_print_social_media_icons' ) ) {
			wpcampus_print_social_media_icons();
		}

		?>
	</div>
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

/**
 * Add header action button(s).
 *
 * TO DO:
 * - Update so message changes as it gets closer
 * and hides/changes after deadline ends.
 */
function wpcampus_2018_print_header_action() {

	$deadline = wpcampus_2018_get_call_speaker_deadline();
	$deadline_format = 'F j, Y';

	if ( $deadline ) :
		?>
		<div id="wpc-header-actions">
			<a class="wpc-header-action" href="/call-for-speakers/"><?php printf( __( '%1$sOur %2$scall for speakers%3$s is open until %4$s.%5$s We\'d love to learn how you build higher ed.', 'wpcampus-2018' ), '<strong>', '<span class="highlight-button uppercase">', '</span>', $deadline->format( $deadline_format ), '</strong>' ); ?></a>
		</div>
	<?php
	endif;
}
add_action( 'wpc_add_before_body', 'wpcampus_2018_print_header_action', 1 );
