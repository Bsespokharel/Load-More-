jQuery(document).ready(function($) {

	$(".cat-filter li").click(function() {
		$(".blog-item").addClass('loading');
		$(".cat-filter li.active").removeClass("active");
		$(this).addClass('active');
		var catid = $(this).attr('data-cat-id');
		var clone_jobs = jQuery(".blog-bottom-row.jobs-load").clone();
		$('.load-more-btn').show();

		/* Load Featured Content */
		$.ajax({
			url: Chobj.admin_ajax,
			type: 'POST',
            data: {
                action: 'category_filter',
                catid: catid,
            },
		})
		.done(function(response) {
			console.log("success");
			$('#featured-block').html(response);
			$(".blog-item").removeClass('loading');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		/* Load main blog content */
		$.ajax({
			url: Chobj.admin_ajax,
			type: 'POST',
            data: {
                action: 'blog_loop_filter',
                cat_loop_id: catid,
            },
		})
		.done(function(response) {
			console.log("success");
			$('#blog-loop-posts').html(response);
			$('#blog-loop-posts').append(clone_jobs);
			var post_count_sucess = count_blogs_posts('totalposts');
			console.log(post_count_sucess);
		    if (parseInt($('#total_blogs').val(), 10) == post_count_sucess) {
		        $('.load-more-btn').hide();
		    }
		})
			.fail(function() {
			console.log("error");
		})
			.always(function() {
			console.log("complete");
		});


	});

	/* Load more [ with category and without category ] */
	$(".load_more").click(function() {
		var clone_jobs = jQuery(".blog-bottom-row.jobs-load").clone();
		post_collection = [];
		var cat_id_loadmore = $('.cat-filter li.active').attr('data-cat-id');
		post_collection = count_blogs_posts('ids');
		$.ajax({
			url: Chobj.admin_ajax,
			type: 'POST',
            data: {
                action: 'blog_load_more',
                postids: post_collection,
                catidloadmore: cat_id_loadmore,
            },
		})
		.done(function(response) {
			console.log("success");
			jQuery(".blog-bottom-row.jobs-load").remove();
			$('#blog-loop-posts').append(response);
			$('#blog-loop-posts').append(clone_jobs);

			var post_count_sucess = count_blogs_posts('totalposts');
			console.log(post_count_sucess);
		    if (parseInt($('#total_blogs').val(), 10) == post_count_sucess) {
		        $('.load-more-btn').hide();
		    }


		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

	});

		var post_count = count_blogs_posts('totalposts');
		console.log(post_count);
	    if (parseInt($('#total_blogs').val(), 10) == post_count) {
	        $('.load-more-btn').hide();
	    }

	/*-Count Total news Displayed-*/
    function count_blogs_posts(retrun_type) {
        post_collection_last = [];
        $('#blog-loop-posts article').each(function() {
            var postid = $(this).attr('data-id');
            post_collection_last.push(postid);
        });
        if (retrun_type == 'totalposts') {
            return post_collection_last.length;
        } else {
            return post_collection_last;
        }
    }


    $(document).on( 'click', '.nav-links a', function( event ) {
		event.preventDefault();
		var single_postid = $("div.blog-single-post").attr('post-data-id');

		$.ajax({
			url: Chobj.admin_ajax,
			type: 'post',
			data: {
				action: 'ajax_nextpost',
				singlepostid: single_postid,
			},
			success: function( result ) {

				$('.blog-single-wrap').html( result );
				var calc_offset = $(".blog-single-wrap").offset().top;
				$("html,body").animate({ scrollTop: calc_offset },600);

			}
		})
	});

});