jQuery(document ).ready (function ($) {
//share
if ($('.mom_share_buttons').length) {
    $('.mom_share_buttons').data('height',$('.mom_share_buttons').css('height'));
    var curHeight = $('.mom_share_buttons').height();
    $('.mom_share_buttons').css('height', 'auto');
    var autoHeight = $('.mom_share_buttons').height();
    $('.mom_share_buttons').css('height', curHeight);
    $('.mom_share_it .sh_arrow').toggle(function () {
	$('.mom_share_buttons').stop().animate({height: autoHeight}, 300);
	$(this).find('i').removeClass();
	$(this).find('i').addClass('bt-icon-angle-double-up');
    }, function () {
	$('.mom_share_buttons').stop().animate({height: $('.mom_share_buttons').data('height')}, 300);
	$(this).find('i').removeClass();
	$(this).find('i').addClass('bt-icon-angle-double-down');
    });
}
// remove empty p
	$('p, div.slider_item')
	.filter(function() {
	    return $.trim($(this).text()) === '' && $(this).children().length == 0
	})
	.remove();
	
//PlaceHolder
    $('input:not(.ov-sf):not(.nav_sf)').each(function() {
    $(this).data('holder',$(this).attr('placeholder'));
    
    $('input:not(.ov-sf):not(.nav_sf)').focusin(function(){
        $(this).attr('placeholder','');
    });
    $('input:not(.ov-sf):not(.nav_sf)').focusout(function(){
        $(this).attr('placeholder',$(this).data('holder'));
    });
        });
    $('textarea').data('holder',$('textarea').attr('placeholder'));
    
    $('textarea').focusin(function(){
        $(this).attr('placeholder','');
    });
    $('textarea').focusout(function(){
        $(this).attr('placeholder',$(this).data('holder'));
    });
    
 // full width slider 
 $('.inner .feature_slider_full').each(function(index, el) {
 	var des = $('.inner').offset();
 	des = -des.left;
 	$(this).css({
 		marginLeft: des+'px',
 		marginRight: des+'px'
 	});
 });
//HIDPI
var hidpi = window.devicePixelRatio > 1 ? true : false;
if (hidpi) {
	// Replace img src with data-hidpi
	$('img[data-hidpi]').each(function() {
		// If width x height hasn't been set, fill it in
		if ($(this).attr('width') == undefined) {
			$(this).attr('width', $(this).width());
		}
		if ($(this).attr('height') == undefined) {
			$(this).attr('height', $(this).height());
		}
		$(this).attr('src', $(this).data('hidpi'));
	});
}

// Cat Counts
       $('.sidebar li.cat-item, .sidebar .widget_archive li').each(function(){
          var $contents = $(this).contents();
          if ($contents.length > 1)  {
	  $contents.eq(1).wrap('<div class="cat_num"><span class="line"></span></div>');

	  $contents.eq(1).each(function(){
});
	  }
    }).contents();
	    $('.sidebar li.cat-item .cat_num .line, .sidebar .widget_archive li .cat_num .line').each(function () {
	       $(this).html($(this).text().substring(2));
	      $(this).html( $(this).text().replace(/\)/gi, "") );
	    });

if ($('.sidebar li.cat-item').length) {
    $('.sidebar li.cat-item .cat_num .line').each( function() {
	if ($(this).is(':empty')){
	    $(this).parent().hide();
	}
	
    });
}
//Porfolio filter
$('.protfolio_filter ul').each( function() {
	var $this = $(this);
	$this.find('li a').click(function() {
	$this.find('li').removeClass('current');
	$(this).parent().addClass('current');
	});
});
//Tabs
//tabbed widget
    jQuery(".widget_momizattabber").each(function(){
        var ul = jQuery(this).find(".main_tabs ul.tabs");

        jQuery(this).find(".tab-content").each(function() {
            jQuery(this).find('a.mom-tw-title').wrap('<li></li>').parent().detach().appendTo(ul);
        });
    });

// Main Tabs
    if ($(".main_tabs ul.tabs").length) { $("ul.tabs").momtabs("div.tabs-content-wrap > .tab-content", { effect: 'fade'}); }

//toggle sidebar
var origfloat = $('.big_main').css('float');
    $('.toggle_sidebar').on('click', function() {
	//console.log(origfloat);
	if ($(this).hasClass('active')) {
	    $(this).removeClass('active');
	    	$('#sidebar').fadeIn(400);
		$('.big_main').css({
		    'margin': 'auto',
		    'float' : origfloat
		});
	} else {
	    $(this).addClass('active');
	    $('#sidebar').fadeOut(400, function() {
	    	    $('.big_main').css({
		'margin': 'auto',
		'float': 'none'
	    });
	    });
	}
    });
// Search box
	$('.search_box_top .search_icon').on('click', function(e) {
		if (!$(this).hasClass('active')) {
		    $('.topbar .search_box_top .sf').animate({width: 'toggle', padding: '0 10px'}).focus();
		    $(this).addClass('active');
		} else {
			$(this).parent('form').submit();
		}

	});

$('.video_frame').each(function(index, el) {
	var t = $(this);
	var w = t.width();
	h = w/16;
	h = h*9;

	t.find('iframe').css('height', h+'px');
	
});
window.onresize = function(event) {
$('.video_frame').each(function(index, el) {
	var t = $(this);
	var w = t.width();
	h = w/16;
	h = h*9;

	t.find('iframe').css('height', h+'px');
	
});
};

$('.embed-youtube').each(function(index, el) {
	var t = $(this);
	var w = t.width();
	h = w/16;
	h = h*9;

	t.find('iframe').css('height', h+'px');
	
});
window.onresize = function(event) {
$('.embed-youtube').each(function(index, el) {
	var t = $(this);
	var w = t.width();
	h = w/16;
	h = h*9;

	t.find('iframe').css('height', h+'px');
	
});
};
		var transformsEnabled = true;
	    if ($('body').hasClass('rtl')) {
		// modify Isotope's absolute position method
		    $.Isotope.prototype._positionAbs = function( x, y ) {
		      return { right: x, top: y };
		    };
		transformsEnabled = false;


	   }
			var container = $('.portfolio_list');
			container.isotope({
			filter: '*',
			layoutMode : 'fitRows',
			animationOptions: {
			duration: 750,
			easing: 'easeInOutExpo',
                    queue: false,
	      transformsEnabled: transformsEnabled
			}
		});
		$('.protfolio_filter ul li a').click(function(){
			var selector = $(this).attr('data-filter');
			container.isotope({
			filter: selector,
			animationOptions: {
			duration: 750,
			easing: 'easeInOutExpo',
			queue: false,
			  transformsEnabled: transformsEnabled
			
			}});
			return false;
		});


//Icon Colors in hover
jQuery('.iconb_wrap').each(function(index, el) {
		var t = $(this);
		var icon = $(this).find('i');
		var icon_wrap = $(this);
		var $hover = icon.attr('data-hover');
		var $bghover = icon_wrap.attr('data-hover');
		var $bdhover = icon_wrap.attr('data-border_hover');
		var $color = icon.attr('data-color');
		var $origcolor = icon.css('color');
		var $bgcolor = icon_wrap.attr('data-color');
		var $origbg = icon_wrap.css('background-color');
		var $bdcolor = icon_wrap.attr('data-border_color');
		var $origbd = icon_wrap.css('border-color');

	t.hover(function(){
		icon.css("color",$hover);
		icon_wrap.css("background",$bghover);
		icon_wrap.css("border-color",$bdhover);
	},function() {
		if($color!==undefined){
			icon.css("color",$color);
		}else {
			icon.css("color",$origcolor);
		}
		if($bgcolor!==undefined){
			icon_wrap.css("background",$bgcolor);
		}else {
			icon_wrap.css("background",$origbg);
		}
		if($bdcolor!==undefined){
			icon_wrap.css("border-color",$bdcolor);
		}else {
		}
	});
});

//icona
jQuery('.mom_icona').each(function(index, el) {
	var t = $(this);
	var icon = $(this).find('i');
	var icon_wrap = $(this);
	var $hover = icon.attr('data-hover');
	var $bghover = icon_wrap.attr('data-hover');
	var $bdhover = icon_wrap.attr('data-border_hover');
	var $color = icon.attr('data-color');
	var $origcolor = icon.css('color');
	var $bgcolor = icon_wrap.attr('data-color');
	var $origbg = icon_wrap.css('background-color');
	var $bdcolor = icon_wrap.attr('data-border_color');
	var $origbd = icon_wrap.css('border-color');

t.hover(function(){
	icon.css("color",$hover);
	icon_wrap.css("background",$bghover);
	icon_wrap.css("border-color",$bdhover);
},function() {
	if($color!==undefined){
		icon.css("color",$color);
	}else {
		icon.css("color",$origcolor);
	}
	if($bgcolor!==undefined){
		icon_wrap.css("background",$bgcolor);
	}else {
		icon_wrap.css("background",$origbg);
	}
	if($bdcolor!==undefined){
		icon_wrap.css("border-color",$bdcolor);
	}else {
	}
});
});

//Porfolio filter
$('.protfolio_filter ul').each( function() {
	var $this = $(this);
	$this.find('li a').click(function() {
	$this.find('li').removeClass('current');
	$(this).parent().addClass('current');
	});
});

// Categories in footer
$('#footer .widget_categories').children('ul').addClass('two_cols_list');
$('#footer .widget_archive').children('ul').addClass('two_cols_list');

// Gallery
    $(".gallery .gallery-item a").prettyPhoto();

//videos
$('.mom-video-widget').fitVids();

//Responsive
$('a.expand-menu').click(function(e) {
	e.preventDefault();
    $('.responsive-menu').toggle();
});

// share button 
$('.share-wrap a').click(function(e) { e.preventDefault(); });

//Default Gallery
if ($('.gallery .gallery-item').length) {
    $(".gallery .gallery-item a").attr('rel', 'prettyPhoto[pp_gal]');
    $(".gallery .gallery-item a").prettyPhoto(); 
}
//share wp 
$(document).on('touchstart click','span.grid_share',function(e) {
	e.preventDefault();
	var t = $(this);
	console.log(t.attr('class'));
	if (t.hasClass('active')) {
		t.removeClass('active fa-rotate-180');
	} else {
		t.addClass('active fa-rotate-180');
	}
});

//lightbox
if ($('.mom_lightbox').length) { 
$(".mom_lightbox > a").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});
}

