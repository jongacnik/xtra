<?php
$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
$author = get_field('author');
$artist = get_field('artist');
$banner = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'artist-banner' ); $banner = $banner[0];
$attachments = new Attachments( 'my_attachments' ); ?>
<?php if( $attachments->exist() ) : ?>
<div id="artist-proj-header">
	<div id="artproj-banner-hover">View Project</div>
	<?php $counter = 0; ?>
    <?php while( $attachments->get() ) : 
    	$img_src = $attachments->src('artist-project-image');
    	$img_cpt = $attachments->field( 'title' );
    ?>
    	<?php if($counter == 0): ?>
    		<a href="<?=$img_src?>" rel="shadowbox[Gallery]" rev="<?=$img_cpt?>"><div id="artproj-banner" style="background-image: url('<?=$banner?>');" class="full-fade"></div></a>
    	<?php else: ?>
    		<a href="<?=$img_src?>" rel="shadowbox[Gallery]" rev="<?=$img_cpt?>" style="display:none;"></a>
    	<?php endif; ?>
    	<?php $counter++; ?>
    <?php endwhile; ?>
    <div id="artproj-meta" class="gothic">Artist: <?=$artist?><span>Click on image to view project</span></div>
</div>
<?php else: ?>
<div id="artist-proj-header">
	<div id="artproj-banner" style="background-image: url('<?=$banner?>');" ></div>
</div>
<?php endif; ?>

<div id="artistproj-wrap" class="padding-fix">

	<div id="artproj-left">
		<div class="glue-anchor"></div>
		<div id="toc-current" class="glue">
			<div id="back-link"><a href="<?=$link?>" class="meta-caps gothic">&#8592; Back to Table of Contents</a></div>
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

	<div id="artproj-right">

		<div id="pages">
			<div class="page">
				<div class="page-inner">
				<?php if($page > 1) :?>
					<?php the_content(); ?>
				<?php else: ?>
					<div id="artproj-header">
						<h2><?php if(!empty($artist)) echo $artist; ?> &mdash; <?php the_title() ;?></h2>
						<span id="artproj-author"><?=$author?></span>
					</div>
					<?php the_content(); ?>
				<?php endif; ?>
				

				</div>
			</div>
		</div>

	</div>
</div>

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