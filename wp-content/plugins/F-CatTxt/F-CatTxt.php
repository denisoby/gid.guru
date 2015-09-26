<?php
/*
Plugin Name: F-Category Text
Description: Custom category text, custom category SEO, custom category templates, AllInOneSEO patches
Version: 1.4
Author: F-Seo
Author URI: http://f-seo.ru
*/


/*
 * Удаление  - пока не используется 
 * @since 0.1
 */
function fcattxt_uninstall(){
     //действие при удалении
}
/* 
 * добавляем доп. описания (wp_editor)
 * @since 1.0
 */
add_action ( 'edit_category_form_fields', 'extra_category_fields');
function extra_category_fields( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option("category_$t_id");    
    ?>
    <tr>	
        <th scope="row" valign="top"><label for="Descr[top]">Верхнее описание</label></th>
        <td>
            <?php             
                $settings = array(
                    'wpautop' => true, 
                    'media_buttons' => true, 
                    'quicktags' => true, 
                    'textarea_rows' => '15', 
                    'textarea_name' => 'descrtop' 
                );	
                wp_editor(stripslashes($cat_meta['descrtop']), 'descr_descrtop', $settings); 
                submit_button( 'Сохранить' );
            ?>            
            <br /><span class="description">Описание сверху.</span>
        </td>
    </tr>
    <tr>
        <th scope="row" valign="top"><label for="Descr[bottom]">Нижнее описание</label></th>
        <td>
            <?php   
                $settings = array(
                    'wpautop' => true, 
                    'media_buttons' => true, 
                    'quicktags' => true, 
                    'textarea_rows' => '15', 
                    'textarea_name' => 'descrbottom' 
                );	
                wp_editor(stripslashes($cat_meta['descrbottom']), 'descr_descrbottom', $settings); 
                submit_button( 'Сохранить' );
            ?>            
            <br /><span class="description">Описание снизу.</span>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="Descr[cat_comm]">Комментарии</label></th>
        <td>
            <input type="text" name="Descr[cat_comm]" id="Descr[cat_comm]" size="3" style="width:60%;" value="<?php echo $cat_meta['cat_comm'] ? $cat_meta['cat_comm'] : ''; ?>"><br />
            <span class="description">ID записи, из которой подтягиваются комментарии</span>
        </td>
    </tr>   
    <tr class="form-field">
        <th scope="row" valign="top"><label for="Descr[title]">SEO Title</label></th>
        <td>
            <input type="text" name="Descr[title]" id="Descr[title]" size="3" style="width:60%;" value="<?php echo $cat_meta['title'] ? $cat_meta['title'] : ''; ?>"><br />
            <span class="description">Добавьте SEO заголовок тут</span>
        </td>
    </tr>    
    <tr class="form-field">
        <th scope="row" valign="top"><label for="Descr[description]">SEO Description</label></th>
        <td>
            <textarea rows="4" name="Descr[description]" id="Descr[description]" size="3" style="width:60%;" ><?php echo $cat_meta['description'] ? $cat_meta['description'] : ''; ?></textarea><br />
            <span class="description">Добавьте SEO описание тут</span>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="Descr[keywords]">SEO Keywords</label></th>
        <td>
            <input type="text" name="Descr[keywords]" id="Descr[keywords]" size="3" style="width:60%;" value="<?php echo $cat_meta['keywords'] ? $cat_meta['keywords'] : ''; ?>"><br />
            <span class="description">Добавьте SEO ключевые слова тут. Разделяйте слова запятыми</span>
        </td>
    </tr>
    <?php 
}
	
/* 
 * сохраняем при обновлении категории
 * @since 0.1
 * отдельное сохранение описаний с проверкой/добавлением страницы для коментов
 * @since 1.2
 */
