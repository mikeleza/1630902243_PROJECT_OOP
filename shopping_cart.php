<?php 
   if(!empty($_GET['action'])){
        switch($_GET['action']){
            case "add":
                if(!empty($_POST['quantity'])){
                    $productByCode = $bookdata->runQuery("SELECT * FROM tblebooks WHERE ID='". $_GET['id']. "'");
                    $itemArray = array($productByCode[0]['ID']=>array('bookname'=>$productByCode[0]["bookname"],
                    'ID'=>$productByCode[0]["ID"],
                    'quantity'=>$_POST["quantity"],
                    'price'=>$productByCode[0]["price"],
                    'image'=>$productByCode[0]["image"]));   
                
                if(!empty($_SEESION['cart_item'])){
                    if(in_array($productByCode[0]['ID'], array_keys($_SEESION["cart_item"]))){
                        foreach($_SEESION['cart_item'] as $k => $v){
                            if($productByCode[0]['ID']==$k){
                                if(empty($_SEESION["cart_item"][$k]['quantity'])){
                                    $_SEESION["cart_item"][$k]['quantity']=0;
                                }
                                $_SEESION['cart_item'][$k]['quantity'] += $_POST["quantity"];
                            }
                        }
                     }else {
                        $_SEESION["cart_item"] = array_merge($_SEESION['cart_item'], $itemArray);
                    } 
                } else {
                    $_SEESION['cart_item'] = $itemArray;
            } 
        }break;

            case "remove":
                if(!empty($_SEESION["cart_item"])){
                    foreach($_SEESION["cart_item"] as $k => $v){
                        if($_GET["id"] == $k)
                        unset($_SEESION['cart_item'][$k]);

                        if(empty($_SEESION['cart_item']))
                        unset($_SEESION['cart_item']);
                    }
                }
                break;
                case "empty":
                    unset($_SEESION['cart_item']);
                break;
        } 
    }?>
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>
    <a href="firstpage.php?x=shopping_cart&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>&action=empty" id="btnEmpty">Empty Cart</a>

   <?php
    if(isset($_SESSION['cart_item'])){
        $total_quantity = 0;
        $total_price = 0;
    
   ?>

    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align: left;">Image</th>
                <th style="text-align: left;" width="45%">Name</th>
                <th style="text-align: right;" width ="5%">Quantity</th>
                <th style="text-align: right;" width ="10%">Unit Price</th>
                <th style="text-align: right;" width ="10%">Price</th>
                <th style="text-align: center;" width ="5%">Remove</th>
            </tr>

            <?php
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
                
            ?>

            <tr>
                <td><img src="upload/<?php echo $item['image'];?>" class="cart-item-image" /></td>
                <td><?php echo $item['name'];?></td>
                <td style="text-align: right;" ><?php echo $item['quantity'];?></td>
                <td style="text-align: right;" ><?php echo '฿'. $item['price'];?></td>
                <td style="text-align: right;" ><?php echo '฿'. $item_price;?></td>
                <td style="text-align: center;" ><a href="firstpage.php?x=shopping_cart&page=&userid=<?php echo $_SEESION['id']?>&R=<?php echo $role?>&C=<?php echo $cate?>&action=remove&id=<?php echo $item['id'];?>" class="btnRemoveAction" alt="Remove Item"><i class="fa-solid fa-trash fa-2xl"></i></td>
            </tr>
            <?php
                $total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
                }
            ?>
            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity;?></td>
                <td align="right" colspan="2"><?php echo '฿'. $total_price;?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php 
                }else {
            ?>
        <div class="no-records">Your Cart is Empty</div>
    <?php }?>
</div>



