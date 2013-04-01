<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="<?=get_template_directory_uri()?>/_js/pdf.js"></script>
<script>
	PDFJS.workerSrc = '<?=get_template_directory_uri()?>/_js/pdf.js';
	thePDF = '<?=get_field("pdf_upload")?>';
</script>
<script src="<?=get_template_directory_uri()?>/_js/viewer.js"></script>
<link rel="stylesheet" href="<?=get_template_directory_uri()?>/_js/script.css"></script>

<div class="controls">
	<a id="zoomOut">-</a>
	<a id="zoomIn">+</a>
</div>

<div class="wrapper"></div>