<?php 
/*
Template Name: About
*/
get_header(); ?>

<div id="about-header">
<?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php //the_content(); ?>
<?php //endwhile; endif; ?>
	X-TRA is a quarterly art journal published in Los Angeles since 1997. The editorial board is composed of Los Angeles-based artists and writers. X-TRA provides an outlet for projects related to contemporary visual arts. We publish diverse critical approaches including expansive features, historical essays, commissioned artist's projects, interviews, and substantive exhibition and book reviews. <br>X-TRA is collectively edited by an independent board of artists and writers based in Los Angeles.
</div>

<div id="about-wrap">
	<div id="about-left" class="padding-fix">
		<div class="box-title century about-head">People</div>
		<div class="about-row">
			<h4>Editorial Board</h4>
			<ul class="tcol">
				<li>Stephen Berens</li>
				<li>Ellen Birrell</li>
				<li>Leslie Dick</li>
				<li>Karen Dunbar</li>
				<li>Shana Lutker</li>
				<li>Mario Ontiveros</li>
				<li>Elizabeth Pulsinelli</li>
				<li>Nizan Shaked</li>
				<li>Damon Willick</li>
			</ul>
		</div>
		<div class="about-row">
			<div class="col1">
				<h4>Executive Editor</h4>
				<ul>
					<li>Elizabeth Pulsinelli</li>
				</ul>
			</div>
			<div class="col1">
				<h4>Managing Editor</h4>
				<ul>
					<li>Shana Lutker</li>
				</ul>
			</div>
			<div class="col1">
				<h4>Assistant Managing Editor</h4>
				<ul>
					<li>Brica Wilcox</li>
				</ul>
			</div>

		</div>
		<div class="about-row">
			<h4>Contributing Editors</h4>
			<ul class="tcol">
				<li>Ken Allan</li>
				<li>Neha Choksi</li>
				<li>Allan deSouza</li>
				<li>Michelle Grabner</li>
				<li>Micol Hebron</li>
				<li>Aram Moshayedi</li>
				<li>Kristina Newhouse</li>
				<li>Jan Tumlir</li>
				<li>Anne Walsh</li>
			</ul>
		</div>
		<div class="about-row">
			<h5>X-TRA is published by Project X Foundation for Art <br>and Criticism, a 501(c)3 nonprofit corporation.</h5>
		</div>
		<div class="about-row">
			<div class="col1">
				<h4>Publishers</h4>
				<ul>
					<li>Jeff Beall</li>
					<li>Stephen Berens</li>
					<li>Ellen Birrell</li>
				</ul>
			</div>
			<div class="col2">
				<h4>board of directors / project x foundation for art and criticism</h4>
				<ul class="dcol">
					<li>Jeff Beall</li>
					<li>Stephen Berens</li>
					<li>Ellen Birrell</li>
					<li>Cay Sophie Rabinowitz</li>
					<li>Mitchell Syrop</li>
					<li>Michelle Whiting</li>
				</ul>
			</div>
		</div>


		<div class="about-row">
			<h4>Advisory Council</h4>
			<ul class="tcol">
				<li>Kevin Appel</li>
				<li>Kafi Blumenfield</li>
				<li>William Leavitt</li>
				<li>Sharon Lockhart</li>
				<li>Clayton Press</li>
				<li>Eve Steele</li>
			</ul>
		</div>


		<div class="about-row">
			<div class="col1">
				<h4>Interns</h4>
				<ul>
					<li>Evan Burrows</li>
					<li>Kellie Lanham</li>
					<li>Nina Castro</li>
				</ul>
			</div>
			<div class="col1">
				<h4>Print Design</h4>
				<ul>
					<li>Brian Roettinger</li>
				</ul>
			</div>
			<div class="col1">
				<h4>Website</h4>
				<ul>
					<li>Takumi Akin</li>
					<li>Jon Gacnik</li>
				</ul>
			</div>

		</div>

	</div>
	<div id="about-right" class="padding-fix">
		<div class="box-title century">Contact</div>
		<div id="contact-box">
			<h4>Mailing Address</h4>
			<span class="about-meta">P.O. Box 41-437<br>
			Los Angeles, CA 90041</span>
			<h4>Phone Number</h4>
			<span class="about-meta">323.982.0279</span>
			<h4>Editorial Comments</h4>
			<span class="about-meta"><a href="mailto:editors@x-traonline.org">editors@x-traonline.org</a></span>
			<h4>Advertising</h4>
			<span class="about-meta"><a href="mailto:ads@x-traonline.org">ads@x-traonline.org</a></span>
		</div>
		<div id="submissions">
			<h6><a href="<?=get_page_link(3060)?>">Submissions</a></h6>
			<span>X-TRA accepts unsolicited submissions via email.<br><br>
			Please send article description, CV, and writing samples to the editors at: <a href="mailto:editors@x-traonline.org">editors@x-traonline.org</a></span>
		</div>
		<iframe src="/extra/mailing.php" width="230" height="138" scrolling="no" class="about-mail"></iframe>

	</div>
</div>



<?php get_footer(); ?>