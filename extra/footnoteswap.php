<!DOCTYPE html>
<html>
	
	<head>
		<title></title>
		<style type="text/css">
			* {
				margin: 0;
				padding: 0;
				-moz-box-sizing: border-box;
				-webkit-box-sizing: border-box;
				box-sizing: border-box;
			}
			body {
				font-family: Arial, helvetica, sans-serif;
				font-size: 12px;
				text-transform: uppercase;
				font-weight: bold;
				letter-spacing: 1px;
				margin: 30px;
			}
			#main {
				width: 800px;
				margin-bottom: 50px;
				text-transform: none;
				font-weight: normal;
			}
			label {
				display: block;
				float: left;
				clear: both;
			}
			textarea, input {
				display: block;
				float: left;
				clear: left;
				height: 500px;
				width: 800px;
				margin-bottom: 50px;
				margin-top: 10px;
			}
			.description {
				font-weight: normal;
				text-transform: none;
				float: left;
				width: 300px;
				height: 400px;
				margin: 20px;
				padding: 20px;
				border: 1px solid #ddd;
			}
		</style>
	</head>
	
	<body>
		<div id="main">
		Use this form to convert already formatted pages where footnotes are at the bottom of the text to the new inline format.
		<br><b>The text should include all the html tags, so copy and paste it from the html editor in wordpress.</b>
		</div>
		<form action="doit.php" method="post">
			<label>Insert Footnote list (html)</label><textarea name="fn" id="fn"></textarea>
				<div class="description">
					The footnote list should be formatted how we have been formatting them. For example, paste them in just like so:
					<br><br>[[1]]This is a note[[1]]
					<br>[[2]]This is a note[[2]]
					<br>[[3]]This is a note[[3]]
					<br>[[4]]This is a note[[4]]
					<br>[[5]]This is a note[[5]]
					<br>[[6]]This is a note[[6]]
					<br><br><br>It does not matter if there are extra returns between them:
					<br><br>[[1]]This is a note[[1]]
					<br><br>[[2]]This is a note[[2]]
				</div>
			<label>Insert Text (html)</label><textarea name="text" id="text"></textarea>
				<div class="description">
					The text should be formatted with the {{}} marker inline. Like so:
					<br><br>We have{{1}} a short{{2}} paragraph{{3}} here and some{{4}} of these words{{5}} have footnotes.{{6}} 
				</div>
			<input type="submit" value="CONVERT">
		</form>
	</body>
	
</html>

