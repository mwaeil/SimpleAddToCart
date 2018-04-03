<?php
    session_start();
    require_once "./class.php";

    $controller = new SimpleCart();

    if(empty($_SESSION['cart'])){
        $_SESSION['cart']=[];
    }

    if(!empty($_GET['action'])){
        switch($_GET['action']){
            case "add":
                $find = 0;
                $name = $_GET['name'];
                $price = $_GET['price'];
                $qty = $_POST['qty'];
                $sub = $price*$qty;
                $cartitem = [$name,$price,$qty,$sub];
                $retval = $controller->SearchInCart($name,$qty,$sub);
                if(!$retval){
                    array_push($_SESSION['cart'],$cartitem);
                }
                break;
            case "remove":
                unset($_SESSION['cart'][$_GET['item']]);
                break;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <table border="1">
        <tr>
            <td>Item</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Subtotal</td>
            <td>Action</td>
        </tr>
        <?php
        
            if(!empty($_SESSION['cart'])){
                $i = 0;
               foreach($_SESSION['cart'] as $key=>$item) {


        ?>
        <tr>
            <td><?php echo $item[0]; ?></td>
            <td><?php echo $item[1]; ?></td>
            <td><?php echo $item[2]; ?></td>
            <td><?php echo $item[3]; ?></td>
            <td><a href='index.php?action=remove&item=<?php echo $key; ?>'>Remove</a></td>
        </tr>
        <?php }
            }  ?>
    </table>
    <br>
    <br>
    <?php
         foreach($controller->products as list($name,$price)){
    ?>
    <form action="index.php?action=add&<?php echo "name=$name&price=$price"; ?>" method="POST">
        <?php echo "$name - PHP $price"; ?>
        <input type="number" name="qty" min="1" max="5" value="1">
        <input type="submit" value="Add To Cart">
    </form>
    <?php } ?>

</body>

</html>