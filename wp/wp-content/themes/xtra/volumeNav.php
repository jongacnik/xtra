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