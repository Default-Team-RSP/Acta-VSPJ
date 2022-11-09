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
            $username = $_SESSION["username"];
            $sql = "SELECT Articles.Title AS Title, Articles.Attribute AS Attribute, Users.Username FROM Articles JOIN Users ON Articles.UserID = Users.UserID WHERE Username='".$username."'";

            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                
                echo "<table id='datatablesSimple'>
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Zobrazit oponentní formulář''>O.F.</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Název</th>
                                <th>Stav</th>
                                <th>PDF</th>
                                <th class='data-bs-toggle='tooltip' title='Zobrazit oponentní formulář''>O.F.</th>
                            </tr>
                        </tfoot>";
                    echo "<tbody>";
                
                while($row = $result->fetch_assoc()){

                        echo "<tr>
                                    <td>".$row["Title"]."</td>
                                    <td>".$row["Attribute"]."</td>
                                    <td><a href='assets/data/clanek_1.pdf' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>";
                                    $attr = $row['Attribute'];
                                    if ($attr != 'nový') {
                                          echo"<td class='data-bs-toggle='tooltip' title='Zobrazit oponentní formulář''><a href='#showreview' data-bs-toggle='modal' data-bs-target='#showreview'><img src='assets/img/form-done.svg' class='icon'></a></td>";
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