<?php
    include('../../../src/class.fileuploader.php');
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files-upload', array(
        'uploadDir' => '../uploads/',
        'title' => 'auto',
    ));
	
	// call to upload the files
    $data = $FileUploader->upload();

	// export to js
	echo json_encode($data);
	exit;