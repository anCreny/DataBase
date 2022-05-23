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
        <div class="hit-the-floor" style="margin-bottom:100px">
            Active Deals
        </div>
    </header>
    <body>
        <table align="center" border="1px" cellpadding= "10px" style = "font-size: 20px">
            <tr>
                <th>
                    IDDeal
                </th>
                <th>
                    Client
                </th>
                <th>
                    Product
                </th>
                <th>
                    TakingDate
                </th>
                <th>
                    DaysLeft
                </th>
                <th>
                    ReturnnigDate
                </th>
            </tr>
                <?php 
                    $stmt = "CALL ActiveDeals()";
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
                    </tr>
                <?php   
                    }
                ?>
        </table>
    </body>
</html>