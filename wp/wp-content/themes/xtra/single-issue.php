<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); $cover = $cover[0];
	$volume = wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); 
	$volume = str_replace('v', 'Volume ', $volume[0]);
	$vNum =  str_replace('Volume ', '', $volume);
	$season = explode(' ', get_the_title()); 
	$year   = $season[1];
	$season = $season[0];
	$number = $numbers[strtolower($season)];
	$iNum = str_replace('Number ', '', $number);
	$buyurl = get_field('purchase_url');
	$issue_name = $post->post_name;
endwhile; endif; ?>
<?php wp_reset_query(); ?>

<div id="table-of-contents" class="padding-fix">
	<div id="toc-left">
		<div class="glue-anchor"></div>
		<div id="toc-current" class="glue">
			<div class="box-title century">Get This Issue</div>
			<div class="current-issue">
				<div class="current-issue-cover"><img src="<?=$cover?>"></div>
				<div class="current-issue-title century"><?=$season?> <?=$year?><br><?=$volume?> <?=$number?></div>
				<ul class="current-issue-meta gothic meta">
					<li><a href="<?=$buyurl?>">Buy Now</a></li>
					<li><a href="https://secure.x-traonline.org/store/product/153">Subscribe</a></li>
					<li><a href="http://x-traonline.org/distribution/">Find a Bookstore</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="toc-center">
		<div class="box-title century">Table of Contents</div>
<?php 
/////////////////////////////
// Get all the Articles
/////////////////////////////
?>

		<?php /* Get Features */
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
		if( $features->have_posts() ) : ?>
		<ul class="toc-section gothic">
			<span class="meta-caps">Features</span>
			<?php while ($features->have_posts()) : $features->the_post();
				$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
				$author = get_field('author'); ?>
		    	<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span><?=$author?></span></li>
		  	<?php endwhile; ?>
		</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

		<?php /* Get Reviews */
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
		if( $reviews->have_posts() ) : ?>
		<ul class="toc-section gothic">
			<span class="meta-caps">Reviews</span>
		  	<?php while ($reviews->have_posts()) : $reviews->the_post();
				$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
				$author = get_field('author'); ?>
		  		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span><?=$author?></span></li>
		  	<?php endwhile; ?>
		  </ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

		<?php /* Get Columns */
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
		if( $columns->have_posts() ) : ?>
		<ul class="toc-section gothic">
			<span class="meta-caps">Columns</span>
		  	<?php while ($columns->have_posts()) : $columns->the_post();
				$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
				$author = get_field('author'); ?>
		  		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span><?=$author?></span></li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	
		<?php /* Get Artist Project */
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
		if( $artist_projects->have_posts() ) : ?>
		<ul class="toc-section gothic">
			<span class="meta-caps">Artist's Project</span>
			<?php while ($artist_projects->have_posts()) : $artist_projects->the_post();
				$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
				$artist = get_field('artist'); ?>
		  		<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span><?=$artist?></span></li>
		  	<?php endwhile; ?>
		</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

	</div>

	<div id="toc-right">
		<div class="box-title century">Issue Archive</div>
		<?php /* Volume Nav */
		include(__DIR__.'/volumeNav.php'); ?>
	</div>
</div>

<?php get_footer(); ?>