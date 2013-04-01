<?php 
	$sent = $_SERVER['QUERY_STRING'];
?>

<link rel="stylesheet" href="http://x-traonline.org/wp/wp-content/themes/xtra/style.css" type="text/css" media="screen,projection" />
<style>
	#mailing {
		width: 230px;
	}
</style>


<form method="post" action="http://oi.vresp.com?fid=97b5aa1435" id="mailing">
	<?php if($sent){ ?>
		<label class="century" style="line-height:95px;">Thank You</label>
	<?php } else { ?>
    	<label class="century">Mailing List</label>
	    <input name="email_address" type="text" 
			onfocus="if(this.value == 'Enter Email Address Here') { this.value = ''; }" 
			onblur="if(this.value == '') { this.value = 'Enter Email Address Here'; }" 
			value="Enter Email Address Here" class="gothic">
			<input id="err" type="hidden" name="err" value="http://x-traonline.org/extra/mailing.php/?statussubscribe=invalid" />
	   <input type="submit" value="submit" class="century">
	  <?php } ?>
</form>