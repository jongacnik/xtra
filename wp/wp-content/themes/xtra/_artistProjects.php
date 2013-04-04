<?php 
/*
Template Name: Artist's Projects Archive
*/
get_header(); ?>

<?php 
/* Global goods of current issue */
$get_current = "SELECT * FROM xtra_posts WHERE post_type='issue' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
$get_current = mysql_fetch_assoc(mysql_query($get_current));
$curr_nm = $get_current['post_title']; ?>

<div id="artist-proj-header" class="landing">

<?php /* Get current artist project */
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
        'operator'	=> 'IN'
        )
    )
);
$articles = new WP_Query($args);
if( $articles->have_posts() ) :
  while ($articles->have_posts()) : $articles->the_post();
	$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); $thumb = $thumb[0]; 
	$volume = wp_get_post_terms( $post->ID, 'volume_taxonomy', array("fields" => "names")); 
	$volume = str_replace('v', 'Volume ', $volume[0]); 
	$season = explode(' ', $curr_nm); 
	$year   = $season[1];
	$season = $season[0];
	$number = $numbers[strtolower($season)];
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author');
	$artist = get_field('artist'); ?>
  	
    <div id="artproj-banner-hover">
		<span class="artprojmeta century"><?=$curr_nm?> <?=$volume?> <?=$number?></span>
		<br><?=$artist?><br><?php the_title(); ?>
	</div>
	<a href="<?php the_permalink() ?>"><div id="artproj-banner" style="background-image: url('<?=$thumb?>');" class="full-fade"></div></a>

  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

</div>


<?php
/* Build alphabet array */
$alphas = range('A', 'Z');
$alphas = array_flip($alphas);
foreach($alphas as $alpha => $v){
	$alphas[$alpha] = array();
}

/* Push Artist info into array based on last name */
$args = array(
  'post_type' 			=> 'article',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'orderby'				=> 'meta_value',
  'meta_key' 			=> 'artist',
  'order' 				=> 'ASC',
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
	$artist = get_field('artist'); 
	$artistSort = explode(' ', $artist); $artistSort = substr(strtoupper($artistSort[1]), 0, 1);
	$url	= get_permalink(); 

	$artistInfo = array(
		'artistName'  => $artist,
		'artistUrl'   => $url
	);
	array_push($alphas[$artistSort], $artistInfo);

  endwhile; 
endif; 
wp_reset_query(); 


/* Sort names by last name within each letter */
foreach($alphas as $alpha => $v){
	$names = array();
	foreach ($alphas[$alpha] as $key => $row){
		$last = explode(' ', $row['artistName']);
		$names[$key] = $last[1];
	}
	array_multisort($names, SORT_ASC, $alphas[$alpha]);
} ?>

<div id="artplanding-wrap">
	<div id="artp-left" class="padding-fix">
		<div class="box-title century">Artist's Projects Archive</div>
		<ul class="artists">
			<?php

			/* Spit out the list */
			foreach($alphas as $alpha => $artists){
				if($alpha == 'H' || $alpha == 'R') echo '</ul><ul class="artists">';
				if(!empty($artists)){ ?>
					<li><span class="alpha"><?=$alpha?></span>
						<ul>
						<?php foreach($artists as $each){ 
							if($each['artistName'] == 'Justin Beal and Vishal Jugdeo') $each['artistName'] = 'Justin Beal and<br>Vishal Jugdeo'; ?>
							<li><a href="<?=$each['artistUrl']?>"><?=$each['artistName']?></a><li>
			  		<?php }
			  		echo '</ul><li>';
				}
			}
			?>
		</ul>

	</div>

	<div id="artp-right"  class="padding-fix">
		<a href="https://secure.x-traonline.org/store/category/4"><div id="artist-edition">
			X-TRA<br>Artist Editions
		</div></a>
		<span class="meta gothic">Available at the Store</span>
		<br><br><a href="https://secure.x-traonline.org/store/category/4" class="century">View All</a>
		<ul class="ads ap">
			<li>
			<?php

			/* Get ads */
			$args = array(
			  'post_type' 			=> 'advertisement',
			  'post_status' 		=> 'publish',
			  'posts_per_page' 		=> -1
			);
			$ads = new WP_Query($args);
			if( $ads->have_posts() ) :
				$count = 1;
				while ($ads->have_posts()) : $ads->the_post();
					$img  = get_field('ad_image');
					$url  = get_field('ad_url');
					$name = get_the_title(); ?>

				    <a href="<?=$url?>" title="<?=$name?>"><img src="<?=$img?>"></a>
						
					<?php $count++;
					if($count%4 == 0) echo '</li><li>'; ?>

			  	<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			</li>
		</ul>
	</div>
</div>


<script type="text/javascript">
	$('.ads').cycle({
		'timeout':5000,
		'speed': 300
	})
</script>

<?php get_footer(); ?>