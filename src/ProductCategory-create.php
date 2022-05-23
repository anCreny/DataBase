<?php 
include 'fnc.php';
$name = "";
$notes = "";
$succes = 0;
if(isset($_POST['name'])){
    $errrors = "";
    if($_POST['name'] == ""){
        $errrors .= "[Name: empty]";
    }else{
        $name = $_POST['name'];
    }
    if($_POST['notes'] == ""){
        $errrors .= "[Notes: empty]";
    }else{
        $notes = $_POST['notes'];
    }
    if($errrors == ""){
        $sql = "INSERT INTO ProductCategory VALUES (NULL, '$name', '$notes')";
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
                    $notes = "";
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
            <form action="ProductCategory.php">
                <button class="button-30" role="button">
                    <-Back
                </button>
            </form>
        </div>
        <div class="hit-the-floor" style = "margin-bottom: 70px; font-size: 45px">
            Adding new ProductCategory
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table align = "center" style = "width:20%">
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="name" value='<?php echo $name ?>' class="Input-text" placeholder="Name">
                            <label for="input" class="Input-label">Name</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="notes" value='<?php echo $notes ?>' class="Input-text" placeholder="Notes">
                            <label for="input" class="Input-label">Notes</label>
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