<?php
/*
Template Name: Random Slider Item
*/
?>

<?php 
$args = array(
	'post_type' 		=> 'article',
	'post_status' 		=> 'publish',
	'meta_key'			=> '_thumbnail_id',
	'post_count'		=> 1,
	'posts_per_page' 	=> 1,
	'orderby'			=> 'rand',
	'tax_query'         => array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'artist_project',
        'field' 	=> 'slug',
        'operator'	=> 'NOT IN'
        )
    )
);
query_posts($args); 
the_post();
?>
<?php the_post_thumbnail('large'); ?>
<a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>