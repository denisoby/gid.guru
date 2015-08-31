<?php
class mom_su_Admin_Views {
	function __construct() {}

	public static function about( $field, $config ) {
		ob_start();
?>
<div id="mom-su-about-screen">
	<h1><?php _e( 'Welcome to Shortcodes Ultimate', 'theme' ); ?> <small><?php _e( 'A real swiss army knife for WordPress', 'theme' ); ?></small></h1>
	<div class="sunrise-inline-menu">
		<a href="http://gndev.info/mom-shortcodes-ultimate/" target="_blank"><strong><?php _e( 'Project homepage', 'theme' ); ?></strong></a>
		<a href="http://gndev.info/kb/" target="_blank"><?php _e( 'Documentation', 'theme' ); ?></a>
		<a href="http://wordpress.org/support/plugin/mom-shortcodes-ultimate/" target="_blank"><?php _e( 'Support forum', 'theme' ); ?></a>
		<a href="http://wordpress.org/extend/plugins/mom-shortcodes-ultimate/changelog/" target="_blank"><?php _e( 'Changelog', 'theme' ); ?></a>
		<a href="https://github.com/gndev/mom-shortcodes-ultimate" target="_blank"><?php _e( 'Fork on GitHub', 'theme' ); ?></a>
	</div>
	<div class="mom-su-clearfix">
		<div class="mom-su-about-column">
			<h3><?php _e( 'Plugin features', 'theme' ); ?></h3>
			<ul>
				<li><?php _e( '40+ amazing shortcodes', 'theme' ); ?></li>
				<li><?php _e( 'Power of CSS3 transitions', 'theme' ); ?></li>
				<li><?php _e( 'Handy shortcodes generator', 'theme' ) ?></li>
				<li><?php _e( 'International', 'theme' ); ?></li>
				<li><?php _e( 'Documented API', 'theme' ); ?></li>
			</ul>
		</div>
		<div class="mom-su-about-column">
			<h3><?php _e( 'What is a shortcode?', 'theme' ); ?></h3>
			<p><?php _e( '<strong>Shortcode</strong> is a WordPress-specific code that lets you do nifty things with very little effort.', 'theme' ); ?></p>
			<p><?php _e( 'Shortcodes can embed files or create objects that would normally require lots of complicated, ugly code in just one line. Shortcode = shortcut.', 'theme' ); ?></p>
		</div>
	</div>
	<div class="mom-su-clearfix">
		<div class="mom-su-about-column">
			<h3><?php _e( 'How does it works', 'theme' ); ?></h3>
			<a href="http://www.youtube.com/watch?v=DR2c266yWEA?autoplay=1&amp;showinfo=0&amp;rel=0&amp;theme=light#" target="_blank" class="mom-su-demo-video"><img src="<?php echo plugins_url( 'assets/images/banners/how-it-works.jpg', mom_su_PLUGIN_FILE ); ?>" alt=""></a>
		</div>
		<div class="mom-su-about-column">
			<h3><?php _e( 'More videos', 'theme' ); ?></h3>
			<ul>
				<li><a href="http://www.youtube.com/watch?v=IjmaXz-b55I" target="_blank"><?php _e( 'Shortcodes Ultimate Tutorial', 'theme' ); ?></a></li>
				<li><a href="http://www.youtube.com/watch?v=YU3Zu6C5ZfA" target="_blank"><?php _e( 'How to use special widget', 'theme' ); ?></a></li>
				<li><a href="http://www.screenr.com/BK0H" target="_blank"><?php _e( 'How to create Carousel', 'theme' ); ?></a></li>
				<li><a href="http://www.youtube.com/watch?v=kCWyO2F7jTw" target="_blank"><?php _e( 'How to create image gallery', 'theme' ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		mom_su_query_asset( 'css', array( 'magnific-popup', 'mom-su-options-page' ) );
		mom_su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'mom-su-options-page' ) );
		return $output;
	}

	public static function custom_css( $field, $config ) {
		ob_start();
?>
<div id="mom-su-custom-css-screen">
	<div class="mom-su-custom-css-originals">
		<p><strong><?php _e( 'You can overview the original styles to overwrite it', $config['textdomain'] ); ?></strong></p>
		<div class="sunrise-inline-menu">
			<a href="<?php echo mom_su_skin_url( 'content-shortcodes.css' ); ?>">content-shortcodes.css</a>
			<a href="<?php echo mom_su_skin_url( 'box-shortcodes.css' ); ?>">box-shortcodes.css</a>
			<a href="<?php echo mom_su_skin_url( 'media-shortcodes.css' ); ?>">media-shortcodes.css</a>
			<a href="<?php echo mom_su_skin_url( 'galleries-shortcodes.css' ); ?>">galleries-shortcodes.css</a>
			<a href="<?php echo mom_su_skin_url( 'players-shortcodes.css' ); ?>">players-shortcodes.css</a>
			<a href="<?php echo mom_su_skin_url( 'other-shortcodes.css' ); ?>">other-shortcodes.css</a>
		</div>
		<?php do_action( 'mom_su/admin/css/originals/after' ); ?>
	</div>
	<div class="mom-su-custom-css-vars">
		<p><strong><?php _e( 'You can use next variables in your custom CSS', $config['textdomain'] ); ?></strong></p>
		<code>%home_url%</code> - <?php _e( 'home url', $config['textdomain'] ); ?><br/>
		<code>%theme_url%</code> - <?php _e( 'theme url', $config['textdomain'] ); ?><br/>
		<code>%plugin_url%</code> - <?php _e( 'plugin url', $config['textdomain'] ); ?>
	</div>
	<div id="mom-su-custom-css-editor">
		<div id="sunrise-field-<?php echo esc_attr($field['id']); ?>-editor"></div>
		<textarea name="sunrise[<?php echo esc_attr($field['id']); ?>]" id="sunrise-field-<?php echo esc_attr($field['id']); ?>" class="regular-text" rows="10"><?php echo stripslashes( get_option( $config['prefix'] . $field['id'] ) ); ?></textarea>
	</div>
</div>
			<?php
		$output = ob_get_contents();
		ob_end_clean();
		mom_su_query_asset( 'css', array( 'magnific-popup', 'mom-su-options-page' ) );
		mom_su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'ace', 'mom-su-options-page' ) );
		return $output;
	}

	public static function examples( $field, $config ) {
		$output = array();
		$examples = mom_su_Data::examples();
		$preview = '<div style="display:none"><div id="mom-su-examples-window"><div id="mom-su-examples-preview"></div></div></div>';
		$open = ( isset( $_GET['example'] ) ) ? sanitize_text_field( $_GET['example'] ) : '';
		$open = '<input id="mom_su_open_example" type="hidden" name="mom_su_open_example" value="' . $open . '" />';
		foreach ( $examples as $group ) {
			$items = array();
			if ( isset( $group['items'] ) ) foreach ( $group['items'] as $item ) {
					$code = ( isset( $item['code'] ) ) ? $item['code'] : plugins_url( 'inc/examples/' . $item['id'] . '.example', mom_su_PLUGIN_FILE );
					$id = ( isset( $item['id'] ) ) ? $item['id'] : '';
					$items[] = '<div class="mom-su-examples-item" data-code="' . $code . '" data-id="' . $id . '" data-mfp-src="#mom-su-examples-window"><i class="fa fa-' . $item['icon'] . '"></i> ' . $item['name'] . '</div>';
				}
			$output[] = '<div class="mom-su-examples-group mom-su-clearfix"><h2 class="mom-su-examples-group-title">' . $group['title'] . '</h2>' . implode( '', $items ) . '</div>';
		}
		mom_su_query_asset( 'css', array( 'magnific-popup', 'font-awesome', 'mom-su-options-page' ) );
		mom_su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'mom-su-options-page' ) );
		return '<div id="mom-su-examples-screen">' . implode( '', $output ) . '</div>' . $preview . $open;
	}

	public static function cheatsheet( $field, $config ) {
		// Prepare print button
		$print = '<div><a href="javascript:;" id="mom-su-cheatsheet-print" class="mom-su-cheatsheet-switch button button-primary button-large">' . __( 'Printable version', 'theme' ) . '</a><div id="mom-su-cheatsheet-print-head"><h1>' . __( 'Shortcodes Ultimate', 'theme' ) . ': ' . __( 'Cheatsheet', 'theme' ) . '</h1><a href="javascript:;" class="mom-su-cheatsheet-switch">&larr; ' . __( 'Back to Dashboard', 'theme' ) . '</a></div></div>';
		// Prepare table array
		$table = array();
		// Table start
		$table[] = '<table><tr><th style="width:20%;">' . __( 'Shortcode', 'theme' ) . '</th><th style="width:50%">' . __( 'Attributes', 'theme' ) . '</th><th style="width:30%">' . __( 'Example code', 'theme' ) . '</th></tr>';
		// Loop through shortcodes
		foreach ( (array) mom_su_Data::shortcodes() as $name => $shortcode ) {
			// Prepare vars
			$icon = ( isset( $shortcode['icon'] ) ) ? $shortcode['icon'] : 'puzzle-piece';
			$shortcode['name'] = ( isset( $shortcode['name'] ) ) ? $shortcode['name'] : $name;
			$attributes = array();
			$example = array();
			$icons = 'icon: music, icon: envelope &hellip; <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">' . __( 'full list', 'theme' ) . '</a>';
			// Loop through attributes
			if ( is_array( $shortcode['atts'] ) )
				foreach ( $shortcode['atts'] as $id => $data ) {
					// Prepare default value
					$default = ( isset( $data['default'] ) && $data['default'] !== '' ) ? '<p><em>' . __( 'Default value', 'theme' ) . ':</em> ' . $data['default'] . '</p>' : '';
					// Check type is set
					if ( empty( $data['type'] ) ) $data['type'] = 'text';
					// Switch attribute types
					switch ( $data['type'] ) {
						// Select
					case 'select':
						$value = implode( ', ', array_keys( $data['values'] ) );
						break;
						// Slider and number
					case 'slider':
					case 'number':
						$value = $data['min'] . '&hellip;' . $data['max'];
						break;
						// Bool
					case 'bool':
						$value = 'yes | no';
						break;
						// Icon
					case 'icon':
						$value = $icons;
						break;
						// Color
					case 'color':
						$value = __( '#RGB and rgba() colors' );
						break;
						// Default value
					default:
						$value = $data['default'];
						break;
					}
					// Check empty value
					if ( $value === '' ) $value = __( 'Any text value', 'theme' );
					// Extra CSS class
					if ( $id === 'class' ) $value = __( 'Any custom CSS classes', 'theme' );
					// Add attribute
					$attributes[] = '<div class="mom-su-shortcode-attribute"><strong>' . $data['name'] . ' <em>&ndash; ' . $id . '</em></strong><p><em>' . __( 'Possible values', 'theme' ) . ':</em> ' . $value . '</p>' . $default . '</div>';
					// Add attribute to the example code
					$example[] = $id . '="' . $data['default'] . '"';
				}
			// Prepare example code
			$example = '[%prefix_' . $name . ' ' . implode( ' ', $example ) . ']';
			// Prepare content value
			if ( empty( $shortcode['content'] ) ) $shortcode['content'] = '';
			// Add wrapping code
			if ( $shortcode['type'] === 'wrap' ) $example .= esc_textarea( $shortcode['content'] ) . '[/%prefix_' . $name . ']';
			// Change compatibility prefix
			$example = str_replace( array( '%prefix_', '__' ), mom_su_cmpt(), $example );
			// Shortcode
			$table[] = '<td>' . '<span class="mom-su-shortcode-icon">' . mom_su_Tools::icon( $icon ) . '</span>' . $shortcode['name'] . '<br/><em class="mom-su-shortcode-desc">' . $shortcode['desc'] . '</em></td>';
			// Attributes
			$table[] = '<td>' . implode( '', $attributes ) . '</td>';
			// Example code
			$table[] = '<td><code contenteditable="true">' . $example . '</code></td></tr>';
		}
		// Table end
		$table[] = '</table>';
		// Query assets
		mom_su_query_asset( 'css', array( 'font-awesome', 'mom-su-cheatsheet' ) );
		mom_su_query_asset( 'js', array( 'jquery', 'mom-su-options-page' ) );
		// Return output
		return '<div id="mom-su-cheatsheet-screen">' . $print . implode( '', $table ) . '</div>';
	}

	public static function addons( $field, $config ) {
		$output = array();
		$addons = array(
			array(
				'name' => __( 'New Shortcodes', 'theme' ),
				'desc' => __( 'Parallax sections, responsive content slider, pricing tables, vector icons, testimonials, progress bars and even more', 'theme' ),
				'url' => 'http://gndev.info/mom-shortcodes-ultimate/extra/',
				'image' => plugins_url( 'assets/images/banners/extra.png', mom_su_PLUGIN_FILE )
			),
			array(
				'name' => __( 'Maker', 'theme' ),
				'desc' => __( 'This add-on allows you to create custom shortcodes. You can easily create any shortcode with different parameters or even override default shortcodes', 'theme' ),
				'url' => 'http://gndev.info/mom-shortcodes-ultimate/maker/',
				'image' => plugins_url( 'assets/images/banners/maker.png', mom_su_PLUGIN_FILE )
			),
			array(
				'name' => __( 'Skins', 'theme' ),
				'desc' => __( 'Set of additional skins for Shortcodes Ultimate. It includes skins for accordeons/spoilers, tabs and some other shortcodes', 'theme' ),
				'url' => 'http://gndev.info/mom-shortcodes-ultimate/skins/',
				'image' => plugins_url( 'assets/images/banners/skins.png', mom_su_PLUGIN_FILE )
			),
			array(
				'name' => __( 'Add-ons bundle', 'theme' ),
				'desc' => __( 'Get all three add-ons with huge discount!', 'theme' ),
				'url' => 'http://gndev.info/mom-shortcodes-ultimate/add-ons-bundle/',
				'image' => plugins_url( 'assets/images/banners/bundle.png', mom_su_PLUGIN_FILE )
			),
		);
		$plugins = array();
		$output[] = '<h2>' . __( 'Shortcodes Ultimate Add-ons', 'theme' ) . '</h2>';
		$output[] = '<div class="mom-su-addons-loop mom-su-clearfix">';
		foreach ( $addons as $addon ) {
			$output[] = '<div class="mom-su-addons-item" style="visibility:hidden" data-url="' . $addon['url'] . '"><img src="' . $addon['image'] . '" alt="' . $addon['image'] . '" /><div class="mom-su-addons-item-content"><h4>' . $addon['name'] . '</h4><p>' . $addon['desc'] . '</p><div class="mom-su-addons-item-button"><a href="' . $addon['url'] . '" class="button button-primary" target="_blank">' . __( 'Learn more', 'theme' ) . '</a></div></div></div>';
		}
		$output[] = '</div>';
		if ( count( $plugins ) ) {
			$output[] = '<h2>' . __( 'Other WordPress Plugins', 'theme' ) . '</h2>';
			$output[] = '<div class="mom-su-addons-loop mom-su-clearfix">';
			foreach ( $plugins as $plugin ) {
				$output[] = '<div class="mom-su-addons-item" style="visibility:hidden" data-url="' . $plugin['url'] . '"><img src="' . $plugin['image'] . '" alt="' . $plugin['image'] . '" /><div class="mom-su-addons-item-content"><h4>' . $plugin['name'] . '</h4><p>' . $plugin['desc'] . '</p>' . mom_su_Shortcodes::button( array( 'url' => $plugin['url'], 'target' => 'blank', 'style' => 'flat', 'background' => '#FF7654', 'wide' => 'yes', 'radius' => '0' ), __( 'Learn more', 'theme' ) ) . '</div></div>';
			}
			$output[] = '</div>';
		}
		mom_su_query_asset( 'css', array( 'animate', 'mom-su-options-page' ) );
		mom_su_query_asset( 'js', array( 'jquery', 'mom-su-options-page' ) );
		return '<div id="mom-su-addons-screen">' . implode( '', $output ) . '</div>';
	}
}
