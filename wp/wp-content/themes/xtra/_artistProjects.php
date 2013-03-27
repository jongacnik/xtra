<?php 
/*
Template Name: Artist's Projects Archive
*/
?>

<?php 
/* Global goods of current issue */
$get_current = "SELECT * FROM xtra_posts WHERE post_type='issue' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
$get_current = mysql_fetch_assoc(mysql_query($get_current));
$curr_nm = $get_current['post_title']; ?>

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
	$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
	$author = get_field('author'); ?>
  	
  	<img src="<?=$thumb?>"><br>
  	<?=$author?><br>
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
    <?=(get_field('web_only') ? 'Web Only ' : '').$type ?><br>
    
  <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<hr>

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
}

/* Spit out the list */
foreach($alphas as $alpha => $artists){
	if(!empty($artists)){
		echo $alpha.'<br><br>';
		foreach($artists as $each){ ?>
			<a href="<?=$each['artistUrl']?>"><?=$each['artistName']?></a><br>
  <?php }
  		echo '<br>';
	}
}
?>