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
			'href'    => '/speakers/',
			'label'   => __( 'Speakers', 'wpcampus-2018' ),
			'current' => is_page( 'speakers' ),
		),
	);

	$menu2 = array(
		array(
			'href'    => '/venue/',
			'label'   => __( 'St. Louis', 'wpcampus-2018' ),
			'current' => is_page( 'venue' ),
		),
		array(
			'href'    => '/sponsors/',
			'label'   => __( 'Sponsors', 'wpcampus-2018' ),
			'current' => is_page( 'sponsors' ),
		),
	);

	?>
	<div class="wpc-container" role="navigation">
		<div class="wpc-logo">
			<a href="/">
				<img alt="<?php printf( esc_attr__( 'The %1$s conference, where %2$s meets higher education, will take place July 12-14, 2018 in St. Louis, Missouri.', 'wpcampus-2018' ), 'WPCampus', 'WordPress' ); ?>" src="<?php echo $wpcampus_dir; ?>assets/images/wpcampus-2018-logo.png">
			</a>
		</div>
		<?php

		wpcampus_2018_print_menu( 'wpc-menu-1', __( 'First part of primary menu', 'wpcampus-2018' ), $menu1 );

		wpcampus_2018_print_menu( 'wpc-menu-2', __( 'Second part of primary menu', 'wpcampus-2018' ), $menu2 );

		?>
		<button class="wpc-toggle-menu" data-toggle="wpc-header" aria-label="<?php _e( 'Toggle menu', 'wpcampus-2018' ); ?>">
			<div class="wpc-open-menu-label"><?php _e( 'Menu', 'wpcampus-2018' ); ?></div>
			<div class="wpc-close-menu-label"><?php _e( 'Close', 'wpcampus-2018' ); ?></div>
		</button>
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
			<a class="wpc-header-action" href="#"><?php printf( __( '%1$sOur %2$scall for speakers%3$s is open until %4$s.%5$s We\'d love to learn how you build higher ed.', 'wpcampus-2018' ), '<strong>', '<span class="underline uppercase">', '</span>', $deadline->format( $deadline_format ), '</strong>' ); ?></a>
		</div>
	<?php
	endif;
}
add_action( 'wpc_add_before_body', 'wpcampus_2018_print_header_action', 1 );

/**
 * Print the Mailchimp signup form.
 */
function wpcampus_print_mailchimp_signup() {

	?>
	<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
	<div id="mc_embed_signup">
		<form action="https://wpcampus.us11.list-manage.com/subscribe/post?u=6d71860d429d3461309568b92&amp;id=05f39a2a20" method="post" id="mc-embedded-subscribe-form" class="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<div id="mc_embed_signup_scroll">
				<h2>Subscribe to WPCampus mailing list</h2>
				<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
				<p>Sign-up to receive email updates about the WPCampus community and conference.</p>
				<div class="mc-field-group-row name">
					<div class="mc-field-group first-name">
						<label for="mce-FNAME">First Name </label>
						<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
					</div>
					<div class="mc-field-group last-name">
						<label for="mce-LNAME">Last Name </label>
						<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
					</div>
				</div>
				<div class="mc-field-group email">
					<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span></label>
					<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
				</div>
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6d71860d429d3461309568b92_05f39a2a20" tabindex="-1" value=""></div>
				<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
			</div>
		</form>
	</div>
	<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[6]='MMERGE6';ftypes[6]='radio';fnames[3]='MMERGE3';ftypes[3]='text';fnames[5]='MMERGE5';ftypes[5]='radio';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
	<?php
}

/**
 * Add the Mailchimp signup form to bottom of all content.
 */
function wpcampus_2018_add_mailchimp_to_content( $content ) {

	// Not on the application.
	if ( is_page( 'call-for-speakers/application' ) ) {
		return $content;
	}

	ob_start();

	wpcampus_print_mailchimp_signup();

	return $content . ob_get_clean();

}
add_action( 'the_content', 'wpcampus_2018_add_mailchimp_to_content' );
