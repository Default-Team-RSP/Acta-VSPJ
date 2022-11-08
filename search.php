﻿<?php
require("connect.php");
?>

<!-- stránka -->
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-5">
            <div class="card-header">
                <i class="bi bi-table"></i> Výsledky vyhledávání
            </div>
            <div class="card-body">
<!-- tabulka -->
    <?php

        /* $query = $_GET['query'];
        
        $min_length = 3;        // minimální délka
        
        if(isset($query) >= $min_length){
            
            $query = htmlspecialchars($query); */
           
            //$sql = "SELECT Articles.Title AS Title, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author, Journals.Topic AS Topic FROM Articles JOIN Users ON Articles.UserID = Users.UserID JOIN Articles.JournalID = Journals.JournalID WHERE (Articles.Title LIKE '%".$query."%') OR (Users.Lastname LIKE '%".$query."%') OR (Users.Firstname LIKE '%".$query."%') OR (Journals.Topic LIKE '%".$query."%')";
            $sql = "SELECT Articles.Title AS Title, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author, Journals.Topic AS Topic FROM Journals INNER JOIN Articles ON Journals.JournalID = Articles.JournalID INNER JOIN Users ON Articles.UserID = Users.UserID";
            
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                
                echo "<table id='search'>
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Téma</th>
                                <th>Autor</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Název</th>
                                <th>Téma</th>
                                <th>Autor</th>
                                <th>PDF</th>
                            </tr>
                        </tfoot>";
                    echo "<tbody>";
                
                while($row = $result->fetch_assoc()){

                        echo "<tr>
                                    <td>".$row["Title"]."</td>
                                    <td>".$row["Topic"]."</td>
                                    <td>".$row["Author"]."</td>
                                    <td><a href='assets/data/clanek_1.pdf' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a></td></tr>";
                }
                
                    echo "</tbody>
                </table>";

            }
            else{
                echo "žádné výsledky";
            }
            
        /*}
        else{
            echo "Minimální délka je ".$min_length;
        } */
    ?>
<!-- konec tabulky -->
            </div>
        </div>
    </div>
</main>