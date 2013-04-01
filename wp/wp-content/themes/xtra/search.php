<?php get_header(); ?>

<?php
$num_cb = $wp_query->post_count;
$id_cb = $paged;
$r_cb=1;
$startNum_cb = $r_cb;
$endNum_cb = 10;
if($id_cb >=2) {
  $s_cb=$id_cb-1;
  $r_cb=($s_cb * 10) + 1;
  $startNum_cb=$r_cb;
  $endNum_cb=$startNum_cb + ($num_cb -1);
} ?>


<div id="search-wrap" class="padding-fix">
	<h1 class="gothic meta-caps"><?php if (have_posts()) :
 			echo "Showing <u>$startNum_cb-$endNum_cb</u> of ";
		endif; ?><u><?=$wp_query->found_posts;?></u> results found for:&nbsp; <u><?php the_search_query() ?></u>
	
	</h1>

	<ul>










<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	if($post->post_type == 'post'){ 
		$date = get_post_meta($post->ID, 'EVENT-date'); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<br><span class="gothic search-meta">—<?=$date[0]?></span><br></li>
	<?php } else {
		$ancestors = get_post_ancestors( $post );
		$issue = get_the_title($ancestors[0]);
		$volume = get_the_title($ancestors[1]);
		$date = get_post_meta($ancestors[0], 'date'); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<br><span class="gothic search-meta">—<?=$date[0]?> <?=$volume?> <?=$issue?></span><br></li>
	<?php } ?>

	<?php endwhile; else: ?>
		<p>Sorry, no posts we're found.</p>
<?php endif; ?>
	</ul>

	<div class="search-navigation"><p><?php posts_nav_link('&nbsp;&nbsp;&nbsp;&nbsp;','&larr;Previous','Next&rarr;'); ?></p></div>

</div>

<?php get_footer(); ?>