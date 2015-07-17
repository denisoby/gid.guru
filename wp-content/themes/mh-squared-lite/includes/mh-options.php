<?php

function mh_squared_lite_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

    class MH_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="mh-upgrade-thumb">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/mh_squared.png" />
        	</p>
        	<p class="mh-upgrade-title">
        		<span class="customize-control-title">
        			<?php _e('Need more features and options?', 'mh-squared-lite'); ?>
        		</span>
        	</p>
        	<p class="mh-upgrade-text">
        		<span class="textfield">
        			<?php _e('If you run an awesome website and need more advanced features, options and custom widgets, you can upgrade to the premium version of this theme which comes with great additional features to customize your website.', 'mh-squared-lite'); ?>
        		</span>
			</p>
			<p class="mh-upgrade-button">
				<a href="http://www.mhthemes.com/themes/mh/squared/" target="_blank" class="button button-secondary">
					<?php _e('Click here for premium features', 'mh-squared-lite'); ?>
				</a>
			</p><?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_squared_lite_theme_options', array('title' => __('Theme Options', 'mh-squared-lite'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_squared_lite_general', array('title' => __('General', 'mh-squared-lite'), 'priority' => 1, 'panel' => 'mh_squared_lite_theme_options'));
	$wp_customize->add_section('mh_squared_lite_layout', array('title' => __('Layout', 'mh-squared-lite'), 'priority' => 2, 'panel' => 'mh_squared_lite_theme_options'));
	$wp_customize->add_section('mh_squared_lite_upgrade', array('title' => __('Upgrade to Premium', 'mh-squared-lite'), 'priority' => 3, 'panel' => 'mh_squared_lite_theme_options'));

	/***** Add Settings *****/

	$wp_customize->add_setting('mh_squared_lite_options[excerpt_length]', array('default' => '25', 'type' => 'option', 'sanitize_callback' => 'mh_squared_lite_sanitize_integer'));
	$wp_customize->add_setting('mh_squared_lite_options[read_more]', array('default' => 'Read More', 'type' => 'option', 'sanitize_callback' => 'mh_squared_lite_sanitize_text'));
	$wp_customize->add_setting('mh_squared_lite_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_squared_lite_sanitize_select'));
	$wp_customize->add_setting('mh_squared_lite_options[premium_version_upgrade]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

	/***** Add Controls *****/

	$wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-squared-lite'), 'section' => 'mh_squared_lite_general', 'settings' => 'mh_squared_lite_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
	$wp_customize->add_control('read_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-squared-lite'), 'section' => 'mh_squared_lite_general', 'settings' => 'mh_squared_lite_options[read_more]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar Alignment', 'mh-squared-lite'), 'section' => 'mh_squared_lite_layout', 'settings' => 'mh_squared_lite_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => __('Right Sidebar', 'mh-squared-lite'), 'left' => __('Left Sidebar', 'mh-squared-lite'))));
	$wp_customize->add_control(new MH_Customize_Upgrade_Control($wp_customize, 'premium_version_upgrade', array('section' => 'mh_squared_lite_upgrade', 'settings' => 'mh_squared_lite_options[premium_version_upgrade]', 'priority' => 1)));
}
add_action('customize_register', 'mh_squared_lite_customize_register');

/***** Data Sanitization *****/

function mh_squared_lite_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_squared_lite_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_squared_lite_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_squared_lite_sanitize_select($input) {
    $valid = array(
        'enable' => __('Enable', 'mh-squared-lite'),
        'disable' => __('Disable', 'mh-squared-lite'),
		'right' => __('Right Sidebar', 'mh-squared-lite'),
        'left' => __('Left Sidebar', 'mh-squared-lite'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_squared_lite_theme_options')) {
	function mh_squared_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_squared_lite_options', array()),
			mh_squared_lite_default_options()
		);
		return $theme_options;
	}
}
if (!function_exists('mh_squared_lite_default_options')) {
	function mh_squared_lite_default_options() {
		$default_options = array(
			'excerpt_length' => '25',
			'read_more' => __('Read More', 'mh-squared-lite'),
			'sidebar' => 'right',
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_squared_lite_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_squared_lite_customizer_css');

?>