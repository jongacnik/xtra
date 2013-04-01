<?php 
/*
Template Name: Advertise
*/
get_header(); ?>

<div id="advertise-wrap">
<div id="advertise-header">
<?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php //the_content(); ?>
<?php //endwhile; endif; ?>
	<h1 class="times">Advertise in X-TRA</h1>
	<span class="gothic">PO Box 41–437 Los Angeles, California 90041 USA<br><a href="mailto:ads@x-traonline.org">ads@x-traonline.org</a></span>
</div>


	<div id="ad-grid">
		<div id="ad-grid-1" class="gothic">
			<span class="rotate-header" id="rh1">Full Bleed</span>
			<span class="rotate-header" id="rh2">No Bleed</span>
		</div>
		<div id="ad-grid-2">
			<span class="gothic ad-grid-title">Full Color</span>
			<br><br><br><b>Required Format</b>
			<br>PDF
			<br>Color mode — CMYK
			<br>Image resolution — 300 dpi

			<br><br><b>Ad Size (All ads are full page)</b>
			<br>Document size — 6.5 × 9.75 inches
			<br>Bleed — 0.125 inches
			<br>Type safe area — 0.375 inches
			<br>Include crop marks

			<br><br>—

			<br><br><b>Required Format</b>
			<br>PDF
			<br>Color mode — CMYK
			<br>Image resolution — 300 dpi

			<br><br><b>Ad Size (All ads are full page)</b>
			<br>Document size — 5.875 × 9.125 inches
			<br>No crop marks


		</div>
		<div id="ad-grid-3">
			<span class="gothic ad-grid-title">One Color</span>
			<br><br><br><b>Required Format</b>
			<br>PDF
			<br>Color mode — Greyscale
			<br>Image resolution — 300 dpi

			<br><br><b>Ad Size (All ads are full page)</b>
			<br>Document size — 6.5 × 9.75 inches
			<br>Bleed — 0.125 inches
			<br>Type safe area — 0.375 inches
			<br>Include crop marks

			<br><br>—

			<br><br><b>Required Format</b>
			<br>PDF
			<br>Color mode — Greyscale
			<br>Image resolution — 300 dpi

			<br><br><b>Ad Size (All ads are full page)</b>
			<br>Document size — 5.875 × 9.125 inches
			<br>No crop marks
		</div>
		<div id="ad-grid-4" class="gothic">
			<span class="rotate-header-2" id="rh3">Full Bleed</span>
			<span class="rotate-header-2" id="rh4">No Bleed</span>
		</div>


	</div>	

		<div id="ad-img">
			<img src="<?php bloginfo('template_url'); ?>/_img/bleed.png">
		</div>

		<div class="ad-row times">
			<h2 class="century">Technical Specifications:</h2>
			<ul>
				<li>High resolution PDFs, version 1.3 or 1.4</li>
				<li>InDesign files must include fonts, logos (EPS/AI format) and high resolution pictures in (TIFF format)</li>
				<li>All images must be 300 dpi for quality reproduction</li>
				<li>All fonts must be embedded</li>
				<li>Files should just converted into CMYK (no RGB, LAB or color profiles)</li>
				<li>Combined color ink density should not exceed 300%.</li>
				<li>To obtain a deep black please use cyan 60%, magenta 0%, yellow 0%, black 100% = color density 160%</li>

			</ul>
		</div>

		<div class="ad-row times">
			<h2 class="century">Selling Ads:</h2>
			<ul>
				<li>Email files or download links to <a href="mailto:ads@x-traonline.org">ads@x-traonline.org</a></li>
				<li>For questions regarding ad details please contact
				   <br><b>X-TRA Assistant Managing Editor</b>	
				   <br>Brica Wilcox
				   <br><a href="mailto:brica@x-traonline.org">brica@x-traonline.org</a></li>

			</ul>
		</div>

		<div id="ad-links" class="gothic">
			<a href="<?php bloginfo('template_url'); ?>/pdf/XTRA_Ad_details.pdf">Download Ad Specs</a>
			<!-- <br><a href="#">Download Media Kit</a> -->
		</div>

	

</div>



<?php get_footer(); ?>