<?php
    require("connect.php");
    include_once ("info1.php");
    include_once ("info2.php");
    include_once ("info3.php");
    include_once ("info4.php");
    
?>
<!-- Stránka -->
<main class="container">
    <h2 class="pb-4 mb-4">Archiv</h2>

    <?php
        $sql = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume FROM Journals ORDER BY Journals.JournalID DESC";

        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
 
            while($row = $result->fetch_assoc()){
            $n = $row["Issue"];
                
            $y = $row["Volume"];
                
            echo"<h3 class='pt-4 pb-4 mt-4'>č. ".$row["Volume"]."/ ".$row["Issue"]."</h3>";
                echo"<div class='button-box col-12 me-2'>";
                    echo"<button type='button'  class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#info".$n."'>Info</button>";
                    echo"<a href='assets/data/cislo_4_2022.pdf' class='btn btn-outline-danger text-dark bg-white' target='_blank'>Celé číslo v <img src='assets/img/PDF_icon.svg' class='icon'></a>";
                echo"</div>";
            }
        }

    ?>

</main>

