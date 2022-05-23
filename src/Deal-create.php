<?php 
include 'fnc.php';
$productCategory = "";
$client = "";
$productDescription = "";
$takingDate = "";
$returningDate = "";
$pledge = "";
$comission = "";
$succes = 0;
if(isset($_POST['prod'])){
    $errrors = "";
    if($_POST['prod'] == ""){
        $errrors .= "[ProductCategory: empty]";
    }else{
        $productCategory = $_POST['prod'];
    }
    if($_POST['client'] == ""){
        $errrors .= "[Client: empty]";
    }else{
        $client = $_POST['client'];
    }
    if($_POST['product'] == ""){
        $errrors .= "[ProductDescription: empty]";
    }else{
        $productDescription = $_POST['product'];
    }
    if($_POST['returningDate'] == ""){
        $errrors .= "[ReturningDate: empty]";
    }else{
        $returningDate = $_POST['returningDate'];
    }
    if($_POST['takingDate'] == ""){
        $errrors .= "[TakingDate: empty]";
    }else{
        $takingDate = $_POST['takingDate'];
    }
    if($_POST['pledge'] == ""){
        $errrors .= "[Pledge: empty]";
    }else{
        $pledge = $_POST['pledge'];
    }
    if($_POST['comission'] == ""){
        $errrors .= "[Comission: empty]";
    }else{
        $comission = $_POST['comission'];
    }
    if($errrors == ""){
        $sql = "INSERT INTO Deal VALUES (NULL, '$client', '$productCategory', '$productDescription', '$takingDate', '$returningDate', '$pledge', '$comission')";
        $stmt = mysqli_prepare($db, $sql);
        if($stmt == false){
            echo "[синтаксис]".mysqli_error($db);
            }else if($stmt != false){
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_errno($stmt) != 0){
                    $succes = 2;
                    $errrors .= '['.mysqli_stmt_error($stmt)."]";
                }else{
                    $productCategory = "";
                    $client = "";
                    $productDescription = "";
                    $takingDate = "";
                    $returningDate = "";
                    $pledge = "";
                    $comission = "";
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
            <form action="Deal.php">
                <button class="button-30" role="button">
                    <-Back
                </button>
            </form>
        </div>
        <div class="hit-the-floor" style = "margin-bottom: 70px; font-size: 45px">
            Adding new Deal
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table align = "center" style = "width:20%">
                <tr>
                    <td>
                        <select name="prod" style="margin: 20px;">
                            <option selected value="">ProductCategory</option>
                            <?php 
                            $sql = "SELECT Name, IDProductCategory FROM ProductCategory";
                            $result = $db -> query($sql);
                            foreach($result as $row){
                            ?>
                            <option value="<?php echo $row['IDProductCategory'] ?>"><?php echo $row['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="client" style="margin: 20px;">
                            <option selected value="">Client</option>
                            <?php 
                            $sql = "SELECT CONCAT(Name, ' ', Surname) AS Name, IDClient FROM Client";
                            $result = $db -> query($sql);
                            foreach($result as $row){
                            ?>
                            <option value="<?php echo $row['IDClient'] ?>"><?php echo $row['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="product" value='<?php echo $productDescription ?>' class="Input-text" placeholder="ProductDescription">
                            <label for="input" class="Input-label">ProductDescription</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateofbirth">TakingDate</label>
                        <input class = "date" type="date" name="takingDate" value="<?php echo $takingDate ?>" id="dateofbirth">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateofbirth">ReturningDate</label>
                        <input class = "date" type="date" name="returningDate" value="<?php echo $returningDate ?>" id="dateofbirth">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="pledge" value='<?php echo $pledge ?>' class="Input-text" placeholder="Pledge">
                            <label for="input" class="Input-label">Pledge</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="comission" value='<?php echo $comission ?>' class="Input-text" placeholder="comission">
                            <label for="input" class="Input-label">Comission</label>
                        </div>
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