<?php
    require("connect.php");
?>
<!-- Pro výběr článku:
<?php

$sql1 = "SELECT Articles.ArticleID  FROM Articles";
    
    $result1 = $conn->query($sql1);
    
    if ($result1->num_rows > 0) {
         
        
        while($row = $result1->fetch_assoc()){

                 $aid = $row['ArticleID'];
        }
        
    }
    else{
        echo "žádné výsledky";
    }
    
?>
-->

<main>
    <div class="container my-5">
        <div class="p-4 align-items-center rounded-3 border shadow-lg">
            <div class="card m-4">
                <div class="card-header bg-dark text-white border border-white">
                    Formulář pro vložení čísla
                </div>
                <div class="card-body">
                    <div class="container mt-3">
                        <form action="./dashboard.php?link=issueform" method="post">
                            <div class="mb-3 row">
                                <label for="volume" class="col-sm-2 col-form-label">Ročník:</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="volume" name="volume" min="<?php echo date("Y")-1; ?>" max="<?php echo date("Y"); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="issue" class="col-sm-2 col-form-label">Číslo:</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="issue" name="issue" min="1" max="4" required>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                            <label for="topic" class="col-sm-2 col-form-label">Téma:</label>
                            <select class="form-select" id="topic" name="topic">
                                <option value="ekonomické vědy">ekonomické vědy</option>
                                <option value="společenské vědy">společenské vědy</option>
                                <option value="technické vědy">technické vědy</option>
                                <option value="vědy o přírodě">vědy o přírodě</option>
                                <option value="vědy o člověku">vědy o člověku</option>
                            </select>
                            </div>
                            <input type="submit" class="btn btn-dark" value="Dál"/>
                            <button type="button" class="btn btn-secondary" onclick="history.back()">Zavřít</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php    

$attr = "nový";  //všem nahraným článkům nastaví příznak nový
if(
    isset($_POST['issue']) &&
    isset($_POST['volume']) &&
    isset($_POST['topic'])

) {
$issue= $conn->real_escape_string($_POST['issue']);
$volume= $conn->real_escape_string($_POST['volume']);
$topic= $conn->real_escape_string($_POST['topic']);

$query = "INSERT INTO Journals (Volume, Issue, Topic) VALUES('$volume','$issue', '$topic')";
                       // Execute the query
            $result = $conn->query($query);
     
            // Check if it was successfull
            if($result) {
                header("location: dashboard.php?link=insertissue");
            }
            else {
                echo 'Error!'
                   . "<pre>{$conn->error}</pre>";
            }

$conn->close(); }
?>