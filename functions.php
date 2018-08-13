<?php
function channel40_scripts() {

	wp_enqueue_script('main', get_template_directory_uri() . '/main.js', array('jquery') , '1.0.0');
	wp_localize_script('main', 'Chobj', array('admin_ajax' => admin_url( 'admin-ajax.php' ),
	));
function catname($id){
$category_detail=get_the_category( $id );
	$s = '';
	foreach ($category_detail as $cd) {
		if ($s) $s .= ', ';
		$s .= $cd->cat_name;
	}
	echo $s;
	//return $s;
}


add_action('wp_ajax_category_filter','category_filter');
add_action('wp_ajax_nopriv_category_filter','category_filter');

function category_filter(){
	$cat_id_filter = $_POST['catid'];
	if($cat_id_filter == 0){
	$args_blog = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			);

		}else{
		$args_blog = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'cat' => $cat_id_filter,
			);
			}
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
			die();
}


add_action('wp_ajax_blog_loop_filter','blog_loop_filter');
add_action('wp_ajax_nopriv_blog_loop_filter','blog_loop_filter');

function blog_loop_filter(){
	$cat_loop_id_filter = $_POST['cat_loop_id'];
	if($cat_loop_id_filter == 0){

			$arg_cnt_filter = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			);
			$query_count_filter = new WP_Query($arg_cnt_filter);
			$blogs_total_post_filter = $query_count_filter->post_count;

		$args_loop_blog = array(
			'post_type' => 'post',
			'offset' => 1,
			'posts_per_page' => 2,
			);

			}else{

			$arg_cnt_filter = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'cat' => $cat_loop_id_filter,
			);
			$query_count_filter = new WP_Query($arg_cnt_filter);
			$blogs_total_post_filter = $query_count_filter->post_count;
			$blogs_total_post_filter = $blogs_total_post_filter ;

   			$args_loop_blog = array(
	          'post_type'=>'post',
	          'offset' => 1,
	          'posts_per_page' => 2,
	          'cat' => $cat_loop_id_filter,
	          );
   			}
          $query_blog_post = new WP_Query($args_loop_blog);
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

		<script type="text/javascript">
			jQuery("#total_blogs").val(<?php echo ($blogs_total_post_filter -1); ?>);
		</script>
<?php
die();
}

add_action('wp_ajax_blog_load_more','blog_load_more');
add_action('wp_ajax_nopriv_blog_load_more','blog_load_more');

function blog_load_more(){
	$exclude_ids = $_POST['postids'];
	$catidloadmore = $_POST['catidloadmore'];
	if($catidloadmore == 0){
	$args_blogs = array(
      'post_type'=>'post',
      'offset' => 1,
      'posts_per_page' => 3,
      'post__not_in' => $exclude_ids,
      );
		}else{
		$args_blogs = array(
	          'post_type'=>'post',
	          'offset' => 1,
	          'posts_per_page' => 3,
	          'post__not_in' => $exclude_ids,
	          'cat' => $catidloadmore,
	          );
		}
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
	<?php  endwhile; wp_reset_postdata();

	die();

}


add_action( 'wp_ajax_nopriv_ajax_nextpost', 'ajax_nextpost' );
add_action( 'wp_ajax_ajax_nextpost', 'ajax_nextpost' );

function ajax_nextpost() {
    $current_postid = $_POST['singlepostid'];
    $next_post_id = get_next_post_id( $current_postid );

    $cs_post = get_post( $current_postid );
	$current_slug = $cs_post->post_name;

    if( $next_post_id ){
    	$next_post_id = $next_post_id;
    	$post_next = get_post( $next_post_id );
    	$next_slug = $post_next->post_name;
    }else{
    	$next_post_id = $current_postid;
    	$post_next = get_post( $current_postid );
    	echo '<script>jQuery("#next_article").hide();</script>';
    	$next_slug = $post_next->post_name;
    }

	$title = $post_next->post_title;
	$content = $post_next->post_content;
	$next_cat_detail = get_the_category( $next_post_id );
	$date = get_the_date('d F Y', $next_post_id);
	foreach ( $next_cat_detail as $ncd ) {
		if ( $c ) $c .= ', ';
		$c .=  $ncd->cat_name;
	}

    echo '<div class="row blog-single-post" post-data-id="'.$next_post_id.'">
		<div class="ch-lg-5">
			<h2 class="blog-sing-title">
				'.$title.'
			</h2>
			'.$content.'
		</div>
		<div class="ch-lg-1 offset-ch-1">
			<p class="blog-date">'. $date .'</p>
			<div class="share-block">
				<p>Share Block</p>
				<ul>
					<li>Facebook</li>
					<li>Twitter</li>
					<li>Linkedin</li>
				</ul>
			</div>
		</div>
		<div class="ch-lg-1">
			<p class="blog-cat">'.$c.' </p>
		</div>
	</div>';
	echo '<script>window.history.pushState({urlPath:"/channel40/'.$current_slug.'/"},"","/channel40/'.$next_slug.'/")</script>';

    die();
}


function get_next_post_id( $post_id ) {
    global $post;
    $oldGlobal = $post;
    $post = get_post( $post_id );
    $category_detail=get_the_category( $post_id );

    $next_post = get_next_post( $category_detail[0]->cat_name, '', 'category' );
    $post = $oldGlobal;
    if ( '' == $next_post ) {
        return 0;
    }
    return $next_post->ID;
}