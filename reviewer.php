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
            $condition = "odeslaný do recenzního řízení"; //pouze články s příznakem "odeslaný do recenzního řízení"
            $username = $_SESSION["username"]; //pouze konkrétního uživatele
            $sql = "SELECT Articles.Title AS Title, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author, Articles.Attribute AS Attribute FROM Articles JOIN Users ON Articles.UserID = Users.UserID JOIN Reviews ON Articles.ArticleID = Reviews.ArticleID WHERE (SELECT Users.UserID FROM Users WHERE username ='".$username."') AND Articles.Attribute LIKE '%".$condition."%'";
            
            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                
                echo "<table id='datatablesSimple'>
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Autor</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Oponentní formulář''>O.F.</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Název</th>
                                <th>Autor</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Oponentní formulář''>O.F.</th>
                            </tr>
                        </tfoot>";
                    echo "<tbody>";
                
                while($row = $result->fetch_assoc()){

                        echo "<tr>
                                    <td>".$row["Title"]."</td>
                                    <td>".$row["Author"]."</td>
                                    <td>".$row["Attribute"]."</td>
                                    <td><a href='assets/data/clanek_1.pdf' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>";
                                    echo"<td class='data-bs-toggle='tooltip' title='Oponentní formulář''><a href='#reviewform' data-bs-toggle='modal' data-bs-target='#setreview'><img src='assets/img/form.svg' class='icon'></a></td>";
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