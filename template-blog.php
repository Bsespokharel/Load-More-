<?php
/*
Template Name: Blog Template
*/
get_header();
while ( have_posts() ) :
	the_post();
	$image_banner = get_field('chanl40_page_banner'); ?>
	<!-- blog banner -->
	<div class="top-banner top-half-banner" style="background-image: url(<?php echo $image_banner['url']; ?>)">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 half-banner">
				</div>
				<h1 class="above-line"><span><?php strip_tags(the_field('chanl40_banner_tittle')); ?></span>
				</h1>
			</div>
		</div>
	</div>


<!-- blog  -->
<div class="blog-wrap grid-dark">
	<div class="container">

	<!-- blog top -->
		<div class="row">
		<div class="ch-lg-2">
			<ul class="cat-filter">
				<li class="active" data-cat-id="0"><a>All</a></li>
				<?php
				$categories = get_categories();
					foreach( $categories as $category ) {
						echo '<li data-cat-id="'.$category->term_id.'"><a> ' . $category->name . ' </a></li>';
					 } ?>
				</ul>
			</div>

			<div id="featured-block">
			<?php
			$args_blog = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				);
				$query_blog = new WP_Query( $args_blog );
				while ( $query_blog->have_posts() ) :
            	$query_blog->the_post();
            	$featured_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
            	?>

				<div class="ch-lg-4">
					<div class="blog-item most-recent">
						<img src="<?php echo $featured_image; ?>" alt="">
					</div>
				</div>
				<div class="ch-lg-2">
					<div class="blog-item most-recent">
						<div class="blog-item-text">
							<p class="blog-cat">
							<?php
								catname( get_the_id() );
								?>
							</p>
							<div class="blog-center">
								<h4 class="blog-title"><?php the_title();?></h4>
								<a href="<?php the_permalink(); ?>" class="ch-btn">Read More</a>
							</div>
							<p class="blog-date"><?php echo get_the_date('d F Y');?></p>
						</div>
					</div>
				</div>
			<?php
				endwhile;
				wp_reset_query();
				?>
			</div>

		</div>

		<!-- blog bottom -->
		<div class="row blog-bottom-row-wrap">
		<div id="blog-loop-posts">
		<?php

	       		$args_blogs = array(
		          'post_type'=>'post',
		          'offset' => 1,
		          'posts_per_page' => 3,
		          );
		          $query_blog_post = new WP_Query($args_blogs);
		         	while ( $query_blog_post->have_posts() ) :
            		$query_blog_post->the_post();
            		$featured_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
		      		?>

					<article class="ch-lg-4 blog-bottom-row" data-id="<?php echo get_the_ID();?>">
						<div class="blog-item">
							<img src="<?php echo $featured_image; ?>" alt="">
							<div class="blog-item-text">
								<p class="blog-cat">
									<?php
									catname( get_the_ID() );
									?>
								</p>
								<div class="blog-center">
									<h4 class="blog-title"><?php the_title(); ?></h4>
									<a href="<?php echo get_the_permalink(); ?>" class="ch-btn">Read More</a>
								</div>
								<p class="blog-date"><?php echo get_the_date('d F Y');?></p>
							</div>
						</div>
					</article>
				<?php  endwhile; wp_reset_postdata();?>
				<div class="ch-lg-4 blog-bottom-row jobs-load">
				<div class="hover-block">
					<div class="first-jobs">
						<h3 class="find-jobs-hover">
							<a href="https://channel40.com.au/find-jobs" target="_blank" class="find-jobs-text above-line">find <br> jobs</a>
						</h3>
						<p>Transport <br> Operators</p>
					</div>
					<!-- <img class="line-rotate above-line rotated-left" src="http://step.naphix.com/channel40/wp-content/themes/channel40/assets/img/horizontal-line.svg" alt=""> -->

					<div class="second-load">
						<p>Freight <br> Owners</p>
						<h3 class="post-load-hover">
							<a href="https://bouncer.channel40.com.au/auth/%20realms/channel40/protocol/openid-connect/auth?client_%20id=channel40&amp;redirect_uri=https%3A%2F%2Fv2.%20channel40.com.au&amp;state=ede976d5-0513-45f9-9a32-%2091bd2fb60adb&amp;nonce=8277c2de-5bdf-4028-ad0a-%207cea453597ff&amp;response_mode=fragment&amp;response_%20type=code&amp;scope=openid" target="_blank" class="post-load-text">post <br> load</a>
						</h3>
					</div>
				</div>
			</div>
			</div>


			<div class="ch-lg-7 text-right load-more-btn">
				<a class="ch-btn ch-btn-green load_more" id="load_more_btn">Load More</a>
				<?php
					$arg_cnt = array(
					'post_type' => 'post',
					'posts_per_page' => -1,
					);
					$query_count = new WP_Query($arg_cnt);
					$blogs_total_post = $query_count->post_count;
					?>
				<input type="hidden" id="total_blogs" value="<?php echo ($blogs_total_post - 1); ?>">
			</div>
		</div>
	</div>
</div>



<?php
endwhile;
get_footer();