<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Order_controller {
        
    public function __construct()
    {
        require("config.php");
        require('vendor/autoload.php');
    }

    // ADD TICKET TO THE BASKET
    public function add_to_basket()
    {
        if(isset($_SESSION['shopping_cart']))
        {
            echo count($_SESSION['shopping_cart']);
            $item_id = array_column($_SESSION['shopping_cart'], 'item_id');

            if(in_array($_GET['id'], $item_id))
            {
                foreach($_SESSION['shopping_cart'] as $key => $value)
                {
                    if($_SESSION['shopping_cart'][$key]['item_id'] == $_GET['id'])
                    {
                        $_SESSION['shopping_cart'][$key]['quantity'] += $_POST['quantity'];
                    }
                }
            }
            else {  
                $count = count($_SESSION['shopping_cart']);
                $array_item = array(
                'item_id' => $_GET['id'],
                'title' => $_POST['txtTitle'],
                'date' => $_POST['txtDate'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['txtPrice'],
                'seat' => $_POST['seatNo'],
                'row' => $_POST['rowNo']
                );

                $_SESSION['shopping_cart'][$count] = $array_item;
            }
        }
        else
        {
            $array_item = array (
                'item_id' => $_GET['id'],
                'title' => $_POST['txtTitle'],
                'date' => $_POST['txtDate'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['txtPrice'],
                'seat' => $_POST['seatNo'],
                'row' => $_POST['rowNo']
            );
            $_SESSION['shopping_cart'][0] = $array_item;
            
        }
        echo '<script>
        alert("Ticket added to your cart!");
        window.location.replace("order.php");
        </script>';
    }


    // DISPLAY ORDER
    public function show_order()
    {
        if(!empty($_SESSION['shopping_cart']))
        {
            $this->create_table();
            $total = 0;
            foreach($_SESSION['shopping_cart'] as $i)
            {
                ?>
                    <tr>
                        <td width="25%"><?php echo $i['title']?></td>
                        <td width="15%"><?php echo $i['date']?></td>
                        <td width="15%"><?php echo $i['row']?></td>
                        <td width="15%"><?php echo $i['seat']?></td>
                        <td width="10%"><?php echo $i['quantity']?></td>
                        <td width="10%"><?php echo number_format($i['price'], 2)?></td>
                        <td width="15%"><?php $price = $i['quantity'] * $i['price'];
                        echo number_format($price, 2)?></td>
                        <td width="10%"><a href="?action=delete&id=<?php echo $i['item_id'];?>"><span>Remove</span></a></td>
                    </tr>
                
                <?php
                $this->remove_item();
            }
            ?>
            <tr> 
            <?php foreach($_SESSION['shopping_cart'] as $item) 
            {
                $total = $total + ($item['quantity'] * $item['price']);
            }
            ?>
            <td colspan="6" align="left">Total</td>  
            <td align="left">$ <?php echo number_format($total, 2); ?></td>  
        </tr> </table>
        <?php
        }
        else{
            echo "bestelling is leeg";
        }
    }
    // REMOVE ITEM FROM BASKET
    private function remove_item() {
        
        if(isset($_GET["action"])) {
            if($_GET["action"] == "delete")
            {
                foreach($_SESSION["shopping_cart"] as $key => $v)
                {
                    if($v["item_id"] == $_GET['id'])
                    {
                        unset($_SESSION["shopping_cart"][$key]);
                        echo "<script>
                        location.reload();
                        </script>";
                    }
                }
            }
        }
    }

    private function create_table()
    {
        ?>
        <table>
            <tr>
                <td width="25%">Title</td>
                <td width="15%">Date</td>
                <td width="10%">Row</td>
                <td width="10%">Seat</td>
                <td width="10%">Quantity</td>
                <td width="15%">Price</td>
                <td width="15%">Total</td>
            </tr>
        <?php
    }

    
    // SEND CONFIRMATION EMAIL WITH QR CODE
    public function send_email($name, $to, $orderNr)
    {
        
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );
            $mail->SMTPDebug = 0;                                   //Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                               //Enable SMTP authentication
            $mail->Username   = 'mymail@gmail.com';        //SMTP username
            $mail->Password   = 'mypassword';                        //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Enable implicit TLS encryption
            $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('kasia.polanskaa@gmail.com', 'FastMovie Renesse');
            $mail->addAddress($to, $name);                          //Name is optional

            //Content
            $mail->isHTML(true);                                    //Set email format to HTML
            $mail->Subject  = 'Confirmation email. FastMovie Renesse.';
            $mail->Body     =  'Hello '. $name.', <br>';
            $mail->Body    .=  'Your order number: '. $orderNr.'<br>';
            $mail->Body    .=  'This is your ticket for the following films: <br>';
            foreach($_SESSION['shopping_cart'] as $i){
                $mail->Body    .=   "<tr><td width='25%'>".$i['title']."</td>"; 
                $mail->Body    .=   "<td width='15%'>".$i['date']."</td>";
                $mail->Body    .=   "<td width='10%'>".$i['quantity']."</td>";
                $mail->Body    .=   "<td width='10%'>".$i['price']."</td>";
                $mail->Body    .=   "<td width='15%'>".$i['quantity'] * $i['price']."</td></tr><br>";
            }
            $mail->Body    .= "<img src='https://api.qrserver.com/v1/create-qr-code/?data=$orderNr&amp;size=100x100'/><br>";
            $mail->Body    .= 'Scan the QR code before entering the cinema room.<br>';
            $mail->Body    .= 'Enjoy, <br> FastMovie Renesse';
            //$mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // $mail->smtpClose();
            echo '<script>alert("Your order has been completed and you will receive confirmation email with your ticket. Enjoy!");
            window.location.replace("../index.php");</script>';
            unset($_SESSION['shopping_cart']);
        } catch (Exception $e) {
            echo "Message could not be sent.<br>";
            // echo $mail->ErrorInfo
        }
        // echo !extension_loaded('openssl')?"Not available":"Available";
    }
}