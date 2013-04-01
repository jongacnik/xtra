<style type="text/css">
	textarea {
		width: 100%;
		height: 100%;
	}
</style>

<?php 
$fn = $_POST['fn'];
$text = $_POST['text'];





$text = htmlentities($text);
if(get_magic_quotes_gpc()) {
   $text = stripslashes($text);
}
$text = str_replace(array("\r", "\r\n", "\n"), '<br>', $text);

$textArray = explode('}}', $text);



$fn = htmlentities($fn);
if(get_magic_quotes_gpc()) {
   $fn = stripslashes($fn);
}
$fn = str_replace(array("\r", "\r\n", "\n"), '', $fn);
$del = array('][', '] [', ']  [', ']   [');
$notesArray = explode($del[0], str_replace($del, $del[0], $fn));
for($i=0;$i<count($notesArray);$i++){
	if ($i == 0){
		$notesArray[$i] = $notesArray[$i].']';
	} else if ($i == (count($notesArray)-1)){
		$notesArray[$i] = '['.$notesArray[$i];
	} else {
		$notesArray[$i] = '['.$notesArray[$i].']';
	}
}



for($j=0;$j<count($textArray)-1;$j++){
	$textArray[$j] .= '}}'.$notesArray[$j];
}

echo '<textarea>';
foreach ($textArray as $chunk){
	echo $chunk;
}
echo '</textarea>';

?>


