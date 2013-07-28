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
	<h1 class="gothic meta-caps">
		<?php if (have_posts()) :
			if ($wp_query->found_posts < $endNum_cb){
				echo "Showing <u>$startNum_cb-$wp_query->found_posts</u> of ";
			} else {
				echo "Showing <u>$startNum_cb-$endNum_cb</u> of ";
			}
		endif; ?>
			<u><?=$wp_query->found_posts;?></u> results found for:&nbsp; <u><?php the_search_query() ?></u>
	</h1>

	<ul>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	if($post->post_type == 'event'){ 
		$date = get_post_meta($post->ID, 'EVENT-date'); ?>

		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<br><span class="gothic search-meta">—<?=$date[0]?></span><br>

	<?php } else { 

		$issue 	= wp_get_post_terms( $post->ID, 'issue_taxonomy', array("fields" => "names")); $issue = $issue[0]; 
		$volume = wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); 
		$volume = str_replace('v', 'Volume ', $volume[0]);
		$season = explode(' ', $issue);
		$number = $numbers[strtolower($season[0])];?>

		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<br><span class="gothic search-meta">—<?=$season[0]?> <?=$season[1]?> <?=$volume?> <?=$number?></span><br>

	<?php } ?>

	<?php endwhile; else: ?>
		<p>Sorry, no posts we're found.</p>
<?php endif; ?>
	</ul>

	<div class="search-navigation"><p><?php posts_nav_link('&nbsp;&nbsp;&nbsp;&nbsp;','&larr;Previous','Next&rarr;'); ?></p></div>

</div>

<?php get_footer(); ?>