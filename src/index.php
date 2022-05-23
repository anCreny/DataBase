<?php 
include 'fnc.php';
?>
<html>
    <head>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title>The Pawnshop</title>
    </head>
    <header>
        <div class="hit-the-floor" style = "margin-bottom: 70px">
            PawnShop
        </div>
    </header>
    <body>
        <div style="text-align: center">
            <form action = "Client.php">
                <button class="button-30" role="button">
                    Client
                </button>
            </form>
        </div> 
        <div style="text-align: center">
            <form method = 'POST' action="Deal.php">
                <button class="button-30" role="button">
                    Deal
                </button>
            </form>
        </div>
        <div style="text-align: center">
            <form method = 'POST' action="ProductCategory.php">
                <button class="button-30" role="button">
                    ProductCategory
                </button>
            </form>
        </div>
        <div style="text-align: center">
            <form method = 'POST' action="OwnProduct.php">
                <button class="button-30" role="button">
                    OwnProduct
                </button>
            </form>
        </div>
        <div style="text-align: center">
            <form method = 'POST' action="Price.php">
                <button class="button-30" role="button">
                    Price
                </button>
            </form>
        </div>
        <div style="text-align: center">
            <form method = 'POST' action="ActiveDeals.php">
                <button class="button-30" role="button">
                    Active Deals
                </button>
            </form>
        </div>
    </body>
</html>