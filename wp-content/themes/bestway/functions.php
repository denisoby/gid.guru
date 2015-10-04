<?php
require_once get_template_directory() . '/framework/main.php';
if (file_exists(get_template_directory() . '/demo/demo.php')) {
            require_once get_template_directory() . '/demo/demo.php';
}
 add_filter( 'no_texturize_shortcodes', 'momt_shortcodes_to_exempt_from_wptexturize' );

if ( current_user_can('contributor') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}

// remove deafault quicktags
function remove_quicktags( $qtInit ) {
    $qtInit['buttons'] = 'link';
    return $qtInit;
}
add_filter('quicktags_settings', 'remove_quicktags');

// add more buttons to the html editor
function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
	QTags.addButton( 'eg_header_2', 'h2', '<h2>', '</h2>', 'none', 'Header 2 tag', 1 );
	QTags.addButton( 'eg_header_3', 'h3', '<h3>', '</h3>', 'none', 'Header 3 tag', 2 );
	QTags.addButton( 'eg_strong', 'Жирный', '<strong>', '</strong>', 'none', 'Strong tag', 3 );
	QTags.addButton( 'eg_em', 'Курсив', '<em>', '</em>', 'none', 'EM tag', 4 );
	QTags.addButton( 'eg_ul', 'Список НЕнумерованный','<ul>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n</ul>\n', '', 'none', 'UL tag', 5 );
	QTags.addButton( 'eg_ol', 'Список нумерованный','<ol>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n<li><p>Text</p></li>\n</ol>\n', '', 'none', 'OL tag', 6 );
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

	remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'rel_canonical');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

require_once MOM_FW . '/Mobile_Detect.php';