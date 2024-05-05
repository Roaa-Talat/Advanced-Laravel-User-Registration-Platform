<?php
// Move image to server
function move_img($image){
    $targetDir = "./Assets/Images/";
    $file_path = $targetDir . $image['name'];
    move_uploaded_file($image['tmp_name'], $file_path);
    return $file_path;
}

// Validate image upload and extension
function validate_img($fileType, $image) {
    if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
        //echo $fileType . '<br>';
        if (($fileType == "image/jpeg") || ($fileType == "image/jpg") || ($fileType == "image/png") || ($fileType == "image/gif")) {
            return true;
        } else {
            //echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            return false;
        }
    } else {
        //echo "Error uploading file or user image is not set.";
        return false;
    }
    return false;
}

if(isset($_FILES['userImage'])) {
    $image = $_FILES['userImage'];
    $fileType = $image['type'];
    if(validate_img($fileType, $image)) {
        $file_path = move_img($image);
        $response = array('status' => 'success', 'message' => 'Image uploaded successfully');
        //echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid image file');
        //echo json_encode($response);
    }
} else {
    //$response = array('status' => 'error', 'message' => 'No image file uploaded');
    //echo json_encode($response);
}

?>