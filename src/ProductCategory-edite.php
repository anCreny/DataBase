<?php 
include 'fnc.php';
$id;
$row;
if(isset($_POST['edite'])){
    $id = $_POST['edite'];
    $sql = "SELECT * FROM ProductCategory WHERE IDProductCategory = '$id'";
    $result = $db->query($sql);
    $row = mysqli_fetch_row($result);
}
$name = "";
$notes = "";
$succes = 0;
if(isset($_POST['name'])){
    $errors = "";
    if($_POST['name'] == ""){
        $name = $row[1];
    }else{
        $name = $_POST['name'];
    }

    if($_POST['notes'] == ""){
        $notes = $row[2];
    }else{
        $notes = $_POST['notes'];
    }
    if($errors == ""){
        $sql = "UPDATE ProductCategory 
                SET
                    Name = '$name',
                    Notes = '$notes'
                WHERE IDProductCategory = '$id'
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
                            $notes = "";
                            $succes = 1;
                            $sql = "SELECT * FROM ProductCategory WHERE IDProductCategory = '$id'";
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
                            <form action="ProductCategory.php">
                                <button class="button-30" role="button">
                                    <-Back
                                </button>
                            </form>
                        </div>
        <div class="hit-the-floor" style = "margin-bottom: 30px; font-size: 45px">
            Editing a ProductCategory
        </div>
    </header>
    <body>
        <form action="" method="POST">
            <table style="width:70%; text-align:center; align-items:center; font-size:20px" align="center">
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        <?php echo $row[1]; ?>
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
                        Notes
                    </th>
                    <td>
                        <?php echo $row[2]; ?>
                    </td>
                    <td>
                        --->
                    </td>
                    <td>
                        <div class="Input" style = "margin: 20px; align-items:center">
                            <input type="text" name="notes" id="input" value="<?php echo $notes; ?>" class="Input-text" placeholder="Notes">
                            <label for="input" class="Input-label">Notes</label>
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