//callitout
if ($('.mom_callout').length) {
    $('.mom_callout').each( function () {
	if ($(this).find('.cobtr').length) {
	var btwidth = parseFloat($(this).find('.cobtr').css('width'))+30;
	var btheight = parseFloat($(this).find('.cobtr').css('height'))/2;
	$(this).find('.callout_content').css('margin-right',btwidth+'px');
	$(this).find('.cobtr').css('margin-top', '-'+btheight+'px');
	}
	if ($(this).find('.cobtl').length) {
	var btwidth = parseFloat($(this).find('.cobtl').css('width'))+30;
	var btheight = parseFloat($(this).find('.cobtl').css('height'))/2;
	$(this).find('.callout_content').css('margin-left',btwidth+'px');
	$(this).find('.cobtl').css('margin-top', '-'+btheight+'px');
	}
    });
}

// Search
$('ul.nav-menu > li.search, .responsive-search, .nav-shearch-icon').on('click', function(e) {
    $('.search-overlay').addClass('open');
    $('.search-overlay .sf').focus();
    e.preventDefault();
});

$('.search-overlay .so-close').on('click', function() {
    $('.search-overlay').removeClass('open');
});

/**** slider ****/
var rtl = false;
if ($('body').hasClass('rtl')) {
	rtl = true;
}
$('.feature_wrap').each(function(index, el) {
		var t = $(this);
		var count = t.find('.slider_item').length;
		var loop = true;
		var margin = 4;
		if (t.hasClass('default-slider-wrap')) {
			if (count < 3) {
			loop = false;
			}
			margin = 0;
		}

if (count > 1 || t.hasClass('default-slider-wrap')) {
	t.owlCarousel({
    items:1,
    nav:true,
    dots: false,
    loop:loop,
    rtl: rtl,
    margin:margin,
    smartSpeed:600,
    navText:false,
});
} else {
	t.find('.slider_item').css('display', 'block');
}

});

