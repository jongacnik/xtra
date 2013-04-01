<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" 
		onfocus="if(this.value == 'Search') { this.value = ''; }" 
		onblur="if(this.value == '') { this.value = 'Search'; }" 
	value="Search" class="gothic" name="s" id="s">
	<input type="submit" id="searchsubmit" value="" />
</form>