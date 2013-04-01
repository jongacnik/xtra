<?php 
/*
Template Name: Procedures
*/

get_header(); ?>

<div id="procedures">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; else: ?>
		<p>Sorry, no posts we're found.</p>
<?php endif; ?>
</div>

<?php get_footer(); ?>