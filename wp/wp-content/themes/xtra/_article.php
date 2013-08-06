<div id="article-wrap" class="padding-fix">
	<div id="art-left">
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

	<div id="art-right">

		<div id="pages">
			<div class="page">
				<div class="page-inner">

				<?php
						$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
						$author = get_field('author');
						$artist = get_field('artist');
						$city   = get_field('city');
						$venue  = get_field('venue'); ?>

				<?php if($page > 1) :?>
					<?php the_content(); ?>
				<?php else: ?>
					<div id="art-header">
						<span class="meta-caps gothic" id="art-type"><?=$type?></span>
						
						<?php if($type=='Review'): ?>
							<span class="review-title"><?php the_title() ;?></span>
							<?php if(!empty($artist)) echo '<h2 class="revrev">'.$artist.'</h2>'; ?>
							<?php 
								$ex1name = get_field('exhibition_name');
								$ex1loc  = get_field('location');
								$ex2name = get_field('exhibition_2_name');
								$ex2loc  = get_field('location_2');
								$ex3name = get_field('exhibition_3_name');
								$ex3loc  = get_field('location_3');

								echo '<div class="multi-review">';
								if(!empty($ex1name)) echo '<h2>'.$ex1name.'</h2>';
								if(!empty($ex1loc)) echo $ex1loc;
								if(!empty($ex2name)) echo '<h2>'.$ex2name.'</h2>';
								if(!empty($ex2loc)) echo $ex2loc;
								if(!empty($ex3name)) echo '<h2>'.$ex3name.'</h2>';
								if(!empty($ex3loc)) echo $ex3loc;
								echo '</div>';
							?>
						<?php else: ?>
							<h2><?php the_title() ;?><br><?php if(!empty($artist)) echo $artist; ?></h2>
						<?php endif; ?>

						<?php if(!empty($venue)) echo '<span id="art-venue">'.$venue.'</span>'; ?>
						<?php if(!empty($city)) echo '<span id="art-city">'.$city.'</span>'; ?>
						<br><?php if(!empty($author)) echo '<span id="art-author">'.$author.'</span>'; ?>
					</div>
					<?php the_content(); ?>
				<?php endif; ?>
				

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
					width: 300
				});
				$(this).addClass('zoomIn')
			}
			
			$(this).parents('p').css('text-align','center')
		});

	});
});
</script>