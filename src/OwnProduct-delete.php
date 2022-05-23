<?php
include 'fnc.php';
$id = $_POST['delete'];
$sql = "DELETE FROM OwnProduct WHERE 
        IDOwnProduct = '$id'";
$stmt = mysqli_prepare($db, $sql);
if($stmt == false){
    echo mysqli_error($db);
}else if($stmt != false){
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_errno($stmt) == 0){
        echo "SUCCESS!";
    }
    echo mysqli_stmt_errno($stmt);
}
?>
<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <link href="das.scss" rel="stylesheet" type="text/scss">
        <meta charset="utf-8">
        <title>Delete</title>
    </head>
        <header>
            <div style = "text-align: left; margin: 20px">
                <form action="OwnProduct.php">
                    <button class="button-30" role="button">
                        <-Back
                    </button>
                </form>
             </div>
        </header>
    <body>
       
    </body>
</html>