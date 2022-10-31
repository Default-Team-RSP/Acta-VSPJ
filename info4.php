<!-- Informace o čísle -->
<div class="modal fade" id="info4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title">Informace o čísle</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <?php
                        $n = 4;
                        $sql = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume, Journals.Topic AS Topic, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author, Articles.Title AS Title FROM Journals INNER JOIN Articles ON Journals.JournalID = Articles.JournalID INNER JOIN Users ON Articles.UserID = Users.UserID WHERE Volume ='2022' AND Issue =".$n;
                        //$sql = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume, Journals.Topic AS Topic FROM Journals WHERE Volume ='2022' AND Issue =".$info;

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<p> Ročník: " . $row["Volume"]. " <br /> Číslo: č. " . $row["Issue"]. "<br /> Téma: " . $row["Topic"]. " <br /> Obsah: </p>";
                            echo "<ol>";
                                while($row = $result->fetch_assoc()) {
                            echo "<li>". $row["Title"]. " (Autor: " . $row["Author"].")</li>";
                            }
                                echo "</ol>";
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