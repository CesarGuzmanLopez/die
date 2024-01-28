<?php
/**
 * The template for displaying 500 pages in PWA.
 *
 * @package CtemaWP WordPress theme
 * @since   1.8.8
 */

pwa_get_header( 'pwa' );

do_action( 'ctema_do_server_error' );

pwa_get_footer( 'pwa' );
