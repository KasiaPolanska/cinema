<?php

require('../frontend/header.php');

?>

<div class="section">
    <div class="container">
        <div class="section-header">
            <?php 
            if(isset($_SESSION['logged_in']))
            {
                echo "Hello " . $_SESSION['login'];

                
            }
            ?>
        </div>
        <form method="POST">
            <input name="btnLoguit" type="submit" value="Log out" class='btn btn-hover'> 
        </form>
        <div class="section-header"><h5>Your orders</h5></div>
        <?php
            include('../backend/order_controller.php');
            $order_contr = new Order_controller();    
            echo $order_contr->show_order();    
            if(isset($_SESSION['shopping_cart']))  {
                ?>
                <a href='#' class='btn btn-hover'>
                    <span>
                        Edit
                    </span>
                </a>
                <?php
            }
        ?>
         
    </div>
</div>


<?php 
    if(isset($_POST['btnLoguit'])){
        if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            echo '<script>
            alert("You are logged out.");
            window.location.replace("../index.php");
            </script>';
        }
    }

include('footer.php');?>