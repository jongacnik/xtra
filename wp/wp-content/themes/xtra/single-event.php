<?php get_header(); ?>
<div id="events-wrap" class="event-single-wrap">

<div id="events-left" class="padding-fix">
	<div id="event-nav" class="gothic meta-caps">
		<a href="<?php bloginfo('url'); ?>/events">&larr; Upcoming and Recent Events</a>
		<div id="nextPrevEvent"><?php previous_post('%', 'previous', 'no'); ?>&nbsp;/&nbsp;<?php next_post('%', 'next', 'no'); ?></div>
	</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<ul id="events" class="events-single">
		<?php
		$thumb    = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider' ); $thumb = $thumb[0]; 
		$sortDate = get_field('EVENT-startdate');
		$date     = get_field('EVENT-date');
		$time     = get_field('EVENT-time');
		$place    = get_field('EVENT-place'); ?>
		<li>
			<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
			<div class="e-meta">
				<span class="date"><?=$date?></span>
				<?php if(!empty($time)){ ?>
				<span class="time"><?=$time?></span>
				<?php } ?>
				<span class="place"><?=$place?></span>
			</div>
			<div class="event-content">
				<a href="<?php the_permalink() ?>"><img src="<?=$thumb?>"></a>
		    	<?php the_content(); ?>
		    	<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" alt="Share on Facebook" title="Share on Facebook" target="_blank">Facebook</a>
		    </div>
		</li>
	</ul>

<?php endwhile; else: ?>

	<p>Sorry, this page does not exist</p>

<?php endif; ?>
</div>

<?php /* make archive */

$years = range(1997, date('Y'));
$years = array_flip($years);
foreach($years as $year => $v){
	$years[$year] = array();
}
$years = array_reverse($years, true);

$args = array(
  'post_type' 			=> 'event',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> -1,
  'post_count'			=> -1,
  'orderby'				=> 'meta_value',
  'meta_key' 			=> 'EVENT-startdate',
  'order' 				=> 'DESC',
);
$upcoming = new WP_Query($args);
if( $upcoming->have_posts() ) :
	while ($upcoming->have_posts()) : $upcoming->the_post(); 
		$name		= get_the_title();
		$url		= get_permalink();
		$sortDate 	= get_field('EVENT-startdate');
		$year 		= substr($sortDate, 0, 4); 

		$eventInfo = array(
			'eventName'  => $name,
			'eventUrl'   => $url,
			'eventDate'  => $sortDate
		);
		
		array_push($years[$year], $eventInfo);

	endwhile;
endif;
wp_reset_query(); ?>

<div id="events-right" class="padding-fix">
	<div id="event-archive">
		<div class="box-title century">Events Archive</div>
		<ul>
	<?php foreach($years as $year => $events){
		if(!empty($events)){ ?>
			<li>
				<span class="event-year"><?=$year?></span>
				<ul>
				<?php foreach($events as $event){ 
					$date = DateTime::createFromFormat('Ymd', $event['eventDate']);
					$date = $date->format('m.d.y'); ?>
					<li><?=$date?><br><a href="<?=$event['eventUrl']?>"><?=$event['eventName']?></a></li>
				<?php } ?>
				</ul>
			</li>
		<?php }
	} ?>
		</li>
	</div>
</div>


</div>
<?php get_footer(); ?>