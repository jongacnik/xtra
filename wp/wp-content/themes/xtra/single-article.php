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