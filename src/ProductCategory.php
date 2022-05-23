<?php 
include 'fnc.php';
?>
<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>Deal</title>
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
            ProductCategory
        </div>
        <div class="hit-the-floor" style = "font-size: 26px; margin-bottom: 20px">
            There's <?php echo mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM ProductCategory"))[0]?> rows
        </div>
        <div style = "text-align: center; margin-bottom: 20px">
            <form action="ProductCategory-create.php">
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
                    IDProductCategory
                </th>
                <th>
                    Name
                </th>
                <th>
                    Notes
                </th>
                <th>
                    Actions
                </th>
            </tr>
                <?php 
                    $stmt = "SELECT * FROM ProductCategory";
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
                                <form action="ProductCategory-edite.php" method="POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="edite" value="<?php echo $row['IDProductCategory']?>">
                                        Edite
                                    </button>
                                </form>
                                <form action = "ProductCategory-delete.php" method = "POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="delete" value="<?php echo $row['IDProductCategory']?>">
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