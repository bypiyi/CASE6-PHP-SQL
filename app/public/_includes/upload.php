
<?php
include_once "_includes/database_connection.php";

$status_message = "";

// file upload directory
$target = 'tmp/';

if (isset($_POST["submit"])) {
    if (!empty($_FILES["file"]["name"])) {
        $file_name = basename($_FILES["file"]["name"]);
        $target_file_path = $target . $file_name;
        $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);

        // allowed formats
        $allow_types = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($file_type, $allow_types)) {

            // upload to server
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file_path)) {
                // insert to database
                $sql = "INSERT INTO business (`image_url`) VALUES (:file_name)";
                $stmt = $pdo->prepare($sql);
                $insert = $stmt->execute([':file_name' => $file_name]);

                if ($insert) {
                    // $status_message = "File uploaded successfully";
                } else {
                    // $status_message = "Error inserting file into database";
                }
            } else {
                // $status_message = "Error uploading file";
            }
        } else {
            // $status_message = "Sorry, file format not allowed";
        }
    } else {
        // $status_message = "Please select a file to upload";
    }
}
?>
