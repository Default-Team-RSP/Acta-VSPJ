<?php
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
            $sql = "SELECT t1.ArticleID, t1.Title, t1.Attribute, t1.Author, Files.FileID FROM (SELECT Articles.ArticleID, Articles.Title, Articles.Attribute, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Role = 'Author') t1 LEFT JOIN (SELECT Reviews.ArticleID, Reviews.UserID, Users.Username FROM Reviews INNER JOIN Users ON Reviews.UserID = Users.UserID) t2 ON (t1.ArticleID=t2.ArticleID) LEFT JOIN Files ON t1.ArticleID = Files.ArticleID WHERE t2.Username ='".$username."' AND t1.Attribute LIKE '%".$condition."%'";
            
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
                                    <td>".$row["Attribute"]."</td>";
                                    $pdf = $row['FileID'];
                                    if (is_null($pdf)) {
                                          echo"<td></td>";
                                    } else {
                                          echo"<td><a href='get_file.php?id={$row['FileID']}'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>";
                                    }
                                    echo"<td class='data-bs-toggle='tooltip' title='Oponentní formulář''><a href='dashboard.php?link=setreview&id={$row['ArticleID']}'><img src='assets/img/form.svg' class='icon'></a></td>";
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