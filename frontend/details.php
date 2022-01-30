<?php
require('header.php');
require("../backend/controller.php");
$contr = new Controller();
?>
    <div class="section">
        <div class="container">
        <form method='POST'>
            <?php if($id = $_GET['id'] != null)
            {
                echo $contr->show_details();
            }
            else {
                echo $contr->find_film();
            }

            ?>
            
            <div class="seats_container" id="seats_container">
                <div class="content">
                    <div class='screen'></div>
                        <?php $contr->display_seats();?>
                        <div class='btn btn-hover buy'>
                            <span>
                                <input type="submit" name="btnSeat" value="Add"><br>
                            </span>
                        </div>

                        <span id="count"></span>
                        <input type="number" name="quantity" value="0" id="value">
                </div>
            </div> 
        </form>
            <?php 
            if(isset($_POST['btnSeat']))
            { 
                if(empty($_POST['seatNo'])) {
                    echo '<script>
                            alert("Please select seat.");
                        </script>';
                }
                else{
                    $contr->buy_ticket();
                }
                //echo $_POST['seatNo'], $_POST['rowNo'];
                
            }

            ?>
        </div>
    </div>
    <?php include('footer.php');?>