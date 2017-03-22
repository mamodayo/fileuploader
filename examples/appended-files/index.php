<!DOCTYPE>
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
		<form action="php/form_upload.php" method="post" enctype="multipart/form-data">
			<?php
				// we are inclunding it only for using FileUploader::mime_content_type method
				include('../../src/class.fileuploader.php');
				
				// create an empty array
                // we will add to this array the files from directory below
                // here you can also add files from MySQL database
				$appendedFiles = array();
			
				// scan uploads directory
				$uploadsFiles = array_diff(scandir('uploads/'), array('.', '..'));
			
				// add files to our array with
				// made to use the correct structure of a file
				foreach($uploadsFiles as $file) {
					// skip if directory
					if(is_dir($file))
						continue;
					
					// add file to our array
					// !important please follow the structure below
					$appendedFiles[] = array(
						"name" => $file,
						"type" => FileUploader::mime_content_type('uploads/' . $file),
						"size" => filesize('uploads/' . $file),
						"file" => 'uploads/' . $file,
						"data" => array(
							"url" => 'http://localhost/fileuploader/examples/appended-files/uploads/' . $file
						)
					);
				}
				
				// convert our array into json string
				$appendedFiles = json_encode($appendedFiles);
			?>
			<input type="file" name="files" data-fileuploader-files='<?php echo $appendedFiles;?>'>
			<input type="submit">
		</form>
    </body>
</html>