<?php 
include 'fnc.php';
?>
<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>OwnProduct</title>
    </head>
    <header>
        <div style = "text-align: left; margin: 20px">
            <form action="index.php">
                <button class="button-30" role="button">
                    <-Back
                </button>
             </form>
        </div>
        <div class="hit-the-floor">
            OwnProduct
        </div>
        <div class="hit-the-floor" style = "font-size: 26px; margin-bottom: 20px">
            There are <?php echo mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM OwnProduct"))[0]?> rows
        </div>
        <div style = "text-align: center; margin-bottom: 20px">
            <form action="OwnProduct-create.php">
                <button class="button-30" role="button">
                    Add one
                </button>
            </form>
        </div>
    </header>
    <body>
        <table align="center" border="1px" cellpadding= "10px" style = "font-size: 20px">
            <tr>
                <th>
                    IDOwnProduct
                </th>
                <th>
                    Product
                </th>
                <th>
                    CurrentPrice
                </th>
                <th>
                    Actions
                </th>
            </tr>
                <?php 
                    $stmt = "SELECT OwnProduct.IDOwnProduct, Deal.ProductDescription, OwnProduct.CurrentPrice FROM OwnProduct
                            JOIN Deal
                            ON Deal.IDDeal = OwnProduct.IDDeal";
                    $result = mysqli_query($db, $stmt);
                    foreach($result as $row){
                ?>
                   <tr>
                        <?php 
                        foreach($row as $subrow){
                            ?>
                                <td align="center">
                                    <?php

                                    echo $subrow;
                                    ?>
                                </td>
                            <?php
                        }
                        ?>
                            <td align="center">
                                <div style = "display: flex; justify-content: center; align-items: center;">
                                <form action="OwnProduct-edite.php" method="POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="edite" value="<?php echo $row['IDOwnProduct']?>">
                                        Edite
                                    </button>
                                </form>
                                <form action = "OwnProduct-delete.php" method = "POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="delete" value="<?php echo $row['IDOwnProduct']?>">
                                        Delete
                                    </button>
                                </form>
                                </div>
                            </td>
                    </tr>
                <?php   
                    }
                ?>
        </table>
    </body>
</html>