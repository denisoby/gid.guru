<?php
require_once get_template_directory() . '/framework/main.php';
if (file_exists(get_template_directory() . '/demo/demo.php')) {
            require_once get_template_directory() . '/demo/demo.php';
}
 add_filter( 'no_texturize_shortcodes', 'momt_shortcodes_to_exempt_from_wptexturize' );

// add more buttons to the html editor
function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
	QTags.addButton( 'eg_br', 'br', '<br>', '', 'none', 'Horizontal break line', 1 );
	QTags.addButton( 'eg_header_2', 'h2', '<h2>', '</h2>', 'none', 'Header 2 tag', 2 );
	QTags.addButton( 'eg_header_3', 'h3', '<h3>', '</h3>', 'none', 'Header 3 tag', 3 );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );

function momt_shortcodes_to_exempt_from_wptexturize($shortcodes){
    $shortcodes[] = 'tabs';
    $shortcodes[] = 'accordions';
    $shortcodes[] = 'images';
    $shortcodes[] = 'graphs';
    return $shortcodes;
}
require_once MOM_FW . '/Mobile_Detect.php';