<?php
require("connect.php");
?>

    <?php
    // Make sure an ID was passed
    if(isset($_GET['id'])) {
    // Get the ID
        $id = intval($_GET['id']);
     
        // Make sure the ID is in fact a valid ID
        if($id <= 0) {
            die('The ID is invalid!');
        }
        else {
                
            // Fetch the file information
            $sql = "SELECT Type, Filename, Content FROM Files WHERE FileID = {$id}";
            $result = $conn->query($sql);
     
            if($result) {
                // Make sure the result is valid
                if($result->num_rows == 1) {
                // Get the row
                    $row = mysqli_fetch_assoc($result);
     
                    // Print headers
                    header("Content-Type: ". $row['Type']);
                    //header("Content-Length: ". $row['size']);
                    header("Content-Disposition: attachment; filename=". $row['Filename']);
     
                    // Print data
                    echo $row['Content'];
                }
                else {
                    echo 'Error! No image exists with that ID.';
                }
     
                // Free the mysqli resources
                @mysqli_free_result($result);
            }
            else {
                echo "Error! Query failed: <pre>{$conn->error}</pre>";
            }
            @mysqli_close($conn);
        }
    }
    else {
        echo 'Error! No ID was passed.';
    }
    ?>

