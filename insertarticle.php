<?php
    require("connect.php");
?>


<form class="row g-2" action="dashboard.php?link=insertarticle" method="post" enctype="multipart/form-data">
            <div class="col-auto">
  <input class="form-control" type="file" name="uploaded_file" id="formFile">
   </div>
  <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" value="Upload file">
            </div>
        </form>
        
    



<?php
$username = $_SESSION["username"]; //reference na konkrétního uživatele


    // Check if a file has been uploaded
    if(isset($_FILES['uploaded_file'])) {
        // Make sure the file was sent without errors
        if($_FILES['uploaded_file']['error'] == 0) {
            // Connect to the database
            
     
            // Gather all required data
            $name = $conn->real_escape_string($_FILES['uploaded_file']['name']);
            $mime = $conn->real_escape_string($_FILES['uploaded_file']['type']);
            $data = $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
            $id = 1;
     
            // Create the SQL query
            $query = "
                
                INSERT INTO Files (Filename, Type, UserID, ArticleID, Content)
                VALUES ('{$name}', '{$mime}', (SELECT UserID FROM Users WHERE Username = '$username'), (SELECT ArticleID FROM Articles WHERE ArticleID='$id'), '{$data}');
               ";
                
                
     
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
