<?php
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

    $condition = "vydaný"; //pouze vydané články"

    $sql = "SELECT t1.ArticleID, t1.Title, t1.Attribute, t1.Author, t2.Topic, Files.FileID FROM (SELECT Articles.JournalID, Articles.ArticleID, Articles.Title, Articles.Attribute, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Role = 'Author') t1 LEFT JOIN (SELECT Journals.JournalID, Journals.Topic FROM Journals) t2 ON (t1.JournalID=t2.JournalID) LEFT JOIN Files ON t1.ArticleID = Files.ArticleID WHERE t1.Attribute LIKE '%".$condition."%'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        echo "<table id='datatablesSimple'>
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
                    <td>".$row["Author"]."</td>";
                    $pdf = $row['FileID'];
                    if (is_null($pdf)) {
                        echo"<td></td>";
                    } else {
                        echo"<td><a href='get_file.php?id={$row['FileID']}'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>";
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