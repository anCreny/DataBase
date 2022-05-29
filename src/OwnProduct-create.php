<?php 
include 'fnc.php';
$deal = "";
$price = "";
$succes = 0;
if(isset($_POST['deal'])){
    $errrors = "";
    if($_POST['deal'] == ""){
        $errrors .= "[Deal: empty]";
    }else{
        $deal = $_POST['deal'];
    }
    if($_POST['price'] == ""){
        $errrors .= "[CurrentPrice: empty]";
    }else{
        $price = $_POST['price'];
    }
    if($errrors == ""){
        $sql = "INSERT INTO OwnProduct VALUES (NULL, '$deal', '$price')";
        $stmt = mysqli_prepare($db, $sql);
        if($stmt == false){
            echo "[синтаксис]".mysqli_error($db);
            }else if($stmt != false){
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_errno($stmt) != 0){
                    $succes = 2;
                    $errrors .= '['.mysqli_stmt_error($stmt)."]";
                }else{
                    $deal = "";
                    $price = "";
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
        <link href="style2.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>Create</title>
    </head>
    <header>
        <div style = "text-align: left; margin: 20px">
            <form action="OwnProduct.php">
                <button class="button-30" role="button">
                    <-Back
                </button>
            </form>
        </div>
        <div class="hit-the-floor" style = "margin-bottom: 70px; font-size: 45px">
            Adding new OwnProduct
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table align = "center" style = "width:20%">
                <tr>
                    <td>
                        <select name="deal" style="margin: 20px;">
                            <option selected value="">Deal</option>
                            <?php 
                            $sql = "SELECT ProductDescription, IDDeal FROM Deal
                                    WHERE IDDeal NOT IN (SELECT IDDeal FROM OwnProduct)";
                            $result = $db -> query($sql);
                            foreach($result as $row){
                            ?>
                            <option value="<?php echo $row['IDDeal'] ?>"><?php echo $row['ProductDescription'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" id="input" name="price" value='<?php echo $price ?>' class="Input-text" placeholder="CurrentPrice">
                            <label for="input" class="Input-label">CurrentPrice</label>
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
        </form>
        <?php if($succes == 1){ ?>
                    <div class="alert success-alert">
                        <h3>SUCCESS</h3>
                        <a class="close">&times;</a>
                    </div>

                <?php }else if($succes == 2){ ?>
                    <div class="alert danger-alert">
                        <h3>Errors: <?php echo $errrors ?></h3>
                        <a class="close">&times;</a>
                    </div>
              <?php  } ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
                $(".close").click(function() {
            $(this)
            .parent(".alert")
            .fadeOut();
        });
    </script>
    </body>
</html>