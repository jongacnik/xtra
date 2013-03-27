<?php

/* Get current issue stuff */

$issue 	= wp_get_post_terms( $post->ID, 'issue_taxonomy', array("fields" => "names")); $issue = $issue[0];
$issue = get_term_by('name', $issue, 'issue_taxonomy'); 

$args = array(
	'name' 				=> $issue->slug,
	'post_type' 		=> 'issue',
	'post_status' 		=> 'publish',
	'numberposts' 		=> 1
);
query_posts($args); 
the_post(); 

$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); $cover = $cover[0];
$volume = wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); 
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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php //Logic if article is AP or not
	$types = get_the_terms( $post->ID , 'artType_taxonomy' );
	$type = array_shift(array_values($types));
	if($type->name == "Artist's Project"){
		include('_artistProject.php');
	} else {
		include('_article.php');
	} ?>

	<h1><?php the_title() ;?></h1>	
	<?php the_content(); ?>

<?php endwhile; else: ?>

	<p>Sorry, this page does not exist</p>

<?php endif; ?>