/**** slider 2****/
$('.feature_wrap_full').each(function(index, el) {
		var t = $(this);
		var count = t.find('.slider_item').length;
		var items = 3;
if ($('body').hasClass('responsive_enabled')) {
            enquire.register("screen and (max-width:1000px)", {
                match : function() {
                   		items = 2;
                },      
                unmatch : function() {
                    items = 3;
                },    
                  
            });
}

if (count > 1) {
t.owlCarousel({
    navigation : false,
    items : items,
    loop:true,
    rtl: rtl,
    smartSpeed:600,
    slideBy:items,
});
} else {
	t.find('.slider_item').css('display', 'block');
}

});
/**** slider 2****/
$('.feature_grid_wrap').each(function(index, el) {
		var t = $(this);
		var count = t.find('.slider_item').length;
		//console.log(count);

if (count > 1) {
	t.owlCarousel({
	    items:1,
	    nav:true,
	    dots: false,
	    loop:true,
    rtl: rtl,
	    margin:5,
	    smartSpeed:600,
	    navText:false,
	});
} else {
	t.find('.slider_item').css('display', 'block');
}
});

$('.responsive-menu > li > .responsive-caret').parent().children('a').on('click', function(e) {
		if (!$(this).parent().hasClass('active')) {
			e.preventDefault();
		}
		$(this).parent().find('ul').toggle();
		$(this).parent().toggleClass('active');
});
$('.responsive-menu > li > .responsive-caret').on('click', function(e) {
		$(this).parent().find('ul').toggle();
		$(this).parent().toggleClass('active');
});

	$('.nav_search').on('click', function(e) {
	    	$('.nav_search_form').toggleClass('active');
			setTimeout(function(){
			    $('.nav_search_form input.nav_sf').focus();
			}, 350);
			e.preventDefault();
			e.stopPropagation();
	});
	$('.nav_search_form').on('click', function(e) {
			e.stopPropagation();
	});
	$('body').on('click', function() {
		$('.nav_search_form').removeClass('active');
	});
	$(document).keydown(function(e) {
		var key = e.keyCode;
		if (key === 27) {
			$('.nav_search_form').removeClass('active');
		}
	});
