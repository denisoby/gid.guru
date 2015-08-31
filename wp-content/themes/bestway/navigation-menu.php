 <?php
		$dd_effect = 'dd-effect-'.mom_option('nav_dd_animation');
		if (mom_option('nav_dd_animation') == '') {
		    $dd_effect = 'dd-effect-slide';
		}
			    $nav_aling = mom_option('nav_align');
	    if (isset($_GET['nav_aling'])) {
	    	$nav_aling = $_GET['nav_aling'];
	    }
		    if ($nav_aling == 'center') {
		    	$nav_aling = ' center-menu';
		    } 

            ?>
		<nav id="navigation" class="<?php echo esc_attr($dd_effect.$nav_aling); ?>">
		    <div class="inner">
		    <?php if ( has_nav_menu( 'main' ) ) { ?>
		    <?php  wp_nav_menu ( array( 'menu_class' => 'nav-menu main-menu','container'=> 'ul', 'theme_location' => 'main' , 'walker' => new mom_custom_Walker()  )); ?>
		    <?php } ?>
		    <?php 
	    $header_style = mom_option('header_style');
	    if (isset($_GET['header_style'])) {
	    	$header_style = $_GET['header_style'];
	    }
		    if ($header_style != 'header_top') { 

		?>
		    <form method="get" class="nav_search_form" action="<?php echo esc_url(home_url()); ?>">
        		<input class="sf nav_sf" type="text" placeholder="<?php _e('Type search keyword and hit enter ...', 'theme'); ?>" autocomplete="off" name="s">
    		</form>
    		<?php
    			    $search = mom_option('nav_shearch_icon');
				    if (isset($_GET['search'])) {
				    	$search = $_GET['search'];
				    }
				    if ($search == 1) { 
    		?>
		      <a href="#" class="nav_search"><i class="fa-search"></i></a>
		    <?php 
		    	}
		    ?>

		      <?php } ?>
		    </div>
		    
		    <div class="clear"></div>
    
		</nav><!--End Navigation-->
		<nav id="responsive_menu">
		    <div class="inner">
			    
			<?php if ( has_nav_menu( 'responsive' ) ) { ?>
	
		    <div class="responsive-menu-wrap">
	
			<a href="#" class="expand-menu"> <i class="bt-icon-align-justify"></i></a>
				    <a href="#" class="responsive-search"><i class="momizat-icon-search"></i></a>

		    <?php  wp_nav_menu ( array( 'menu_class' => 'responsive-menu in_navigation','container'=> 'ul', 'theme_location' => 'responsive', 'walker' => new mom_mobile_custom_walker()  )); ?>
			</div>
	
	
		    <?php } ?>
		    </div>
		<div class="clear"></div>
		</nav>