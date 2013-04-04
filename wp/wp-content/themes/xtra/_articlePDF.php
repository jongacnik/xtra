
<script src="<?=get_template_directory_uri()?>/_js/pdf.js"></script>
<script>
	PDFJS.workerSrc = '<?=get_template_directory_uri()?>/_js/pdf.js';
	thePDF = '<?=get_field("pdf_upload")?>';
</script>
<script src="<?=get_template_directory_uri()?>/_js/viewer.js"></script>
<link rel="stylesheet" href="<?=get_template_directory_uri()?>/_js/script.css"></script>

<div id="article-wrap" class="padding-fix pdf">
	<div id="art-left">
		<div class="glue-anchor"></div>
		<div id="toc-current" class="glue">
			<div id="back-link"><a href="<?=$link?>" class="meta-caps gothic">&#8592; Back to Table of Contents</a></div>
			<div class="current-issue">
				<div class="current-issue-cover"><a href="<?=$link?>" class="fade"><img src="<?=$cover?>"></a></div>
				<div class="current-issue-title century"><?=$season?> <?=$year?><br><?=$volume?><br><?=$number?></div>
				<ul class="current-issue-meta-pdf gothic meta">
					<li><a href="<?=$buyurl?>">Buy Now</a></li>
					<li><a href="https://secure.x-traonline.org/store/product/153">Subscribe</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="art-right">
		<div id="art-header">

			<?php
			$type 	= wp_get_post_terms( $post->ID, 'artType_taxonomy', array("fields" => "names")); $type = $type[0];
			$author = get_field('author');
			$artist = get_field('artist');
			$city   = get_field('city');
			$venue  = get_field('venue'); ?>

			<span class="meta-caps gothic" id="art-type"><?=$type?></span>
			<h2><?php the_title() ;?><br><?php if(!empty($artist)) echo $artist; ?></h2>
			<?php if(!empty($venue)) echo '<span id="art-venue">'.$venue.'</span>'; ?>
			<?php if(!empty($city)) echo '<span id="art-city">'.$city.'</span>'; ?>
			<br><?php if(!empty($author)) echo '<span id="art-author">'.$author.'</span>'; ?>
		</div>
	</div>

</div>

<div class="pdfWrap"></div>