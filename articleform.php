<?php
    require("connect.php");
?>
<?php
$username = $_SESSION["username"]; //reference na konkrétního uživatele


$sql1 = "SELECT Users.Firstname, Users.Lastname FROM Users WHERE Users.Username LIKE '".$username."'";
    
    $result1 = $conn->query($sql1);
    
    if ($result1->num_rows > 0) {
         
        
        while($row = $result1->fetch_assoc()){

                 $firstname = $row['Firstname'];
                 $lastname = $row['Lastname'];
        }
        
    }
    else{
        echo "žádné výsledky";
    }
    
?>

<main>
    <div class="container my-5">
        <div class="p-4 align-items-center rounded-3 border shadow-lg">
            <div class="card m-4">
                <div class="card-header bg-dark text-white border border-white">
                    Formulář pro vložení příspěvku
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <form action="./dashboard.php?link=articleform" method="post">
                            <div class="mb-3 row">
                                <label for="firstname" class="col-sm-2 col-form-label">Jméno:</label>
                                <div class="col-4">
                                <input type="text" id="lastname" class="form-control" placeholder="<?php echo " " . $firstname . ""; ?>" disabled />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="lastname" class="col-sm-2 col-form-label">Příjmení:</label>
                                <div class="col-4">
                                <input type="text" id="lastname" class="form-control" placeholder="<?php echo " " . $lastname . ""; ?>" disabled />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="title" class="col-sm-2 col-form-label">Název článku:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="title" name="title" required />
                                </div>
                            </div>
                            <?php
                            if($_SESSION["role"]=='Admin')
                            {
                            ?>
                            <div class="mb-3 row">
                            <label for="attr" class="col-sm-2 col-form-label">Stav:</label>
                            <select class="form-select" id="attr" name="attr">
                                <option value="nový">nový</option>
                                <option value="vydaný">vydaný</option>
                            </select>
                            </div>
                            <?php
                            }
                            ?>
                            <input type="submit" class="btn btn-dark" value="Dál"/>
                            <button type="button" class="btn btn-secondary" onclick="history.back()">Zavřít</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php    
$attr = "nový";
 if($_SESSION["role"]=='Admin')
                            {
if(
    isset($_POST['title']) &&
    isset($_POST['attr'])
    
) {
$title= $conn->real_escape_string($_POST['title']);
$attr= $conn->real_escape_string($_POST['attr']);

$query = "INSERT INTO Articles (UserID, Title, Attribute) VALUES((SELECT UserID FROM Users WHERE Username = '$username'),'$title', '$attr')";
                       // Execute the query
            $result = $conn->query($query);
     
            // Check if it was successfull
            if($result) {
                header("location: dashboard.php?link=insertarticle");
            }
            else {
                echo 'Error!'
                   . "<pre>{$conn->error}</pre>";
            }

$conn->close(); }
}
else
{
   
    if(
    isset($_POST['title'])
    
) {
$title= $conn->real_escape_string($_POST['title']);
$attr = "nový";

$query = "INSERT INTO Articles (UserID, Title, Attribute) VALUES((SELECT UserID FROM Users WHERE Username = '$username'),'$title', '$attr')";
                       // Execute the query
            $result = $conn->query($query);
     
            // Check if it was successfull
            if($result) {
                header("location: dashboard.php?link=insertarticle");
            }
            else {
                echo 'Error!'
                   . "<pre>{$conn->error}</pre>";
            }

$conn->close(); }
}
?>