<?php 
/*
Template Name: Volumes
*/
?>

<?php get_header(); ?>

<div id="issue-archive">

<?php $volumes = count(get_terms( 'volume_taxonomy'));
	for($i=$volumes;$i>0;$i--){ ?>
		<ul class="level-1">
		<li class="volume">
            <div class="box-title century">Volume <?=$i?></div>
            <ul class="level-2">
	  	<?php $args = array(
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
			$total = $issues->found_posts;

			if($total < 4){
	  			for($j = 4-$total; $j > 0; $j--){ 
	  				$thisN = 'Number '.($j+$total); ?>
	  				<li>
		    			<a class="coming-soon" href="<?php the_permalink(); ?>"><div class="issue-title times"><?php echo 'Coming '.array_search($thisN, $numbers); ?> <?=$thisN?></a>
					</li>
	  	  <?php }
	  		}

			while ($issues->have_posts()) : $issues->the_post(); 
		    	$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); $cover = $cover[0]; ?>
		    	<li>
		    		<a href="<?php the_permalink(); ?>"><img src="<?=$cover?>" class="full-fade"><div class="issue-title times"><?php the_title(); ?>
                    <br>Number <?=$counter?></div></a>

					<?php $counter--; ?>
				</li>
	  <?php endwhile;
	  		
		endif;

	    echo '</ul></li>';
		wp_reset_query(); 
  }
?>

</div>
<?php get_footer(); ?>