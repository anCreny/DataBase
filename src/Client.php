<?php 
include 'fnc.php';
?>
<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>Client</title>
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
            Client
        </div>
        <div class="hit-the-floor" style = "font-size: 26px; margin-bottom: 20px">
            There's <?php echo mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM Client"))[0]?> rows
        </div>
        <div style = "text-align: center; margin-bottom: 20px">
            <form action="Client-create.php">
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
                    IDClient
                </th>
                <th>
                    Surname
                </th>
                <th>
                    Name
                </th>
                <th>
                    Patronymic
                </th>
                <th>
                    PaperNumber
                </th>
                <th>
                    PaperSeries
                </th>
                <th>
                    PaperTakingDate
                </th>
                <th>
                    Actions
                </th>
            </tr>
                <?php 
                    $stmt = "SELECT * FROM Client";
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
                                <form action="Client-edite.php" method="POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="edite" value="<?php echo $row['IDClient']?>">
                                        Edite
                                    </button>
                                </form>
                                <form action = "Client-delete.php" method = "POST" style = "margin-bottom:0px; margin:5px">
                                    <button class="button-6" role="button" name="delete" value="<?php echo $row['IDClient']?>">
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