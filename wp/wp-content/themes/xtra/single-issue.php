<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); $cover = $cover[0];
	$volume = wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); 
	$volume = str_replace('v', 'Volume ', $volume[0]); 
	$season = explode(' ', get_the_title()); 
	$year   = $season[1];
	$season = $season[0];
	$number = $numbers[strtolower($season)];
	$buyurl = get_field('purchase_url');
	$issue_name = $post->post_name;
?>
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
/////////////////////////////
// Get all the Articles
/////////////////////////////
?>
<br><br>Features<br>
<?php

/* Get Features */
$args = array(
  'issue_taxonomy' 		=> $issue_name,
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'tax_query'			=> array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'feature',
        'field' 	=> 'slug',
        'operator'	=> 'IN'
        )
    )
);
$features = new WP_Query($args);
if( $features->have_posts() ) :
  while ($features->have_posts()) : $features->the_post();
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<br><br>Reviews<br>
<?php

/* Get Reviews */
$args = array(
  'issue_taxonomy' 		=> $issue_name,
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'tax_query'			=> array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'review',
        'field' 	=> 'slug',
        'operator'	=> 'IN'
        )
    )
);
$reviews = new WP_Query($args);
if( $reviews->have_posts() ) :
  while ($reviews->have_posts()) : $reviews->the_post();
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<br><br>Columns<br>
<?php

/* Get Columns */
$args = array(
  'issue_taxonomy' 		=> $issue_name,
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'tax_query'			=> array(
		array(
        'taxonomy' 	=> 'artType_taxonomy',
        'terms' 	=> 'column',
        'field' 	=> 'slug',
        'operator'	=> 'IN'
        )
    )
);
$columns = new WP_Query($args);
if( $columns->have_posts() ) :
  while ($columns->have_posts()) : $columns->the_post();
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>


<br><br>Artist Projects<br>
<?php

/* Get Artist Project */
$args = array(
  'issue_taxonomy' 		=> $issue_name,
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
$artist_projects = new WP_Query($args);
if( $artist_projects->have_posts() ) :
  while ($artist_projects->have_posts()) : $artist_projects->the_post();
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$artist = get_field('artist'); ?>
  	
  	<?=$artist?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<hr>
<?php 
/////////////////////////////
// Build Volume Nav
/////////////////////////////
?>
<?php $volumes = count(get_terms( 'volume_taxonomy'));
		for($i=$volumes;$i>0;$i--){
			echo $i.'<br>';
		  	$args = array(
			  'post_type' 			=> 'issue',
			  'post_status' 		=> 'publish',
			  'posts_per_page' 		=> -1,
			  'orderby'				=> 'menu_order',
			  'tax_query'			=> array(
					array(
			        'taxonomy' 	=> 'volume_taxonomy',
			        'terms' 	=> 'v'.$i,
			        'field' 	=> 'slug',
			        'operator'	=> 'IN'
			        )
			    )
			);
			$issues = new WP_Query($args);
			if( $issues->have_posts() ) :
			  $counter = $issues->found_posts;
			  while ($issues->have_posts()) : $issues->the_post(); ?>
			    Number <?=$counter?>
				<?php the_permalink(); ?><br>
				<?php $counter--; ?>
		<?php endwhile;
			endif;
			wp_reset_query(); 
	  }
?>


<?php endwhile; else: ?>

	<p>Sorry, this page does not exist</p>

<?php endif; ?>