<?php 

/**
 * suffix Theme Customizer.
 *
 * @package suffix
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core/customizer-core.php';

//customizer 
require get_template_directory() . '/inc/customizer/core/default.php';
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function suffix_lite_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/core/control.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/core/sanitize.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	// Load customize option.
	require get_template_directory() . '/inc/customizer/option-panel.php';
	
	/*theme option panel details*/
	require get_template_directory() . '/inc/customizer/theme-option.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Suffix_Lite_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Suffix_Lite_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Suffix', 'suffix-lite' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'suffix-lite' ),
				'pro_url'  => 'https://www.themeinwp.com/theme/suffix/',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'suffix_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function suffix_lite_customize_preview_js() {

	wp_enqueue_script( 'suffix_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}
add_action( 'customize_preview_init', 'suffix_lite_customize_preview_js' );

function suffix_lite_customizer_css() {
	wp_enqueue_script( 'suffix_lite_customize_controls', get_template_directory_uri() . '/assets/twp/js/customizer-admin.js', array( 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'suffix_lite_customizer_css',0 );
