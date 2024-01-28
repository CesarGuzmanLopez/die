<?php

function ctemacp_output_ctema_extra_notice_enqueue_scripts( $hook ) {
	if ( ! apply_filters(
		'ctemawp:admin:display-ctema-extra-plugin-notice',
		true
	) ) {
		return;
	}

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	if ( get_option( 'dismissed-ctemawp_plugin_notice', false ) ) {
		return;
	}

	$manager = new Ctemawp_Plugin_Manager();
	$status  = $manager->get_ctema_extra_status()['status'];

	if ( $status === 'active' ) {
		return;
	}

	wp_enqueue_script( 'ctema-extra-plugin-notice-js', CTEMAWP_INC_DIR_URI . 'activation-notice/assets/js/notice.min.js', array( 'jquery' ), CTEMAWP_THEME_VERSION, true );
	wp_localize_script(
		'ctema-extra-plugin-notice-js',
		'owp_notification_i18n',
		array(
			'activating'            => __( 'Activating...', 'ctemawp' ),
			'installing_activating' => __( 'Installing & activating...', 'ctemawp' ),
		)
	);
	wp_register_style( 'ctema-extra-plugin-notice-css', CTEMAWP_INC_DIR_URI . 'activation-notice/assets/css/notice.min.css', array(), CTEMAWP_THEME_VERSION );
	wp_enqueue_style( 'ctema-extra-plugin-notice-css' );
}
add_action( 'admin_enqueue_scripts', 'ctemacp_output_ctema_extra_notice_enqueue_scripts' );

add_action(
	'admin_notices',
	function () {
		ctemacp_output_ctema_extra_notice();
	}
);

function ctemacp_output_ctema_extra_notice() {
	if ( ! apply_filters(
		'ctemawp:admin:display-ctema-extra-plugin-notice',
		true
	) ) {
		return;
	}

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	if ( get_option( 'dismissed-ctemawp_plugin_notice', false ) ) {
		return;
	}

	$manager = new Ctemawp_Plugin_Manager();
	$status  = $manager->get_ctema_extra_status()['status'];

	if ( $status === 'active' ) {
		return;
	}

	echo '<div class="notice notice-ctema-extra-plugin">';
	echo '<div class="notice-ctema-extra-plugin-root">';

	?>

	<div class="owp-ctema-extra-plugin-inner">
		<button type="button" class="notice-dismiss">
			<span class="screen-reader-text">
				<?php _e( 'Dismiss this notice.', 'ctemawp' ); ?>
			</span>
		</button>

		<span class="owp-notification-icon">
			<img src="<?php echo esc_url( CTEMAWP_INC_DIR_URI . '/activation-notice/assets/img/ctemawp-blue-icon.png' ); ?>" />
		</span>

		<div class="owp-notification-content">
			<h2><?php esc_html_e( 'Awesome Possum - You\'re Amazing!', 'ctemawp' ); ?></h2>
			<h3 class="notice-subheading"><?php esc_html_e( 'Thank you for installing the CtemaWP theme.', 'ctemawp' ); ?></h3>
			<p>
				<?php esc_html_e( 'We highly recommend you to install and activate the', 'ctemawp' ); ?>
				<b><?php esc_html_e( 'Ctema Extra', 'ctemawp' ); ?></b> plugin.
				<br>
				<?php esc_html_e( 'This plugin will unlock new power tools to help you build an amazing website. Get access to:', 'ctemawp' ); ?></p>
				<ul>
					<li> <?php echo esc_html__( 'freemium website template demos,', 'ctemawp' ); ?> </li>
					<li> <?php echo esc_html__( 'WordPress widgets,', 'ctemawp' ); ?> </li>
					<li> <?php echo esc_html__( 'Metabox settings to control pages and posts individually,', 'ctemawp' ); ?> </li>
					<li> <?php echo esc_html__( 'ability to create and use custom templates,', 'ctemawp' ); ?> </li>
					<li> <?php echo esc_html__( 'and much, much more.', 'ctemawp' ); ?> </li>
				</ul>
			</p>
		</div>
	</div>
	<?php

	echo '</div>';
	echo '</div>';
}
