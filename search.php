<?php
require("connect.php");
?>

<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Acta VŠPJ | Hledání</title>
    <!-- CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <!-- Scripts -->
    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
    <?php
    include_once("header.php");
    include_once("login.php");
    include_once("signup.php");


    ?>

<main class="container">
    <div class="bg-light rounded alert alert-danger alert-dismissible fade show" role="alert">                             
        <strong>Tato aplikace je výsledkem školního projektu v kurzu Řízení SW projektů na Vysoké škole polytechnické Jihlava. Nejedná se o stránky skutečného odborného časopisu!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                   
    </div> 
    <h2 class="pb-4 mb-4">Výsledky vyhledávání</h2>
    
    <?php

        $query = $_GET['query'];
        
        $min_length = 3;        // minimální délka
        
        if(isset($query) >= $min_length){
            
            $query = htmlspecialchars($query); 
           
            $sql = "SELECT Articles.Title AS Title, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles JOIN Users ON Articles.UserID = Users.UserID WHERE (Articles.Title LIKE '%".$query."%') OR (Users.Lastname LIKE '%".$query."%') OR (Users.Firstname LIKE '%".$query."%')";
            
            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                
                echo "<table class='table'><tr><th style='width: 50%'>Název</th><th style='width: 40%'>Autor</th><th style='width: 10%'>PDF</th></tr>";
                
                while($row = $result->fetch_assoc()){

                    echo "<tr><td style='width: 50%'>".$row["Title"]."</td>
                    <td style='width: 40%'>".$row["Author"]."</td>
                    <td style='width: 10%'><a href='assets/data/clanek_1.pdf' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a></td></tr>";
                }
                
                echo "</table>";
                
            }
            else{
                echo "žádné výsledky";
            }
            
        }
        else{
            echo "Minimální délka je ".$min_length;
        }
    ?>


 
</main>
    
    <?php
    include_once("footer.php");
    ?>

</body>
</html>