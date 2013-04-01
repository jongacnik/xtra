<?php 
/*
Template Name: Artist's Project
*/
get_header(); ?>
<script>
	Shadowbox.init({
		overlayOpacity: 1,
		displayCounter: 0
	});
	$('#main-nav-links li').each(function(){
		$(this).removeClass('current_page_ancestor');
	});
	$('#main-nav-links li:nth-child(3)').addClass('current_page_ancestor');
</script>

<?php $title = get_the_title($post->ID);
$type = get_the_category($post->ID); $type = $type[0]->cat_name;
$author = get_post_meta($post->ID, 'author');
$artist = get_post_meta($post->ID, 'artist');
$cover = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$archivedParents = get_post_ancestors($post->ID); 
$year = get_post_meta($archivedParents[0], 'date');
$storeURL = get_post_meta($archivedParents[0], 'URL');
$thumbnail = get_the_post_thumbnail($archivedParents[0], 'medium');

?>

<!-- ARTIST PROJECT -->
<style>
/** {
	color: white !important;
	background: black !important;
}*/
</style>
<script>
	//$(function(){
	//	$('#logo-link').html('<img src="http://jongacnik.com/subs/xtra/wp/wp-content/themes/xtra/images/inverse-logo.gif">');
	//	$('#footer-link').html('<img src="http://jongacnik.com/subs/xtra/wp/wp-content/themes/xtra/images/inverse-footer.gif">');
	//});
</script>
<div id="artist-proj-header">
	<div id="artproj-banner-hover">View Project</div>
	<?php 



$size = "full";
$args = array(
	'numberposts' => null,
	'post_parent' => $post->ID,
	'post_type' => 'attachment',
	'nopaging' => false,
	'post_mime_type' => 'image',
	'order' => 'ASC',
	'orderby' => 'menu_order ID',
	'post_status' => 'any'
);
$attachments =& get_children($args);
$count = 0;
if ($attachments) {
	if(count($attachments)>1){
		foreach($attachments as $attachment) {
			foreach($attachment as $attachment_key => $attachment_value) {
				$imageAlt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
				echo $imageAlt;
				if ($imageAlt == 'gallery' || $imageAlt == 'Gallery'){
					$imageCaption = $attachment->post_excerpt;
					$imagearray = wp_get_attachment_image_src($attachment_value, $size, false);
					$imageURI = $imagearray[0];
					if ($count==0){ ?>
						<a href="<?=$imageURI?>" rel="shadowbox[Gallery]" rev="<?=$imageCaption?>" title="<?=$artist[0]?> — <?=$title?>"><div id="artproj-banner" style="background-image: url('<?=$cover[0]?>');" class="full-fade"></div></a>
					<?php $count++; } else { ?>
						<a href="<?=$imageURI?>" rel="shadowbox[Gallery]" rev="<?=$imageCaption?>" title="<?=$artist[0]?> — <?=$title?>" style="display:none;"></a>

				<?php	}
				} break;	
			 }
		}
	} else { ?>
		<div id="artproj-banner" style="background-image: url('<?=$cover[0]?>'); cursor: default;" ></div>
		<style>
		artproj-banner-hover, #artproj-meta span { display: none ;}
		</style>
	<?php }
}
unset($args); ?>









	<div id="artproj-meta" class="gothic">Artist: <?=$artist[0]?><span>Click on image to view project</span></div>



</div>
<div id="artistproj-wrap" class="padding-fix">
	<div id="artproj-left">
		<div class="glue-anchor"></div>
		<div id="toc-current" class="glue">
			<div id="back-link"><a href="<?=get_page_link($archivedParents[0]);?>" class="meta-caps gothic">&#8592; Back to Table of Contents</a>
				<br><br><a href="<?=get_page_link(2724);?>" class="meta-caps gothic">&#8592; Back to Artist's Projects</a></div>
			<div class="current-issue">
				<div class="current-issue-cover"><a href="<?=get_page_link($archivedParents[0]);?>" class="fade"><?=$thumbnail?></a></div>
				<div class="current-issue-title century"><?=$year[0]?><br><?=get_the_title($archivedParents[1])?> <?=get_the_title($archivedParents[0])?></div>
				<ul class="current-issue-meta gothic meta">
					<li><a href="<?=$storeURL[0]?>">Buy Now</a></li>
					<li><a href="https://secure.x-traonline.org/store/product/153">Subscribe</a></li>
					<li><a href="http://x-traonline.org/distribution/">Find a Bookstore</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="artproj-right">

		<div id="pages">
			<div class="page">
				<div class="page-inner">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if($page > 1) :?>
						<?php the_content(); ?>
					<?php else: ?>
						<div id="artproj-header">
							<h2><?=$artist[0]?> &mdash; <?=$title?></h2>
							<span id="artproj-author"><?=$author[0]?></span>
						</div>
						<?php the_content(); ?>
					<?php endif; ?>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
		<div id="page-nav" class="gothic meta">
			<?php wp_link_pages('before=&after=&link_before=<span class="number">&link_after=</span>&next_or_number=next_and_number&nextpagelink=→&previouspagelink=←'); ?> 
		</div>

	</div>
</div>

<script type="text/javascript">
$(function(){

	$(window).load(function(){

		$('#pages img').each(function(){
			var imgH = $(this).height();
			var imgW = $(this).width();
			if (imgH > imgW){
				$(this).css({
					width: 300,
					cursor: 'pointer'
				});
			}
		});

	});
});
</script>

<?php get_footer(); ?>