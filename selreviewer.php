<?php
    require("connect.php");
?>
<?php

    $sql1 = "SELECT UserID, CONCAT(Users.Firstname,' ',Users.Lastname) AS Reviewer FROM Users WHERE Users.Role = 'Reviewer'";
    $result1 = $conn->query($sql1);
?>


<main>
    <div class="container my-5">
        <div class="p-4 align-items-center rounded-3 border shadow-lg">
            <div class="card m-4">
                <div class="card-header bg-dark text-white border border-white">
                    Formulář pro výběr recenzenta
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <form action="./dashboard.php?link=selreviewer" method="post">
                            <input type="number" class="d-none" name="artid" value="<?php echo $_GET['aid']?>">
                            <div class="mb-3 row">
                                <label for="rev" class="col-sm-2 col-form-label">Recenzent:</label>
                                <select class="form-select" id="rev" name="rev">
                                    <?php
                                        if ($result1->num_rows > 0) {
                                            while($row = $result1->fetch_assoc()){
                                                     echo"<option value='".$row['UserID']."'>".$row['Reviewer']."</option>";
                                            }
                                            
                                        }
                                        else{
                                            echo "žádné výsledky";
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <input type="submit" class="btn btn-dark" value="Vybrat"/>
                            <button type="button" class="btn btn-secondary" onclick="history.back()">Zavřít</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php    
  
    if(
    isset($_POST['rev']) &&
    isset($_POST['artid'])
) {
$rev= $_POST['rev'];
$artid= $_POST['artid'];

$sql = "UPDATE Articles SET Articles.Attribute = 'odeslaný do recenzního řízení' WHERE Articles.ArticleID ='$artid';";
$sql .= "INSERT INTO Reviews (Reviews.UserID, Reviews.ArticleID) VALUES ('$rev', '$artid')";
                       // Execute the query
            $result = mysqli_multi_query($conn, $sql);
     
            // Check if it was successfull
            if($result) {
                echo"<div class='w-50'>
                        <div class='alert alert-success alert-dismissible fade show'>            
                            <a href='dashboard.php' type='button' class='btn-close'></a>
                            Recenzent byl úspěšně přiřazen!<span class='mx-5'>
                        </div>        
                </div>";
            }
            else {
                echo 'Error!'
                   . "<pre>{$conn->error}</pre>";
            }

$conn->close(); }

?>