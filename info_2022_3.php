<!-- Informace o čísle -->
<div class="modal fade" id="info_2022_3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title">Informace o čísle</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <?php
                        $condition = "vydaný"; //pouze vydané články"
                        $n = 3;
                        $y = 2022;
                        
                        $sql1 = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume, Journals.Topic AS Topic FROM Journals WHERE Volume ='".$y."' AND Issue =".$n;
                        $sql2 = "SELECT Files.FileID, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author, Articles.Title AS Title FROM Files RIGHT JOIN Articles ON Files.ArticleID=Articles.ArticleID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Articles.Attribute LIKE '%".$condition."%' AND Volume ='".$y."' AND Issue =".$n;

                        $result1 = $conn->query($sql1);
                        $result2 = $conn->query($sql2);

                        if ($result1->num_rows > 0) {
                          // output data of each row
                            while($row = $result1->fetch_assoc()) {
                                echo "Ročník: " . $row["Volume"]. " <br /> Číslo: č. " . $row["Issue"]. "<br /> Téma: " . $row["Topic"]. " <br />
                                Obsah: <br />";
                                if ($result2->num_rows > 0) {
                                    echo "<ol>";
                                        while($row = $result2->fetch_assoc()) {
                                            echo "<li>". $row["Title"]. " (Autor: " . $row["Author"].")";
                                            $pdf = $row['FileID'];
                                            if (is_null($pdf)) {
                                                echo" ";
                                            } else {
                                                echo" <a href='get_file.php?id={$row['FileID']}' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a>";
                                          
                                            }
                                            echo "</li>";
                                        }
                                    echo "</ol>";
                                }
                            }
                        } else {
                          echo "žádné výsledky";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>