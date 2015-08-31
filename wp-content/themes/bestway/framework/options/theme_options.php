<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */
if (!class_exists("ReduxFramework")) {
    return;
}

            $opt_name = 'mom_options';
            
            if(defined('ICL_LANGUAGE_CODE')) {
                $lang = explode('-',ICL_LANGUAGE_CODE);
                     $lang = $lang[0];
                    if ($lang != '') {
                        $opt_name = 'mom_options_'.$lang;
                    }
            }
                
if (!class_exists("Redux_Framework_goodnews_config")) {

    class Redux_Framework_goodnews_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';
        $mom_textdomain = 'framework';
            $img_path = MOM_URI .'/framework/options/momizat/images';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', $mom_textdomain), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo esc_html($this->theme->display('Name')); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', $mom_textdomain), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', $mom_textdomain), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', $mom_textdomain) . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', $mom_textdomain), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }


            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', $mom_textdomain),
                'fields' => array(

                        array (
                    'desc' => __('Select theme style full-width or fixed width', $mom_textdomain),
                    'id' => 'theme_style',
                    'type' => 'image_select',
                    'options' => array (
                        '' => $img_path .'/full.png',
                        'boxed' => $img_path .'/boxed.png',
                        'boxed2' => $img_path . '/boxed2.png',
                    ),
                    'title' => __('Theme Style', $mom_textdomain),
                    'default' => '',
                ),

                                    array (
                    'desc' => __('Select main layout', $mom_textdomain),
                    'id' => 'main_layout',
                    'type' => 'image_select',
                    'options' => array (
                        'right-sidebar' => $img_path .'/right_side.png',
                        'left-sidebar' => $img_path .'/left_side.png',
                        'full' => $img_path .'/full.png',
                    ),
                    'title' => __('Layout', $mom_textdomain),
                    'default' => 'right-sidebar',
                ),

            /*  array (
                    'id' => 'full_site_width',
                    'step' => '1',
                    'min' => '300',
                    'max' => '1136',
                    'suffix' => 'px',
                    'type' => 'slider',
                    'title' => __('Site width (for full width layout only)', $mom_textdomain),
                    'default' => '1136',
                                        //'required'  => array('main_layout', '=', 'full'),
                ),
                          */          
/*                          
                array (
                    'id' => 'content_in_full',
                    'type' => 'switch',
                    'title' => 'Content witdth in full width: ',
                                        'on'        => 'Wide',
                                        'off'       => 'small',
                    'default' => 1,

                                        
                ),
*/
                array (
                    'id' => 'date_format',
                    'desc' => __('Change date format click <a href="http://codex.wordpress.org/Formatting_Date_and_Time">here</a> to see hwo to change it', 'theme'),
                    'type' => 'text',
                    'title' => __('Date Format', 'theme'),
                    'default' => 'F d, Y',
                ),                                
                                
                array (
                    'id' => 'enable_responsive',
                    'desc' => __('Enable or disable responsive', 'theme'),
                    'type' => 'switch',
                    'title' => __('Enable Responsive', 'theme'),
                    'default' => true,
                ),
                
                        array (
                            'id' => 'mom_og_tags',
                            'type' => 'switch',
                            'title' => __('Facebook open graph tag', 'framework'),
                            'desc' => __('You need to disable this if use any SEO plugin for delete duplicated "og" tags', 'framework'),
                            'default' => 1,
                            'on'        => __('Enable', 'framework'),
                            'off'       => __('Disable', 'framework')
                        ), 

                array (
                    'desc' => __('upload your favicon', 'theme'),
                    'id' => 'custom_favicon',
                    'type' => 'media',
                    'title' => __('favicon', 'theme'),
                    'url' => true,
                ),

                array (
                    'id' => 'apple_touch_icon',
                    'type' => 'media',
                    'title' => __('Apple Touch icon', $mom_textdomain),
                    'subtitle' => __('This icon used for iOS system if user add your site to home page size must be 152x152', $mom_textdomain),
                    'url' => true,
                ),
                                
                array (
                    'desc' => __('it can be google analytics or any Script code, it will be add before closing of body tag', $mom_textdomain),
                    'id' => 'footer_script',
                    'type' => 'textarea',
                    'title' => __('Footer scripts', $mom_textdomain),
                ),
                )
            );

$this->sections[] = array(
        'icon' => 'el-icon-cog',
        'title' => __('Blog settings', $mom_textdomain),
        //'desc'  => __('change posts and widgets boxes style', $mom_textdomain),
        'subsection' => true,
        'fields' => array(
                array (
                    'id' => 'posts_layout',
                    'type' => 'radio',
                    'title' => __('Posts Layout', $mom_textdomain),
                    'default' => '',
                    'options' => array(
                                '' => __('Default', $mom_textdomain),
                                'grid' => __('Grid', $mom_textdomain),
                                'list' => __('List', $mom_textdomain),

                        )
                ),

                array (
                    'id' => 'grid_cols',
                    'type' => 'select',
                    'title' => __('Grid columns', $mom_textdomain),
                    'default' => '',
                    'options' => array(
                                '2' => __('Two columns', $mom_textdomain),
                                '3' => __('Three columns', $mom_textdomain),
                                '4' => __('Four columns', $mom_textdomain),
                       ),
                      'required'  => array('posts_layout', '=', 'grid'),

                ),

                array (
                    'id' => 'blog_style',
                    'type' => 'radio',
                    'title' => __('Posts & Widgets box', $mom_textdomain),
                    'default' => 'white',
                    'options' => array(
                                '' => __('Default style', $mom_textdomain),
                                'border' => __('Border boxes', $mom_textdomain),
                                'white' => __('White boxes', $mom_textdomain),

                        )
                ),
                array (
                    'id' => 'style_radius',
                    'type' => 'switch',
                    'title' => __('Posts box radius', $mom_textdomain),
                    'desc'  => __('Make boxes with round corners', $mom_textdomain),
                    'default' => false,
                ),


                array (
                    'id' => 'post_content_excerpt',
                    'type' => 'switch',
                    'title' => __('Show posts content as: ', $mom_textdomain),
                    'desc' => __('select how you want see your posts content in home page and archives the default is full post unless you use < ! --more-- > tag', $mom_textdomain),
                    'default' => 0,
                                        'on'        => 'Excerpt',
                                        'off'       => 'Full Post',
                                        
                ),
                array (
                    'id' => 'pagination_type',
                    'type' => 'select',
                    'title' => __('Pagination type', $mom_textdomain),
                    'options' => array (
                        'default' => __('Older and newer posts', $mom_textdomain),
                        'pagination' => __('Paged numbers', $mom_textdomain),
                        'ajax' => __('Ajax', $mom_textdomain),
                        'scroll' => __('Infinity Scroll', $mom_textdomain),
                    ),
                    'default' => 'default',
                    
                ),


            )
        );

