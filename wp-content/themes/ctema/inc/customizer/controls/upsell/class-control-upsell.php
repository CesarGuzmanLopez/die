<?php
/**
 * Customizer Control: ctemawp-upsell.
 *
 * @package     CtemaWP WordPress theme
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Upsell control
 */
class CtemaWP_Customizer_Upsell_Section_Control extends WP_Customize_Section {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ctemawp-upsell';
	public $url  = '';
	public $id = '';

	/**
	 * JSON.
	 */
	public function json() {
		$json 			= parent::json();
		$json['url'] 	= esc_url( $this->url );
		$json['id'] 	= $this->id;
		return $json;
	}

	/**
	 * Render template
	 *
	 * @access protected
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3>
				<a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a>
			</h3>
		</li>
		<?php
	}
}

/**
 * Enqueue control related scripts/styles.
 *
 * @access public
 */
function ctemawp_upsell_enqueue() {
	wp_enqueue_script( 'ctemawp-upsell', CTEMAWP_INC_DIR_URI . 'customizer/assets/min/js/upsell.min.js', array( 'customize-controls' ), false, true );
	wp_enqueue_style( 'ctemawp-upsell', CTEMAWP_INC_DIR_URI . 'customizer/assets/min/css/upsell.min.css', null );
}
add_action( 'customize_controls_enqueue_scripts', 'ctemawp_upsell_enqueue' );