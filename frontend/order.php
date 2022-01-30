<?php
require_once('header.php');
include('../backend/order_controller.php');
$order_contr = new Order_controller();       

if(isset($_POST['btnClean']))
{
    unset($_SESSION['shopping_cart']);
    header("Refresh:0");
}
?>
    <div class="section">
        <div class="container">
            <?php
            if(isset($_POST['btnFinish']))
            {
                $name = $_POST['txtName'];
                $to = $_POST['txtEmail'];
                $orderNr = rand(100, 1000000);

                $order_contr->send_email($name, $to, $orderNr);
                
            }
            else if(empty($_POST['btnBuy']))
            {
                echo $order_contr->show_order();
                ?>
                <form method="POST">
                <a href='#' class='btn btn-hover'>
                    <span>
                        <input type="submit" name="btnClean" value="Remove All">
                    </span>
                </a>
                <a href='#' class='btn btn-hover'>
                    <span>
                        <input type="submit" name="btnBuy" value="Buy tickets">
                    </span>
                </a>
            </form>
            <?php
            }
            else {
                echo $order_contr->show_order();
                ?>
                <form method="POST">
                    <input type="text" name="txtName" placeholder="Your name">
                    <input type="email" name="txtEmail" placeholder="E-mail address">
                    <a href='#' class='btn btn-hover'>
                    <span>
                        <input type="submit" name="btnFinish" value="Buy tickets">
                    </span>
                    </a>
                </form>
                <?php
            }
            ?>
            
        </div>
        
        </div>
    </div>
    <?php include('footer.php');?>