add_action ('edited_category', 'save_extra_category_fileds');
function save_extra_category_fileds ($term_id ) {
    if (isset ( $_POST['Descr'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option ( "category_$t_id");
        $cat_keys = array_keys($_POST['Descr']);
            foreach ($cat_keys as $key) {
            if (isset($_POST['Descr'][$key])) {
                $cat_meta[$key] = $_POST['Descr'][$key];
            }
        }        
    }
    if (isset($_POST['descrtop'])):
        if (!$cat_meta['cat_comm']){
            $my_post = array(
                'post_type'     => 'cat_comm',
                'post_title'    => 'Cat comm для категории ' . $t_id,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_author'   => 1,
                
            );
            $p_id = wp_insert_post( $my_post );
            update_post_meta($p_id, '_aioseop_noindex', 'on');
            update_post_meta($p_id, '_aioseop_nofollow', 'on');            
            $cat_meta['cat_comm'] = $p_id;               
        }
        $cat_meta['descrtop'] = $_POST['descrtop'];
        update_post_meta( $cat_meta['cat_comm'], 'term_id', $term_id );
    endif;
    if (isset($_POST['descrbottom'])):
        if (!$cat_meta['cat_comm']){
            $my_post = array(
                'post_type'     => 'cat_comm',
                'post_title'    => 'Cat comm для категории ' . $t_id,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_author'   => 1,
                
            );
            $p_id = wp_insert_post( $my_post );
            update_post_meta($p_id, '_aioseop_noindex', 'on');
            update_post_meta($p_id, '_aioseop_nofollow', 'on');            
            $cat_meta['cat_comm'] = $p_id;                   
        }
        $cat_meta['descrbottom'] = $_POST['descrbottom'];
        update_post_meta( $cat_meta['cat_comm'], 'term_id', $term_id );
    endif;
    update_option( "category_$t_id", $cat_meta );
}

/*
 *  функция вывода верхнего описания
 *  @since 0.1
 *	use wpautop
 *  @since 1.1.1
 *      фильтр для вывода содержания
 *  @since 1.4
 */
function show_descr_top($id) {
    $cat_meta = get_option("category_$id");
    $descr_top = apply_filters( 'show_descr_top', stripslashes($cat_meta['descrtop']) ); //Пример зацепки для функции get_the_title();
    echo '<div class="fseo_cat_descr_top">' . do_shortcode(wpautop( $descr_top )) . '</div>';
}

/* 
 *  функция вывода нижнего описания
 *  @since 0.1
 *  use wpautop
 *  @since 1.1.1
 *  inserting comments
 *  @since 1.2
 *  language
 *  @since 1.3
 */ 
function show_descr_bottom($id) {
    $cat_meta = get_option("category_$id");
    echo '<div class="fseo_cat_descr_bottom">' . do_shortcode(wpautop(stripslashes($cat_meta['descrbottom']))) . '</div>';
    ?>
        <?php 
            $lang = get_bloginfo('language');
            if ($lang == 'en-US') :
        ?>
            <div class="social-likes" style="margin-bottom: 10px;">
                <div class="facebook" title="Share on Facebook">Facebook</div>
                <div class="twitter" title="Share on Twitter">Twitter</div>
                <div class="plusone" title="Share on Google+">Google+</div>
                <div class="pinterest" title="Share image on Pinterest">Pinterest</div>
                <div class="pinterest" title="Share on LinkedIn">LinkedIn</div>   
            </div>
        <?php else: ?>            
            <div class="social-likes" style="margin-bottom: 10px;">
                <div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
                <div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div>
                <div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
                <div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div>
                <div class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</div>            
            </div>
        <?php endif; ?>
    <?php
    wp_reset_query();
    $cat_comm = $cat_meta['cat_comm'];    
    if ($cat_comm!=''):
        $comm_page = new WP_Query ("post_type=cat_comm&p=" . $cat_meta['cat_comm']);
        while ($comm_page->have_posts ()) : $comm_page->the_post (); ?>            
            <?php global $withcomments; $withcomments = true; comments_template( '', true ); ?>            
        <?php endwhile;
    endif;
}

/*
 *  редирект после комментария на ту же страницу
 *  @since 1.2
 */
add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
    return $_SERVER["HTTP_REFERER"] . '#comments';
}

/*
 *  вывод SEO полей description&keywords
 *  @since 1.0
 */
function add_fcat_meta(){  
    if ( is_category() ) :
        $cat_id = get_query_var('cat');
        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $cat_data = get_option("category_$term_id");
        if (isset($cat_data['description'])){ ?>
            <meta name="description" content="<?php echo $cat_data['description']; ?>">       
        <?php }  
        if (isset($cat_data['keywords'])){ ?>
            <meta name="keywords" content="<?php echo $cat_data['keywords']; ?>">
        <?php }  
    endif;
}
add_action('wp_head', 'add_fcat_meta');

/* 
 * замена SEO заголовка от плагина All In One SEO Pack
 * @since 1.0
 */
function add_fcat_title()
{  
    if (is_category()){
        $cat_id = get_query_var('cat');
        $cat_data = get_option("category_$cat_id");
        if (isset($cat_data['title']) && $cat_data['title']!=''){  
            $title = $cat_data['title']; 
            return $title;
        }
        else{
            $current_category = single_cat_title("", false);
            $title = $current_category;
            return $title;
        }
    } 
}
add_filter('aioseop_category_title',add_fcat_title);

/* 
 * убрать нофоллоу у рубрик если есть описание
 * @since 1.1
 */
function remove_noindex_cat()
{
    if (is_category()){
        $cat_id = get_query_var('cat');
        $cat_data = get_option("category_$cat_id");
        if ($cat_data['descrtop']!='' || $cat_data['descrbottom']!=''){
            $robots_meta = 'index, follow';
        }           
        else{
            $robots_meta = 'noindex, nofollow';
        }
    }
    return $robots_meta;
}
add_filter('aioseop_cat_noindex', remove_noindex_cat);

/*
 *  шаблоны для категорий
 *  @since 1.0
 */
class Custom_Category_Templates {
    var $template;
    function __construct() {
            if( is_admin() ) {
                    add_action( 'category_add_form_fieа рlds', array( &$this, 'add_template_option') );
                    add_action( 'category_edit_form_fields', array( &$this, 'edit_template_option') );
                    add_action( 'created_category', array( &$this, 'save_option' ), 10, 2 );
                    add_action( 'edited_category', array( &$this, 'save_option' ), 10, 2 );
                    add_action( 'delete_category', array( &$this, 'delete_option' ) );
            } else {
                    add_filter( 'category_template', array( &$this, 'category_template' ) );
            }
    }
    function category_template( $template ) {
            $category_templates = get_option( 'category_templates', array() );
            $category = get_queried_object();
            $id = $category->term_id;
            $tmpl = locate_template( $category_templates[$id] );
            if( isset( $category_templates[$id] ) && 'default' !== $category_templates[$id] && '' !== $tmpl ) {
                    $this->template = $category_templates[$id];
                    add_filter( 'body_class', array( &$this, 'body_class' ) );
                    return $tmpl;
            }
            return $template;
    }
    function body_class( $classes ) {
            $template = sanitize_html_class( str_replace( '.', '-', $this->template ) );
            $classes[] = 'category-template-' . $template;
            return $classes;
    }
    function save_option( $term_id ) {
            if( isset( $_POST['template'] ) ) {
                    $template = trim( $_POST['template'] );
                    $category_templates = get_option( 'category_templates', array() );
                    if( 'default' == $template ) {
                            unset( $category_templates[$term_id] );
                    } else {
                            $category_templates[$term_id] = $template;
                    }
                    update_option( 'category_templates', $category_templates );
            }
    }
    function add_template_option() { ?>
            <div class="form-field">
                    <label for="template">Шаблон</label>
                    <select name="template" id="template" class="postform">
                            <option value='default'>Стандартный вывод</option>
                            <?php $this->category_templates_dropdown() ?>
                    </select>
                    <p class="description">Выберите шаблон для данной категории</p>
            </div>
    <?php }
    function edit_template_option() {
            $id = $_REQUEST['tag_ID'];
            $templates = get_option( 'category_templates' );
            $template = $templates[$id];
            ?>
            <tr class="form-field">
                    <th scope="row" valign="top">
                            <label for="template">Шаблон</label>
                    </th>
                    <td>
                            <select name="template" id="template" class="postform">
                                    <option value='default'>Стандартный вывод</option>
                                    <?php $this->category_templates_dropdown( $template ) ?>
                            </select>
                            <p class="description">Выберите шаблон для данной категории</p>
                    </td>
            </tr>
    <?php }
    function delete_option( $term_id ) {
            $category_templates = get_option( 'category_templates', array() );
            if( isset( $category_templates[$term_id] ) ) {
                    unset( $category_templates[$term_id] );
                    update_option( 'category_templates', $category_templates );
            }
    }
    /**
     * Генерирует выпадающий список для выбора шаблона категории
     *
     * @since 1.0
     * @return void
     */
    function category_templates_dropdown( $default = null ) {
            $templates = array_flip( $this->get_category_templates() );
            ksort( $templates );
            foreach( array_keys( $templates ) as $template )
                    : if ( $default == $templates[$template] )
                            $selected = " selected='selected'";
                    else
                            $selected = '';
            echo "nt<option value='".$templates[$template]."' $selected>$template</option>";
            endforeach;
    }
    /**
     * Получает список доступных шаблонов категорий в выбранной теме
     *
     * @since 1.0
     * @return array Key - название шаблона, value - название файла шаблона
     */
    function get_category_templates( $template = null ) {
            $category_templates = array();
            $theme = wp_get_theme( $template );
            $files = (array) $theme->get_files( 'php', 1 );

            foreach ( $files as $file => $full_path ) {
                    if ( ! preg_match( '|Category Template:(.*)$|mi', file_get_contents( $full_path ), $header ) )
                            continue;
                    $category_templates[ $file ] = _cleanup_header_comment( $header[1] );
            }

            if ( $theme->parent() )
                    $category_templates += $this->get_category_templates( $theme->get_template() );

            return $category_templates;
	}
}
$custom_category_templates = new Custom_Category_Templates();

/*
 * кастомный тип материалов для комментариев
 * @since 1.2
 */
function catcomm_post_type() {
	$labels = array(
		'name'                => _x( 'Cat Comment', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Cat Comment', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Cat Comment', 'text_domain' ),
		'parent_item_colon'   => __( 'Родитель:', 'text_domain' ),
		'all_items'           => __( 'Cat Comment', 'text_domain' ),
		'view_item'           => __( 'Просмотреть', 'text_domain' ),
		'add_new_item'        => __( 'Добавить', 'text_domain' ),
		'add_new'             => __( 'Добавить', 'text_domain' ),
		'edit_item'           => __( 'Изменить', 'text_domain' ),
		'update_item'         => __( 'Обновить', 'text_domain' ),
		'search_items'        => __( 'Поиск', 'text_domain' ),
		'not_found'           => __( 'Не найдено', 'text_domain' ),
		'not_found_in_trash'  => __( 'Не найдено в корзине', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'cat_comm', 'text_domain' ),
		'description'         => __( 'Post Type Description', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'comments', 'custom-fields' ),
		'hierarchical'        => false,
		'public'              => false,
                'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'cat_comm', $args );

}
add_action( 'init', 'catcomm_post_type', 0 );