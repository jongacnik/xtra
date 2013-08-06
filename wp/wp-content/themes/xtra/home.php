<?php 

/* Global goods of current issue */
$get_current = "SELECT * FROM xtra_posts WHERE post_type='issue' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
$get_current = mysql_fetch_assoc(mysql_query($get_current));
$curr_nm = $get_current['post_title'];
$curr_id = $get_current['ID']; ?>

<?php get_header(); ?>

<?php 
/* Get current issue stuff */
$args = array(
	'post_type' 		=> 'issue',
	'post_status' 		=> 'publish',
	'p'					=> $curr_id
);
query_posts($args); 
the_post(); 

$cover  = wp_get_attachment_image_src( get_post_thumbnail_id($curr_id), 'medium' ); $cover = $cover[0];
$volume = wp_get_post_terms( $curr_id, 'volume_taxonomy', array("fields" => "names")); 
$volume = str_replace('v', 'Volume ', $volume[0]); 
$season = explode(' ', get_the_title()); 
$year   = $season[1];
$season = $season[0];
$number = $numbers[strtolower($season)];
$buyurl = get_field('purchase_url');
$link = get_permalink(); ?>
<?php wp_reset_query(); ?>



<div id="xtra-home">
	<div id="top-row" class="padding-fix">
		<div id="archive-slider">
			<div class="box-title century">From the Archives</div>	
			<ul id="archive-slideables">
			<?php

			/* Get random articles */
			$args = array(
				'post_type' 		=> 'article',
				'post_status' 		=> 'publish',
				'meta_key'			=> '_thumbnail_id',
				'post_count'		=> 10,
				'posts_per_page' 	=> 10,
				'orderby'			=> 'rand',
				'tax_query'         => array(
					array(
			        'taxonomy' 	=> 'artType_taxonomy',
			        'terms' 	=> 'artist_project',
			        'field' 	=> 'slug',
			        'operator'	=> 'NOT IN'
			        )
			    )
			);
			$slider = new WP_Query($args);
			if( $slider->have_posts() ) :
			  while ($slider->have_posts()) : $slider->the_post(); 
				$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider' ); $thumb = $thumb[0]; 
				$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
				$vol 	= wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); $vol = str_replace('v', 'Volume ', $vol[0]);
				$iss 	= wp_get_post_terms( $post->ID, 'issue_taxonomy', array("fields" => "names")); $iss = $iss[0];
				$seas 	= explode(' ', $iss);
				$num 	= $numbers[strtolower($seas[0])];
				$author = get_field('author'); ?>

				<li>
					<a href="<?php the_permalink() ?>"><img src="<?=$thumb?>" class="full-fade"></a>
					<a href="<?php the_permalink() ?>" class="archive-slider-link">
						<div class="a-volume a-meta"><?=$vol?></div>
						<div class="a-date a-meta"><?=$iss?></div>
						<div class="a-issue a-meta"><?=$num?><br></div>
						<div class="a-type a-meta"><?=(get_field('web_only') ? 'Web Only ' : '').$type ?></div>
						<div class="archive-vertical">
							<div class="archive-author gothic"><?=$author?></div>
							<div class="archive-title bold"><?php the_title(); ?></div>
						</div>
					</a>
				</li>

  				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			</ul>
	    </div>

	    <div id="home-current">
			<div class="box-title century">Current Issue</div>
			<div class="current-issue">
				<div class="current-issue-cover"><a href="<?=$link?>" class="fade"><img src="<?=$cover?>"></a></div>
				<div class="current-issue-title century"><?=$season?> <?=$year?><br><?=$volume?> <?=$number?></div>
				<ul class="current-issue-meta gothic meta">
					<li><a href="<?=$buyurl?>">Buy Now</a></li>
					<li><a href="https://secure.x-traonline.org/store/product/153">Subscribe</a></li>
					<li><a href="http://x-traonline.org/distribution/">Find a Bookstore</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="home-grid" class="padding-fix">
	    <div id="white-hack"></div>
			<div id="home-left">
				<div id="home-events">
					<div class="box-title century home-small-box">Events</div>
					<ul> <!-- INSERT EVENTS -->

						<?php $args = array(
						  'post_type' 			=> 'event',
						  'post_status' 		=> 'publish',
						  'posts_per_page' 		=> 2,
						  'post_count'			=> 2
						);
						$events = new WP_Query($args);
						if( $events->have_posts() ) :
						  while ($events->have_posts()) : $events->the_post();
						  	$thumb  	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); $thumb = $thumb[0];  
							$eventName	= get_the_title();
							$eventName = strlen($eventName) > 60 ? substr( $eventName, 0, strrpos( substr( $eventName, 0, 60), ' ' ) ).'...' : $eventName;
							$eventUrl	= get_permalink();
							$eventDate  = get_field('EVENT-date'); ?>
							
						<li>
							<a href="<?=$eventUrl?>" class="home-image fade"><img src="<?=$thumb?>"></a>
							<span class="home-da gothic"><?=$eventDate?></span>
							<div class="home-title">
								<a href="<?=$eventUrl?>"><?=$eventName?></a>
							</div>
						</li>

					<?php endwhile; 
						endif;
						wp_reset_query(); ?>

					</ul>
				</div>
	    				



	    		<?php /* Get current artist project */
				$args = array(
				  'issue_taxonomy' 		=> $curr_nm,
				  'post_type' 			=> 'article',
				  'post_status' 		=> 'publish',
				  'posts_per_page' 		=> 1,
				  'post_count'			=> 1,
				  'tax_query'			=> array(
						array(
				        'taxonomy' 	=> 'artType_taxonomy',
				        'terms' 	=> 'artist_project',
				        'field' 	=> 'slug',
				        'operator'	=> 'IN'
				        )
				    )
				);
				$articles = new WP_Query($args);
				if( $articles->have_posts() ) :
				  while ($articles->have_posts()) : $articles->the_post();
					$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); $thumb = $thumb[0]; 
					$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
					$author = get_field('author');
					$artist = get_field('artist'); ?>

					<a href="<?php the_permalink() ?>" id="home-artistp">
						<div class="home-image" style="background-image: url('<?=$thumb?>');"></div>
						<span class="home-da decennie">Artist's Project</span>
						<div class="home-title decennie">
							<?=$artist?><br><?php the_title(); ?>
						</div>
						<span class="meta gothic"><?=$author?></span>
					</a>
				    
				  <?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>

				
		</div>
			

		<div id="home-center">
			<div class="box-title century"><?=$volume.' '.$number?></div>
			<ul>

				<?php

				/* Get current articles (except artist project) */
				$args = array(
				  'issue_taxonomy' 		=> $curr_nm,
				  'post_type' 			=> 'article',
				  'post_status' 		=> 'publish',
				  'posts_per_page' 		=> -1,
				  'tax_query'			=> array(
						array(
				        'taxonomy' 	=> 'artType_taxonomy',
				        'terms' 	=> 'artist_project',
				        'field' 	=> 'slug',
				        'operator'	=> 'NOT IN'
				        )
				    )
				);
				$articles = new WP_Query($args);
				if( $articles->have_posts() ) :
					while ($articles->have_posts()) : $articles->the_post();
						$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); $thumb = $thumb[0]; 
						$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
						$author = get_field('author');
						$title = get_the_title();
						$title = strlen($title) > 60 ? substr( $title, 0, strrpos( substr( $title, 0, 60), ' ' ) ).'...' : $title; ?>

					    <li>
							<a href="<?php the_permalink() ?>" class="home-image fade"><img src="<?=$thumb?>"></a>
							<span class="home-da gothic"><?=$author?></span>
							<div class="home-title">
								<a href="<?php the_permalink() ?>"><?=$title?></a>
							</div>
							<span class="meta-caps gothic home-type"><?=(get_field('web_only') ? 'Web Only ' : '').$type ?></span>
						</li>

				  	<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>

			</ul>
		</div>
		

		<div id="home-right">
			<ul class="featured-ads">
				<?php

				/* Get ads */
				$args = array(
				  	'post_type' 		=> 'advertisement',
				  	'post_status' 		=> 'publish',
				  	'posts_per_page' 	=> -1,
				  	'meta_query' 		=> array(
						array (
							'key' 		=> 'featured_ad',
							'value' 	=> '1',
							'compare' 	=> '=',
						),
					),
				);
				$ads = new WP_Query($args);
				if( $ads->have_posts() ) :
					while ($ads->have_posts()) : $ads->the_post();
						$imgID = get_field('ad_image');
						$img   = wp_get_attachment_image_src( $imgID, 'advertisement-feature' );
						$url   = get_field('ad_url');
						$name  = get_the_title(); ?>
					    <li>
					    	<a href="<?=$url?>" title="<?=$name?>"><img src="<?=$img[0]?>"></a>
						</li>
				  	<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</ul>

			<div id="home-about">
				<?php bloginfo('description'); ?>
			</div>

			<iframe src="<?php bloginfo('template_url'); ?>/mailing.php" width="230" height="138" scrolling="no" id="mailingFrame"></iframe>

			<ul class="ads">
				<li>
				<?php

				/* Get ads */
				$args = array(
					'post_type' 		=> 'advertisement',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> -1,
					'meta_query' 		=> array(
						array (
							'key' 		=> 'featured_ad',
							'value' 	=> '0',
							'compare' 	=> '=',
						),
					),
				);
				$ads = new WP_Query($args);
				if( $ads->have_posts() ) :

					while ($ads->have_posts()) : $ads->the_post();
						$imgID = get_field('ad_image');
						$img   = wp_get_attachment_image_src( $imgID, 'advertisement' );
						$url   = get_field('ad_url');
						$name  = get_the_title(); ?>

					    <a href="<?=$url?>" title="<?=$name?>"><img src="<?=$img[0]?>"></a>

				  	<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
				</li>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#archive-slideables').cycle({ 
	    fx: 'scrollLeft', 
		speed: 300, 
	})
	$('.featured-ads').cycle({
		'timeout':5000,
		'speed': 300
	})
</script>

</div> <!-- /#home -->
<?php get_footer(); ?>