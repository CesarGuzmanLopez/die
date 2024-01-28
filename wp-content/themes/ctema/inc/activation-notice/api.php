<?php

add_action(
	'wp_ajax_ctemawp_dismissed_notice',
	function () {
		update_option( 'dismissed-ctemawp_plugin_notice', true );
		wp_die();
	}
);


add_action(
	'wp_ajax_ctemawp_check_notice_actions',
	function () {

		$manager      = new Ctemawp_Plugin_Manager();
		$status       = $manager->get_ctema_extra_status();
		$actions_html = '';
		if ( $status['status'] == 'installed' ) {
			$actions_html = '<div class="notice-actions">
        <button type="button" class="button button-primary" data-action="activate">' . __( 'Activate Ctema Extra', 'ctemawp' ) . '</button>
        </div>';
		} elseif ( $status['status'] == 'uninstalled' ) {
			$actions_html = '<div class="notice-actions">
        <button type="button" class="button button-primary" data-action="install_activate">' . __( 'Install & Activate Ctema Extra', 'ctemawp' ) . '</button>
        </div>';
		}
		wp_send_json_success(
			$actions_html
		);
	}
);


add_action(
	'wp_ajax_ctemawp_notice_button_click',
	function () {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$manager = new Ctemawp_Plugin_Manager();
		$status  = $manager->get_ctema_extra_status();

		if ( $status['status'] === 'active' ) {
			wp_send_json_success(
				array(
					'status'    => 'active',
					'pluginUrl' => admin_url( 'admin.php?page=ctemawp' ),
				)
			);
		}

		if ( $status['status'] === 'uninstalled' ) {
			$manager->download_and_install( $status['slug'] );
			$manager->plugin_activation( $status['slug'] );

			wp_send_json_success(
				array(
					'status'    => 'active',
					'pluginUrl' => admin_url( 'admin.php?page=ctemawp' ),
				)
			);
		}

		if ( $status['status'] === 'installed' ) {
			$manager->plugin_activation( $status['slug'] );

			wp_send_json_success(
				array(
					'status'    => 'active',
					'pluginUrl' => admin_url( 'admin.php?page=ctemawp' ),
				)
			);
		}

		wp_die();
	}
);
