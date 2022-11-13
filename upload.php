<!-- UPLOAD CELÝCH ČÍSEL V PDF -->

<?php
    require("connect.php");
?>


<form class="row g-2" action="index.php?stranka=upload" method="post" enctype="multipart/form-data">
            <div class="col-auto">
  <input class="form-control" type="file" name="uploaded_file" id="formFile">
   </div>
  <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" value="Upload file">
            </div>
        </form>
        
    



<?php
$n = 4;
$y = 2022;


    // Check if a file has been uploaded
    if(isset($_FILES['uploaded_file'])) {
        // Make sure the file was sent without errors
        if($_FILES['uploaded_file']['error'] == 0) {
            // Connect to the database
            
     
            // Gather all required data
            $name = $conn->real_escape_string($_FILES['uploaded_file']['name']);
            $mime = $conn->real_escape_string($_FILES['uploaded_file']['type']);
            $data = $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
            
            
     
            // Create the SQL query
            $query = "
                INSERT INTO Files (
                    Filename, Type, UserID, JournalID, Content
                )
                VALUES (
                    '{$name}', '{$mime}', (SELECT UserID FROM Users WHERE Username = '$username'), (SELECT JournalID FROM Journals WHERE Volume ='$y' AND Issue ='$n'), '{$data}'
                )";
     
            // Execute the query
            $result = $conn->query($query);
     
            // Check if it was successfull
            if($result) {
                echo 'Úspěch! Váš soubor byl úspěšně přidán!';
            }
            else {
                echo 'Error! Soubor se nepodařilo vložit'
                   . "<pre>{$conn->error}</pre>";
            }
        }
        else {
            echo 'Při nahrávání souboru došlo k chybě. '
               . 'Error code: '. intval($_FILES['uploaded_file']['error']);
        }
     
        // Close the mysql connection
        $conn->close();
    }
    else {
        echo 'Error! Soubor nebyl odeslán!';
    }

     


?>
