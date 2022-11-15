<?php
    require("connect.php");
?>

<main>
    <div class="container my-5">
        <div class="p-4 align-items-center rounded-3 border shadow-lg">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white border border-white">
                    Formulář pro vložení příspěvku
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <form class="row g-2" action="dashboard.php?link=insertarticle" method="post" enctype="multipart/form-data">
                            <div class="col-auto">
                                <input class="form-control" type="file" name="uploaded_file" id="formFile">
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary mb-3" value="Nahrát soubor...">
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
     
            // Create the SQL query
            $query = "
                
                INSERT INTO Files (Filename, Type, UserID, ArticleID, Content)
                VALUES ('{$name}', '{$mime}', (SELECT UserID FROM Users WHERE Username = '$username'), (SELECT ArticleID FROM Articles ORDER BY ArticleID DESC LIMIT 1), '{$data}')
               ";
                
                
     
            // Execute the query
            $result = $conn->query($query);
     
            // Check if it was successfull
            if($result) {
                echo 'Úspěch! Váš příspěvek byl úspěšně přidán!';
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
    

     


?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
