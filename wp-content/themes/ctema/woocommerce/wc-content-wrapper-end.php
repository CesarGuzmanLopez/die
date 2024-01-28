<?php
/**
 * After Container template.
 *
 * @package CtemaWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>

			</article><!-- #post -->

			<?php do_action( 'ctema_after_content_inner' ); ?>

		</div><!-- #content -->

		<?php do_action( 'ctema_after_content' ); ?>

	</div><!-- #primary -->

	<?php do_action( 'ctema_after_primary' ); ?>

</div><!-- #content-wrap -->

<?php do_action( 'ctema_after_content_wrap' ); ?>
