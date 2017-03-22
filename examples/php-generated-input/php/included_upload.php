<?php
	// change directory
	// we are doing it while including this file
	// default directory is /php-generated-input/
	chdir('./php');
    include('../../../src/class.fileuploader.php');

	// create an empty array
	$appendedFiles = array();

	// scan uploads directory
	$uploadsFiles = array_diff(scandir('../uploads/'), array('.', '..'));

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
			"type" => FileUploader::mime_content_type('../uploads/' . $file),
			"size" => filesize('../uploads/' . $file),
			"file" => 'uploads/' . $file,
			"data" => array(
				"url" => 'http://localhost/fileuploader/examples/php-generated-input/uploads/' . $file
			)
		);
	}
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'limit' => 4,
        'maxSize' => 4,
		'fileMaxSize' => 4,
        'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        'required' => false,
        'uploadDir' => '../uploads/',
        'title' => '{random}',
		'replace' => false,
        'listInput' => true,
        'files' => $appendedFiles
    ));
	
	// call to upload the files
    $data = $FileUploader->upload();
	if($data['hasWarnings']) {
        $warnings = $data['warnings'];
        
   		echo '<pre>';
        print_r($warnings);
		echo '</pre>';
    }
	
	// unlink the files
	// !important only for appended files
	// you will need to give the array with appendend files in 'files' option of the fileUploader
	foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
		unlink('../uploads/' . $value['name']);
	}