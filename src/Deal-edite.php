<?php 
include 'fnc.php';
$id;
$row;
if(isset($_POST['edite'])){
    $id = $_POST['edite'];
    $sql = "SELECT * FROM Deal WHERE IDDeal = '$id'";
    $result = $db->query($sql);
    $row = mysqli_fetch_row($result);
}
$productCategory = "";
$client = "";
$productDescription = "";
$takingDate = "";
$returningDate = "";
$pledge = "";
$comission = "";
$succes = 0;
if(isset($_POST['prod'])){
    $errors = "";
    if($_POST['prod'] == ""){
        $productCategory = $row[2];
    }else{
        $productCategory = $_POST['prod'];
    }

    if($_POST['client'] == ""){
        $client = $row[1];
    }else{
        $client = $_POST['client'];
    }

    if($_POST['product'] == ""){
        $productDescription = $row[3];
    }else{
        $productDescription = $_POST['product'];
    }

    if($_POST['takdate'] == ""){
        $takingDate = $row[4];
    }else{
        $takingDate = $_POST['takdate'];
    }

    if($_POST['retdate'] == ""){
        $returningDate = $row[5];
    }else{
        $returningDate = $_POST['retdate'];
    }
    if($_POST['pledge'] == ""){
        $pledge = $row[6];
    }else{
        $pledge = $_POST['pledge'];
    }
    if($_POST['comission'] == ""){
        $comission = $row[7];
    }else{
        $comission = $_POST['comission'];
    }
    if($errors == ""){
        $sql = "UPDATE Deal 
                SET
                    IDClient = '$client',
                    IDProductCategory = '$productCategory',
                    ProductDescription = '$productDescription',
                    TakingDate = '$takingDate',
                    ReturningDate = '$returningDate',
                    Pledge = '$pledge',
                    Comission = '$comission'
                WHERE IDDeal = '$id'
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
                            $productCategory = "";
                            $client = "";
                            $productDescription = "";
                            $takingDate = "";
                            $returningDate = "";
                            $pledge = "";
                            $comission = "";
                            $succes = 1;
                            $sql = "SELECT * FROM Deal WHERE IDDeal = '$id'";
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
                            <form action="Deal.php">
                                <button class="button-30" role="button">
                                    <-Back
                                </button>
                            </form>
                        </div>
        <div class="hit-the-floor" style = "margin-bottom: 30px; font-size: 45px">
            Editing a Deal
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table style="width:70%; text-align:center; align-items:center; font-size:20px" align="center">
                <tr>
                    <th>
                        Client
                    </th>
                    <td>
                        <?php
                        $idclient = $row[1];
                        $sql = "SELECT CONCAT(Name, ' ', Surname) FROM Client WHERE IDClient = '$idclient'";
                        $ros = mysqli_fetch_row($db -> query($sql));
                        echo $ros[0]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <select name="client" style="margin-top:20px; margin-bottom:20px">
                            <option selected value="">Client</option>
                            <?php 
                            $sql = "SELECT CONCAT(Name, ' ', Surname) AS Name, IDClient FROM Client";
                            $result = $db -> query($sql);
                            foreach($result as $roww){
                            ?>
                            <option value="<?php echo $roww['IDClient'] ?>"><?php echo $roww['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        ProductCategory
                    </th>
                    <td>
                        <?php
                        $idproductcategory = $row[2];
                        $sql = "SELECT Name FROM ProductCategory WHERE IDProductCategory";
                        $ros = mysqli_fetch_row($db -> query($sql));
                        echo $ros[0]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <select name="prod" style="margin-top:20px; margin-bottom:20px">
                            <option selected value="">ProductCategory</option>
                            <?php 
                            $sql = "SELECT Name, IDProductCategory FROM ProductCategory";
                            $result = $db -> query($sql);
                            foreach($result as $roww){
                            ?>
                            <option value="<?php echo $roww['IDProductCategory'] ?>"><?php echo $roww['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        ProductDescription
                    </th>
                    <td>
                        <?php echo $row[3]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="product" id="input" value="<?php echo $productDescription; ?>" class="Input-text" placeholder="ProductDescription">
                            <label for="input" class="Input-label">ProductDescription</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        TakingDate	
                    </th>
                    <td>
                        <?php echo $row[4]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <input class = "date" type="date" name="takdate" value="<?php echo $takingDate; ?>" style="font-size: 1.2em;">
                    </td>
                </tr>
                <tr>
                    <th>
                        ReturningDate
                    </th>
                    <td>
                        <?php echo $row[5]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <input class = "date" type="date" name="retdate" value="<?php echo $returningDate; ?>" style="font-size: 1.2em;">
                    </td>
                </tr>
                <tr>
                    <th>
                        Pledge
                    </th>
                    <td>
                        <?php echo $row[6]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="pledge" id="input" value="<?php echo $pledge; ?>" class="Input-text" placeholder="Pledge">
                            <label for="input" class="Input-label">Pledge</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        Comission
                    </th>
                    <td>
                        <?php echo $row[7]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="comission" id="input" value="<?php echo $comission; ?>" class="Input-text" placeholder="Comission">
                            <label for="input" class="Input-label">Comission</label>
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