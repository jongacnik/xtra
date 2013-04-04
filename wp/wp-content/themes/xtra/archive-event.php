<?php get_header(); ?>

<div id="events-header" class="times">
<p>As a platform for provoking critical discourse about contemporary art,<br> 
X-TRA hosts events throughout the year, including artists’ talks, readings, conversations, performances, and film and video screenings. We have 
co-produced events in collaboration with the following venues and organizations: For Your Art; Museum of Contemporary Art, Armory Center for the Arts, Pasadena; College Art Association; Human Resources, Los Angeles; Barnsdall Art Park; Chapman University; Creative Arts Agency; Los Angeles Contemporary Exhibitions (LACE); Mandrake; Honor Fraser Gallery; and the Art Los Angeles Contemporary Art Fair.</p>
</div>


<?php /* Get upcoming/recent event */
$eventWidget = array(
	'upcoming' 	=> array(),
	'recent'	=> array()
);
$today = date('Ymd');

$args = array(
  'post_type' 			=> 'event',
  'post_status' 		=> 'publish',
  'posts_per_page' 		=> 5,
  'post_count'			=> 5
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

	if($sortDate >= $today){
		array_push($eventWidget['upcoming'], $eventInfo);
	} else {
		array_push($eventWidget['recent'], $eventInfo);
	}
	
	endwhile; 
endif;
wp_reset_query(); ?>

<div id="events-wrap" class="evArch">
	<div id="events-left" class="padding-fix">

		<div id="event-overview">
			<div class="box-title century">Events</div>
			<?php foreach($eventWidget as $modules => $module){
				if(!empty($module)){ ?>
				<div id="<?=$modules?>">
					<h3><?=$modules?> Events</h3>
					<ul>	
					<?php foreach($module as $event){ 
						$date = DateTime::createFromFormat('Ymd', $event['eventDate']);
						$date = $date->format('m.d.y');?>
						<li><span class="e-date"><?=$date?></span><a href="<?=$event['eventUrl']?>"><?=$event['eventName']?></a></li>
					<?php } ?>
					</ul>
				</div>
			<?php }
			} ?>
		</div>


		<?php if (have_posts()) : ?>
		<ul id="events">
			<?php while (have_posts()) : the_post(); 
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
			    	<?php the_excerpt(); ?>
			    </div>
			</li>
			<?php endwhile; ?>
		</ul>
		<div class="eventNav">
			<? next_posts_link('&larr; Previous') ?>
			<? previous_posts_link('Next &rarr;') ?>
		</div>
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
			$count = 0;
			while ($ads->have_posts()) : $ads->the_post();
				$img  = get_field('ad_image');
				$url  = get_field('ad_url');
				$name = get_the_title(); ?>

			    <?php if($count!=0 && $count%4 == 0) echo '</li><li>'; ?>
			    <a href="<?=$url?>" title="<?=$name?>"><img src="<?=$img?>"></a>
				<?php $count++; ?>

		  	<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</li>	
	</ul>
</div>




<script>
$('.page-item-7586').addClass('current_page_item')
$('.ads').cycle({
	'timeout':5000,
	'speed': 300
})
</script>
<?php get_footer(); ?>