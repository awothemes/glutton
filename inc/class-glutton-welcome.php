<?php
/**
 * Glutton Welcome Class
 *
 * @author   AwoThemes
 * @package  glutton
 * @since    1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class glutton_welcome {

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'glutton_welcome_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'glutton_activation_admin_notice' ) );

		add_action( 'glutton_welcome', array( $this, 'glutton_welcome_intro' ), 				10 );
		add_action( 'glutton_welcome', array( $this, 'glutton_welcome_who' ), 				20 );

	} // end constructor

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.3.4
	 */
	public function glutton_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // input var okay
			add_action( 'admin_notices', array( $this, 'glutton_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.3.4
	 */
	public function glutton_welcome_admin_notice() {
		?>
			<div class="updated fade">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing glutton!', 'glutton')); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=glutton-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with glutton', 'glutton' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.3.4
	 */
	public function glutton_welcome_register_menu() {
		add_theme_page( 'Glutton', 'Glutton docs', 'read', 'glutton-welcome', array( $this, 'glutton_welcome_screen' ) );
	}

	/**
	 * The welcome screen
	 * @since 1.3.4
	 */
	public function glutton_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="wrap about-wrap">

			<?php
			/**
			 * @hooked glutton_welcome_intro - 10
			 * @hooked glutton_welcome_who - 20
			 */
			do_action( 'glutton_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * welcome screen intro
	 * @since 1.3.4
	 */
	public function glutton_welcome_intro() {
		$glutton = wp_get_theme( 'glutton' );

		?>
<section class="pattern" id="twocolumnlayout2">

<div class="wrap">

	<h1 style="margin-bottom:1em;">Glutton</h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables">

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->
						
						<div class="inside">

						<div class="inside">
							<h3><?php _e( 'Theme description:', 'glutton' ); ?></h3>
							<p>Glutton is a clean and modern WordPress theme for Cafe & Restaurant and any food related business web site. Built with the latest WordPress technology. Glutton support responsive layout so it looks great on all devices.</p>
								<p><a target="blank" href="http://demo.awothemes.pro/glutton" class="button-primary"><?php _e( 'View Demo', 'glutton' ); ?></a>
								<a target="blank" href="http://awothemes.pro/docs/glutton" class="button-secondary"><?php _e( 'Documentation', 'glutton' ); ?></a></p>
 
						</div>

						<!-- .inside -->
						</div>
					</div>
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->
						
						<div class="inside">

						<div class="inside">
							<h3><?php _e( 'Can\'t find a feature or found a bug?', 'glutton' ); ?></h3>
							<p><?php echo sprintf( esc_html__( 'Please suggest ideas or report an error at the %sGlutton Support Forum%s.', 'glutton' ), '<a target="blank" href="https://wordpress.org/support/theme/glutton">', '</a>' ); ?></p>
						</div>
						<!-- .inside -->

						<div class="inside">
							<h3><?php _e( 'Are you enjoying Glutton?', 'glutton' ); ?></h3>
							<p><?php echo sprintf( esc_html__( 'Why not leave a review on %sWordPress.org%s? We\'d really appreciate it! :-)', 'glutton' ), '<a target="blank" href="https://wordpress.org/support/theme/glutton/reviews/#new-post">', '</a>' ); ?></p>
						</div>
						<!-- .inside -->
						
						<div class="inside">
							<h3><?php _e( 'Can I Contribute?', 'glutton' ); ?></h3>
							<p><?php _e( 'Want to contribute a patch or create a new feature? GitHub is the place to go!', 'glutton' ); ?></p>
							<p><a target="blank" href="https://github.com/awothemes/glutton" class="button-primary"><?php _e( 'Glutton at GitHub', 'glutton' ); ?></a></p>
						</div>
						<!-- .inside -->
						</div>
					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					
					<div class="postbox">
						<div class="inside">
							<h3 class="hndl">Meet Our WordPress Themes:</h3>
						</div>
					</div>
				</div>
				<div class="meta-box-sortables">
					
					<div class="postbox">
						<!--<div class="inside">-->	
							<a target="blank" href="https://wordpress.org/themes/slresponsive"><img src="<?php echo esc_url( 'demo.awothemes.pro/slresponsive/wp-content/themes/slresponsive/screenshot.png' ); ?>" alt="slresponsive" /></a>
							<h2><span><a target="blank" href="https://wordpress.org/themes/slresponsive">SlResponsive WordPress Theme</a></span></h2>
					<!--</div>-->
					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
</section>

		<?php
	}

	/**
	 * welcome screen who section
	 * @since 1.3.4
	 */
	public function glutton_welcome_who() {
		?>

		<?php
	}
}
return new glutton_welcome();

