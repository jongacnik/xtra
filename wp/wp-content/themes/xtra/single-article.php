<?php get_header(); ?>

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
$buyurl = get_field('purchase_url');
$link = get_permalink(); 

//Dirty fix for Volume 1
$tit = get_the_title();
if($tit == 'Spring 1997'){
	$number = 'Number 1';
} elseif($tit == 'Summer 1997'){
	$number = 'Number 2';
} elseif($tit == 'Fall 1997'){
	$number = 'Number 3';
} elseif($tit == 'Winter 1998'){
	$number = 'Number 4';
} elseif($tit == 'Summer 1998'){
	$number = 'Number 5';
} ?>
<?php wp_reset_query(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php //Logic if article is AP or not
	$types = get_the_terms( $post->ID , 'artType_taxonomy' );
	$type = array_shift(array_values($types));
	if(get_field('pdf')){
		include('_articlePDF.php');
	} else {
		if($type->name == "Artist's Project"){
			include('_artistProject.php');
		} else {
			include('_article.php');
		}
	}
	?>

<?php endwhile; else: ?>

	<p>Sorry, this page does not exist</p>

<?php endif; ?>

<?php get_footer(); ?>