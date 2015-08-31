<?php
/*=========================================================
*		Shortcodes
========================================================= */
add_filter( 'mom_su/data/shortcodes', 'mom_register_my_custom_shortcode' );
function mom_register_my_custom_shortcode( $shortcodes ) {
	$imgs = MOM_URI . '/framework/shortcodes/images/';
	$ptcats = get_terms("portfolio_category");
    $img_path = MOM_URI .'/framework/options/momizat/images';


	$sidebars = array();
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		$sidebars[$sidebar['id']] = $sidebar['name'];
	}
	$formats = get_theme_support( 'post-formats' );
	$f = array();
	foreach ($formats[0] as $format) {
		$f[$format] = $format;
	}
	$get_ads = get_posts('post_type=ads&posts_per_page=-1');
	$ads = array();
	foreach ($get_ads as $ad) {
		$ads[$ad->ID] = $ad->post_title;
	}

	$get_fonts = mom_google_fonts();
	$fonts = array();
	foreach ($get_fonts as $key => $value) {
		$fonts[$key] = $value;
	}

				// Blog
					$shortcodes['feature_slider'] = array(
					'name' => __( 'Feature Slider', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'type' => array(
							'type' => 'radio_img',
							'values' => array(
								    'grid' => array($img_path .'/grid.png'),
								    'grid2' => array($img_path .'/grid2.png'),
								    'grid3' => array($img_path .'/grid3.png'),
								    'default' => array($img_path .'/default.png'),
								    'mix' => array($img_path .'/mix.png'),
								    'full' => array($img_path .'/full-s.png'),
							),
							'default' => 'grid',
							'name' => __( 'Feature Sliders Type', 'theme' ),
						),						
						'slides_hint' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Next and Prev slide hint', 'theme' ),
							'desc' => __( 'this option show next and previous slide in gray', 'theme' )
						),

						'display' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Latest Posts', 'theme' ),
								'category' => __( 'Category', 'theme' ),
								'tag' => __( 'Tag', 'theme' ),
								'posts' => __( 'Specific Posts', 'theme' )
							),
							'default' => '',
							'name' => __( 'Display', 'theme' ),
							'desc' => __( 'get post from anywhere', 'theme' )
						),

						'category' => array(
							'type' => 'select',
							'values' => array('' => 'select category...') + mom_su_Tools::get_terms( 'category' ),
							'default' => '',
							'name' => __( 'Ceategory', 'theme' ),
							'required'  => array('display', 'category'),
						),

						'tag' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'name' => __( 'Tag', 'theme' ),
							'desc' => __( 'Tag slug or id', 'theme' ),
							'required'  => array('display', 'tag'),
						),


						'specific_posts' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'name' => __( 'Specific Posts', 'theme' ),
							'desc' => __( 'insert posts id\'s ex. 511,122,300', 'theme' ),
							'required'  => array('display', 'posts'),
						),

						'exclude_categories' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'desc' => __( 'insert Categories id\'s ex. 3,7,12', 'theme' ),
							'name' => __( 'Exclude Categories', 'theme' ),
						),


						'count' => array(
							'type' => 'text',
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 10,
							'name' => __( 'Number Of posts', 'theme' ),
						),


						'orderby' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Recent', 'theme' ),
								'popular' => __( 'Popular', 'theme' ),
								'random' => __( 'Random', 'theme' )
							),
							'default' => '',
							'name' => __( 'Order by', 'theme' ),
							'desc' => __( 'recent, popular, random', 'theme' )
						),

						'sort' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'DESC', 'theme' ),
								'ASC' => __( 'ASC', 'theme' )
							),
							'default' => '',
							'name' => __( 'Sort by', 'theme' ),
							'desc' => __( 'DESC, ASC', 'theme' )
						),

						'post_type' => array(
							'type' => 'text',
							'name' => __( 'Post Type', 'theme' ),
						),

					
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)

					),
					'desc' => __( 'Feature Slider', 'theme' ),
					'icon' => 'desktop'
				);

				// Blog
					$shortcodes['posts_grid'] = array(
					'name' => __( 'Posts Grid', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'columns' => array(
							'type' => 'select',
							'values' => array(
								'2' => __( 'Two columns', 'theme' ),
								'3' => __( 'Three columns', 'theme' ),
								'4' => __( 'Four columns', 'theme' )
							),
							'default' => '4',
							'name' => __( 'Columns', 'theme' ),
						),

						'display' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Latest Posts', 'theme' ),
								'category' => __( 'Category', 'theme' ),
								'tag' => __( 'Tag', 'theme' )
							),
							'default' => '',
							'name' => __( 'Display', 'theme' ),
							'desc' => __( 'get post from anywhere', 'theme' )
						),

						'category' => array(
							'type' => 'select',
							'values' => array('' => 'select category...') + mom_su_Tools::get_terms( 'category' ),
							'default' => '',
							'name' => __( 'Ceategory', 'theme' ),
							'required'  => array('display', 'category'),
						),

						'tag' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'name' => __( 'Tag (Slug)', 'theme' ),
							'required'  => array('display', 'tag'),
						),

						'format' => array(
							'type' => 'select',
							'name' => __( 'Format ', 'theme' ),
							'desc' => __( 'display posts by format', 'theme' ),
							'values' => $f,
							'default' => '',
							'multiple' => true
						),

						'count' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'name' => __( 'Number Of posts', 'theme' ),
						),


						'orderby' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Recent', 'theme' ),
								'popular' => __( 'Popular', 'theme' ),
								'random' => __( 'Random', 'theme' )
							),
							'default' => '',
							'name' => __( 'Order by', 'theme' ),
							'desc' => __( 'recent, popular, random', 'theme' )
						),

						'sort' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'DESC', 'theme' ),
								'ASC' => __( 'ASC', 'theme' )
							),
							'default' => '',
							'name' => __( 'Sort by', 'theme' ),
							'desc' => __( 'DESC, ASC', 'theme' )
						),

						'pagination' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Pagination', 'theme' ),
							'desc' => __( 'enable Pagination', 'theme' )
						),

						'pagination_type' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Default', 'theme' ),
								'ajax' => __( 'Ajax', 'theme' ),
								'scroll' => __( 'Infinite Scroll', 'theme' )
							),
							'default' => '',
							'required' => array('pagination', 'yes'),
							'name' => __( 'Pagination Type', 'theme' ),
							'desc' => __( 'Cuation: do not use ajax if your order posts by random', 'theme' )
						),
						'load_more_count' => array(
							'type' => 'text',
							'values' => '',
							'default' => '',
							'name' => __( 'posts count on load ', 'theme' ),
							'required' => array('pagination', 'yes'),
							'desc' => __('the count of posts on load if you set the pagination type to ajax default is 3')
						),

					),
					'desc' => __( 'Blog posts', 'theme' ),
					'icon' => 'th'
				);


				// Tabs
					$shortcodes['tabs'] = array(
					'name' => __( 'Tabs', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Horizontal Tabs', 'theme' ),
								'vertical' => __( 'Vertical Tabs', 'theme' )
							),
							'default' => '',
							'name' => __( 'Style', 'theme' ),
							'desc' => __( 'Choose style for this tabs', 'theme' )
						),
						'align' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Context', 'theme' ),
								'center' => __( 'Center', 'theme' )
							),
							'default' => '',
							'name' => __( 'Align', 'theme' ),
							'desc' => __( 'Tabs Alignment', 'theme' )
						),

						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)
					),
					'content' => __( "[tab title=\"Title 1\"]Content 1[/tab]\n[tab title=\"Title 2\"]Content 2[/tab]\n[tab title=\"Title 3\"]Content 3[/tab]", 'theme' ),
					'desc' => __( 'Tabs container', 'theme' ),
					'icon' => 'list-alt'
				);
				// Accordions
					$shortcodes['accordions'] = array(
					'name' => __( 'Accordions', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'type' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Accordion', 'theme' ),
								'toggle' => __( 'Toggle', 'theme' )
							),
							'default' => '',
							'name' => __( 'Type', 'theme' ),
							'desc' => __( 'accordion or toggle', 'theme' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)
					),
					'content' => __( "[accordion title=\"Title 1\"]Content 1[/accordion]\n[accordion title=\"Title 2\"]Content 2[/accordion]\n[accordion title=\"Title 3\"]Content 3[/accordion]", 'theme' ),
					'desc' => __( 'Accordions container', 'theme' ),
					'icon' => 'list-ul'
				);

				// Buttons
					$shortcodes['button'] = array(
					'name' => __( 'Button', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'content' => __( "Click Here", 'theme' ),
					'atts' => array(
						'color' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Theme color', 'theme' ),
								'yellow' => __( 'yellow', 'theme' ),
								'orange' => __( 'orange', 'theme' ),
								'orange2' => __( 'orange2', 'theme' ),
								'red' => __( 'red', 'theme' ),
								'green' => __( 'green', 'theme' ),
								'blue' => __( 'blue', 'theme' ),
								'black' => __( 'black', 'theme' ),
								'white' => __( 'white', 'theme' ),
								'grey' => __( 'grey', 'theme' ),
								'dark_grey' => __( 'dark grey', 'theme' ),
								'custom' => __( 'custom', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Color', 'theme' ),
							'desc' => __( 'Select one or make your own', 'theme' )
						),
						
						'bgcolor' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						
						'hoverbg' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color on hover', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						'textcolor' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Text Color', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						
						'texthcolor' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Text Color on hover', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						'bordercolor' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						
						'hoverborder' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color on hover', 'theme' ),
							'default' => '',
							'required' => array('color', 'custom')
						),

						'style' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Normal', 'theme' ),
								'flat' => __( 'Flat', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Style', 'theme' ),
						),

						'border_width' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 300,
							'step' => 1,
							'default' => 0,
							'name' => __( 'Border width', 'theme' ),
						),

						'size' => array(
							'type' => 'select',
							'values' => array(
								'medium' => __( 'Medium', 'theme' ),
								'' => __( 'Small', 'theme' ),
								'large' => __( 'Large', 'theme' ),
							),
							'default' => 'medium',
							'name' => __( 'Size', 'theme' ),
						),

						'align' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Left', 'theme' ),
								'right' => __( 'Right', 'theme' ),
								'center' => __( 'Center', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Align', 'theme' ),
						),


						'width' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Fit with content', 'theme' ),
								'full' => __( 'Full width', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Width', 'theme' ),
						),
						
						'link' => array(
							'type' => 'text',
							'default' => '',
							'name' => __( 'Button Link', 'theme' ),
						),

						'target' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Open in same window/tab', 'theme' ),
								'ـblank' => __( 'Open in new window/tab', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Link Target', 'theme' ),
						),

						'font' => array(
							'type' => 'select',
							'values' => mom_google_fonts(),
							'default' => '',
							'name' => __( 'Font', 'theme' ),
						),

						'text_transform' => array(
							'type' => 'select',
							'values' => array(
								'uppercase' => __( 'UPPERCASE', 'theme' ),
								'none' => __( 'Normal', 'theme' ),
							),
							'default' => 'uppercase',
							'name' => __( 'Text transform', 'theme' ),
						),

						'font_weight' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Normal', 'theme' ),
								'bold' => __( 'Bold', 'theme' ),
							),
							'default' => '',
							'name' => __( 'Font weight', 'theme' ),
						),

						'padding' => array(
							'default' => '',
							'name' => __( 'Padding <a target="_blank" href="http://www.w3schools.com/css/css_padding.asp">learn more</a>', 'theme' ),
							'desc' => __( 'space inside the button', 'theme' )
						),

						'radius' => array(
							'default' => '',
							'name' => __( 'Radius', 'theme' ),
							'desc' => __( 'insert a radius number eg. 10', 'theme' )
						),

						'outer_border' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Outer Border', 'theme' ),
							'desc' => __( 'This make the button looks good', 'theme' )
						),

						'outer_border_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Outer Border Color', 'theme' ),
							'required' => array('outer_border', 'yes')
						),

						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
							'desc' => __( 'Tons of icons fit with any button', 'theme' )
						),

						'icon_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color', 'theme' ),
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)

					),
					'icon' => 'th-large',
					'desc' => ''
				);


				// Google Map
					$shortcodes['map'] = array(
					'name' => __( 'Map', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'width' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Container Width', 'theme' ),
								'full' => __( 'Full', 'theme' )
							),
							'default' => '',
							'name' => __( 'Width', 'theme' ),
						),
						'height' => array(
							'default' => '',
							'name' => __( 'Height', 'theme' ),
							'desc' => __( 'eg. 450px', 'theme' )
						),

						'lat' => array(
							'default' => '',
							'name' => __( 'Latitude', 'theme' ),
						),

						'long' => array(
							'default' => '',
							'name' => __( 'Longitude', 'theme' ),
						),

						'color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Overlay Color', 'theme' ),
						),

						'zoom' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 30,
							'step' => 1,
							'default' => 13,
							'name' => __( 'Zoom', 'theme' ),
						),

						'pan' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Pan', 'theme' ),
						),

						'controls' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Controls', 'theme' ),
						),

						'marker_icon' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'Marker icon', 'theme' ),
						),
						'marker_title' => array(
							'default' => '',
							'name' => __( 'Marker Title', 'theme' ),
							'desc' => __( 'you will see this when mouse over the marker icon', 'theme' ),
						),
						'marker_animation' => array(
							'type' => 'select',
							'values' => array(
									'DROP' => __('Drop', 'theme'),
									'BOUNCE' => __('Bounce', 'theme'),

								),
							'default' => 'DROP',
							'name' => __( 'Marker icon Animation', 'theme' ),
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						),
					),
					'content' => '',
					'desc' => __( 'Insert Google Map', 'theme' ),
					'icon' => 'map-marker'
				);

				// Icontext
					$shortcodes['icontext'] = array(
					'name' => __( 'Icon Text', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'content' => __( "Content Here", 'theme' ),
					'atts' => array(
						'size' => array(
							'type' => 'select',
							'values' => array(
								'' => __( 'Small', 'theme' ),
								'big' => __( 'Big', 'theme' )
							),
							'default' => '',
							'name' => __( 'Size', 'theme' ),
						),

						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
						),

						'icon_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color', 'theme' ),
							'desc' => __('Not work with image icon', 'theme'),
							'required' => array('icon', '', '!=')
						),
						'icon_size' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 60,
							'step' => 1,
							'default' => '',
							'name' => __( 'Icon Size', 'theme' ),
						),

					'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						),
					),
					'content' => 'Content Here',
					'desc' => __( 'Insert Icon Text', 'theme' ),
					'icon' => 'check-square-o'
				);
				// Iconbox
					$shortcodes['iconbox'] = array(
					'name' => __( 'Icon Box', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'content' => __( "Content Here", 'theme' ),
					'atts' => array(

						'align' => array(
							'type' => 'radio',
							'values' => array(
								'left' => array($imgs.'iconleft.png'),
								'center' => array($imgs.'iconcenter.png'),
								'right' => array($imgs.'iconright.png'),
								'middle_left' => array($imgs.'iconmleft.png'),
								'middle_right' => array($imgs.'iconmright.png'),
							),
							'default' => 'left',
							'name' => __( 'Icon Alignment', 'theme' ),
						),						
						'title' => array(
							'default' => '',
							'name' => __( 'Title', 'theme' ),
						),

						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
						),

						'icon_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color', 'theme' ),
							'desc' => __('Not work with image icon', 'theme'),
							'required' => array('icon', '', '!=')
						),
						'size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 60,
							'step' => 1,
							'default' => 38,
							'name' => __( 'Icon Size', 'theme' ),
							'required' => array('icon', '', '!=')
						),

						'icon_align_to' => array(
							'type' => 'select',
							'values' => array(
									'box' => __('Box','theme'),
									'title' => __('Title','theme'),

								),
							'default' => '',
							'name' => __( 'Icon Align to', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						
						'icon_link' => array(
							'name' => __( 'Icon Link', 'theme' ),
							'default' => '',
							'required' => array('icon', '', '!=')
						),

						'icon_bg' => array(
							'type' => 'select',
							'default' => '',
							'values' => array(
									'' => __('None','theme'),
									'circle' => __('Circle','theme'),
									'square' => __('Square','theme'),

								),
							'name' => __( 'Icon Background', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_bg_size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => 80,
							'name' => __( 'background Size', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bg_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bg_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color on mouse over', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color on mouse over', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_width' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => '',
							'name' => __( 'Border width', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'hover_animation' => array(
							'type' => 'select',
							'default' => '',
							'values' => array(
								'' => __('none', 'theme'),
								'border_increase' => __('Border Increase', 'theme'),
								'border_decrease' => __('Border Decrease', 'theme'),
								'icon_move' => __('Icon Move', 'theme'),
							),
							'name' => __( 'Hover Animation', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'square_bg_radius' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => '',
							'name' => __( 'Square Radius', 'theme' ),
							'required' => array('icon_bg', 'square', '=', 3)
						),

						'icon_animation' => array(
							'type' => 'select',
							'values' => array(
									'' => 'None',
									'bounce' => 'bounce',
									'flash' => 'flash',
									'pulse' => 'pulse',
									'rubberBand' => 'rubberBand',
									'shake' => 'shake',
									'swing' => 'swing',
									'tada' => 'tada',
									'wobble' => 'wobble',
									'bounceIn' => 'bounceIn',
									'bounceInDown' => 'bounceInDown',
									'bounceInLeft' => 'bounceInLeft',
									'bounceInRight' => 'bounceInRight',
									'bounceInUp' => 'bounceInUp',
									'fadeIn' => 'fadeIn',
									'fadeInDown' => 'fadeInDown',
									'fadeInDownBig' => 'fadeInDownBig',
									'fadeInLeft' => 'fadeInLeft',
									'fadeInLeftBig' => 'fadeInLeftBig',
									'fadeInRight' => 'fadeInRight',
									'fadeInRightBig' => 'fadeInRightBig',
									'fadeInUp' => 'fadeInUp',
									'fadeInUpBig' => 'fadeInUpBig',
									'flip' => 'flip',
									'flipInX' => 'flipInX',
									'flipInY' => 'flipInY',
									'lightSpeedIn' => 'lightSpeedIn',
									'rotateIn' => 'rotateIn',
									'rotateInDownLeft' => 'rotateInDownLeft',
									'rotateInDownRight' => 'rotateInDownRight',
									'rotateInUpLeft' => 'rotateInUpLeft',
									'rotateInUpRight' => 'rotateInUpRight',
									'slideInDown' => 'slideInDown',
									'slideInLeft' => 'slideInLeft',
									'slideInRight' => 'slideInRight',
									'hinge' => 'hinge',
									'rollIn' => 'rollIn',
								),
							'default' => '',
							'name' => __( 'Icon Animation', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_animation_duration' => array(
							'default' => '',
							'name' => __( 'Duration', 'theme' ),
							'desc' => __( 'in seconds', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),
						'icon_animation_delay' => array(
							'default' => '',
							'name' => __( 'Delay', 'theme' ),
							'desc' => __( 'in seconds', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),
						'icon_animation_iteration' => array(
							'default' => '',
							'name' => __( 'Iteration', 'theme' ),
							'desc' => __( '-1 for infinite', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),

						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						),
					),
					'content' => 'Content Here',
					'desc' => __( 'Insert Icon Text', 'theme' ),
					'icon' => 'check-square-o'
				);

				// Iconbox
					$shortcodes['icon'] = array(
					'name' => __( 'Icon', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(

						'align' => array(
							'type' => 'select',
							'values' => array(
								'left' => __('Left', 'theme'),
								'center' => __('Center', 'theme'),
								'right' => __('Right', 'theme'),
							),
							'default' => 'left',
							'name' => __( 'Icon Alignment', 'theme' ),
						),						
						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
						),

						'icon_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color', 'theme' ),
							'desc' => __('Not work with image icon', 'theme'),
							'required' => array('icon', '', '!=')
						),
						'size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 60,
							'step' => 1,
							'default' => 32,
							'name' => __( 'Icon Size', 'theme' ),
							'required' => array('icon', '', '!=')
						),

						
						'icon_link' => array(
							'name' => __( 'Icon Link', 'theme' ),
							'default' => '',
							'required' => array('icon', '', '!=')
						),

						'icon_bg' => array(
							'type' => 'select',
							'default' => '',
							'values' => array(
									'' => __('None','theme'),
									'circle' => __('Circle','theme'),
									'square' => __('Square','theme'),

								),
							'name' => __( 'Icon Background', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_bg_size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => 70,
							'name' => __( 'background Size', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bg_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bg_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color on mouse over', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Border Color on mouse over', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bd_width' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => '',
							'name' => __( 'Border width', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'hover_animation' => array(
							'type' => 'select',
							'default' => '',
							'values' => array(
								'' => __('none', 'theme'),
								'border_increase' => __('Border Increase', 'theme'),
								'border_decrease' => __('Border Decrease', 'theme'),
								'icon_move' => __('Icon Move', 'theme'),
							),
							'name' => __( 'Hover Animation', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'square_bg_radius' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => '',
							'name' => __( 'Square Radius', 'theme' ),
							'required' => array('icon_bg', 'square', '=', 3)
						),

						'icon_animation' => array(
							'type' => 'select',
							'values' => array(
									'' => 'None',
									'bounce' => 'bounce',
									'flash' => 'flash',
									'pulse' => 'pulse',
									'rubberBand' => 'rubberBand',
									'shake' => 'shake',
									'swing' => 'swing',
									'tada' => 'tada',
									'wobble' => 'wobble',
									'bounceIn' => 'bounceIn',
									'bounceInDown' => 'bounceInDown',
									'bounceInLeft' => 'bounceInLeft',
									'bounceInRight' => 'bounceInRight',
									'bounceInUp' => 'bounceInUp',
									'fadeIn' => 'fadeIn',
									'fadeInDown' => 'fadeInDown',
									'fadeInDownBig' => 'fadeInDownBig',
									'fadeInLeft' => 'fadeInLeft',
									'fadeInLeftBig' => 'fadeInLeftBig',
									'fadeInRight' => 'fadeInRight',
									'fadeInRightBig' => 'fadeInRightBig',
									'fadeInUp' => 'fadeInUp',
									'fadeInUpBig' => 'fadeInUpBig',
									'flip' => 'flip',
									'flipInX' => 'flipInX',
									'flipInY' => 'flipInY',
									'lightSpeedIn' => 'lightSpeedIn',
									'rotateIn' => 'rotateIn',
									'rotateInDownLeft' => 'rotateInDownLeft',
									'rotateInDownRight' => 'rotateInDownRight',
									'rotateInUpLeft' => 'rotateInUpLeft',
									'rotateInUpRight' => 'rotateInUpRight',
									'slideInDown' => 'slideInDown',
									'slideInLeft' => 'slideInLeft',
									'slideInRight' => 'slideInRight',
									'hinge' => 'hinge',
									'rollIn' => 'rollIn',
								),
							'default' => '',
							'name' => __( 'Icon Animation', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_animation_duration' => array(
							'default' => '',
							'name' => __( 'Duration', 'theme' ),
							'desc' => __( 'in seconds', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),
						'icon_animation_delay' => array(
							'default' => '',
							'name' => __( 'Delay', 'theme' ),
							'desc' => __( 'in seconds', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),
						'icon_animation_iteration' => array(
							'default' => '',
							'name' => __( 'Iteration', 'theme' ),
							'desc' => __( '-1 for infinite', 'theme' ),
							'required' => array('icon_animation', '', '!=',3)
						),

						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						),
					),
					'desc' => __( 'Insert Icon', 'theme' ),
					'icon' => 'check-square-o'
				);

				// Diveder
				$shortcodes['divide'] = array(
					'name' => __( 'Divider', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'width' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Long', 'theme'),
									'medium' => __('Medium', 'theme'),
									'short' => __('Short', 'theme'),
								),
							'default' => '',
							'name' => __( 'Width', 'theme' ),
						),
						'height' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 50,
							'step' => 1,
							'default' => 1,
							'name' => __( 'Height', 'theme' ),
						),
						'style' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Line', 'theme'),
									'dots' => __('Dots', 'theme'),
									'dashs' => __('Dashes', 'theme'),
								),
							'default' => '',
							'name' => __( 'Style', 'theme' ),
						),

						'icon' => array(
							'type' => 'select',
							'values' => array(
									'' => __('None', 'theme'),
									'square' => __('Square', 'theme'),
									'circle' => __('Circle', 'theme'),
								),
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
						),

						'icon_position' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Center', 'theme'),
									'right' => __('Right', 'theme'),
									'left' => __('Left', 'theme'),
								),
							'required' => array('icon', '', '!='),
							'default' => '',
							'name' => __( 'Icon Position', 'theme' ),
						),

						'align' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Center', 'theme'),
									'right' => __('Right', 'theme'),
									'left' => __('Left', 'theme'),
								),
							'default' => '',
							'name' => __( 'Align', 'theme' ),
							'desc' => __( 'Divider Alignment', 'theme' ),
						),

						'custom_width' => array(
							'type' => 'text',
							'name' => __( 'custom width', 'theme' ),
							'desc' => __( 'works perfect if select width as long you can set it with px or % ex. 100px', 'theme' )
						),

						'margin_top' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Space above it', 'theme' ),
						),
						'margin_bottom' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 200,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Space under it', 'theme' ),
						),

						'color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Divider Custom color', 'theme' ),
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'ellipsis-h'
				);

				// Gap
				$shortcodes['spacer'] = array(
					'name' => __( 'Spacer', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'height' => array(
							'type' => 'slider',
							'min' => -100,
							'max' => 300,
							'step' => 1,
							'default' => 40,
							'name' => __( 'Height', 'theme' ),
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'arrows-v'
				);
				// highlight
				$shortcodes['highlight'] = array(
					'name' => __( 'Highlight', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'background' => array(
							'type' => 'color',
							'default' => '',
							'values' => array( ),
							'default' => '#ffff99',
							'name' => __( 'Background', 'theme' ),
							'desc' => __( 'Highlighted text background color', 'theme' )
						),
						'color' => array(
							'type' => 'color',
							'default' => '',
							'values' => array( ),
							'default' => '#878787',
							'name' => __( 'Text color', 'theme' ), 'desc' => __( 'Highlighted text color', 'theme' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)
					),
					'content' => __( 'Highlighted text', 'theme' ),
					'desc' => __( 'Highlighted text', 'theme' ),
					'icon' => 'pencil'
				);

				// dropcap
				$shortcodes['dropcap'] = array(
					'name' => __( 'dropcap', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Normal', 'theme'),
									'square' => __('Square', 'theme'),
									'circle' => __('Circle', 'theme'),
								),
							'name' => __( 'Style', 'theme' ),
							'desc' => __( 'dropcap styles', 'theme' ),
						),

						'color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Letter color', 'theme' )
						),						
						'bgcolor' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background color', 'theme' ),
						'required' => array('style', '', '!=')
						),						

						'sradius' => array(
							'type' => 'text',
							'default' => '',
							'name' => __( 'Background color', 'theme' ),
							'required' => array('style', 'square')
						),						

						'font' => array(
							'type' => 'select',
							'default' => '',
							'name' => __( 'Font', 'theme' ),
							'values' => $fonts
						),						



					),
					'content' => __( 'D', 'theme' ),
					'desc' => __( '', 'theme' ),
					'icon' => 'bold'
				);



				// animate
				$shortcodes['animate'] = array(
					'name' => __( 'Animation', 'theme' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'animation' => array(
							'type' => 'select',
							'values' => array_combine( mom_su_Data::animations(), mom_su_Data::animations() ),
							'default' => 'bounceIn',
							'name' => __( 'Animation', 'theme' ),
							'desc' => __( 'Select animation type', 'theme' )
						),
						'duration' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 0.1,
							'default' => 1,
							'name' => __( 'Duration', 'theme' ),
							'desc' => __( 'Animation duration (seconds)', 'theme' )
						),
						'delay' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 0.1,
							'default' => 0,
							'name' => __( 'Delay', 'theme' ),
							'desc' => __( 'Animation delay (seconds)', 'theme' )
						),
						'iteration' => array(
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 0,
							'name' => __( 'Iteration', 'theme' ),
							'desc' => __( 'Animation iteration (times)', 'theme' )
						),
						'offset' => array(
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 0,
							'name' => __( 'Offset', 'theme' ),
							'desc' => __( 'Distance to start the animation (related to the browser bottom)', 'theme' )
						),
						'inline' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Inline', 'theme' ),
							'desc' => __( 'This parameter determines what HTML tag will be used for animation wrapper. Turn this option to YES and animated element will be wrapped in SPAN instead of DIV. Useful for inline animations, like buttons', 'theme' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)
					),
					'content' => __( 'Animated content', 'theme' ),
					'desc' => __( 'Wrapper for animation. Any nested element will be animated', 'theme' ),
					'icon' => 'bolt'
				);

				// Sidebar
				$shortcodes['sidebar'] = array(
					'name' => __( 'Widgetized Sidebar', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'sidebar' => array(
							'type' => 'select',
							'values' => $sidebars,
							'default' => '',
							'name' => __( 'Sidebar', 'theme' ),
							'desc' => __( 'Select sidebar to display', 'theme' )
						),

						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)
					),
					'content' => '',
					'desc' => __( 'Highlighted text', 'theme' ),
					'icon' => 'pencil'
				);
	
				// ad
				$shortcodes['ad'] = array(
					'name' => __( 'Ad', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'id' => array(
							'type' => 'select',
							'values' => $ads,
							'name' => __( 'Select ad', 'theme' ),
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'flag'
				);	

				// box
				$shortcodes['box'] = array(
					'name' => __( 'Box', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'type' => array(
							'type' => 'select',
							'values' => array(
									""	=> __('Default', 'theme'),
									"info"	=> __('Info', 'theme'),
									"note"	=> __('Note', 'theme'),
									"error"	=> __('Error', 'theme'),
									"tip"	=> __('Tip', 'theme'),
									"custom"	=> __('Custom', 'theme'),								
								),
							'default' => '',
							'name' => __( 'Type', 'theme' ),
							'desc' => __( 'select one or create your custom', 'theme' ),
						),
						'bgimg' => array(
							'type' => 'upload',
							'name' => __( 'Background Image', 'theme' ),
							'default' => '',
							'required' => array('type', 'custom')
						),


						'bg' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color', 'theme' ),
							'default' => '',
							'required' => array('type', 'custom')
						),

						'color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Text Color', 'theme' ),
							'default' => '',
							'required' => array('type', 'custom')
						),

						'border' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'border Color', 'theme' ),
							'default' => '',
							'required' => array('type', 'custom')
						),

						'radius' => array(
							'type' => 'text',
							'name' => __( 'Radius', 'theme' ),
							'default' => '',
							'desc'	=> __('insert box border radius number eg. 10','theme'),
						),

						'fontsize' => array(
							'type' => 'text',
							'name' => __( 'Font Size', 'theme' ),
							'default' => '',
							'desc'	=> __('insert a font size as a number eg. 14','theme'),
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'inbox'
				);	


				// lightbox
				$shortcodes['lightbox'] = array(
					'name' => __( 'lightbox', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(

						'thumb' => array(
							'type' => 'upload',
							'name' => __( 'Thumbnail', 'theme' ),
							'default' => '',
						),

						'type' => array(
							'type' => 'select',
							'name' => __( 'Type', 'theme' ),
							'default' => '',
							'values' => array(
									'' => __('Image', 'theme'),
									'video' => __('Video', 'theme'),
								),
						),

						'link' => array(
							'type' => 'text',
							'name' => __( 'Link', 'theme' ),
							'default' => '',
							'desc'	=> __('it can be image link or video link (youtube&vimeo only), if leave empty it will be the thumbnail image link.','theme'),
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'external-link'
				);	

				// list
				$shortcodes['list'] = array(
					'name' => __( 'List', 'theme' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(

						'margin_top' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 300,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Space above list', 'theme' ),
						),

						'margin_bottom' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 300,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Space under list', 'theme' ),
						),
						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'theme' ),
						),

						'icon_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_color_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Icon Color on mouse over', 'theme' ),
							'required' => array('icon', '', '!=')
						),
						'icon_size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 60,
							'step' => 1,
							'default' => 16,
							'name' => __( 'Icon Size', 'theme' ),
							'required' => array('icon', '', '!=')
						),

						'icon_bg' => array(
							'type' => 'select',
							'default' => '',
							'values' => array(
									'' => __('None','theme'),
									'circle' => __('Circle','theme'),
									'square' => __('Square','theme'),

								),
							'name' => __( 'Icon Background', 'theme' ),
							'required' => array('icon', '', '!=')
						),

						'icon_bg_color' => array(
							'type' => 'color',
							'default' => '',
							'name' => __( 'Background Color', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'icon_bg_hover' => array(
							'type' => 'color',
							'default' => '',
							'name' => __('Background Color on mouse over', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),

						'square_bg_radius' => array(
							'type' => 'text',
							'default' => '',
							'name' => __( 'Square background radius', 'theme' ),
							'required' => array('icon_bg', '', '!=', 3)
						),


					),
					'content' => 'saperate each list item with comma.',
					'desc' => '',
					'icon' => 'list-ul'
				);	

				// video
				$shortcodes['mom_video'] = array(
					'name' => __( 'Video', 'theme' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(

						'type' => array(
							'type' => 'select',
							'name' => __( 'Type', 'theme' ),
							'default' => '',
							'values' => array(
									'youtube' => __('Youtube', 'theme'),
									'vimeo' => __('vimeo', 'theme'),
								),
						),

						'id' => array(
							'type' => 'text',
							'name' => __( 'Video ID', 'theme' ),
							'default' => '',
							'desc'	=> __('	video id is the bold text in this links : http://www.youtube.com/watch?v=XSo4JQnm8Bw, http://vimeo.com/7449107','theme'),
						),
						'width' => array(
							'type' => 'text',
							'name' => __( 'width (px)', 'theme' ),
							'default' => '',
						),

						'height' => array(
							'type' => 'text',
							'name' => __( 'height (px)', 'theme' ),
							'default' => '',
						),

					),
					'content' => '',
					'desc' => '',
					'icon' => 'film'
				);	
	// Return modified data
	return $shortcodes;
}

/*=========================================================
*		Groups
========================================================= */

add_filter( 'mom_su/data/groups', 'mom_my_custom_groups' );

function mom_my_custom_groups ($groups) {
	unset( $groups['data']);
	unset( $groups['box']);
	$groups['shop'] = __('Shop', 'theme');
	return $groups;

}
/*=========================================================
*		Icons
========================================================= */
add_filter( 'mom_su/data/icons', 'mom_my_custom_icons' );

function mom_my_custom_icons ($icons) {
	$icons = array('fa-adjust', 'fa-adn', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-ambulance', 'fa-anchor', 'fa-android', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-apple', 'fa-archive', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-left', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-up', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows', 'fa-arrows-alt', 'fa-arrows-h', 'fa-arrows-v', 'fa-asterisk', 'fa-automobile', 'fa-backward', 'fa-ban', 'fa-bank', 'fa-bar-chart-o', 'fa-barcode', 'fa-bars', 'fa-beer', 'fa-behance', 'fa-behance-square', 'fa-bell', 'fa-bell-o', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-bitcoin', 'fa-bold', 'fa-bolt', 'fa-bomb', 'fa-book', 'fa-bookmark', 'fa-bookmark-o', 'fa-briefcase', 'fa-btc', 'fa-bug', 'fa-building', 'fa-building-o', 'fa-bullhorn', 'fa-bullseye', 'fa-cab', 'fa-calendar', 'fa-calendar-o', 'fa-camera', 'fa-camera-retro', 'fa-car', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-caret-up', 'fa-certificate', 'fa-chain', 'fa-chain-broken', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square', 'fa-check-square-o', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-child', 'fa-circle', 'fa-circle-o', 'fa-circle-o-notch', 'fa-circle-thin', 'fa-clipboard', 'fa-clock-o', 'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload', 'fa-cny', 'fa-code', 'fa-code-fork', 'fa-codepen', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-columns', 'fa-comment', 'fa-comment-o', 'fa-comments', 'fa-comments-o', 'fa-compass', 'fa-compress', 'fa-copy', 'fa-credit-card', 'fa-crop', 'fa-crosshairs', 'fa-css3', 'fa-cube', 'fa-cubes', 'fa-cut', 'fa-cutlery', 'fa-dashboard', 'fa-database', 'fa-dedent', 'fa-delicious', 'fa-desktop', 'fa-deviantart', 'fa-digg', 'fa-dollar', 'fa-dot-circle-o', 'fa-download', 'fa-dribbble', 'fa-dropbox', 'fa-drupal', 'fa-edit', 'fa-eject', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-empire', 'fa-envelope', 'fa-envelope-o', 'fa-envelope-square', 'fa-eraser', 'fa-eur', 'fa-euro', 'fa-exchange', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-expand', 'fa-external-link', 'fa-external-link-square', 'fa-eye', 'fa-eye-slash', 'fa-facebook', 'fa-facebook-square', 'fa-fast-backward', 'fa-fast-forward', 'fa-fax', 'fa-female', 'fa-fighter-jet', 'fa-file', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-files-o', 'fa-film', 'fa-filter', 'fa-fire', 'fa-fire-extinguisher', 'fa-flag', 'fa-flag-checkered', 'fa-flag-o', 'fa-flash', 'fa-flask', 'fa-flickr', 'fa-floppy-o', 'fa-folder', 'fa-folder-o', 'fa-folder-open', 'fa-folder-open-o', 'fa-font', 'fa-forward', 'fa-foursquare', 'fa-frown-o', 'fa-gamepad', 'fa-gavel', 'fa-gbp', 'fa-ge', 'fa-gear', 'fa-gears', 'fa-gift', 'fa-git', 'fa-git-square', 'fa-github', 'fa-github-alt', 'fa-github-square', 'fa-gittip', 'fa-glass', 'fa-globe', 'fa-google', 'fa-google-plus', 'fa-google-plus-square', 'fa-graduation-cap', 'fa-group', 'fa-h-square', 'fa-hacker-news', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-hdd-o', 'fa-header', 'fa-headphones', 'fa-heart', 'fa-heart-o', 'fa-history', 'fa-home', 'fa-hospital-o', 'fa-html5', 'fa-image', 'fa-inbox', 'fa-indent', 'fa-info', 'fa-info-circle', 'fa-inr', 'fa-instagram', 'fa-institution', 'fa-italic', 'fa-joomla', 'fa-jpy', 'fa-jsfiddle', 'fa-key', 'fa-keyboard-o', 'fa-krw', 'fa-language', 'fa-laptop', 'fa-leaf', 'fa-legal', 'fa-lemon-o', 'fa-level-down', 'fa-level-up', 'fa-life-bouy', 'fa-life-ring', 'fa-life-saver', 'fa-lightbulb-o', 'fa-link', 'fa-linkedin', 'fa-linkedin-square', 'fa-linux', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-location-arrow', 'fa-lock', 'fa-long-arrow-down', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-long-arrow-up', 'fa-magic', 'fa-magnet', 'fa-mail-forward', 'fa-mail-reply', 'fa-mail-reply-all', 'fa-male', 'fa-map-marker', 'fa-maxcdn', 'fa-medkit', 'fa-meh-o', 'fa-microphone', 'fa-microphone-slash', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-mobile', 'fa-mobile-phone', 'fa-money', 'fa-moon-o', 'fa-mortar-board', 'fa-music', 'fa-navicon', 'fa-openid', 'fa-outdent', 'fa-pagelines', 'fa-paper-plane', 'fa-paper-plane-o', 'fa-paperclip', 'fa-paragraph', 'fa-paste', 'fa-pause', 'fa-paw', 'fa-pencil', 'fa-pencil-square', 'fa-pencil-square-o', 'fa-phone', 'fa-phone-square', 'fa-photo', 'fa-picture-o', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-pied-piper-square', 'fa-pinterest', 'fa-pinterest-square', 'fa-plane', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-power-off', 'fa-print', 'fa-puzzle-piece', 'fa-qq', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-quote-left', 'fa-quote-right', 'fa-ra', 'fa-random', 'fa-rebel', 'fa-recycle', 'fa-reddit', 'fa-reddit-square', 'fa-refresh', 'fa-renren', 'fa-reorder', 'fa-repeat', 'fa-reply', 'fa-reply-all', 'fa-retweet', 'fa-rmb', 'fa-road', 'fa-rocket', 'fa-rotate-left', 'fa-rotate-right', 'fa-rouble', 'fa-rss', 'fa-rss-square', 'fa-rub', 'fa-ruble', 'fa-rupee', 'fa-save', 'fa-scissors', 'fa-search', 'fa-search-minus', 'fa-search-plus', 'fa-send', 'fa-send-o', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o', 'fa-shield', 'fa-shopping-cart', 'fa-sign-in', 'fa-sign-out', 'fa-signal', 'fa-sitemap', 'fa-skype', 'fa-slack', 'fa-sliders', 'fa-smile-o', 'fa-sort', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-asc', 'fa-sort-desc', 'fa-sort-down', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-sort-up', 'fa-soundcloud', 'fa-space-shuttle', 'fa-spinner', 'fa-spoon', 'fa-spotify', 'fa-square', 'fa-square-o', 'fa-stack-exchange', 'fa-stack-overflow', 'fa-star', 'fa-star-half', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-star-o', 'fa-steam', 'fa-steam-square', 'fa-step-backward', 'fa-step-forward', 'fa-stethoscope', 'fa-stop', 'fa-strikethrough', 'fa-stumbleupon', 'fa-stumbleupon-circle', 'fa-subscript', 'fa-suitcase', 'fa-sun-o', 'fa-superscript', 'fa-support', 'fa-table', 'fa-tablet', 'fa-tachometer', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-taxi', 'fa-tencent-weibo', 'fa-terminal', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-thumb-tack', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ticket', 'fa-times', 'fa-times-circle', 'fa-times-circle-o', 'fa-tint', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-right', 'fa-toggle-up', 'fa-trash-o', 'fa-tree', 'fa-trello', 'fa-trophy', 'fa-truck', 'fa-try', 'fa-tumblr', 'fa-tumblr-square', 'fa-turkish-lira', 'fa-twitter', 'fa-twitter-square', 'fa-umbrella', 'fa-underline', 'fa-undo', 'fa-university', 'fa-unlink', 'fa-unlock', 'fa-unlock-alt', 'fa-unsorted', 'fa-upload', 'fa-usd', 'fa-user', 'fa-user-md', 'fa-users', 'fa-video-camera', 'fa-vimeo-square', 'fa-vine', 'fa-vk', 'fa-volume-down', 'fa-volume-off', 'fa-volume-up', 'fa-warning', 'fa-wechat', 'fa-weibo', 'fa-weixin', 'fa-wheelchair', 'fa-windows', 'fa-won', 'fa-wordpress', 'fa-wrench', 'fa-xing', 'fa-xing-square', 'fa-yahoo', 'fa-yen', 'fa-youtube', 'fa-youtube-play', 'fa-youtube-square', 'momizat-icon-home', 'momizat-icon-home2', 'momizat-icon-home3', 'momizat-icon-office', 'momizat-icon-newspaper', 'momizat-icon-pencil', 'momizat-icon-pencil2', 'momizat-icon-quill', 'momizat-icon-pen', 'momizat-icon-blog', 'momizat-icon-droplet', 'momizat-icon-paint-format', 'momizat-icon-image', 'momizat-icon-image2', 'momizat-icon-images', 'momizat-icon-camera', 'momizat-icon-music', 'momizat-icon-headphones', 'momizat-icon-play', 'momizat-icon-film', 'momizat-icon-camera2', 'momizat-icon-dice', 'momizat-icon-pacman', 'momizat-icon-spades', 'momizat-icon-clubs', 'momizat-icon-diamonds', 'momizat-icon-pawn', 'momizat-icon-bullhorn', 'momizat-icon-connection', 'momizat-icon-podcast', 'momizat-icon-feed', 'momizat-icon-book', 'momizat-icon-books', 'momizat-icon-library', 'momizat-icon-file', 'momizat-icon-profile', 'momizat-icon-file2', 'momizat-icon-file3', 'momizat-icon-file4', 'momizat-icon-copy', 'momizat-icon-copy2', 'momizat-icon-copy3', 'momizat-icon-paste', 'momizat-icon-paste2', 'momizat-icon-paste3', 'momizat-icon-stack', 'momizat-icon-folder', 'momizat-icon-folder-open', 'momizat-icon-tag', 'momizat-icon-tags', 'momizat-icon-barcode', 'momizat-icon-qrcode', 'momizat-icon-ticket', 'momizat-icon-cart', 'momizat-icon-cart2', 'momizat-icon-cart3', 'momizat-icon-coin', 'momizat-icon-credit', 'momizat-icon-calculate', 'momizat-icon-support', 'momizat-icon-phone', 'momizat-icon-phone-hang-up', 'momizat-icon-address-book', 'momizat-icon-notebook', 'momizat-icon-envelope', 'momizat-icon-pushpin', 'momizat-icon-location', 'momizat-icon-location2', 'momizat-icon-compass', 'momizat-icon-map', 'momizat-icon-map2', 'momizat-icon-history', 'momizat-icon-clock', 'momizat-icon-clock2', 'momizat-icon-alarm', 'momizat-icon-alarm2', 'momizat-icon-bell', 'momizat-icon-stopwatch', 'momizat-icon-calendar', 'momizat-icon-calendar2', 'momizat-icon-print', 'momizat-icon-keyboard', 'momizat-icon-screen', 'momizat-icon-laptop', 'momizat-icon-mobile', 'momizat-icon-mobile2', 'momizat-icon-tablet', 'momizat-icon-tv', 'momizat-icon-cabinet', 'momizat-icon-drawer', 'momizat-icon-drawer2', 'momizat-icon-drawer3', 'momizat-icon-box-add', 'momizat-icon-box-remove', 'momizat-icon-download', 'momizat-icon-upload', 'momizat-icon-disk', 'momizat-icon-storage', 'momizat-icon-undo', 'momizat-icon-redo', 'momizat-icon-flip', 'momizat-icon-flip2', 'momizat-icon-undo2', 'momizat-icon-redo2', 'momizat-icon-forward', 'momizat-icon-reply', 'momizat-icon-bubble', 'momizat-icon-bubbles', 'momizat-icon-bubbles2', 'momizat-icon-bubble2', 'momizat-icon-bubbles3', 'momizat-icon-bubbles4', 'momizat-icon-user', 'momizat-icon-users', 'momizat-icon-user2', 'momizat-icon-users2', 'momizat-icon-user3', 'momizat-icon-user4', 'momizat-icon-quotes-left', 'momizat-icon-busy', 'momizat-icon-spinner', 'momizat-icon-spinner2', 'momizat-icon-spinner3', 'momizat-icon-spinner4', 'momizat-icon-spinner5', 'momizat-icon-spinner6', 'momizat-icon-binoculars', 'momizat-icon-search', 'momizat-icon-zoom-in', 'momizat-icon-zoom-out', 'momizat-icon-expand', 'momizat-icon-contract', 'momizat-icon-expand2', 'momizat-icon-contract2', 'momizat-icon-key', 'momizat-icon-key2', 'momizat-icon-lock', 'momizat-icon-lock2', 'momizat-icon-unlocked', 'momizat-icon-wrench', 'momizat-icon-settings', 'momizat-icon-equalizer', 'momizat-icon-cog', 'momizat-icon-cogs', 'momizat-icon-cog2', 'momizat-icon-hammer', 'momizat-icon-wand', 'momizat-icon-aid', 'momizat-icon-bug', 'momizat-icon-pie', 'momizat-icon-stats', 'momizat-icon-bars', 'momizat-icon-bars2', 'momizat-icon-gift', 'momizat-icon-trophy', 'momizat-icon-glass', 'momizat-icon-mug', 'momizat-icon-food', 'momizat-icon-leaf', 'momizat-icon-rocket', 'momizat-icon-meter', 'momizat-icon-meter2', 'momizat-icon-dashboard', 'momizat-icon-hammer2', 'momizat-icon-fire', 'momizat-icon-lab', 'momizat-icon-magnet', 'momizat-icon-remove', 'momizat-icon-remove2', 'momizat-icon-briefcase', 'momizat-icon-airplane', 'momizat-icon-truck', 'momizat-icon-road', 'momizat-icon-accessibility', 'momizat-icon-target', 'momizat-icon-shield', 'momizat-icon-lightning', 'momizat-icon-switch', 'momizat-icon-power-cord', 'momizat-icon-signup', 'momizat-icon-list', 'momizat-icon-list2', 'momizat-icon-numbered-list', 'momizat-icon-menu', 'momizat-icon-menu2', 'momizat-icon-tree', 'momizat-icon-cloud', 'momizat-icon-cloud-download', 'momizat-icon-cloud-upload', 'momizat-icon-download2', 'momizat-icon-upload2', 'momizat-icon-download3', 'momizat-icon-upload3', 'momizat-icon-globe', 'momizat-icon-earth', 'momizat-icon-link', 'momizat-icon-flag', 'momizat-icon-attachment', 'momizat-icon-eye', 'momizat-icon-eye-blocked', 'momizat-icon-eye2', 'momizat-icon-bookmark', 'momizat-icon-bookmarks', 'momizat-icon-brightness-medium', 'momizat-icon-brightness-contrast', 'momizat-icon-contrast', 'momizat-icon-star', 'momizat-icon-star2', 'momizat-icon-star3', 'momizat-icon-heart', 'momizat-icon-heart2', 'momizat-icon-heart-broken', 'momizat-icon-thumbs-up', 'momizat-icon-thumbs-up2', 'momizat-icon-happy', 'momizat-icon-happy2', 'momizat-icon-smiley', 'momizat-icon-smiley2', 'momizat-icon-tongue', 'momizat-icon-tongue2', 'momizat-icon-sad', 'momizat-icon-sad2', 'momizat-icon-wink', 'momizat-icon-wink2', 'momizat-icon-grin', 'momizat-icon-grin2', 'momizat-icon-cool', 'momizat-icon-cool2', 'momizat-icon-angry', 'momizat-icon-angry2', 'momizat-icon-evil', 'momizat-icon-evil2', 'momizat-icon-shocked', 'momizat-icon-shocked2', 'momizat-icon-confused', 'momizat-icon-confused2', 'momizat-icon-neutral', 'momizat-icon-neutral2', 'momizat-icon-wondering', 'momizat-icon-wondering2', 'momizat-icon-point-up', 'momizat-icon-point-right', 'momizat-icon-point-down', 'momizat-icon-point-left', 'momizat-icon-warning', 'momizat-icon-notification', 'momizat-icon-question', 'momizat-icon-info', 'momizat-icon-info2', 'momizat-icon-blocked', 'momizat-icon-cancel-circle', 'momizat-icon-checkmark-circle', 'momizat-icon-spam', 'momizat-icon-close', 'momizat-icon-checkmark', 'momizat-icon-checkmark2', 'momizat-icon-spell-check', 'momizat-icon-minus', 'momizat-icon-plus', 'momizat-icon-enter', 'momizat-icon-exit', 'momizat-icon-play2', 'momizat-icon-pause', 'momizat-icon-stop', 'momizat-icon-backward', 'momizat-icon-forward2', 'momizat-icon-play3', 'momizat-icon-pause2', 'momizat-icon-stop2', 'momizat-icon-backward2', 'momizat-icon-forward3', 'momizat-icon-first', 'momizat-icon-last', 'momizat-icon-previous', 'momizat-icon-next', 'momizat-icon-eject', 'momizat-icon-volume-high', 'momizat-icon-volume-medium', 'momizat-icon-volume-low', 'momizat-icon-volume-mute', 'momizat-icon-volume-mute2', 'momizat-icon-volume-increase', 'momizat-icon-volume-decrease', 'momizat-icon-loop', 'momizat-icon-loop2', 'momizat-icon-loop3', 'momizat-icon-shuffle', 'momizat-icon-arrow-up-left', 'momizat-icon-arrow-up', 'momizat-icon-arrow-up-right', 'momizat-icon-arrow-right', 'momizat-icon-arrow-down-right', 'momizat-icon-arrow-down', 'momizat-icon-arrow-down-left', 'momizat-icon-arrow-left', 'momizat-icon-arrow-up-left2', 'momizat-icon-arrow-up2', 'momizat-icon-arrow-up-right2', 'momizat-icon-arrow-right2', 'momizat-icon-arrow-down-right2', 'momizat-icon-arrow-down2', 'momizat-icon-arrow-down-left2', 'momizat-icon-arrow-left2', 'momizat-icon-arrow-up-left3', 'momizat-icon-arrow-up3', 'momizat-icon-arrow-up-right3', 'momizat-icon-arrow-right3', 'momizat-icon-arrow-down-right3', 'momizat-icon-arrow-down3', 'momizat-icon-arrow-down-left3', 'momizat-icon-arrow-left3', 'momizat-icon-tab', 'momizat-icon-checkbox-checked', 'momizat-icon-checkbox-unchecked', 'momizat-icon-checkbox-partial', 'momizat-icon-radio-checked', 'momizat-icon-radio-unchecked', 'momizat-icon-crop', 'momizat-icon-scissors', 'momizat-icon-filter', 'momizat-icon-filter2', 'momizat-icon-font', 'momizat-icon-text-height', 'momizat-icon-text-width', 'momizat-icon-bold', 'momizat-icon-underline', 'momizat-icon-italic', 'momizat-icon-strikethrough', 'momizat-icon-omega', 'momizat-icon-sigma', 'momizat-icon-table', 'momizat-icon-table2', 'momizat-icon-insert-template', 'momizat-icon-pilcrow', 'momizat-icon-left-toright', 'momizat-icon-right-toleft', 'momizat-icon-paragraph-left', 'momizat-icon-paragraph-center', 'momizat-icon-paragraph-right', 'momizat-icon-paragraph-justify', 'momizat-icon-paragraph-left2', 'momizat-icon-paragraph-center2', 'momizat-icon-paragraph-right2', 'momizat-icon-paragraph-justify2', 'momizat-icon-indent-increase', 'momizat-icon-indent-decrease', 'momizat-icon-new-tab', 'momizat-icon-embed', 'momizat-icon-code', 'momizat-icon-console', 'momizat-icon-share', 'momizat-icon-mail', 'momizat-icon-mail2', 'momizat-icon-mail3', 'momizat-icon-mail4', 'momizat-icon-google', 'momizat-icon-google-plus', 'momizat-icon-google-plus2', 'momizat-icon-google-plus3', 'momizat-icon-google-plus4', 'momizat-icon-google-drive', 'momizat-icon-facebook', 'momizat-icon-facebook2', 'momizat-icon-facebook3', 'momizat-icon-instagram', 'momizat-icon-twitter', 'momizat-icon-twitter2', 'momizat-icon-twitter3', 'momizat-icon-feed2', 'momizat-icon-feed3', 'momizat-icon-feed4', 'momizat-icon-youtube', 'momizat-icon-youtube2', 'momizat-icon-vimeo', 'momizat-icon-vimeo2', 'momizat-icon-vimeo3', 'momizat-icon-lanyrd', 'momizat-icon-flickr', 'momizat-icon-flickr2', 'momizat-icon-flickr3', 'momizat-icon-flickr4', 'momizat-icon-picassa', 'momizat-icon-picassa2', 'momizat-icon-dribbble', 'momizat-icon-dribbble2', 'momizat-icon-dribbble3', 'momizat-icon-forrst', 'momizat-icon-forrst2', 'momizat-icon-deviantart', 'momizat-icon-deviantart2', 'momizat-icon-steam', 'momizat-icon-steam2', 'momizat-icon-github', 'momizat-icon-github2', 'momizat-icon-github3', 'momizat-icon-github4', 'momizat-icon-github5', 'momizat-icon-wordpress', 'momizat-icon-wordpress2', 'momizat-icon-joomla', 'momizat-icon-blogger', 'momizat-icon-blogger2', 'momizat-icon-tumblr', 'momizat-icon-tumblr2', 'momizat-icon-yahoo', 'momizat-icon-tux', 'momizat-icon-apple', 'momizat-icon-finder', 'momizat-icon-android', 'momizat-icon-windows', 'momizat-icon-windows8', 'momizat-icon-soundcloud', 'momizat-icon-soundcloud2', 'momizat-icon-skype', 'momizat-icon-reddit', 'momizat-icon-linkedin', 'momizat-icon-lastfm', 'momizat-icon-lastfm2', 'momizat-icon-delicious', 'momizat-icon-stumbleupon', 'momizat-icon-stumbleupon2', 'momizat-icon-stackoverflow', 'momizat-icon-pinterest', 'momizat-icon-pinterest2', 'momizat-icon-xing', 'momizat-icon-xing2', 'momizat-icon-flattr', 'momizat-icon-foursquare', 'momizat-icon-foursquare2', 'momizat-icon-paypal', 'momizat-icon-paypal2', 'momizat-icon-paypal3', 'momizat-icon-yelp', 'momizat-icon-libreoffice', 'momizat-icon-file-pdf', 'momizat-icon-file-openoffice', 'momizat-icon-file-word', 'momizat-icon-file-excel', 'momizat-icon-file-zip', 'momizat-icon-file-powerpoint', 'momizat-icon-file-xml', 'momizat-icon-file-css', 'momizat-icon-html5', 'momizat-icon-html52', 'momizat-icon-css3', 'momizat-icon-chrome', 'momizat-icon-firefox', 'momizat-icon-IE', 'momizat-icon-opera', 'momizat-icon-safari', 'momizat-icon-IcoMoon', 'enotype-icon-phone',
'enotype-icon-mobile',
'enotype-icon-mouse',
'enotype-icon-directions',
'enotype-icon-mail',
'enotype-icon-paperplane',
'enotype-icon-pencil',
'enotype-icon-feather',
'enotype-icon-paperclip',
'enotype-icon-drawer',
'enotype-icon-reply',
'enotype-icon-reply-all',
'enotype-icon-forward',
'enotype-icon-user',
'enotype-icon-users',
'enotype-icon-user-add',
'enotype-icon-vcard',
'enotype-icon-export',
'enotype-icon-location',
'enotype-icon-map',
'enotype-icon-compass',
'enotype-icon-location2',
'enotype-icon-target',
'enotype-icon-share',
'enotype-icon-sharable',
'enotype-icon-heart',
'enotype-icon-heart2',
'enotype-icon-star',
'enotype-icon-star2',
'enotype-icon-thumbs-up',
'enotype-icon-thumbs-down',
'enotype-icon-chat',
'enotype-icon-comment',
'enotype-icon-quote',
'enotype-icon-house',
'enotype-icon-popup',
'enotype-icon-search',
'enotype-icon-flashlight',
'enotype-icon-printer',
'enotype-icon-bell',
'enotype-icon-link',
'enotype-icon-flag',
'enotype-icon-cog',
'enotype-icon-tools',
'enotype-icon-trophy',
'enotype-icon-tag',
'enotype-icon-camera',
'enotype-icon-megaphone',
'enotype-icon-moon',
'enotype-icon-palette',
'enotype-icon-leaf',
'enotype-icon-music',
'enotype-icon-music2',
'enotype-icon-new',
'enotype-icon-graduation',
'enotype-icon-book',
'enotype-icon-newspaper',
'enotype-icon-bag',
'enotype-icon-airplane',
'enotype-icon-lifebuoy',
'enotype-icon-eye',
'enotype-icon-clock',
'enotype-icon-microphone',
'enotype-icon-calendar',
'enotype-icon-bolt',
'enotype-icon-thunder',
'enotype-icon-droplet',
'enotype-icon-cd',
'enotype-icon-briefcase',
'enotype-icon-air',
'enotype-icon-hourglass',
'enotype-icon-gauge',
'enotype-icon-language',
'enotype-icon-network',
'enotype-icon-key',
'enotype-icon-battery',
'enotype-icon-bucket',
'enotype-icon-magnet',
'enotype-icon-drive',
'enotype-icon-cup',
'enotype-icon-rocket',
'enotype-icon-brush',
'enotype-icon-suitcase',
'enotype-icon-cone',
'enotype-icon-earth',
'enotype-icon-keyboard',
'enotype-icon-browser',
'enotype-icon-publish',
'enotype-icon-progress-3',
'enotype-icon-progress-2',
'enotype-icon-brogress-1',
'enotype-icon-progress-0',
'enotype-icon-sun',
'enotype-icon-sun2',
'enotype-icon-adjust',
'enotype-icon-code',
'enotype-icon-screen',
'enotype-icon-infinity',
'enotype-icon-light-bulb',
'enotype-icon-credit-card',
'enotype-icon-database',
'enotype-icon-voicemail',
'enotype-icon-clipboard',
'enotype-icon-cart',
'enotype-icon-box',
'enotype-icon-ticket',
'enotype-icon-rss',
'enotype-icon-signal',
'enotype-icon-thermometer',
'enotype-icon-droplets',
'enotype-icon-uniE66E',
'enotype-icon-statistics',
'enotype-icon-pie',
'enotype-icon-bars',
'enotype-icon-graph',
'enotype-icon-lock',
'enotype-icon-lock-open',
'enotype-icon-logout',
'enotype-icon-login',
'enotype-icon-checkmark',
'enotype-icon-cross',
'enotype-icon-minus',
'enotype-icon-plus',
'enotype-icon-cross2',
'enotype-icon-minus2',
'enotype-icon-plus2',
'enotype-icon-cross3',
'enotype-icon-minus3',
'enotype-icon-plus3',
'enotype-icon-erase',
'enotype-icon-blocked',
'enotype-icon-info',
'enotype-icon-info2',
'enotype-icon-question',
'enotype-icon-help',
'enotype-icon-warning',
'enotype-icon-cycle',
'enotype-icon-cw',
'enotype-icon-ccw',
'enotype-icon-shuffle',
'enotype-icon-arrow',
'enotype-icon-arrow2',
'enotype-icon-retweet',
'enotype-icon-loop',
'enotype-icon-history',
'enotype-icon-back',
'enotype-icon-switch',
'enotype-icon-list',
'enotype-icon-add-to-list',
'enotype-icon-layout',
'enotype-icon-list2',
'enotype-icon-text',
'enotype-icon-text2',
'enotype-icon-document',
'enotype-icon-docs',
'enotype-icon-landscape',
'enotype-icon-pictures',
'enotype-icon-video',
'enotype-icon-music3',
'enotype-icon-folder',
'enotype-icon-archive',
'enotype-icon-trash',
'enotype-icon-upload',
'enotype-icon-download',
'enotype-icon-disk',
'enotype-icon-install',
'enotype-icon-cloud',
'enotype-icon-upload2',
'enotype-icon-bookmark',
'enotype-icon-bookmarks',
'enotype-icon-book2',
'enotype-icon-play',
'enotype-icon-pause',
'enotype-icon-record',
'enotype-icon-stop',
'enotype-icon-next',
'enotype-icon-previous',
'enotype-icon-first',
'enotype-icon-last',
'enotype-icon-resize-enlarge',
'enotype-icon-resize-shrink',
'enotype-icon-volume',
'enotype-icon-sound',
'enotype-icon-mute',
'enotype-icon-flow-cascade',
'enotype-icon-flow-branch',
'enotype-icon-flow-tree',
'enotype-icon-flow-line',
'enotype-icon-flow-parallel',
'enotype-icon-arrow-left',
'enotype-icon-arrow-down',
'enotype-icon-arrow-up--upload',
'enotype-icon-arrow-right',
'enotype-icon-arrow-left2',
'enotype-icon-arrow-down2',
'enotype-icon-arrow-up',
'enotype-icon-arrow-right2',
'enotype-icon-arrow-left3',
'enotype-icon-arrow-down3',
'enotype-icon-arrow-up2',
'enotype-icon-arrow-right3',
'enotype-icon-arrow-left4',
'enotype-icon-arrow-down4',
'enotype-icon-arrow-up3',
'enotype-icon-arrow-right4',
'enotype-icon-arrow-left5',
'enotype-icon-arrow-down5',
'enotype-icon-arrow-up4',
'enotype-icon-arrow-right5',
'enotype-icon-arrow-left6',
'enotype-icon-arrow-down6',
'enotype-icon-arrow-up5',
'enotype-icon-arrow-right6',
'enotype-icon-arrow-left7',
'enotype-icon-arrow-down7',
'enotype-icon-arrow-up6',
'enotype-icon-uniE6D8',
'enotype-icon-arrow-left8',
'enotype-icon-arrow-down8',
'enotype-icon-arrow-up7',
'enotype-icon-arrow-right7',
'enotype-icon-menu',
'enotype-icon-ellipsis',
'enotype-icon-dots',
'enotype-icon-dot',
'enotype-icon-cc',
'enotype-icon-cc-by',
'enotype-icon-cc-nc',
'enotype-icon-cc-nc-eu',
'enotype-icon-cc-nc-jp',
'enotype-icon-cc-sa',
'enotype-icon-cc-nd',
'enotype-icon-cc-pd',
'enotype-icon-cc-zero',
'enotype-icon-cc-share',
'enotype-icon-cc-share2',
'enotype-icon-daniel-bruce',
'enotype-icon-daniel-bruce2',
'enotype-icon-github',
'enotype-icon-github2',
'enotype-icon-flickr',
'enotype-icon-flickr2',
'enotype-icon-vimeo',
'enotype-icon-vimeo2',
'enotype-icon-twitter',
'enotype-icon-twitter2',
'enotype-icon-facebook',
'enotype-icon-facebook2',
'enotype-icon-facebook3',
'enotype-icon-googleplus',
'enotype-icon-googleplus2',
'enotype-icon-pinterest',
'enotype-icon-pinterest2',
'enotype-icon-tumblr',
'enotype-icon-tumblr2',
'enotype-icon-linkedin',
'enotype-icon-linkedin2',
'enotype-icon-dribbble',
'enotype-icon-dribbble2',
'enotype-icon-stumbleupon',
'enotype-icon-stumbleupon2',
'enotype-icon-lastfm',
'enotype-icon-lastfm2',
'enotype-icon-rdio',
'enotype-icon-rdio2',
'enotype-icon-spotify',
'enotype-icon-spotify2',
'enotype-icon-qq',
'enotype-icon-instagram',
'enotype-icon-dropbox',
'enotype-icon-evernote',
'enotype-icon-flattr',
'enotype-icon-skype',
'enotype-icon-skype2',
'enotype-icon-renren',
'enotype-icon-sina-weibo',
'enotype-icon-paypal',
'enotype-icon-picasa',
'enotype-icon-soundcloud',
'enotype-icon-mixi',
'enotype-icon-behance',
'enotype-icon-circles',
'enotype-icon-vk',
'enotype-icon-smashing','brankic-icon-number',
'brankic-icon-number2',
'brankic-icon-number3',
'brankic-icon-number4',
'brankic-icon-number5',
'brankic-icon-number6',
'brankic-icon-number7',
'brankic-icon-number8',
'brankic-icon-number9',
'brankic-icon-number10',
'brankic-icon-number11',
'brankic-icon-number12',
'brankic-icon-number13',
'brankic-icon-number14',
'brankic-icon-number15',
'brankic-icon-number16',
'brankic-icon-number17',
'brankic-icon-number18',
'brankic-icon-number19',
'brankic-icon-number20',
'brankic-icon-quote',
'brankic-icon-quote2',
'brankic-icon-tag',
'brankic-icon-tag2',
'brankic-icon-link',
'brankic-icon-link2',
'brankic-icon-cabinet',
'brankic-icon-cabinet2',
'brankic-icon-calendar',
'brankic-icon-calendar2',
'brankic-icon-calendar3',
'brankic-icon-file',
'brankic-icon-file2',
'brankic-icon-file3',
'brankic-icon-files',
'brankic-icon-phone',
'brankic-icon-tablet',
'brankic-icon-window',
'brankic-icon-monitor',
'brankic-icon-ipod',
'brankic-icon-tv',
'brankic-icon-camera',
'brankic-icon-camera2',
'brankic-icon-camera3',
'brankic-icon-film',
'brankic-icon-film2',
'brankic-icon-film3',
'brankic-icon-microphone',
'brankic-icon-microphone2',
'brankic-icon-microphone3',
'brankic-icon-drink',
'brankic-icon-drink2',
'brankic-icon-drink3',
'brankic-icon-drink4',
'brankic-icon-coffee',
'brankic-icon-mug',
'brankic-icon-ice-cream',
'brankic-icon-cake',
'brankic-icon-inbox',
'brankic-icon-download',
'brankic-icon-upload',
'brankic-icon-inbox2',
'brankic-icon-checkmark',
'brankic-icon-checkmark2',
'brankic-icon-cancel',
'brankic-icon-cancel2',
'brankic-icon-plus',
'brankic-icon-plus2',
'brankic-icon-minus',
'brankic-icon-minus2',
'brankic-icon-notice',
'brankic-icon-notice2',
'brankic-icon-cog',
'brankic-icon-cogs',
'brankic-icon-cog2',
'brankic-icon-warning',
'brankic-icon-health',
'brankic-icon-suitcase',
'brankic-icon-suitcase2',
'brankic-icon-suitcase3',
'brankic-icon-picture',
'brankic-icon-pictures',
'brankic-icon-pictures2',
'brankic-icon-android',
'brankic-icon-marvin',
'brankic-icon-pacman',
'brankic-icon-cassette',
'brankic-icon-watch',
'brankic-icon-chronometer',
'brankic-icon-watch2',
'brankic-icon-alarm-clock',
'brankic-icon-time',
'brankic-icon-time2',
'brankic-icon-headphones',
'brankic-icon-wallet',
'brankic-icon-checkmark3',
'brankic-icon-cancel3',
'brankic-icon-eye',
'brankic-icon-position',
'brankic-icon-site-map',
'brankic-icon-site-map2',
'brankic-icon-cloud',
'brankic-icon-upload2',
'brankic-icon-chart',
'brankic-icon-chart2',
'brankic-icon-chart3',
'brankic-icon-chart4',
'brankic-icon-chart5',
'brankic-icon-chart6',
'brankic-icon-location',
'brankic-icon-download2',
'brankic-icon-basket',
'brankic-icon-folder',
'brankic-icon-gamepad',
'brankic-icon-alarm',
'brankic-icon-alarm-cancel',
'brankic-icon-phone2',
'brankic-icon-phone3',
'brankic-icon-image',
'brankic-icon-open',
'brankic-icon-sale',
'brankic-icon-direction',
'brankic-icon-map',
'brankic-icon-trashcan',
'brankic-icon-vote',
'brankic-icon-graduate',
'brankic-icon-lab',
'brankic-icon-tie',
'brankic-icon-football',
'brankic-icon-eight-ball',
'brankic-icon-bowling',
'brankic-icon-bowling-pin',
'brankic-icon-baseball',
'brankic-icon-soccer',
'brankic-icon-3d-glasses',
'brankic-icon-microwave',
'brankic-icon-refrigerator',
'brankic-icon-oven',
'brankic-icon-washing-machine',
'brankic-icon-mouse',
'brankic-icon-smiley',
'brankic-icon-sad',
'brankic-icon-mute',
'brankic-icon-hand',
'brankic-icon-radio',
'brankic-icon-satellite',
'brankic-icon-medal',
'brankic-icon-medal2',
'brankic-icon-switch',
'brankic-icon-key',
'brankic-icon-cord',
'brankic-icon-locked',
'brankic-icon-unlocked',
'brankic-icon-locked2',
'brankic-icon-unlocked2',
'brankic-icon-magnifier',
'brankic-icon-zoom-in',
'brankic-icon-zoom-out',
'brankic-icon-stack',
'brankic-icon-stack2',
'brankic-icon-stack3',
'brankic-icon-moon-andstar',
'brankic-icon-transformers',
'brankic-icon-batman',
'brankic-icon-space-invaders',
'brankic-icon-skeletor',
'brankic-icon-lamp',
'brankic-icon-lamp2',
'brankic-icon-umbrella',
'brankic-icon-street-light',
'brankic-icon-bomb',
'brankic-icon-archive',
'brankic-icon-battery',
'brankic-icon-battery2',
'brankic-icon-battery3',
'brankic-icon-battery4',
'brankic-icon-battery5',
'brankic-icon-megaphone',
'brankic-icon-megaphone2',
'brankic-icon-patch',
'brankic-icon-pil',
'brankic-icon-injection',
'brankic-icon-thermometer',
'brankic-icon-lamp3',
'brankic-icon-lamp4',
'brankic-icon-lamp5',
'brankic-icon-cube',
'brankic-icon-box',
'brankic-icon-box2',
'brankic-icon-diamond',
'brankic-icon-bag',
'brankic-icon-money-bag',
'brankic-icon-grid',
'brankic-icon-grid2',
'brankic-icon-list',
'brankic-icon-list2',
'brankic-icon-ruler',
'brankic-icon-ruler2',
'brankic-icon-layout',
'brankic-icon-layout2',
'brankic-icon-layout3',
'brankic-icon-layout4',
'brankic-icon-layout5',
'brankic-icon-layout6',
'brankic-icon-layout7',
'brankic-icon-layout8',
'brankic-icon-layout9',
'brankic-icon-layout10',
'brankic-icon-layout11',
'brankic-icon-layout12',
'brankic-icon-layout13',
'brankic-icon-layout14',
'brankic-icon-tools',
'brankic-icon-screwdriver',
'brankic-icon-paint',
'brankic-icon-hammer',
'brankic-icon-brush',
'brankic-icon-pen',
'brankic-icon-chat',
'brankic-icon-comments',
'brankic-icon-chat2',
'brankic-icon-chat3',
'brankic-icon-volume',
'brankic-icon-volume2',
'brankic-icon-volume3',
'brankic-icon-equalizer',
'brankic-icon-resize',
'brankic-icon-resize2',
'brankic-icon-stretch',
'brankic-icon-narrow',
'brankic-icon-resize3',
'brankic-icon-download3',
'brankic-icon-calculator',
'brankic-icon-library',
'brankic-icon-auction',
'brankic-icon-justice',
'brankic-icon-stats',
'brankic-icon-stats2',
'brankic-icon-attachment',
'brankic-icon-hourglass',
'brankic-icon-abacus',
'brankic-icon-pencil',
'brankic-icon-pen2',
'brankic-icon-pin',
'brankic-icon-pin2',
'brankic-icon-discout',
'brankic-icon-edit',
'brankic-icon-scissors',
'brankic-icon-profile',
'brankic-icon-profile2',
'brankic-icon-profile3',
'brankic-icon-rotate',
'brankic-icon-rotate2',
'brankic-icon-reply',
'brankic-icon-forward',
'brankic-icon-retweet',
'brankic-icon-shuffle',
'brankic-icon-loop',
'brankic-icon-crop',
'brankic-icon-square',
'brankic-icon-square2',
'brankic-icon-circle',
'brankic-icon-dollar',
'brankic-icon-dollar2',
'brankic-icon-coins',
'brankic-icon-pig',
'brankic-icon-bookmark',
'brankic-icon-bookmark2',
'brankic-icon-address-book',
'brankic-icon-address-book2',
'brankic-icon-safe',
'brankic-icon-envelope',
'brankic-icon-envelope2',
'brankic-icon-radio-active',
'brankic-icon-music',
'brankic-icon-presentation',
'brankic-icon-male',
'brankic-icon-female',
'brankic-icon-aids',
'brankic-icon-heart',
'brankic-icon-info',
'brankic-icon-info2',
'brankic-icon-piano',
'brankic-icon-rain',
'brankic-icon-snow',
'brankic-icon-lightning',
'brankic-icon-sun',
'brankic-icon-moon',
'brankic-icon-cloudy',
'brankic-icon-cloudy2',
'brankic-icon-car',
'brankic-icon-bike',
'brankic-icon-truck',
'brankic-icon-bus',
'brankic-icon-bike2',
'brankic-icon-plane',
'brankic-icon-paper-plane',
'brankic-icon-rocket',
'brankic-icon-book',
'brankic-icon-book2',
'brankic-icon-barcode',
'brankic-icon-barcode2',
'brankic-icon-expand',
'brankic-icon-collapse',
'brankic-icon-pop-out',
'brankic-icon-pop-in',
'brankic-icon-target',
'brankic-icon-badge',
'brankic-icon-badge2',
'brankic-icon-ticket',
'brankic-icon-ticket2',
'brankic-icon-ticket3',
'brankic-icon-microphone4',
'brankic-icon-cone',
'brankic-icon-blocked',
'brankic-icon-stop',
'brankic-icon-keyboard',
'brankic-icon-keyboard2',
'brankic-icon-radio2',
'brankic-icon-printer',
'brankic-icon-checked',
'brankic-icon-error',
'brankic-icon-add',
'brankic-icon-minus3',
'brankic-icon-alert',
'brankic-icon-pictures3',
'brankic-icon-atom',
'brankic-icon-eyedropper',
'brankic-icon-globe',
'brankic-icon-globe2',
'brankic-icon-shipping',
'brankic-icon-ying-yang',
'brankic-icon-compass',
'brankic-icon-zip',
'brankic-icon-zip2',
'brankic-icon-anchor',
'brankic-icon-locked-heart',
'brankic-icon-magnet',
'brankic-icon-navigation',
'brankic-icon-tags',
'brankic-icon-heart2',
'brankic-icon-heart3',
'brankic-icon-usb',
'brankic-icon-clipboard',
'brankic-icon-clipboard2',
'brankic-icon-clipboard3',
'brankic-icon-switch2',
'brankic-icon-ruler3','linecon-icon-heart',
'linecon-icon-cloud',
'linecon-icon-star',
'linecon-icon-tv',
'linecon-icon-sound',
'linecon-icon-video',
'linecon-icon-trash',
'linecon-icon-user',
'linecon-icon-key',
'linecon-icon-search',
'linecon-icon-settings',
'linecon-icon-camera',
'linecon-icon-tag',
'linecon-icon-lock',
'linecon-icon-bulb',
'linecon-icon-pen',
'linecon-icon-diamond',
'linecon-icon-display',
'linecon-icon-location',
'linecon-icon-eye',
'linecon-icon-bubble',
'linecon-icon-stack',
'linecon-icon-cup',
'linecon-icon-phone',
'linecon-icon-news',
'linecon-icon-mail',
'linecon-icon-like',
'linecon-icon-photo',
'linecon-icon-note',
'linecon-icon-clock',
'linecon-icon-paperplane',
'linecon-icon-params',
'linecon-icon-banknote',
'linecon-icon-data',
'linecon-icon-music',
'linecon-icon-megaphone',
'linecon-icon-study',
'linecon-icon-lab',
'linecon-icon-food',
'linecon-icon-t-shirt',
'linecon-icon-fire',
'linecon-icon-clip',
'linecon-icon-shop',
'linecon-icon-calendar',
'linecon-icon-wallet',
'linecon-icon-vynil',
'linecon-icon-truck',
'linecon-icon-world','steady-icon-type',
'steady-icon-box',
'steady-icon-archive',
'steady-icon-envelope',
'steady-icon-email',
'steady-icon-files',
'steady-icon-uniE606',
'steady-icon-file-settings',
'steady-icon-file-add',
'steady-icon-file',
'steady-icon-align-left',
'steady-icon-align-right',
'steady-icon-align-center',
'steady-icon-align-justify',
'steady-icon-file-broken',
'steady-icon-browser',
'steady-icon-windows',
'steady-icon-window',
'steady-icon-folder',
'steady-icon-folder-add',
'steady-icon-folder-settings',
'steady-icon-folder-check',
'steady-icon-wifi-low',
'steady-icon-wifi-mid',
'steady-icon-wifi-full',
'steady-icon-connection-empty',
'steady-icon-connection-25',
'steady-icon-connection-50',
'steady-icon-connection-75',
'steady-icon-connection-full',
'steady-icon-list',
'steady-icon-grid',
'steady-icon-uniE620',
'steady-icon-battery-charging',
'steady-icon-battery-empty',
'steady-icon-battery-25',
'steady-icon-battery-50',
'steady-icon-battery-75',
'steady-icon-battery-full',
'steady-icon-settings',
'steady-icon-arrow-left',
'steady-icon-arrow-up',
'steady-icon-arrow-down',
'steady-icon-arrow-right',
'steady-icon-reload',
'steady-icon-refresh',
'steady-icon-volume',
'steady-icon-volume-increase',
'steady-icon-volume-decrease',
'steady-icon-mute',
'steady-icon-microphone',
'steady-icon-microphone-off',
'steady-icon-book',
'steady-icon-checkmark',
'steady-icon-checkbox-checked',
'steady-icon-checkbox',
'steady-icon-paperclip',
'steady-icon-download',
'steady-icon-tag',
'steady-icon-trashcan',
'steady-icon-search',
'steady-icon-zoom-in',
'steady-icon-zoom-out',
'steady-icon-chat',
'steady-icon-chat-1',
'steady-icon-chat-2',
'steady-icon-chat-3',
'steady-icon-comment',
'steady-icon-calendar',
'steady-icon-bookmark',
'steady-icon-email2',
'steady-icon-heart',
'steady-icon-enter',
'steady-icon-cloud',
'steady-icon-book2',
'steady-icon-star',
'steady-icon-clock',
'steady-icon-printer',
'steady-icon-home',
'steady-icon-flag',
'steady-icon-meter',
'steady-icon-switch',
'steady-icon-forbidden',
'steady-icon-lock',
'steady-icon-unlocked',
'steady-icon-unlocked2',
'steady-icon-users',
'steady-icon-user',
'steady-icon-users2',
'steady-icon-user2',
'steady-icon-bullhorn',
'steady-icon-share',
'steady-icon-screen',
'steady-icon-phone',
'steady-icon-phone-portrait',
'steady-icon-phone-landscape',
'steady-icon-tablet',
'steady-icon-tablet-landscape',
'steady-icon-laptop',
'steady-icon-camera',
'steady-icon-microwave-oven',
'steady-icon-credit-cards',
'steady-icon-calculator',
'steady-icon-bag',
'steady-icon-diamond',
'steady-icon-drink',
'steady-icon-shorts',
'steady-icon-vcard',
'steady-icon-sun',
'steady-icon-bill',
'steady-icon-coffee',
'steady-icon-uniE66F',
'steady-icon-newspaper',
'steady-icon-stack',
'steady-icon-map-marker',
'steady-icon-map',
'steady-icon-support',
'steady-icon-uniE675',
'steady-icon-barbell',
'steady-icon-stopwatch',
'steady-icon-atom',
'steady-icon-syringe',
'steady-icon-health',
'steady-icon-bolt',
'steady-icon-pill',
'steady-icon-bones',
'steady-icon-lab',
'steady-icon-clipboard',
'steady-icon-mug',
'steady-icon-bucket',
'steady-icon-select',
'steady-icon-graph',
'steady-icon-crop',
'steady-icon-image',
'steady-icon-cube',
'steady-icon-bars',
'steady-icon-chart',
'steady-icon-pencil',
'steady-icon-measure',
'steady-icon-eyedropper');
	//momizat icons
	return $icons;

}
