﻿<?php
require("connect.php");
?>

<!-- stránka -->
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-5">
            <div class="card-header">
                <i class="bi bi-table"></i> Přehled článků
            </div>
            <div class="card-body">
<!-- tabulka -->
    <?php
            $condition = "nový"; //pouze články s příznakem "nový"
            
            //$sql1 = "SELECT t1.Title, t1.Attribute, t1.Author, t2.Reviewer FROM (SELECT Articles.ArticleID, Articles.Title, Articles.Attribute, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Role = 'Author') t1 LEFT JOIN (SELECT Reviews.ArticleID, CONCAT(Users.Firstname,' ',Users.Lastname) AS Reviewer FROM Reviews INNER JOIN Users ON Reviews.UserID = Users.UserID) t2 ON (t1.ArticleID=t2.ArticleID) WHERE t1.Attribute LIKE '%".$condition."%'";
            $sql1 = "SELECT t1.ArticleID, t1.Title, t1.Attribute, t1.Author, Files.FileID FROM (SELECT Articles.ArticleID, Articles.Title, Articles.Attribute, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Role = 'Author') t1 LEFT JOIN (SELECT Reviews.ArticleID FROM Reviews INNER JOIN Users ON Reviews.UserID = Users.UserID) t2 ON (t1.ArticleID=t2.ArticleID) LEFT JOIN Files ON t1.ArticleID = Files.ArticleID WHERE t1.Attribute LIKE '%".$condition."%'";
            $sql2 = "SELECT CONCAT(Users.Firstname,' ',Users.Lastname) AS Reviewer FROM Users WHERE Users.Role = 'Reviewer'";
            
            $result1 = $conn->query($sql1);
            
            if($result1->num_rows > 0){
                
                echo "<table id='datatablesSimple'>
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Autor</th>
                                <th>Recenzent</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Oponentní formulář''>O.F.</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Název</th>
                                <th>Autor</th>
                                <th>Recenzent</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Oponentní formulář''>O.F.</th>
                            </tr>
                        </tfoot>";
                    echo "<tbody>";
                
                while($row = $result1->fetch_assoc()){

                        echo "<tr>
                                    <td>".$row["Title"]."</td>
                                    <td>".$row["Author"]."</td>";
                                    $attr = $row['Attribute'];
                                    if ($attr != 'nový') {
                                          echo"<td>".$row["Reviewer"]."</td>";
                                    } else {
                                          echo"<td class='data-bs-toggle='tooltip' title='Výběr recenzenta''><a href='dashboard.php?link=selreviewer&aid={$row['ArticleID']}'><img src='assets/img/form-person.svg' class='icon'></a></td>";
                                    }
                                    echo"<td>".$row["Attribute"]."</td>";
                                    $pdf = $row['FileID'];
                                    if (is_null($pdf)) {
                                          echo"<td></td>";
                                    } else {
                                          echo"<td><a href='get_file.php?id={$row['FileID']}'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>";
                                    }
                                    $attr = $row['Attribute'];
                                    if ($attr != 'nový' && $attr != 'odeslaný do recenzního řízení') {
                                          echo"<td class='data-bs-toggle='tooltip' title='Zobrazit oponentní formulář''><a href='dashboard.php?link=showreview&aid={$row['ArticleID']}'><img src='assets/img/form-done.svg' class='icon'></a></td>";
                                    } else {
                                          echo"<td></td>";
                                    }
                        echo "</tr>";
                }
                
                    echo "</tbody>
                </table>";

            }
            else{
                echo "žádné výsledky";
            }
            

    ?>
<!-- konec tabulky -->
            </div>
        </div>
    </div>
</main>