/**** Instagram ****/
$(".images_feed_widget .instagram-pics").owlCarousel({
    navigation : false,
    items : 6,
    rtl: rtl,
    loop:true,
    smartSpeed:600,
    autoplay: true,
				responsive:{	
				1000:{
				  items:6
				},

				671:{
				  items:4
				},
				
				480:{
				  items:3
				},
			    
				320:{
				  items:3
				},
				1:{
				  items:1
				}
			}    
});
/*-----------------------------------------
*	Shortcode
*-----------------------------------------*/
	jQuery('.mom_button').hover(
		function(){
		var $hoverbg = jQuery(this).attr('data-hoverbg');
		var $texthcolor = jQuery(this).attr('data-texthover');
		var $borderhover = jQuery(this).attr('data-borderhover');
		jQuery(this).css("background-color",$hoverbg);
		jQuery(this).css("color",$texthcolor);
		jQuery(this).css("border-color",$borderhover);
	},function() {
		var $bgcolor = jQuery(this).attr('data-bg');
		var $textColor = jQuery(this).attr('data-text');
		var $bordercolor = jQuery(this).attr('data-border');
		if($bgcolor!==undefined){
			jQuery(this).css("background-color",$bgcolor);
		}else {
			jQuery(this).css("background-color",'');
		}
		if($textColor!==undefined){
			jQuery(this).css("color",$textColor);
		}else {
			jQuery(this).css("color",'');
		}
		if($bordercolor !== undefined){
			jQuery(this).css("border-color",$bordercolor);
		}else {
			jQuery(this).css("border-color",'');
		}
	});
