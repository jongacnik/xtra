<?php 
/*
Template Name: Volumes
*/
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
			while ($issues->have_posts()) : $issues->the_post(); 
		    	$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); $cover = $cover[0]; ?>
		    	<img src="<?=$cover?>"><br>
		    	<?php the_title(); ?><br>
		    	Number <?=$counter?><br>
				<?php the_permalink(); ?><br>
				<?php $counter--; ?>
	  <?php endwhile;
		endif;
		wp_reset_query(); 
  }
?>