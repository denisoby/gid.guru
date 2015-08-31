                <div id="widget_area_wrap" class="sidebar sidebar_area">
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
            </div>