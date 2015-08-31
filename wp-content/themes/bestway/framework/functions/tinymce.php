<?php
//Tinymce
function mom_tinymce_script() {
	  global $pagenow, $typenow;
  if (empty($typenow) && !empty($_GET['post'])) {
    $post = get_post($_GET['post']);
    $typenow = $post->post_type;
  }
    if ($pagenow=='post-new.php' OR $pagenow=='post.php') { 
global $wpdb;
$cats = get_terms("category");
$tags = get_terms("post_tag");
$formats = get_theme_support( 'post-formats' );

$faces = mom_google_fonts();
// Get ads
$ads = get_posts('post_type=ads&posts_per_page=-1');
if ($pagenow=='post-new.php' OR $pagenow=='post.php') {
      $the_id = get_the_ID();  
} else {
    $the_id = '';  
}
?>
<script type="text/javascript">
post_id = '<?php echo get_the_ID(); ?>';
mom_url = '<?php echo esc_url(MOM_URI); ?>';
$ptcats = '';
$cats = '<?php 
        foreach ( $cats as $cat ) {
        echo '<option value="'.esc_attr($cat->term_id).'">' . esc_attr($cat->name) . '</option>';
        }
?>';

$tags = '<?php 
        foreach ( $tags as $tag ) {
        echo '<option value="'.esc_attr($tag->term_id).'">' . esc_attr($tag->name) . '</option>';
        }
?>';
$formats = '<?php 
        foreach ( $formats[0] as $format ) {
        echo '<option value="'.esc_attr($format).'">' . esc_attr($format) . '</option>';
        }
?>';

$faces = '<?php 
        foreach ( $faces as $key => $face ) {
        echo '<option value="'.esc_attr($key).'">' . $face . '</option>';
        }
?>';

$ads = '<?php 
foreach($ads as $item) {
        echo '<option value="'.esc_attr($item->ID).'">' . esc_attr($item->post_title) . '</option>';
        }
    ?>';

</script>
<?php
}
}
add_action( 'in_admin_footer', 'mom_tinymce_script' );