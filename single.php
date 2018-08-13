<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package channel40
 */

get_header();
while ( have_posts() ) :
the_post();
$image_banner = get_field('banner_image');
?>

<div class="top-banner top-half-banner" style="background-image: url(<?php echo $image_banner['url']; ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 half-banner">
			</div>
		</div>
	</div>
</div>

<div class="container blog-single-wrap">
	<div class="row blog-single-post" post-data-id="<?php echo get_the_id();?>">
		<div class="ch-lg-5">
			<h2 class="blog-sing-title">
				<?php the_title();?>
			</h2>
			<?php the_content(); ?>

			<!-- next article -->
			<?php if(get_next_post_id(get_the_id())){?>
			<div class="nav-links">
				<a href="#" class="ch-btn single-next-btn" id="next_article">Next Article</a>
			</div>
			<?php }?>

			<!-- show on mobile -->
			<div class="share-block mbl" style="display:none;">
				<p>Share this</p>
				<ul>
					<li><a class="icon-facebook" rel="nofollow"
							href="http://www.facebook.com/"
							onclick="popUp=window.open(
								'http://www.facebook.com/sharer.php?u=<?php the_permalink();?>',
								'popupwindow',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Facebook</i>
						</a></li>
					<li><a class="icon-twitter" rel="nofollow"
							href="http://twitter.com/"
							onclick="popUp=window.open(
								'http://twitter.com/intent/tweet?text=\'[<?php echo get_the_title();?>]\' via @[ishor_mgr] - [<?php the_permalink(); ?>]',
								'popupwindow1',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Twitter</i>
						</a>
					</li>
					<li><a class="icon-linkedin" rel="nofollow"
							href="http://www.linkedin.com/"
							onclick="popUp=window.open(
								'http://www.linkedin.com/shareArticle?url=<?php the_permalink();?>',
								'popupwindow2',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Linkedin</i>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="ch-lg-1 offset-ch-1">
			<p class="blog-date"><?php echo get_the_date('d F Y');?></p>
			<div class="share-block">
				<p>Share this</p>
				<ul>
					<li><a class="icon-facebook" rel="nofollow"
							href="http://www.facebook.com/"
							onclick="popUp=window.open(
								'http://www.facebook.com/sharer.php?u=<?php the_permalink();?>',
								'popupwindow',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Facebook</i>
						</a></li>
					<li><a class="icon-twitter" rel="nofollow"
							href="http://twitter.com/"
							onclick="popUp=window.open(
								'http://twitter.com/intent/tweet?text=\'[<?php echo get_the_title();?>]\' via @[ishor_mgr] - [<?php the_permalink(); ?>]',
								'popupwindow1',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Twitter</i>
						</a>
					</li>
					<li><a class="icon-linkedin" rel="nofollow"
							href="http://www.linkedin.com/"
							onclick="popUp=window.open(
								'http://www.linkedin.com/shareArticle?url=<?php the_permalink();?>',
								'popupwindow2',
								'scrollbars=yes,width=800,height=400');
							popUp.focus();
							return false">
							<i class="visuallyhidden">Linkedin</i>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="ch-lg-1">
			<p class="blog-cat"><?php catname( get_the_id() ); ?></p>
		</div>


	</div>
</div>




<?php
endwhile;
get_footer();
