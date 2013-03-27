<?php 

/* Global goods of current issue */
$get_current = "SELECT * FROM xtra_posts WHERE post_type='issue' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
$get_current = mysql_fetch_assoc(mysql_query($get_current));
$curr_nm = $get_current['post_title'];
$curr_id = $get_current['ID']; ?>

<?php 
/* Get current issue stuff */
$args = array(
	'post_type' 		=> 'issue',
	'post_status' 		=> 'publish',
	'p'					=> $curr_id
);
query_posts($args); 
the_post(); 

$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($curr_id), 'medium' ); $cover = $cover[0];
$volume = wp_get_post_terms( $curr_id, 'volume_taxonomy', array("fields" => "names")); 
$volume = str_replace('v', 'Volume ', $volume[0]); 
$season = explode(' ', get_the_title()); 
$year   = $season[1];
$season = $season[0];
$number = $numbers[strtolower($season)];
$buyurl = get_field('purchase_url'); ?>
<?php wp_reset_query(); ?>

<div class="issue">
<img src="<?=$cover?>">
<br><?=$season?> <?=$year?>
<br><?=$volume?>
<br><?=$number?>
<br><?=$buyurl?>
</div>


<hr>
<?php

/* Get current articles (except artist project) */
$args = array(
  'issue_taxonomy' 		=> $curr_nm,
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'tax_query'			=> array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'artist_project',
        'field' 	=> 'slug',
        'operator'	=> 'NOT IN'
        )
    )
);
$articles = new WP_Query($args);
if( $articles->have_posts() ) :
  while ($articles->have_posts()) : $articles->the_post();
	$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); $thumb = $thumb[0]; 
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<img src="<?=$thumb?>"><br>
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php /* Get current artist project */
$args = array(
  'issue_taxonomy' 		=> $curr_nm,
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'tax_query'			=> array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'artist_project',
        'field' 	=> 'slug',
        'operator'	=> 'IN'
        )
    )
);
$articles = new WP_Query($args);
if( $articles->have_posts() ) :
  while ($articles->have_posts()) : $articles->the_post();
	$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); $thumb = $thumb[0]; 
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<img src="<?=$thumb?>"><br>
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<hr>

<?php

/* Get random articles */
$args = array(
	'post_type' 		=> 'article',
	'post_status' 		=> 'publish',
	'meta_key'			=> '_thumbnail_id',
	'post_count'		=> 10,
	'posts_per_page' 	=> 10,
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
$slider = new WP_Query($args);
if( $slider->have_posts() ) :
  while ($slider->have_posts()) : $slider->the_post(); 
	$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); $thumb = $thumb[0]; 
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$vol 	= wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); $vol = str_replace('v', 'Volume ', $vol[0]);
	$iss 	= wp_get_post_terms( $post->ID, 'issue_taxonomy', array("fields" => "names")); $iss = $iss[0];
	$seas 	= explode(' ', $iss);
	$num 	= $numbers[strtolower($seas[0])];
	$author = get_field('author'); ?>

	<img src="<?=$thumb?>"><br>
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    <?=$vol?><br>
    <?=$iss?><br>
    <?=$num?><br>

  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>