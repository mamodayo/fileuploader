<?php
    include('../../../src/class.fileuploader.php');

	// get POST inputs
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'limit' => 1,
        'maxSize' => null,
		'fileMaxSize' => null,
        'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
        'required' => false,
        'uploadDir' => '../uploads/',
        'title' => 'my_avatar',
		'replace' => true,
        'listInput' => true,
        'files' => null
    ));
	
	// call to upload the files
    $data = $FileUploader->upload();
	if($data['hasWarnings']) {
        $warnings = $data['warnings'];
        
   		echo '<pre>';
        print_r($warnings);
		echo '</pre>';
    }
	
	if($data['isSuccess'] && count($data['files']) > 0) {
		$file = $data['files'][0]['file'];
		$filename = $data['files'][0]['name'];
		
		// echo our form data
		echo '<h1>Your form data:</h1>';
		echo 'Username: ' . $username . '<br>';
		echo 'Email: ' . $email . '<br>';
		echo 'Avatar:<br> <img src="' . $file . '" style="max-width: 400px; max-height: 400px">';
	}