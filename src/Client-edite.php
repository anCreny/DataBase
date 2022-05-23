<?php 
include 'fnc.php';
$id;
$row;
if(isset($_POST['edite'])){
    $id = $_POST['edite'];
    $sql = "SELECT * FROM Client WHERE IDClient = '$id'";
    $result = $db->query($sql);
    $row = mysqli_fetch_row($result);
}
$name = "";
$surname = "";
$patronymic = "";
$paperNumber = "";
$paperSeries = "";
$paperDate = "";
$succes = 0;
if(isset($_POST['name'])){
    $errors = "";
    if($_POST['name'] == ""){
        $name = $row[2];
    }else{
        $name = $_POST['name'];
    }

    if($_POST['surname'] == ""){
        $surname = $row[1];
    }else{
        $surname = $_POST['surname'];
    }

    if($_POST['patronymic'] == ""){
        $patronymic = $row[3];
    }else{
        $patronymic = $_POST['patronymic'];
    }

    if($_POST['papernumber'] == ""){
        $paperNumber = $row[4];
    }else if(ctype_digit($_POST['papernumber'])){
        $paperNumber = $_POST['papernumber'];
    }else{
        $errors .= "[PaperNumber: not only numbers]\n";
    }

    if($_POST['paperseries'] == ""){
        $paperSeries = $row[5];
    }else if(ctype_digit($_POST['paperseries'])){
        $paperSeries = $_POST['paperseries'];
    }else{
        $errors .= "[PaperSeries: not only numbers]\n";
    }
    if($_POST['date'] == ""){
        $paperDate = $row[6];
    }else{
        $paperDate = $_POST['date'];
    }
    if($errors == ""){
        $sql = "UPDATE Client 
                SET
                    Surname = '$surname',
                    Name = '$name',
                    Patronymic = '$patronymic',
                    NumberOfPaper = '$paperNumber',
                    PaperSeries = '$paperSeries',
                    PaperTakingDate = '$paperDate'
                WHERE IDClient = '$id'
                    ";
                    $stmt = mysqli_prepare($db, $sql);
                    if($stmt == false){
                        echo "[синтаксис]".mysqli_error($db);
                    }else if($stmt != false){
                        mysqli_stmt_execute($stmt);
                        if (mysqli_stmt_errno($stmt) != 0){
                            $succes = 2;
                            $errors .= '['.mysqli_stmt_error($stmt)."]\n";
                        }else{
                            $name = "";
                            $surname = "";
                            $patronymic = "";
                            $paperNumber = "";
                            $paperSeries = "";
                            $paperDate = "";
                            $succes = 1;
                            $sql = "SELECT * FROM Client WHERE IDClient = '$id'";
                            $result = $db->query($sql);
                            $row = mysqli_fetch_row($result);
                        }
            }
    }else{
        $succes = 2;
    }
    
}
?>

<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <link href="das.scss" rel="stylesheet" type="text/scss">
        <meta charset="utf-8">
        <title>Create</title>
    </head>
    <header>
        <div style = "text-align: left; margin: 20px">
                            <form action="Client.php">
                                <button class="button-30" role="button">
                                    <-Back
                                </button>
                            </form>
                        </div>
        <div class="hit-the-floor" style = "margin-bottom: 30px; font-size: 45px">
            Editing a Client
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table style="width:50%; text-align:center; align-items:center; font-size:20px" align="center">
                <tr>
                    <th>
                        Surname
                    </th>
                    <td>
                        <?php echo $row[1]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="surname" value="<?php echo $surname; ?>" id="input" class="Input-text" placeholder="Surname">
                            <label for="input" class="Input-label">Surname</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        <?php echo $row[2]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="name" id="input" value="<?php echo $name; ?>" class="Input-text" placeholder="Name">
                            <label for="input" class="Input-label">Name</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        Patronymic
                    </th>
                    <td>
                        <?php echo $row[3]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="patronymic" id="input" value="<?php echo $patronymic; ?>" class="Input-text" placeholder="Patronymic">
                            <label for="input" class="Input-label">Patronymic</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        PaperNumber
                    </th>
                    <td>
                        <?php echo $row[4]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="papernumber" id="input" value="<?php echo $paperNumber; ?>" class="Input-text" placeholder="PaperNumber">
                            <label for="input" class="Input-label">PaperNumber</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        PaperSeries
                    </th>
                    <td>
                        <?php echo $row[5]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="paperseries" id="input" value="<?php echo $paperSeries; ?>" class="Input-text" placeholder="PaperSeries">
                            <label for="input" class="Input-label">PaperSeries</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        PaperTakingDate
                    </th>
                    <td>
                        <?php echo $row[6]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <input class = "date" type="date" name="date" value="<?php echo $paperDate; ?>" style="font-size: 1.2em;">
                    </td>
                </tr>
            </table>
            <div style = "text-align: center; margin: 20px">
                <button class="button-30" role="button" name="edite" value="<?php echo $row[0]; ?>">
                    Submit
                </button>
            </div>
        </form>
        <div>
            <?php if($succes == 1){
                echo "SUCCESS!";
            }else if($succes == 2){
                echo $errors;
            } ?>
        </div>
    </body>
</html>