$this->sections[] = array(
        'icon' => 'el-icon-cog',
        'title' => __('Social Networks', $mom_textdomain),
        'fields' => array(
                array (
                    'id' => 'twitter_url',
                    'type' => 'text',
                    'title' => __('Twitter', 'theme'),
                    'default' => '#',
                ),
                array (
                    'id' => 'facebook_url',
                    'type' => 'text',
                    'title' => __('Facebook', 'theme'),
                    'default' => '#',
                ),
                array (
                    'id' => 'gplus_url',
                    'type' => 'text',
                    'title' => __('Google+', 'theme'),
                    'default' => '#',
                ),
                array (
                    'id' => 'linkedin_url',
                    'type' => 'text',
                    'title' => __('Linkedin', 'theme'),
                    'default' => '#',
                ),
                array (
                    'id' => 'youtube_url',
                    'type' => 'text',
                    'title' => __('Youtube', 'theme'),
                ),
                array (
                    'id' => 'skype_url',
                    'type' => 'text',
                    'title' => __('Skype Name', 'theme'),
                ),
                array (
                    'id' => 'flickr_url',
                    'type' => 'text',
                    'title' => __('Flickr', 'theme'),
                ),
                array (
                    'id' => 'picasa_url',
                    'type' => 'text',
                    'title' => __('Picasa', 'theme'),
                ),
                array (
                    'id' => 'vimeo_url',
                    'type' => 'text',
                    'title' => __('vimeo', 'theme'),
                ),
                array (
                    'id' => 'tumblr_url',
                    'type' => 'text',
                    'title' => __('tumblr', 'theme'),
                ),
                array (
                    'id' => 'rss_on_off',
                    'type' => 'checkbox',
                    'title' => __('RSS', 'theme'),
                ),
                array (
                    'id' => 'rss_custom',
                    'type' => 'text',
                    'desc' => __('leave empty to use default rss link', 'theme'),
                    'title' => __('Custom RSS URL', 'theme'),
                ),
        )
    );

