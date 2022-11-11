<?php
    require("connect.php");
    include_once ("info4.php");
?>

<!-- Stránka -->             
                   
    <div class="container my-5">                             
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">                                     
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">                                             
                <h1 class="display-4 fw-bold lh-1">Acta VŠPJ</h1>                                             
                <p class="lead">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In convallis. Donec quis nibh at felis congue commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>                                             
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">                                                     
                    <a href="#issue" class="btn btn-outline-success btn-lg px-4 me-md-2 fw-bold">Aktuální číslo</a>
                </div>                                                          
            </div>                                     
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg d-none d-md-block">                                             
                <img class="rounded-lg-3" src="assets/img/acta-vspj.svg" alt="" height="450">                                     
            </div>                             
        </div>                     
    </div>            
    <!-- aktuální článek -->                     
    <div class="container p-4" style="padding-top:10px">
        <div id="issue" class="container">

        <div class="container p-4" style="padding-top:10px">
            <div id="issue" class="container">

                        <?php
                        $condition = "vydaný"; //pouze vydané články"
                        
                        $sql1 = "SELECT Journals.Issue AS Issue, Journals.Volume AS Volume FROM Journals ORDER BY Journals.Volume DESC, Journals.Issue DESC LIMIT 1";
                        $sql2 = "SELECT Articles.Title AS Title, CONCAT(Users.Firstname,' ',Users.Lastname) AS Author FROM Articles INNER JOIN Users ON Articles.UserID = Users.UserID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID INNER JOIN Reviews ON Articles.ArticleID = Reviews.ArticleID WHERE Articles.Attribute LIKE '%".$condition."%'";
                        
                        $result1 = $conn->query($sql1);
                        $result2 = $conn->query($sql2);

                        if ($result1->num_rows > 0) {
                            while($row = $result1->fetch_assoc()){
                            $n = $row["Issue"];
                
                            $y = $row["Volume"];
                                
                            echo"<h3 class='pt-4 pb-4 mt-4'>č. ".$row["Volume"]."/ ".$row["Issue"]."</h3>";
                                echo"<div class='button-box col-12 me-2'>";
                                    echo"<button type='button'  class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#info".$n."'>Info</button>";
                                    echo"<a href='assets/data/cislo_4_2022.pdf' class='btn btn-outline-danger text-dark bg-white' target='_blank'>Celé číslo v <img src='assets/img/PDF_icon.svg' class='icon'></a>";
                                echo"</div>";
                            echo "<div class='table-responsive border-top mt-4'>";
                                

                            if ($result2->num_rows > 0) {
                                
                                    echo "<table class='table'>
                                        <tr>
                                            <th style='width: 50%'>Název</th>
                                            <th style='width: 40%'>Autor</th>
                                            <th style='width: 10%'>PDF</th>
                                        </tr>";
                                        while($row = $result2->fetch_assoc()) {
                                        echo "<tr>
                                            <td style='width: 50%'>".$row["Title"]."</td>
                                                <td style='width: 40%'>".$row["Author"]."</td>
                                                <td style='width: 10%'><a href='assets/data/clanek_1.pdf' target='_blank'><img src='assets/img/PDF_icon.svg' class='icon'></a></td>
                                            </tr>";}
                                    echo "</table>";
                                
                            } else {
                                echo "žádné výsledky";
                            }
                        }
                    }
                        ?>
                            </div>
            </div>

            
        </div>

        </div>
    </div>
