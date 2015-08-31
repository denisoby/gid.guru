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
                            t.parent().before(data);

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
                           	t.data('offset', offset+nop);
                                console.log(offset);
	});
	
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

	jQuery("a.load-more-posts.pagination-type-scroll").bind('inview', function(e) {
            e.preventDefault();
		var t = $(this);
		var l = t.next('.ajax-loading');
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