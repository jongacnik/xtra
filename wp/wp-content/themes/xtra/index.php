<?php 

$get_current = "SELECT * FROM xtra_posts WHERE post_type='issue' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
$get_current = mysql_fetch_assoc(mysql_query($get_current));
$curr_nm = $get_current['post_title'];
$curr_id = $get_current['ID'];

$args = array(
  'issue_taxonomy' 	=> $curr_nm,
  'post_type' 		=> 'article',
  'post_status' 	=> 'publish',
  'posts_per_page' 	=> -1
);
$articles = new WP_Query($args);
if( $articles->have_posts() ) :
  while ($articles->have_posts()) : $articles->the_post(); ?>

  	<?php the_post_thumbnail('thumbnail'); ?>
    <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<hr>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(function(){
	$('.slide').each(function(){
		$(this).load('/wp/random-slider-item/?cachebuster=' + Math.floor(Math.random()*10001))
	})
	// setTimeout(function(){
	// 	window.setInterval(function(){
	// 		$('.slide:nth-child(1)').remove()
	// 		$('#slides').append('<div class="slide" />').load('/wp/random-slider-item/?cachebuster=' + Math.floor(Math.random()*10001))
	// 	},800)
	// },800)
	
})
</script>
<div id="slides">
	<div class="slide"></div>
	<div class="slide"></div>
	<div class="slide"></div>
</div>