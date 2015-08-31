<?php 
    $footer_color = mom_option('footer_color');
    $instagram_position = mom_option('instagram_position');
    if (isset($_GET['footer_color'])) {
        $footer_color = $_GET['footer_color'];
    }
    if (isset($_GET['instagram_position'])) {
        $instagram_position = $_GET['instagram_position'];
    }

?>
<?php if ($instagram_position == 0) get_template_part('instagram', 'widget'); ?>
<?php 
if ($footer_color == 'light') {
    if (mom_option('hide_footer_widgets') == true ) {
        get_template_part('widget', 'area'); 
    }
}
?>
<?php 
if ($footer_color == 'dark') {
    if (mom_option('hide_footer_widgets') == true ) { ?>  
                <footer id="footer">
		<div class="inner">
                <?php $footer_layout = mom_option('footer_layout'); if ( $footer_layout == 'third') { ?>
			<div class="mom_column one_third">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>

                        </div><!-- End third col -->
                        <div class="mom_column one_third">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div><!-- End third col -->
                        <div class="mom_column one_third last">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>

                        </div><!-- End third col -->
            <?php } elseif ($footer_layout == 'one') { ?>
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
            <?php } elseif ($footer_layout == 'one_half') { ?>
                        <div class="mom_column one_half">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_half last">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>
            <?php } elseif ($footer_layout == 'fourth') { ?>
                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fourth last">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>
            <?php } elseif ($footer_layout == 'fifth') { ?>
                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_fifth last">
                <?php 
                    if ( is_active_sidebar( 'footer5' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { } 
                    }
                ?>
                        </div>
            <?php } elseif ($footer_layout == 'sixth') { ?>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer5' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { } 
                    }
                ?>
                        </div>
                        <div class="mom_column one_sixth last">
                <?php 
                    if ( is_active_sidebar( 'footer6' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer6')){ }else { } 
                    }
                ?>
                        </div>

            <?php } elseif ($footer_layout == 'half_twop') { ?>
                        <div class="mom_column one_half" style="margin-right: 3%;">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fourth last">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>
            
            <?php } elseif ($footer_layout == 'twop_half') { ?>
                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fourth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_half last">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

            <?php } elseif ($footer_layout == 'half_threep') { ?>
                        <div class="mom_column one_half">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth last">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>
            <?php } elseif ($footer_layout == 'threep_half') { ?>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_half last">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>

            <?php } elseif ($footer_layout == 'third_threep') { ?>
                        <div class="mom_column one_third">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fifth last">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>


            <?php } elseif ($footer_layout == 'threep_third') { ?>

                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_fifth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>
                        
                        <div class="mom_column one_third last">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>

            <?php } elseif ($footer_layout == 'third_fourp') { ?>
                        <div class="mom_column one_third">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth last">
                <?php 
                    if ( is_active_sidebar( 'footer5' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { } 
                    }
                ?>
                        </div>


            <?php } elseif ($footer_layout == 'fourp_third') { ?>
                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer1' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer2' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer3' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { } 
                    }
                ?>
                        </div>

                        <div class="mom_column one_sixth">
                <?php 
                    if ( is_active_sidebar( 'footer4' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { } 
                    }
                ?>
                        </div>
            
            <div class="mom_column one_third last">
                <?php 
                    if ( is_active_sidebar( 'footer5' ) ) {
                        if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { } 
                    }
                ?>
                        </div>

            <?php } ?>
            <div class="clear"></div>
	</div>
            </footer>
<?php } } ?>
<?php if ($instagram_position == 1) get_template_part('instagram', 'widget'); ?>

<?php if (mom_option('hide_footer_c') == true ) { ?>  
	    <div class="copyright">
                <div class="inner">
		    <?php get_template_part('mom', 'social'); ?> 
                    <p><?php
                    if (mom_option('copyrights') != '') {
				if(function_exists('icl_register_string')) {
					icl_register_string('Theme Options', 'Footer Copyrights', mom_option('copyrights'));
					echo icl_t('Theme Options', 'Footer Copyrights', do_shortcode(mom_option('copyrights')));
				} else {
					echo do_shortcode(mom_option('copyrights'));
				}	
            } else {
                echo '&copy; 2015 - '.get_bloginfo('title').' <a href="http://www.themelions.com/" target="_blank">Designed & Developed by Theme Lions</a>';
            }
			    
			    ?></p>
                </div><!--End Inner-->
            </div><!--End Copyright-->
	    <?php } ?>
	</div><!--End Wrap-->
	<?php echo mom_option('footer_script'); ?>
        <?php wp_footer(); ?>
    </body>
</html>