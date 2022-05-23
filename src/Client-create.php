<?php 
include 'fnc.php';
$name = "";
$surname = "";
$patronymic = "";
$paperNumber = "";
$paperSeries = "";
$paperDate = "";
$succes = 0;
if(isset($_POST['surname'])){
    $errrors = "";
    if($_POST['name'] == ""){
        $errrors .= "[Name: empty]";
    }else{
        $name = $_POST['name'];
    }
    if($_POST['surname'] == ""){
        $errrors .= "[Surname: empty]";
    }else{
        $surname = $_POST['surname'];
    }
    if($_POST['patronymic'] == ""){
        $errrors .= "[Patronymic: empty]";
    }else{
        $patronymic = $_POST['patronymic'];
    }
    if($_POST['paperseries'] == ""){
        $errrors .= "[Paperseries: empty]";
    }else if(ctype_digit($_POST['paperseries'])){
        $paperSeries = $_POST['paperseries'];
    }else{
        $errrors .= "[PaperSeries: not only numbers]"; 
    }
    if($_POST['papernumber'] == ""){
        $errrors .= "[Papernumber: empty]";
    }else if(ctype_digit($_POST['papernumber'])){
        $paperNumber = $_POST['papernumber'];
    }else{
        $errrors .= "[PaperNumber: not only numbers]";
    }
    if($_POST['papertakingdate'] == ""){
        $errrors .= "[Papertakingdate: empty]";
    }else{
        $paperDate = $_POST['papertakingdate'];
    }
    if($errrors == ""){
        $sql = "INSERT INTO Client VALUES (NULL, '$surname', '$name', '$patronymic', '$paperNumber', '$paperSeries', '$paperDate')";
        $stmt = mysqli_prepare($db, $sql);
        if($stmt == false){
            echo "[синтаксис]".mysqli_error($db);
            }else if($stmt != false){
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_errno($stmt) != 0){
                    $succes = 2;
                    $errrors .= '['.mysqli_stmt_error($stmt)."]";
                }else{
                    $name = "";
                    $surname = "";
                    $patronymic = "";
                    $paperNumber = "";
                    $paperSeries = "";
                    $paperDate = "";
                    $succes = 1;
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
        <div class="hit-the-floor" style = "margin-bottom: 70px; font-size: 45px">
            Adding new Client
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table align = "center" style = "width:20%">
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="surname" id="input" value='<?php echo $surname ?>' class="Input-text" placeholder="Surname">
                            <label for="input" class="Input-label">Surname</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="name" id="input" value='<?php echo $name ?>' class="Input-text" placeholder="Name">
                            <label for="input" class="Input-label">Name</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="patronymic" value='<?php echo $patronymic ?>' class="Input-text" placeholder="Patronymic">
                            <label for="input" class="Input-label">Patronymic</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input maxlength="6" type="text" name="papernumber" id="input" value="<?php echo $paperNumber ?>" class="Input-text" placeholder="PaperNumber(6n.)">
                            <label for="input" class="Input-label">PaperNumber</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input maxlength="4" type="text" name="paperseries" id="input" value="<?php echo $paperSeries ?>" class="Input-text" placeholder="PaperSeries(4n.)">
                            <label for="input" class="Input-label">PaperSeries</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateofbirth">PaperTakingDate</label>
                        <input class = "date" type="date" name="papertakingdate" value="<?php echo $paperDate ?>" id="dateofbirth">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style = "text-align: center; margin: 20px">
                            <button class="button-30" role="button">
                                Add one
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <?php if($succes == 1){
                    echo "SUCCESS!";
                }else if($succes == 2){
                    echo $errrors;
                } ?>
            </div>
        </form>
    </body>
</html>