// Social Share 
        $this->sections[] = array(
        'icon' => 'el-icon-cog',
        'title' => __('Posts Share', $mom_textdomain),
        'fields' => array(
            array(
                'id'        => 'ss_facebook',
                'type'      => 'switch',
                'title'     => __('Facebook', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_twitter',
                'type'      => 'switch',
                'title'     => __('Twitter', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_google',
                'type'      => 'switch',
                'title'     => __('gplus', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_linkedin',
                'type'      => 'switch',
                'title'     => __('Linkedin', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_pinterest',
                'type'      => 'switch',
                'title'     => __('Pinterest', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_email',
                'type'      => 'switch',
                'title'     => __('Email', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_su',
                'type'      => 'switch',
                'title'     => __('Stumbleupon', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_reddit',
                'type'      => 'switch',
                'title'     => __('Reddit', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_evernote',
                'type'      => 'switch',
                'title'     => __('Evernote', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_delicious',
                'type'      => 'switch',
                'title'     => __('Delicious', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_tumblr',
                'type'      => 'switch',
                'title'     => __('Tumblr', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),
            
            array(
                'id'        => 'ss_ff',
                'type'      => 'switch',
                'title'     => __('Friendfeed', $mom_textdomain),
                'subtitle'  => __('show or hide', $mom_textdomain),
                'default'   => 1,
                'on'        => __('Enabled', 'theme'),
                'off'       => __('Disabled', 'theme'),
            ),

        )
    );

    $this->sections[] = array(
        'icon' => 'el-icon-cog',
        'title' => __('Header', $mom_textdomain),
        'fields' => array(

                array (
                    'desc' => __('Select Header Style', $mom_textdomain),
                    'id' => 'header_style',
                    'type' => 'image_select',
                    'options' => array (
                                                'header_top' =>  array ('img' => $img_path .'/header_top.png'),
                                                'header' =>  array ('img' => $img_path .'/header.png'),
                                                'header1' => array ('img' => $img_path .'/header1.png'),
                                                'header2' =>  array ('img' => $img_path .'/header2.png')
                                        ),
                    'title' => __('Header Style', $mom_textdomain),
                    'default' => 'header_top',
                                            'presets'  => false,

                ),
                                array(
                                    'id'       => 'Header_Padding',
                                    'type'     => 'spacing',
                                    'mode'     => 'padding',
                                    'top'      => true,
                                    'right'         => false,     // Disable the right
                                    'bottom'        => true,     // Disable the bottom
                                    'left'          => false,     // Disable the left
                                    'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                                    //'units_extended'=> 'true',    // Allow users to select any type of unit
                                    //'display_units' => 'false',   // Set to false to hide the units if the units are specified
                                    'title'    => __( 'Header Padding', $mom_textdomain),
                                    'subtitle' => __( 'Allow your users to choose the spacing or margin they want.', $mom_textdomain),
                                    'desc'     => __( 'Padding Top and Padding Bottom Logo', $mom_textdomain),
                                    'default'  => '',
                                ),
                array (
                    'id' => 'logo_img',
                    'desc' => __('upload custom logo', $mom_textdomain),
                    'type' => 'media',
                    'title' => __('The logo', $mom_textdomain),
                    'url' => true,
                ),
                array (
                    'id' => 'retina_logo_img',
                    'desc' => __('retina logo must be your logo in double size if original logo is 150*70 retina logo must be 300*140', $mom_textdomain),
                    'type' => 'media',
                    'title' => __('Retina Logo', $mom_textdomain),
                    'url' => true,
                ),

                     array (
                    'id' => 'sticky_navigation',
                    'type' => 'switch',
                    'title' => __('Sticky Navigation', $mom_textdomain),
                    'default' => 0,
                    ),                 
        
        )

    );
    $this->sections[] = array(
        'icon' => 'el-icon-credit-card',
        'title' => __('Top Navigation', $mom_textdomain),
        'subsection' => true,
        'fields' => array(
                array (
                    'id' => 'style_topbar',
                    'type' => 'select',
                    'options' => array (
                        '' => __('Dark', $mom_textdomain),
                        'topbar_light' => __('Light', $mom_textdomain),
                    ),
                    'title' => __('Color', $mom_textdomain),
                    'default' => '',
                ),
                array(
                    'id'        => 'top_search',
                    'type'      => 'switch',
                    'title'     => __('Search Button', $mom_textdomain),
                    'subtitle'  => __('show or hide', $mom_textdomain),
                    'default'   => 1,
                    'on'        => __('Enabled', 'theme'),
                    'off'       => __('Disabled', 'theme'),
                ),
                array (
                    'id' => 'tn_right_content',
                    'type' => 'select',
                    'options' => array (
                        'social' => __('Social Icons', $mom_textdomain),
                        'custom' => __('Custom Text', $mom_textdomain),
                    ),
                    'title' => __('Right Content', $mom_textdomain),
                    'default' => 'social',
                ),
                array (
                    'id' => 'tn_right_custom_text',
                    'type' => 'editor',
                    'title' => __('Custom Text', $mom_textdomain),
                                        'required'  => array('tn_right_content', '=', 'custom'),
                ),
                
                )
    );
    $this->sections[] = array(
        'icon' => 'el-icon-cog',
        'subsection' => true,
        'title' => __('Navigation', $mom_textdomain),
        'fields' => array(
                    array(
                        'id'        => 'nav_align',
                        'type'      => 'select',
                        'title'     => __('Alignment', $mom_textdomain),
                        'options'   => array(
                                             '' => __('Context', $mom_textdomain),
                                             'center' => __('Center', $mom_textdomain),
                                            ),
                        'default'   => '',
            'desc'  => __('Context mean left on LTR sites, Right on RTL sites', $mom_textdomain)
                    ),
            
        array(
            'id'        => 'nav_shearch_icon',
            'type'      => 'switch',
            'title'     => __('Search Icon', $mom_textdomain),
            'default'   => 1,
        ),
  
                    array(
                        'id'        => 'nav_dd_animation',
                        'type'      => 'select',
                        'title'     => __('Dropdown Animation ', $mom_textdomain),
                        'options'   => array(
                                             'fade' => __('Fade', $mom_textdomain),
                                             'slide' => __('Slide', $mom_textdomain),
                                             'skew' => __('Skew', $mom_textdomain),
                                            ),
                        'default'   => 'slide',
                    ),              
        )
    );


    $this->sections[] = array(
        'icon' => 'el-icon-cog',
        'title' => __('Feature Slider', $mom_textdomain),
        'fields' => array(
            array(
            'id'        => 'slider_show',
            'type'      => 'switch',
            'title'     => __('Show / Hide Feature Slider', $mom_textdomain),
            'default'   => 0,
            'on'        => __('Show', 'theme'),
            'off'       => __('Hide', 'theme'),
            'desc'  => __('Show / Hide Feature Slider in the Theme', $mom_textdomain)
            ),
            array (
            'id' => 'slider_type',
            'type' => 'image_select',
            'default' => 'grid',
            'options' => array (
                'grid' => $img_path .'/grid.png',
                'grid2' => $img_path .'/grid2.png',
                'grid3' => $img_path .'/grid3.png',
                'default' => $img_path .'/default.png',
                'mix' => $img_path .'/mix.png',
                'full' => $img_path .'/full-s.png',
            ),
            'title' => 'Feature Sliders Type',
            'default' => '',
            ),
            array(
            'id'        => 'feature_slider_boxed',
            'type'      => 'switch',
            'title'     => __('Next and Prev slide hint', $mom_textdomain),
            'default'   => 1,
            'on'        => 'on',
            'off'       => 'off',
            'desc'  => __('this option show next and previous slide in gray', $mom_textdomain)
            ),
                    array(
                        'id'        => 'slider_display',
                        'type'      => 'select',
                        'title'     => __('Slider Posts display ', $mom_textdomain),
                        'subtitle'  => __('Choose The Feature Slider Dispaly', $mom_textdomain),
                        'options'   => array(
                                             '' => __('Latest Posts', $mom_textdomain),
                                             'category' => __('Category', $mom_textdomain),
                                             'tag' => __('Tag', $mom_textdomain),
                                             'posts' => __('Specific Posts', $mom_textdomain),
                                            ),
                        'default'   => '',
                    ),
            array(
                        'id'        => 'slider_category',
                        'type'      => 'select',
                        'title'     => __('Category', $mom_textdomain),
                        'desc'  => __('Choos the Categorey', $mom_textdomain),
            'data' => 'categories',
                        'required'  => array('slider_display', '=', 'category'),
                    ),
            array(
                        'id'        => 'slider_tag',
                        'type'      => 'text',
                        'title'     => __('Tag ', $mom_textdomain),
                        'desc'  => __('Tag slug or id', $mom_textdomain),
                        'required'  => array('slider_display', '=', 'tag'),
                    ),

            array(
                        'id'        => 'slider_specific_posts',
                        'type'      => 'text',
                        'title'     => __('Specific Posts', $mom_textdomain),
                        'subtitle'  => __('insert posts id\'s ex. 511,122,300', $mom_textdomain),
                        'required'  => array('slider_display', '=', 'posts'),
                    ),

            array(
                        'id'        => 'slider_exclude_categories',
                        'type'      => 'text',
                        'title'     => __('Exclude Categories', $mom_textdomain),
                        'subtitle'  => __('insert Categories id\'s ex. 3,7,12', $mom_textdomain),
                    ),

/*
            array(
                        'id'        => 'slider_format',
                        'type'      => 'text',
                        'title'     => __('Post Format', $mom_textdomain),
                        'desc'  => __('Insert Post format ex audio, video, gallery, image, chat, aside, status, or,', $mom_textdomain),
                    ),
*/
            array(
                        'id'        => 'slider_orderby',
                        'type'      => 'select',
                        'title'     => __('Orderby', $mom_textdomain),
                        'desc'  => __('Choose from, recent, popular, random', $mom_textdomain),
                         'options'    => array(
                                'date' => __('Recent', $mom_textdomain),
                                'popular' => __('Popular', $mom_textdomain),
                                'random' => __('Random', $mom_textdomain),
                            ),
            'default' => 'date',
                    ),
            array(
                        'id'        => 'slider_sort',
                        'type'      => 'select',
                        'title'     => __('Sort', $mom_textdomain),
            'options'    => array(
                                'DESC' => __('DESC', $mom_textdomain),
                                'ASC' => __('ASC', $mom_textdomain),
                            ),
            'default' => 'DESC',
                    ),
            array(
                        'id'            => 'slider_count',
                        'type'          => 'slider',
                        'title'         => __('Number of posts', $mom_textdomain),
                        'default'       => 10,
                        'min'           => -1,
                        'desc'          => __('-1 for show all posts', $mom_textdomain),
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'input'
                    ),
            array(
                        'id'        => 'slider_post_type',
                        'type'      => 'select',
                        'title'     => __('Post Type', $mom_textdomain),
                        'desc'  => __('Choos the Post Type', $mom_textdomain),
            'data' => 'post_types',
                    ),
        )
    );

    $this->sections[] = array(
        'icon' => 'el-icon-credit-card',
        'title' => __('Footer', $mom_textdomain),
        'fields' => array(

        array(
            'id'        => 'footer_color',
            'title'     => __('Footer color', $mom_textdomain),
            'type' => 'image_select',
            'options' => array (
                    'light' => array('img' => $img_path.'/light.png'),
                    'dark' => array('img' => $img_path.'/dark.png'),
            ),
            'default' => 'light'

        ),

                                    array (
                    'desc' => 'Select Footer layout',
                    'id' => 'footer_layout',
                    'type' => 'image_select',
                    'options' => array (
                        'one' => $img_path .'/footer/1.png',
                        'one_half' => $img_path .'/footer/2.png',
                        'third' => $img_path .'/footer/3.png',
                        'fourth' => $img_path .'/footer/4.png',
                        'fifth' => $img_path .'/footer/5.png',
                        'sixth' => $img_path .'/footer/6.png',
                        'half_twop' => $img_path .'/footer/half_twop.png',
                        'twop_half' => $img_path .'/footer/twop_half.png',
                        'half_threep' => $img_path .'/footer/half_threep.png',
                        'threep_half' => $img_path .'/footer/threep_half.png',
                        'third_threep' => $img_path .'/footer/third_threep.png',
                        'threep_third' => $img_path .'/footer/threep_third.png',
                        'third_fourp' => $img_path .'/footer/third_fourp.png',
                        'fourp_third' => $img_path .'/footer/fourp_third.png',
                    ),
                    'title' => 'Layout',
                    'default' => 'fourth',
                ),
            
                array (
                    'id' => 'instagram_position',
                    'type' => 'switch',
                    'title' => __('Photo stram Position', 'theme'),
                    'default' => 1,
                    'on' => __('Below the footer', $mom_textdomain),
                    'off' => __('Above the footer', $mom_textdomain),

                ),


                array (
                    'id' => 'hide_footer_widgets',
                    'type' => 'switch',
                    'title' => __('Footer widgets', 'theme'),
                    'default' => 1

                ),

                array (
                    'id' => 'hide_footer_c',
                    'type' => 'switch',
                    'title' => __('copyrights Area', 'theme'),
                    'default' => 1

                ),
                array (
                    'desc' => __('footer copyrights text', 'theme'),
                    'id' => 'copyrights',
                    'type' => 'textarea',
                    'title' => __('copyrights', 'theme'),
                    'default' => __('', 'theme'),
                ),

        )
    );
    
    $this->sections[] = array(
        'icon' => 'el-icon-font',
        'title' => __('Typography', $mom_textdomain),
        'fields' => array(
                    array(
                        'id'        => 'main_font',
                        'type'      => 'typography',
                        'title'     => __('Main Font', $mom_textdomain),
                        'subtitle'  => __('Specify the main font it used in main menu, headings.', $mom_textdomain),
                        'google'    => true,
                        'font-style' => false,
                        'font-weight' => false,
                        'font-size' => false,
                        'subsets' => false,
                        'line-height' => false,
                        'text-align' => false,
                        'color' => false,
                        'preview' => array('text' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'theme')),
                        'output' => array('h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 .subTitle, h2 .subTitle, h3 .subTitle, h4 .subTitle, h5 .subTitle, h6 .subTitle,  ul.nav-menu li, .entry-content a.more-link, .button, #wp-calendar, .article_nav span, form.wpcf7-form .wpcf7-submit, .breadcrumb, .portfolio_list li .pt_overlay h3, .project_details ul li, .mom-socials-counter ul li .sc-count span, .featured-img a, .widget .widget_title, .sf, .widget .tagcloud a, .archive_page .tags a, .mom-socials-counter ul li .msc span.msc-count, .mom-socials-counter ul li .msc span.msc-count a, #footer .widget .widget_title, #footer .widget .wpcf7-form input:not(.wpcf7-submit), .widget .wpcf7-form textarea, #footer .widget input[type="submit"], .copyright p, .main_title, .comment-reply-title, .single_page .tag_cloud a, .comments_list li .comment_info .comment_author_name, .comments_list li .comment_info .comment-reply-link,.comments_list li .comment_info .comment-edit-link, .comment-form #submit-comment, .mom_quote, .mom_testimonial, .acch_numbers, .mom_list ul li, ul.nav-menu li a, .mom-select select, ul.products li .onsale, .main_tabs .tabs li, .posts_pagination span, .feature_slider .caption  .sp_details .sp_cate, .feature_slider .caption  .sp_details .sp_date, .feature_slider_full .caption .sp_details .sp_cate, .feature_slider_full .caption .sp_date, .format-link .entry-content p, .sf, .widget ul li a, .widget .tagcloud a, .archive_page .tags a, .mom-socials-counter ul li .msc span.msc-count, .mom-socials-counter ul li .msc span.msc-follow , .widget_instagram .momizat-instagram .widget_title, .widget_instagram .momizat-instagram .follow_title a, #footer .widget .widget_title, #footer .widget .wpcf7-form input:not(.wpcf7-submit), .widget .wpcf7-form textarea, #footer .widget input[type="submit"], .copyright p, .main_title, .comment-reply-title, .single_page .tag_cloud a, .comments_list li .comment_info .comment_author_name , .comments_list li .comment_info .comment-reply-link,.comments_list li .comment_info .comment-edit-link, .comment-form #submit-comment, .page_title, .posts-grid li.post-grid.format-quote_old .pg-container .pg-content .content_quote a p, .posts-grid li.post-grid .format-note .note p, .mom_testimonial, .feature_slider_grid .caption .sp_cate, .feature_slider_grid .caption .sp_date, .header_page .page_title.cpt, .header_page .br_title, .grid_cat_link, .protfolio_filter, .feature_slider_grid .caption .sp_cate a, .mom_share_buttons .mom_share_bt, .mom_share_it .sh_arrow span span, .article_nav, .article_related_posts .related_posts li, .page-links-title, .page-links span:not(.page-links-title), .page-links a')

                    ),                    

                    array(
                        'id'        => 'body_typo',
                        'type'      => 'typography',
                        'title'     => __('Body Typography', $mom_textdomain),
                        'google'    => true,
                        'subsets' => false,
                        'text-align' => false,
                        'preview' => array('text' =>  __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'theme')),
                        'output' => array('body'),
                        'default' => array (
                            'font-family' => ''
                        )

                    ),
                    array(
                        'id'        => 'navi_typo',
                        'type'      => 'typography',
                        'title'     => __('Navigation Typography', $mom_textdomain),
                        'google'    => true,
                        'subsets' => false,
                        'text-align' => false,
                        'line-height' => false,
                        'preview' => array('text' =>  __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'theme')),
                        'output' => array('ul.nav-menu li, ul.nav-menu li a'),
                        'default' => array (
                            'font-family' => ''
                        )

                    ),                    
                )
    );
        
    
    $this->sections[] = array(
        'icon' => 'el-icon-brush',
        'title' => __('Colors', $mom_textdomain),
        'fields' => array(
                                            array (
                            'id' => 'main_skin',
                            'type' => 'image_select',
                            'options' => array (
                                    '' => array('img' => $img_path.'/light.png'),
                                    'dark' => array('img' => $img_path.'/dark.png'),
                            ),
                            'title' => __('Skin', 'framework'),
                            'default' => 'light'
                        ),
                    
                    array(
                        'id'        => 'main_color',
                        'type'      => 'color',
                        'title'     => __('Main Color', $mom_textdomain),
                        'sub-title'     => __('the purple color', $mom_textdomain),
                        'transparent' => false,
                        'output' => array (
                            'color' => 'a:hover, .mom-select:hover:before, .entry-meta span a:hover, ul.nav-menu li a:hover, .post_format, .pagination span.current, .pagination a:hover, a.more-link, #navigation ul.nav-menu li > a:hover ,#navigation ul.nav-menu li.current-menu-item:not(.no-current) > a,#navigation ul.nav-menu li.current-menu-item:not(.no-current) > a , #navigation ul.nav-menu li.current-menu-ancestor:not(.no-current) > a,  #navigation ul.nav-menu li.current-menu-parent:not(.no-current) > a, #navigation ul.nav-menu > li > ul > li.current-menu-item:not(.no-current) > a, #navigation ul.main-menu li a:hover, .responsive-menu-wrap .expand-menu i, .responsive-menu li:not(.active) a:hover, .responsive-search, .header1 #navigation ul.nav-menu > li a:hover, .header1 #navigation ul.nav-menu > li.current-menu-item:not(.no-current) a, .header1 #navigation ul.nav-menu > li.current_page_item a, .header1 #navigation ul.nav-menu li ul.sub-menu li a:hover, .topbar ul.main-menu > li:not(.mom_mega) ul.sub-menu li a:hover, .topbar #navigation .main-menu li.mom_mega .mega_col_title > a:hover, .topbar.topbar_light ul.main-menu > li:not(.mom_mega) ul.sub-menu li a:hover, .topbar.topbar_light #navigation .main-menu li.mom_mega .mega_col_title > a:hover, .feature_slider .caption  .sp_details .sp_cate a:hover, .feature_slider .caption  .sp_details .sp_title a:hover, .search-overlay .so-close i:hover, .posts_pagination span a:hover, .search_box .subb:hover, .widget ul li a:hover, .sidebar .widget ul li a:hover+.cat_num span, .popular_posts li .pop_content h4 a:hover, .mom-recent-comments .author_comment .rc-post a:hover, .widget .tweet_list li a, .widget .tweet_list li p a, .widget .recent_comments li .comment_content p span a:hover, .widget .recent_comments li .comment_content p a, #footer .widget .tweet_list li a:hover, #footer .popular_posts li .pop_content h4 a:hover, #footer .widget ul.two_cols_list li a:hover, .widget_instagram .momizat-instagram .follow_title a, .mom-socials-counter ul li .msc span:hover a, #footer .widget ul.two_cols_list li:hover, #footer .mom-recent-comments .author_comment .rc-post a:hover, #footer .widget .tagcloud a:hover, #footer .popular_widget .popular_posts_title a:hover,#footer .popular_widget .popular_meta span a:hover, .copyright p a:hover, .mom_share_it .sh_arrow:hover, .mom_share_it .sh_arrow:hover, .mom_share_it .sh_arrow:hover i, .article_nav span a:hover, .author_box .author_head .author a:hover, .author_box ul li.home a:hover, .article_related_posts .related_posts li:hover, .article_related_posts .related_posts li:hover a, .comments_list li .children li .comment_info .comment_author_name, .comments_list li .comment_info .comment-reply-link:hover,.comments_list li .comment_info .comment-edit-link:hover, .portfolio_list li .pt_ov_icons a:hover, .project_details .pt_info .info-data a:hover,.project_details .pt_info .info-data:hover, .pt_related_pro .related_arrows a:hover ,.project_details .details_arrow a:hover, .archive_page ul li:hover, .archive_page ul li a:hover, .mom_archive_page .tags a:hover, .main_tabs .tabs a.current, .toggle_active .toggle_icon:before, .widget_instagram .momizat-instagram .follow_title a, .feature_slider_grid .caption .sp_title a:hover, .feature_slider .caption .sp_details span.sp_cate a, .mom_icon, .icon-text i, ul.products li .mom_product_details .price, .woocommerce .widget_price_filter .price_slider_amount span,.woocommerce-page .widget_price_filter .price_slider_amount span, .widget ul li .amount, .total .amount, .main_tabs .tabs li.active > a, .shop-style-switcher a.active, .summary.entry-summary .price, .popular_widget .popular_meta span a:hover, .textwidget a, .about-me-widget a, .main_tabs .tabs a.current, .toggle_active:before, .grid_cat_link a, .posts-grid li.post-grid .pg-container .pg-meta .meta a:hover, span.grid_share:hover, span.grid_share.active, .protfolio_filter ul li.current a, .widget .widget_title a, .widget_rss ul li cite, .page-links a:hover, .sticky .post_content:before',
                           'background-color' => 'ul.nav-menu > li > a > .menu_bl, ol.flex-control-nav li a.flex-active, .format-quote_old .post_content, .format-aside .aside_frame, .format-status .status_frame, .pagination span.current, .pagination a:hover, .widget .tagcloud a:hover, .archive_page .tags a:hover, .single_page .tag_cloud a:hover, .comment-form #submit-comment, form.wpcf7-form .wpcf7-submit, .posts-grid li.post-grid.format-quote_old .pg-container .pg-content, .button, #commentform #submit-comment, input[type="submit"], #bbpress-forums #bbp-single-user-details + ul li a, a.orange2_bt, a.blue2_bt, .mom_iconbox_square, .mom_iconbox_circle, .toggle_active:before, .parograss_inner, .pagination span.current, .topbar .search_box_top .search_icon, .topbar .search_box_top .sf, .responsive-menu > li.active > a, .button, #commentform #submit-comment, input[type="submit"], #bbpress-forums #bbp-single-user-details + ul li a, ul.products li .onsale, ul.products li .mom_product_thumbnail .mom_woo_cart_bt .button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .format-gallery ol.flex-control-nav li a.flex-active, .mom_share_buttons .mom_share_bt:hover, .page-links > span:not(.page-links-title)',
                           'border-color' => '.protfolio_filter ul li:hover, .protfolio_filter ul li.current, .pt_related_pro .related_arrows a:hover ,.project_details .details_arrow a:hover, .mom_quote, .mom_quote .quote-arrow, .iconb_wrap .border_increase_effect, .toggle_active:before, .iconb_wrap .border_decrease_effect, .mom_quote, .mom_quote .quote-arrow, .protfolio_filter ul li.current a. .sticky .post_content',
                           'fill' => '.post_format path'
                        )
                    ),
                   /*
                    array(
                        'id'        => 'main_border',
                        'type'      => 'color',
                        'title'     => __('Main border Color', $mom_textdomain),
                        'transparent' => false,
                        'mode' => 'border-color',
                        'output' => array('#navigation, .sidebar .widget, .sidebar .widget ul li,.post .post_title, .meta_format, .page_title.cpt, .page_head, .page_style, .post_style, .single_page .single_content, .mom_share_it, .author_box, .article_related_posts, .comments_list li .comment_info, .posts-grid li.post-grid:not(.format-quote) .pg-container, .posts-grid li.post-grid .pg-container .pg-meta, .format-note .note_wrap::before, .format-note .note_wrap, .popular_widget'),
                    ),
                    */
                       array(
                        'id'    => 'body-color-info',
                        'type'  => 'info',
                        'style' => 'success',
                        'notice'    => true,
                        'icon'  => 'el-icon-brush',
                        'title' => __('Body Colors.', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'body_background',
                        'type'      => 'background',
                        'output'    => array('body', 'body.style_white_box', 'body.layout-boxed'),
                        'title'     => __('Body Background', $mom_textdomain),
                    ),

                    
                       array(
                        'id'    => 'header-color-info',
                        'type'  => 'info',
                        'style' => 'success',
                        'notice'    => true,
                        'icon'  => 'el-icon-brush',
                        'title' => __('Header', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'header_background',
                        'type'      => 'background',
                        'output'    => array('.header, .header1, .header2'),
                        'title'     => __('Header Background', $mom_textdomain),
                        'mode'      => 'background-color',
                    ),
                    array(
                        'id'    => 'nav-color-info',
                        'type'  => 'info',
                        'style' => 'success',
                        'notice'    => true,
                        'icon'  => 'el-icon-brush',
                        'title' => __('Navigation', $mom_textdomain),
                    ),
                     array(
                        'id'        => 'nav_background_color',
                        'type'      => 'color',
                        'output'    => array('#navigation, .header1 #navigation, .header2 #navigation .inner, .topbar'),
                        'title'     => __('Navigation Background', $mom_textdomain),
                        'mode'      => 'background-color',

                    ),
                     array(
                        'id'        => 'nav_border_color',
                        'type'      => 'color',
                        'output'    => array('#navigation, .header1 #navigation, .header2 #navigation .inner'),
                        'title'     => __('Navigation Borders', $mom_textdomain),
                        'mode'      => 'border-color',
                    ),
                     array(
                        'id'        => 'nav_links_color',
                        'type'      => 'color',
                        'output'    => array('ul.nav-menu li a, .topbar ul.nav-menu > li > a'),
                        'title'     => __('Navigation Links color', $mom_textdomain),
                        'mode'      => 'color',
                    ),
                    array(
                        'id'        => 'dropdown_menu',
                        'type'      => 'color',
                        'output'    => array(
                                'border-bottom-color' => 'ul.nav-menu > li.menu-item-has-children:hover:hover > a:after',
                                'background-color' => 'ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu, #navigation .main-menu li.mom_mega.menu-item-depth-0 > .mom_mega_wrap, .topbar #navigation .main-menu li.mom_mega.menu-item-depth-0 > .mom_mega_wrap, .topbar ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu',
                            ),
                        'title'     => __('Navigation Dropdown Background', $mom_textdomain),
                    ),
                   /*
                   array(
                        'id'        => 'sub_menu_arrow',
                        'type'      => 'color',
                        'output'    => array('color' => '', 'border-bottom-color' => 'ul.nav-menu li > ul:after' ),
                        'title'     => __('Navigation Dropdown Arrow Color', $mom_textdomain),
                    ),
                    */
                    array(
                        'id'        => 'sub_menu_brd',
                        'type'      => 'color',
                        'output'    => array(
                                'border-bottom-color' => 'ul.nav-menu > li.menu-item-has-children:hover:hover > a:before',
                                'border-color' => 'ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu, #navigation .main-menu li.mom_mega.menu-item-depth-0 > .mom_mega_wrap, ul.main-menu > li:not(.mom_mega) ul.sub-menu li a, #navigation ul.main-menu li.mom_mega .mom_mega_wrap ul li a, #navigation .main-menu li.mom_mega .mega_col_title > a, .topbar ul.main-menu > li:not(.mom_mega) ul.sub-menu li a, .topbar #navigation ul.main-menu li.mom_mega .mom_mega_wrap ul li a, .topbar #navigation .main-menu li.mom_mega .mega_col_title > a',
                            ),
                        'title'     => __('Navigation Dropdown Borders', $mom_textdomain),
                    ),
                     array(
                        'id'        => 'nav_dropdown_links_color',
                        'type'      => 'color',
                        'output'    => array('ul.main-menu > li:not(.mom_mega) ul.sub-menu li a, #navigation .main-menu li.mom_mega .mega_col_title > a, .topbar ul.main-menu > li:not(.mom_mega) ul.sub-menu li a, .topbar #navigation .main-menu li.mom_mega .mega_col_title > a, #navigation ul.main-menu li.mom_mega .mom_mega_wrap ul li a'),
                        'title'     => __('Dropdown Links color', $mom_textdomain),
                        'mode'      => 'color',
                    ),
                    array(
                        'id'        => 'res_nav_bg',
                        'type'      => 'color',
                        'title'     => __('responsive Menu background color', $mom_textdomain),
                        'output'    => '.responsive-menu',
                        'mode'      => 'background'
                    ),

                    array(
                        'id'        => 'res_nav_txt',
                        'type'      => 'color',
                        'title'     => __('responsive Menu text color', $mom_textdomain),
                        'output'    => '.responsive-menu li a',
                        'mode'      => 'color'
                    ),
                   

                    array(
                        'id'        => 'res_nav_bds',
                        'type'      => 'color',
                        'title'     => __('responsive Menu borders', $mom_textdomain),
                        'output'    => '.responsive_menu, .responsive-menu li a',
                        'mode'      => 'border-color'
                    ),

                       array(
                        'id'    => 'main-box-color-info',
                        'type'  => 'info',
                        'style' => 'success',
                        'notice'    => true,
                        'icon'  => 'el-icon-brush',
                        'title' => __('Main Box Colors.', $mom_textdomain),
                        'desc' => __('Posts and widget boxes colors.', $mom_textdomain),
                    ),
                    array(
                        'id'        => 'main_box_background',
                        'type'      => 'background',
                        'output'    => array('.style_border_box .sidebar .widget, .style_border_box .header_page, .style_border_box .single_page, .style_border_box .post_style, .style_border_box .page_style'),
                        'title'     => __('Background', $mom_textdomain),
                        'desc'     => __('Works only for white boxes & border boxes style', $mom_textdomain),
                    ), 
                                        array(
                        'id'        => 'main_box_border',
                        'type'      => 'color',
                        'transparent' => false,
                        'output'    => array('.style_border_box .sidebar .widget, .style_border_box .header_page, .style_border_box .single_page, .style_border_box .post_style, .style_border_box .page_style, .meta_format, .post_title, a.more-link, .widget .widget_title, .post_content, #widget_area_wrap, .widget ul li, .popular_widget'),
                        'title'     => __('Borders colors', $mom_textdomain),
                        'mode' => 'border-color'
                    ),                       
                    array(
                        'id'        => 'main_box_headings',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'output'    => array('.post_title, .post_title a, .main_title, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, .comment-reply-title'),
                        'title'     => __('Box Headings Colors', $mom_textdomain),
                        'transparent' => false
                    ),                       
                    array(
                        'id'        => 'widget_headings',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'output'    => array('.sidebar .widget .widget_title'),
                        'title'     => __('Widget Headings Colors', $mom_textdomain),
                        'transparent' => false
                    ),                  
                                       
                )

    );
         
         if (function_exists('tl_portfolio_register_portfolio_post_type')) {     
    $this->sections[] = array(
        'icon' => 'el-icon-picture',
        'title' => __('Portfolio', $mom_textdomain),
        'fields' => array(
                                    array (
                    'desc' => __('Filter, pagination or both', $mom_textdomain),
                    'id' => 'portfolio_nav',
                    'type' => 'select',
                    'options' => array (
                        'filter' => 'Filter',
                        'pagination' => 'Pagination',
                                                'both' => 'Both'
                    ),
                    'title' => __('Navigation', $mom_textdomain),
                    'default' => 'both',
                ),                                                                     
                                    array (
                    'desc' => __('work only if you select navigation as pagination or both, if you select filter it will display all items', $mom_textdomain),
                    'id' => 'portfolio_count',
                    'step' => '1',
                    'min' => '1',
                    'max' => '50',
                    'type' => 'slider',
                    'title' => __('Number of items per page ', $mom_textdomain),
                    'default' => '9',
                ),                                                                     
                                    array (
                    'desc' => __('Portfolio columns', $mom_textdomain),
                    'id' => 'portfolio_cols',
                    'type' => 'select',
                    'options' => array (
                        '2' => 'Two Columns',
                        '3' => 'Three Columns',
                                                '4' => 'Four Columns'
                    ),
                    'title' => __('Columns', $mom_textdomain),
                    'default' => 'three',
                ), 
                )

    );
}
    
if (class_exists('woocommerce')) {
    $this->sections[] = array(
        'icon' => 'fa-shopping-cart',
        'title' => __('Woocommerce settings', $mom_textdomain),
        'fields' => array(
                array (
                    'id' => 'woo_products_per_page',
                    'desc' => __('-1 for all products', $mom_textdomain),
                    'step' => '1',
                    'min' => '-1',
                    'max' => '50',
                    'suffix' => 'px',
                    'type' => 'slider',
                    'title' => __('Number of products per page', $mom_textdomain),
                    'default' => '9',
                ),
        )
    );
}
    
    
            $this->sections[] = array(
        'icon' => 'momizat-icon-cog',
        'title' => __('Custom CSS', $mom_textdomain),
            'fields' => array(
                    array(
                        'id'        => 'custom_css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS', $mom_textdomain),
                        'subtitle'  => __('insert custom css.', 'redux-framework-demo'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),
        )
    );
              
    $this->sections[] = array(
        'icon' => 'el-icon-key',
        'title' => __('API\'s Authentication', $mom_textdomain),
                        'desc' => __('this section for connect with Different APIs such as twitter, mailchimp, instagram, etc ... some of theme function depend on this APIs so make sure you insert the Authentication information below.', $mom_textdomain),
        'fields' => array(
                    array(
                        'id' => 'auth_twi_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Twitter (required for using twitter widgets and social counters widget)', $mom_textdomain),
                        'desc' => __('you can get twitter Authentication data by following this <a href="http://www.youtube.com/watch?v=zdSHhiHAxBA"  target="_blank">tutorial</a>', $mom_textdomain),
                    ),
                    
                array (
                    'id' => 'twitter_ck',
                    'type' => 'text',
                    'title' => __('Consumer key', $mom_textdomain),
                ),
                array (
                    'id' => 'twitter_cs',
                    'type' => 'text',
                    'title' => __('Consumer secret', $mom_textdomain),
                ),
                array (
                    'id' => 'twitter_at',
                    'type' => 'text',
                    'title' => __('Access token', $mom_textdomain),
                ),
                array (
                    'id' => 'twitter_ats',
                    'type' => 'text',
                    'title' => __('Access token secret', $mom_textdomain),
                ),
                    //
                    //array(
                    //    'id' => 'auth_mc_info',
                    //    'type' => 'info',
                    //    'style' => 'warning',
                    //    'title' => __('Mailchimp (required for using newsletter widget)', $mom_textdomain),
                    //    'desc' => __('to find your API key <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">click here</a>', $mom_textdomain),
                    //),
                    //
                    //array (
                    //        'id' => 'mailchimp_api_key',
                    //        'type' => 'text',
                    //        'title' => __('Mailchimp API Key', $mom_textdomain),
                    //),
                    
                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Google+ (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('to get Google+ API key <a href="http://www.youtube.com/watch?v=-wPKcfEadAc" target="_blank">Follow this</a>', $mom_textdomain),
                    ),

                    array (
                            'id' => 'googlep_api_key',
                            'type' => 'text',
                            'title' => __('Google+ API Key', $mom_textdomain),
                    ),

                        array(
                            'id' => 'notice_critical34f5',
                            'type' => 'info',
                            'notice' => true,
                        'style' => 'warning',
                            'icon' => 'momizat-icon-youtube',
                            'title' => __('Youtube (required for Social counter widget)', 'framework'),
                            'desc' => __('to get Youtube API key <a href="https://www.youtube.com/watch?v=Im69kzhpR3I" target="_blank">Follow this</a>', 'framework')
                        ),
                        array (
                                'id' => 'youtube_api_key',
                                'type' => 'text',
                                'title' => __('Youtube API Key', 'framework'),
                        ),

                        array(
                            'id' => 'notice_critical34158f5',
                            'type' => 'info',
                            'notice' => true,
                        'style' => 'warning',
                            'icon' => 'momizat-icon-facebook',
                            'title' => __('Facebook (required for Social counter widget)', 'framework'),
                            'desc' => __('to get Facebook access token <a href="https://smashballoon.com/custom-facebook-feed/access-token/" target="_blank">Follow this</a>', 'framework')
                        ),
                        array (
                                'id' => 'facebook_access_token',
                                'type' => 'text',
                                'title' => __('Facebook Access Token', 'framework'),
                        ),


                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Sound Cloud (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('in documentation', $mom_textdomain),
                    ),

                    array (
                            'id' => 'soundcloud_client_id',
                            'type' => 'text',
                            'title' => __('Sound Cloud Client ID', $mom_textdomain),
                    ),
                    
                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Behace (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('in documentation', $mom_textdomain),
                    ),

                    array (
                            'id' => 'behance_api_key',
                            'type' => 'text',
                            'title' => __('Behance API key', $mom_textdomain),
                    ),                    

                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Instagram (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('<a href="http://www.pinceladasdaweb.com.br/instagram/access-token" target="_blank">Click Here</a> To get the Access Token', $mom_textdomain),
                    ),

                    array (
                            'id' => 'instagram_access_token',
                            'type' => 'text',
                            'title' => __('Instagram Access Token', $mom_textdomain),
                    ),                    
                                        

        )

    );


            $this->sections[] = array(
                    'icon' => 'el-icon-website',
                    'title' => __('Demo Import', $mom_textdomain),
                    'desc' => __('if you need a quick start or a new to wordpress this section will help your get our demo with one click', $mom_textdomain),
                    'class' => 'demo-import-section',
                    'fields' => array(
                            array(
                                'id'        => 'goodnews_demo_import',
                                'type'      => 'callback',
                                'title'     => __('Import Demo Content', 'redux-framework-demo'),
                                'callback'  => 'mom_theme_import_demo'
                            ),
    
                    )
            );



        }

        public function setHelpTabs() {

        $mom_textdomain = 'framework';
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', $mom_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $mom_textdomain)
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', $mom_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $mom_textdomain)
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', $mom_textdomain);
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {
                global $opt_name;

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
        $mom_textdomain = 'framework';
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => $opt_name, // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Options', $mom_textdomain),
                'page' => __('Options', $mom_textdomain),
                'google_api_key' => 'AIzaSyAPXYUZF718qjEDQZJ8I1xJuc1WOLVTBHA', // Must be defined to add google fonts to the typography module
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => false, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'momizat_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );



            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
            } else {
            }

            // Add content after the form.
        }

    }

    new Redux_Framework_goodnews_config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**

  Custom function for the callback validation referenced above

 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;

function momizatCustomScripts() {
    wp_register_style(
        'momizat-options-css',
        MOM_URI . '/framework/options/momizat/momizat.css',
        '', // Be sure to include redux-css so it's appended after the core css is applied
        time(),
        'all'
    );  
    wp_enqueue_style('momizat-options-css');

    wp_register_script(
        'momizat-options-js',
        MOM_URI . '/framework/options/momizat/momizat.js',
        array( 'jquery' ), // Be sure to include redux-css so it's appended after the core css is applied
        time(),
        'all'
    );  
    wp_enqueue_script('momizat-options-js');
}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'redux/page/mom_options/enqueue', 'momizatCustomScripts' );

if (!defined('FS_CHMOD_DIR')) {
   define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
}
if (!defined('FS_CHMOD_FILE')) {
    define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );    
}



if (!function_exists('mom_theme_import_demo')):
    function mom_theme_import_demo() { ?>
    
    <div class="mom_demo_import_wrap">
        <div class="mom_demo_import_item">
            <a href="#" class="run-demo-content demo-item-image"><span class="demo_loading loading"></span><div class="bt"><span><?php _e('Click to import', 'theme'); ?></span></div><span class="import_warning"><?php _e('Do not close this page!','theme'); ?></span><img src="<?php echo MOM_URI; ?>/framework/options/momizat/images/demo/default.png"></a>
            <div class="mom_demo_import_item_details">
                <p><strong><?php _e('what you get:', 'theme'); ?></strong> <a href="http://themes.themelions.com/bestway/" target="_blank"><?php _e('Online Demo'); ?></a></p>

                <h4><?php _e('Recommended Plugins:', 'theme'); ?> </h4>
                <ul>
                    <li><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">Woocommerce</a> - <?php _e('for online shop function', 'theme'); ?> </li>
                </ul>
            </div>
        </div>

        <div class="mom_demo_import_item">
            <a href="#" class="run-demo-content demo-item-image" data-dir="rtl"><span class="demo_loading loading"></span><div class="bt"><span><?php _e('Click to import', 'theme'); ?></span></div><span class="import_warning"><?php _e('Do not close this page!','theme'); ?></span><img src="<?php echo MOM_URI; ?>/framework/options/momizat/images/demo/rtl.png"></a>
            <div class="mom_demo_import_item_details">
                <p><strong><?php _e('what you get:', 'theme'); ?></strong> <a href="http://themes.themelions.com/bestway/rtl/" target="_blank"><?php _e('RTL Demo'); ?></a></p>

                <h4><?php _e('Recommended Plugins:', 'theme'); ?> </h4>
                <ul>
                    <li><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">Woocommerce</a> - <?php _e('for online shop function', 'theme'); ?> </li>
                </ul>
            </div>
        </div>
    </div>

    <?php }
endif;