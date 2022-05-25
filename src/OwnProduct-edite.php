<?php 
include 'fnc.php';
$id;
$row;
if(isset($_POST['edite'])){
    $id = $_POST['edite'];
    $sql = "SELECT * FROM OwnProduct WHERE IDOwnProduct = '$id'";
    $result = $db->query($sql);
    $row = mysqli_fetch_row($result);
}
$deal = "";
$price = "";
$succes = 0;
if(isset($_POST['deal'])){
    $errors = "";
    if($_POST['deal'] == ""){
        $deal = $row[1];
    }else{
        $deal = $_POST['deal'];
    }

    if($_POST['price'] == ""){
        $price = $row[2];
    }else{
        $price = $_POST['price'];
    }
    if($errors == ""){
        $sql = "UPDATE OwnProduct 
                SET
                    IDDeal = '$deal',
                    CurrentPrice = '$price'
                WHERE IDOwnProduct  = '$id'
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
                            $deal = "";
                            $price = "";
                            $succes = 1;
                            $sql = "SELECT * FROM OwnProduct WHERE IDOwnProduct = '$id'";
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
        <div class="hit-the-floor" style = "margin-bottom: 30px; font-size: 45px">
            Editing an OwnProduct
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table style="width:70%; text-align:center; align-items:center; font-size:20px" align="center">
                <tr>
                    <th>
                        Product
                    </th>
                    <td>
                        <?php 
                        $idDeal = $row[1];
                        $stmt = "SELECT ProductDescription FROM Deal
                                WHERE IDDeal = '$idDeal'";
                        $ros = mysqli_fetch_row($db -> query($stmt));
                        echo $ros[0]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td style="text-align:left">
                        <select name="deal" style="margin: 20px; margin-left:0px; align-items:left">
                            <option selected value="">Deal</option>
                            <?php 
                            $sql = "SELECT ProductDescription, IDDeal FROM Deal
                                    WHERE IDDeal NOT IN (SELECT IDDeal FROM OwnProduct)";
                            $result = $db -> query($sql);
                            foreach($result as $roww){
                            ?>
                            <option value="<?php echo $roww['IDDeal'] ?>"><?php echo $roww['ProductDescription'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        CurrentPrice
                    </th>
                    <td>
                        <?php echo $row[2]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="price" id="input" value="<?php echo $price; ?>" class="Input-text" placeholder="CurrentPrice">
                            <label for="input" class="Input-label">CurrentPrice</label>
                        </div>
                    </td>
                </tr>
            </table>
            <div style = "text-align: center; margin: 20px">
                <button class="button-30" role="button" name="edite" value="<?php echo $row[0]; ?>">
                    Submit
                </button>
            </div>
        </form>
        <?php if($succes == 1){ ?>
                    <div class="alert success-alert">
                        <h3>SUCCESS</h3>
                        <a class="close">&times;</a>
                    </div>

                <?php }else if($succes == 2){ ?>
                    <div class="alert danger-alert">
                        <h3>Errors: <?php echo $errors ?></h3>
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