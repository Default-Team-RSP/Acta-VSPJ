<?php
    require("connect.php");
    include_once ("info_2021_4.php");
    include_once ("info_2022_1.php");
    include_once ("info_2022_2.php");
    include_once ("info_2022_3.php");
    include_once ("info_2022_4.php");
    
?>
<!-- Stránka -->
<main class="container">
    <h2 class="pb-4 mb-4">Archiv</h2>

    <?php
        $sql = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume, Files.FileID FROM Journals LEFT JOIN Files ON Journals.JournalID = Files.JournalID ORDER BY Journals.Volume DESC, Journals.Issue DESC";

        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
 
            while($row = $result->fetch_assoc()){
            $n = $row["Issue"];
                
            $y = $row["Volume"];
                
            echo"<h3 class='pt-4 pb-4 mt-4'>č. ".$row["Volume"]."/ ".$row["Issue"]."</h3>";
                echo"<div class='button-box col-12 me-2'>";
                    echo"<button type='button'  class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#info_".$y."_".$n."'>Info</button>";
                    $pdf = $row['FileID'];
                    if (is_null($pdf)) {
                        echo" ";
                    } else {
                        echo"<a href='get_file.php?id={$row['FileID']}' class='btn btn-outline-danger text-dark bg-white' target='_blank'>Celé číslo v <img src='assets/img/PDF_icon.svg' class='icon'></a>";
                    }
                    
                echo"</div>";
            }
        }

    ?>

</main>