// Tab Current icon
if (('ul.mom_tabs li a i').length) {
    $('.mom_tabs_container').each(function () {
	var $this = $(this);
	var current_tab = $this.find('.mom_tabs li a.current i[class^="momizat-icon"]');
	current_tab.css('color', current_tab.attr('data-current'));
	$this.find('.mom_tabs li a').click(function () {
	if ($(this).hasClass('current')) {
	var $current = $(this).find('[class^="momizat-icon"]').attr('data-current');
	var $orig = $(this).find('[class^="momizat-icon"]').attr('data-color');
	
	$this.find('.mom_tabs li a i[class^="momizat-icon"]').css('color',$orig);
	$('[class^="momizat-icon"]', this).css('color', $current);
	} 
	});
    });
}
// Accordion Current icon
if (('h2.acc_title i').length) {
    $('.accordion').each(function () {
	var $this = $(this);
	var current_acc = $this.find('h2.active i[class^="momizat-icon"]');
	current_acc.css('color', current_acc.attr('data-current'));
	$this.find('h2.acc_title').click(function () {
	if ($(this).hasClass('active')) {
	var $current = $(this).find('[class^="momizat-icon"]').attr('data-current');
	var $orig = $(this).find('[class^="momizat-icon"]').attr('data-color');
	
	$this.find('h2.acc_title i[class^="momizat-icon"]').css('color',$orig);
	$('[class^="momizat-icon"]', this).css('color', $current);
	} 
	});
    });
}
//Accordion
$('.accordion').each( function() {
var acc = $(this);
if (acc.hasClass('toggle_acc')) {
acc.find('li:first .acc_title').addClass('active');
acc.find('.acc_toggle_open').addClass('active');
acc.find('.acc_toggle_open').next('.acc_content').show();
acc.find('.acc_toggle_close').removeClass('active');
acc.find('.acc_toggle_close').next('.acc_content').hide();
acc.find('.acc_title').click(function() {
$(this).toggleClass('active');
$(this).next('.acc_content').slideToggle();
});
} else {
acc.find('li:first .acc_title').addClass('active');
acc.find('.acc_title').click(function() {
if(!$(this).hasClass('active')) {
acc.find('.acc_title').removeClass('active');
acc.find('.acc_content').slideUp();
$(this).addClass('active');
$(this).next('.acc_content').slideDown();
}
});
}
});
$(".accordion").each(function () {
$(this).find('.acc_title').each(function(i) {
$(this).find('.acch_numbers').text(i+1);
});
});
//team members
	var tm_cols = 2;
	var tm_2_i = 0;
	$(".team_member2").each(function(){
		tm_2_i++;
		tm_cols = 2;
		if (tm_2_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_3_i = 0;
	$(".team_member3").each(function(){
		tm_3_i++;
		tm_cols = 3;
		if (tm_3_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_4_i = 0;
	$(".team_member4").each(function(){
		tm_4_i++;
		tm_cols = 4;
		if (tm_4_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_5_i = 0;
	$(".team_member5").each(function(){
		tm_5_i++;
		tm_cols = 5;
		if (tm_5_i % tm_cols === 0) {$(this).addClass("last");}
	});
$('.team_member').each( function () {
    var socials = $(this).find('.member_social ul li');
    var width = 100/socials.length;
    socials.css('width',width+'%');
});	
//teaser boxes
	var tb_cols = 2;
	var tb_2_i = 0;
	$(".teaser_box2").each(function(){
		tb_2_i++;
		tb_cols = 2;
		if (tb_2_i % tb_cols === 0) {$(this).addClass("last");}
	});
	var tb_3_i = 0;
	$(".teaser_box3").each(function(){
		tb_3_i++;
		tb_cols = 3;
		if (tb_3_i % tb_cols === 0) {$(this).addClass("last");}
	});

	var tb_4_i = 0;
	$(".teaser_box4").each(function(){
		tb_4_i++;
		tb_cols = 4;
		if (tb_4_i % tb_cols === 0) {$(this).addClass("last");}
	});

	var tb_5_i = 0;
	$(".teaser_box5").each(function(){
		tb_5_i++;
		tb_cols = 5;
		if (tb_5_i % tb_cols === 0) {$(this).addClass("last");}
	});

//Mom Columns
	var mom_cols = 2;
	var mc_2_i = 0;
	$(".mom_columns2").each(function(){
		mc_2_i++;
		mom_cols = 2;
		if (mc_2_i % mom_cols === 0) {$(this).addClass("last");}
	});
	var mc_3_i = 0;
	$(".mom_columns3").each(function(){
		mc_3_i++;
		mom_cols = 3;
		if (mc_3_i % mom_cols === 0) {$(this).addClass("last");}
	});

	var mc_4_i = 0;
	$(".mom_columns4").each(function(){
		mc_4_i++;
		mom_cols = 4;
		if (mc_4_i % mom_cols === 0) {$(this).addClass("last");}
	});

	var mc_5_i = 0;
	$(".mom_columns5").each(function(){
		mc_5_i++;
		mom_cols = 5;
		if (mc_5_i % mom_cols === 0) {$(this).addClass("last");}
	});
	
//Porfolio filter
$('.protfolio_filter ul').each( function() {
	var $this = $(this);
	$this.find('li a').click(function() {
	$this.find('li').removeClass('current');
	$(this).parent().addClass('current');
	});
});

if ($('.progress_outer').length) {
    $('.progress_outer').each( function() {
	var $this = $(this);
    $this.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
      if (isInView) {
		$(this).find('.parograss_inner').show();
		$(this).find('.parograss_inner').addClass('ani-bar');
	if (visiblePartY == 'top') {
	  // top part of element is visible
	} else if (visiblePartY == 'bottom') {
	  // bottom part of element is visible
	} else {
	  // whole part of element is visible
	}
      } else {
	// element has gone out of viewport
      }
    });
    
    });
}
//toggles
jQuery("h4.toggle_title").click(function () {
	$(this).next(".toggle_content").slideToggle();
	$(this).toggleClass("active_toggle");
	$(this).parent().toggleClass("toggle_active");
});

$("h4.toggle_min").click(function () {
	$(this).next(".toggle_content_min").slideToggle();
	$(this).toggleClass("active_toggle_min");
});

//lightbox
if ($('.mom_lightbox').length) {
$(".mom_lightbox a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});
}
 $("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});


//animatior
$('.animator.animated, .iconb_wrap.animated').each( function() {
    var $this = $(this);
    var animation = $(this).attr('data-animate');

$this.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
  if (isInView) {
	    $(this).addClass(animation);
	    $(this).css('visibility', 'visible');
	    if(animation.indexOf('fade') === -1)
	    {
	      $(this).css('opacity', '1');
	    }
    if (visiblePartY == 'top') {
      // top part of element is visible
    } else if (visiblePartY == 'bottom') {
      // bottom part of element is visible
    } else {
      // whole part of element is visible
    }
  } else {
    // element has gone out of viewport
  }
});

});

//Sticky navigation
if ($(window).width() > 1000) {
   if ($('body').hasClass('sticky_navigation_on')) {
        var aboveHeight = $('#header-wrapper').outerHeight();
        if ($('body').hasClass('header_style_header_top')) {
        	aboveHeight = 0;
        }
        $(window).scroll(function(){
	        //if scrolled down more than the headerÕs height
                if ($(window).scrollTop() > aboveHeight){
	        // if yes, add ÒfixedÓ class to the <nav>
	        // add padding top to the #content
            if ( $('#wpadminbar').length ) {
                $('#navigation').addClass('sticky-nav').css('top','28px').next().css('padding-top','52px');
                $('#navigation').parents('.topbar').addClass('has_sticky_nav');
             } else {
                $('#navigation').addClass('sticky-nav').css('top','0').next().css('padding-top','52px');
                $('#navigation').parents('.topbar').addClass('has_sticky_nav');
            } 
                } else {
 
	        // when scroll up or less than aboveHeight,
                $('#navigation').removeClass('sticky-nav').css('top', 0).next().css('padding-top','0');
                $('#navigation').parents('.topbar').removeClass('has_sticky_nav');
                }
        });	
    } 
}

//masonry
imagesLoaded( $('#mas_container'), function( instance ) {
  console.log('all images are loaded');
	$('#mas_container').masonry({
	  itemSelector: '.post-grid',
	});
});

/* ==========================================================================
 *               Google maps
   ========================================================================== */
   if ($('.mom_google_map').length) {
$('.mom_google_map').each( function() {
        var id = $(this).attr('id');
        var lat = $(this).data('lat');
        var longi = $(this).data('long');
        var color = $(this).data('color');
        var zoom = $(this).data('zoom');
        var pan = $(this).data('pan');
        if (pan != 'yes') {
          pan = false;
        } else {
          pan = true;
        }
        var controls = $(this).data('controls');
        if (controls != 'yes') {
          controls = false;
        } else {
          controls = true;
        }
        var marker_icon = $(this).data('marker_icon');
        var marker_title = $(this).data('marker_title');
        var marker_animation = $(this).data('marker_animation');
        var sat = $(this).data('sat');
        var info = $(this).data('marker_info');
        var ani = '';
        if (marker_animation == 'BOUNCE') {
          ani = google.maps.Animation.BOUNCE;
        } else if(marker_animation == 'DROP') {
            ani = google.maps.Animation.BOUNCE;
        }        

        function maps_init() {
            var styles = {
            'mommap':  [{
            "featureType": "administrative",
            "stylers": [
            { "visibility": "on" }
            ]
            },
            {
            "featureType": "road",
            "stylers": [
            { "visibility": "on" },
            { "hue": color }
            ]
            },
            {
            "elementType": "geometry",
            "stylers": [
            { "visibility": "simplified" },
            { "hue": color },
            {"weight": 1.1}
            ]
            },
            {
            "stylers": [
            { "visibility": "on" },
            { "hue": color },
            { "saturation": sat }
            ]
            }
            ]};

            var coord = new google.maps.LatLng(lat, longi);
            var options = {
            zoom: zoom,
                center: coord,
                //mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                mapTypeId: 'mommap',
                draggable: true,
                zoomControl: controls,
                panControl: pan,
                mapTypeControl: controls,
                scaleControl: controls,
                streetViewControl: controls,
                overviewMapControl: controls,
                scrollwheel: false,
                disableDoubleClickZoom: true
            }
        var map = new google.maps.Map(document.getElementById(id), options);
        var styledMapType = new google.maps.StyledMapType(styles['mommap'], {name: 'mommap'});
        map.mapTypes.set('mommap', styledMapType);
 var contentString = '<div class"map-info-window"><p>'+info+'</p></div>';
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

        var marker = new google.maps.Marker({
        position: coord, 
        map: map,
        title:marker_title,
        icon: marker_icon,
        animation: ani
    });   
if (info !== '') {
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }

    }
    google.maps.event.addDomListener(window, 'load', maps_init);
    google.maps.event.addDomListener(window, 'resize', maps_init);


});
}

});

// ajax requests
jQuery(document).ready(function($) {

        offset = '';
	jQuery("a.more-posts").click( function(e) {
            e.preventDefault();
		var t = $(this);
		var l = t.next('.ajax-loading');
                offset = t.data('offset');
		var cat = t.data('cat');
		var tag = t.data('tag');
		var format = t.data('format');
		var m = t.data('m');
                nop = t.data('number_of_posts');
			jQuery.ajax({
			type: "post",
			url: MomLMore.url,
                        dataType: 'html',
                        data: "action=mom_loadMore&nonce="+MomLMore.nonce+"&offset="+offset+"&cat="+cat+"&tag="+tag+"&format="+format+"&m="+m,
			beforeSend: function(data) {
			    t.hide();
			    l.show();
			},
			success: function(data){
                   if ($('body').hasClass('posts-grid-layout')) {
						$container = $('#mas_container');
						var $moreBlocks = jQuery(data).filter('li.post-grid');
						$container.append( $moreBlocks );
						$moreBlocks.imagesLoaded(function(){
								$moreBlocks.animate({ opacity: 1 });
								$container.masonry( 'appended', $moreBlocks );

						if (data === '') { t.hide(); l.hide(); } else { l.hide(); t.show();}
						});
                   } else {
	                   t.parent().before(data);
						if (data === '') { t.hide(); l.hide(); } else { l.hide(); t.show();}
                   }

			}
		});	
                           	t.data('offset', offset+nop);
                                console.log(offset);
	});

		jQuery("a.more-posts-scroll").bind( 'inview', function(e, visible) {
			if (visible) { 
		var t = $(this);
		var l = t.next('.ajax-loading');
                offset = t.data('offset');
		var cat = t.data('cat');
		var tag = t.data('tag');
		var format = t.data('format');
		var m = t.data('m');
                nop = t.data('number_of_posts');
			jQuery.ajax({
			type: "post",
			url: MomLMore.url,
                        dataType: 'html',
                        data: "action=mom_loadMore&nonce="+MomLMore.nonce+"&offset="+offset+"&cat="+cat+"&tag="+tag+"&format="+format+"&m="+m,
			beforeSend: function(data) {
			    t.hide();
			    l.show();
			},
			success: function(data){
                   if ($('body').hasClass('posts-grid-layout')) {
						$container = $('#mas_container');
						var $moreBlocks = jQuery(data).filter('li.post-grid');
						$container.append( $moreBlocks );
						$moreBlocks.imagesLoaded(function(){
								$moreBlocks.animate({ opacity: 1 });
								$container.masonry( 'appended', $moreBlocks );
								//share wp 
						if (data === '') { t.hide(); l.hide(); } else { l.hide(); t.show();}
						});
                   } else {
	                   t.parent().before(data);
								//share wp 
						if (data === '') { t.hide(); l.hide(); } else { l.hide(); t.show();}
                   }
			}
		});	
                           	t.data('offset', offset+nop);

	}
	});

/*Flickr widget*/
if ($('.flicker-widget-wrap').length) {
	$('.flicker-widget-wrap').each(function() {
		var t = $(this);
		var id = t.data('id');
		var count = t.data('count');
		var box = t.data('box');

			t.jflickrfeed({
				limit: count,
				qstrings: {
					id: id
				},
				itemTemplate: '<div class="flicker-widget-item">'+
								'<a rel="prettyPhoto[gallery1]" href="{{image}}" title="{{title}}">' +
									'<img src="{{image_q}}" alt="{{title}}" />' +
								'</a>' +
							  '</div>'
			}, function(data) {
				if(box == 'on') { 
					$(".flicker-widget-item a").prettyPhoto();
				}
				var rtl = false;
if ($('body').hasClass('rtl')) {
	rtl = true;
}
	items = 10;
	if (count >= 10) {
		items = count;
	}
		t.owlCarousel({
			    navigation : false,
			    items : items,
			    rtl: rtl,
			    loop:true,
			    smartSpeed:600,
			    autoplay: true,
							responsive:{	
							1000:{
							  items:items
							},

							671:{
							  items:4
							},
							
							480:{
							  items:3
							},
						    
							320:{
							  items:3
							},
							1:{
							  items:1
							}
						}    
			});

			});
	});
}


/* Dribbble widget */
if ($('.dribbble-widget-wrap').length) {
	$('.dribbble-widget-wrap').each(function() {
		var t = $(this);
		var id = t.data('id');
		var count = t.data('count');
		var box = t.data('box');
		var size = t.data('size');
	$.jribbble.getShotsByPlayerId(id, function (playerShots) {
    var html = [];
       $.each(playerShots.shots, function (i, shot) {
		var shot_link = shot.url;
		if(box == 'on') {
		shot_link = shot.image_url;
		}
		img = shot.image_teaser_url;
		if (size == 'large') {
			if (typeof shot.image_400_url !== 'undefined') {
				img = shot.image_400_url;
			}
		}
		//console.log(shot);
        html.push('<div class="dribbble-widget-item">');
        html.push('<a rel="prettyphoto[dribbble]" target="_blank" href="' + shot_link + '">');
        html.push('<img src="' + img + '" ');
        html.push('alt="' + shot.title + '" width="'+ shot.width +'" height="'+ shot.height +'"></a></div>');
    });

    t.html(html.join(''));
	if(box == 'on') {
		$(".dribbble-widget-item a").prettyPhoto();
	}
					var rtl = false;
if ($('body').hasClass('rtl')) {
	rtl = true;
}

	items = 6;
	if (count >= 6) {
		items = count;
	}

		t.owlCarousel({
			    navigation : false,
			    items : items,
			    rtl: rtl,
			    loop:true,
			    smartSpeed:600,
			    autoplay: true,
							responsive:{	
							1000:{
							  items:items
							},

							671:{
							  items:4
							},
							
							480:{
							  items:3
							},
						    
							320:{
							  items:3
							},
							1:{
							  items:1
							}
						}    
			});


}, {page: 1, per_page: count});
	});
}

});


jQuery(document).ready(function($) {

        offset = '';
	jQuery("a.load-more-posts.pagination-type-ajax").click( function(e) {
            e.preventDefault();
		var t = $(this);
		var l = t.next('.ajax-loading');
			count = t.data('count');
			offset = t.data('offset');
                        display = t.data('display');
                        category = t.data('category');
                        tag = t.data('tag');
                        sort = t.data('sort');
                        orderby = t.data('orderby');
                        format = t.data('format');
                        load_more_count = t.data('load_more_count');
			
		jQuery.ajax({
			type: "post",
			url: MomLMore.url,
                        dataType: 'html',
                        data: "action=mom_grid_loadMore&nonce="+MomLMore.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&number_of_posts="+count+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&format="+format+"&load_more_count="+load_more_count,
			beforeSend: function() {
			    t.hide();
			    l.show();
			},
			success: function(data){
			    $container = $('#mas_container');
			    var $moreBlocks = jQuery(data).filter('li.post-grid');
			    $container.append( $moreBlocks );
				$moreBlocks.imagesLoaded(function(){
				    $moreBlocks.animate({ opacity: 1 });
				    $container.masonry( 'appended', $moreBlocks );
					    //share wp 

				});

				if (data === '') {
					//t.text('No More Posts');
					t.hide();
					l.hide();
				} else {
				    l.hide();
				    t.show();
				}
			}
		});	
                           	t.data('offset', offset+load_more_count);
                                //console.log(offset);
	});

	jQuery("a.load-more-posts.pagination-type-scroll").bind('inview', function(e, visible) {
            e.preventDefault();
		var t = $(this);
		var l = t.next('.ajax-loading');
			count = t.data('count');
			offset = t.data('offset');
                        display = t.data('display');
                        category = t.data('category');
                        tag = t.data('tag');
                        sort = t.data('sort');
                        orderby = t.data('orderby');
                        format = t.data('format');
                        excerpt_length = t.data('excerpt_length');
                        load_more_count = t.data('load_more_count');
			
		jQuery.ajax({
			type: "post",
			url: MomLMore.url,
                        dataType: 'html',
                        data: "action=mom_grid_loadMore&nonce="+MomLMore.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&number_of_posts="+count+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&format="+format+"&excerpt_length="+excerpt_length+"&load_more_count="+load_more_count,
			beforeSend: function(data) {
			    t.hide();
			    l.show();
			},
			success: function(data){
			    $container = $('#mas_container');
			    var $moreBlocks = jQuery(data).filter('li.post-grid');
			    $container.append( $moreBlocks );
				$moreBlocks.imagesLoaded(function(){
				    $moreBlocks.animate({ opacity: 1 });
				    $container.masonry( 'appended', $moreBlocks );
					    //share wp 

				});


				if (data === '') {
					//t.text('No More Posts');
					t.hide();
					l.hide();
				} else {
				    l.hide();
				    t.show();

				}
			}
		});	
                           	t.data('offset', offset+load_more_count);
                                //console.log(offset);
	});

});

/*!
 * enquire.js v2.1.2 - Awesome Media Queries in JavaScript
 * Copyright (c) 2014 Nick Williams - http://wicky.nillia.ms/enquire.js
 * License: MIT (http://www.opensource.org/licenses/mit-license.php)
 */

!function(a,b,c){var d=window.matchMedia;"undefined"!=typeof module&&module.exports?module.exports=c(d):"function"==typeof define&&define.amd?define(function(){return b[a]=c(d)}):b[a]=c(d)}("enquire",this,function(a){"use strict";function b(a,b){var c,d=0,e=a.length;for(d;e>d&&(c=b(a[d],d),c!==!1);d++);}function c(a){return"[object Array]"===Object.prototype.toString.apply(a)}function d(a){return"function"==typeof a}function e(a){this.options=a,!a.deferSetup&&this.setup()}function f(b,c){this.query=b,this.isUnconditional=c,this.handlers=[],this.mql=a(b);var d=this;this.listener=function(a){d.mql=a,d.assess()},this.mql.addListener(this.listener)}function g(){if(!a)throw new Error("matchMedia not present, legacy browsers require a polyfill");this.queries={},this.browserIsIncapable=!a("only all").matches}return e.prototype={setup:function(){this.options.setup&&this.options.setup(),this.initialised=!0},on:function(){!this.initialised&&this.setup(),this.options.match&&this.options.match()},off:function(){this.options.unmatch&&this.options.unmatch()},destroy:function(){this.options.destroy?this.options.destroy():this.off()},equals:function(a){return this.options===a||this.options.match===a}},f.prototype={addHandler:function(a){var b=new e(a);this.handlers.push(b),this.matches()&&b.on()},removeHandler:function(a){var c=this.handlers;b(c,function(b,d){return b.equals(a)?(b.destroy(),!c.splice(d,1)):void 0})},matches:function(){return this.mql.matches||this.isUnconditional},clear:function(){b(this.handlers,function(a){a.destroy()}),this.mql.removeListener(this.listener),this.handlers.length=0},assess:function(){var a=this.matches()?"on":"off";b(this.handlers,function(b){b[a]()})}},g.prototype={register:function(a,e,g){var h=this.queries,i=g&&this.browserIsIncapable;return h[a]||(h[a]=new f(a,i)),d(e)&&(e={match:e}),c(e)||(e=[e]),b(e,function(b){d(b)&&(b={match:b}),h[a].addHandler(b)}),this},unregister:function(a,b){var c=this.queries[a];return c&&(b?c.removeHandler(b):(c.clear(),delete this.queries[a])),this}},new g});
