<?php
    include('../../../src/class.fileuploader.php');

	// create an empty array
    // we will add to this array the files from directory below
    // here you can also add files from MySQL database
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
				"url" => 'http://localhost/fileuploader/examples/appended-files/uploads/' . $file
			)
		);
	}

	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'uploadDir' => '../uploads/',
        'title' => 'name',
        'files' => $appendedFiles
    ));
	
	// call to upload the files
    $data = $FileUploader->upload();
    
    // if uploaded and success
    if($data['isSuccess'] && count($data['files']) > 0) {
        // get uploaded files
        $uploadedFiles = $data['files'];
    }
    // if warnings
	if($data['hasWarnings']) {
        // get warnings
        $warnings = $data['warnings'];
        
   		echo '<pre>';
        print_r($warnings);
		echo '</pre>';
        exit;
    }
	
	// unlink the files
	// !important only for appended files
	// you will need to give the array with appendend files in 'files' option of the FileUploader
	foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
		unlink('../uploads/' . $value['name']);
	}
	
	// get the fileList
	$fileList = $FileUploader->getFileList();
	
	// show
	echo '<pre>';
	print_r($fileList);
	echo '</pre>';