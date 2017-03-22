<?php include_once('php/included_upload.php'); ?><!DOCTYPE>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Appended files example - Fileuploader</title>

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
		
		<!-- styles -->
		<link href="../../src/jquery.fileuploader.css" media="all" rel="stylesheet">
		
		<!-- js -->
		<script src="http://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
		<script src="../../src/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="./js/custom.js" type="text/javascript"></script>

		<style>
			body {
				font-family: 'Roboto', sans-serif;
				font-size: 14px;
                line-height: normal;
				color: #47525d;
				background-color: #fff;

				margin: 0;
				padding: 20px;
				
				width: 560px;
			}
		</style>
	</head>

	<body>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<?php
				// this variable is comming from the included file
				$input = $FileUploader->generateInput();
				
				// change file path from ../uploads/ to uploads/
				// used for data-fileuploader-files attribute
				// in other words used only for appended files
				$input = str_replace('..\/uploads\/', 'uploads\/', $input);
			
				// echo the input
				echo $input;
			?>
			<input type="submit">
		</form>
    </body>
</html>