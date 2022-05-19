<?php
    include 'header.php';
      // session_start();
    //    if(isset($_SESSION['cart'])){
    //        $cart=$_SESSION['cart'];
    //    }
    //    else{
    //        $cart=[];
    //    }
        include 'cart_function.php';
        include 'order_function.php';
        include '../database/connect.php';

    // if(!isset($_SESSION["user"])){
    //      header("location:login.php?action=order");
    // }
    if(isset($_SESSION['user'])){
        //$username=$_SESSION['user'];
        $username=$_SESSION['user'];

        $result=mysqli_fetch_array(mysqli_query($conn,"SELECT user_id FROM tbl_user WHERE user_name='$username'"));
        $user_id=$result['user_id'];

        $result2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_cart WHERE user_id='$user_id'"));

        $cart_id=$result2['cart_id'];      

        $pdt="SELECT * FROM tbl_cart INNER JOIN tbl_cart_detail ON tbl_cart.cart_id=tbl_cart_detail.cart_id
        INNER JOIN tbl_product ON tbl_product.product_id=tbl_cart_detail.product_id
         WHERE tbl_cart.cart_id=$cart_id";
         $q=mysqli_query($conn,$pdt);
        $cart=[];
        while($row=mysqli_fetch_array($q)){
            $cart[]=$row;

        }
    }
    else{
        $cart=[];
    }
    mysqli_set_charset($conn,'utf8');
?>
<?php
    $user=$_SESSION["user"];
    $id_user_query= mysqli_query($conn, "SELECT user_id FROM tbl_user WHERE user_name='$user'");
    $user_row=mysqli_fetch_array($id_user_query);
    $id_user=$user_row['user_id'];
    if(isset($_POST['name'])){
        $status=1;
        $date=date("Y/m/d");
        $phone=$_POST["phone"];
        $addess=$_POST["address"];
        $name=$_POST["name"];
        $email=$_POST["email"];
        $total=total($cart);
        $delivery=delivery_fee(total($cart));
        $t=$total+$delivery;
        $note=$_POST['note'];
        if(isset($_POST['payment']))
        {
            $payment=$_POST['payment'];
            if($payment==1){
                $payment_method=1;
            }
            else
            $payment_method=2;

        }
 
        $query=mysqli_query($conn,"INSERT INTO tbl_order(user_id,order_name,order_phone,order_email,order_address,order_date,order_status,order_total,order_delivery,order_note,order_payment)
         VALUES ('$id_user','$name','$phone','$email','$addess','$date','$status','$t','$delivery','$note','$payment_method')");

        if($query){
            $id_order=mysqli_insert_id($conn);
            foreach($cart as $value){
                mysqli_query($conn,"INSERT INTO tbl_order_detail(order_id,product_id,order_quantity,order_price)
                 VALUES('$id_order','$value[product_id]','$value[product_mount]','$value[product_price]')");

                $query_product=mysqli_query($conn,"UPDATE tbl_product SET product_quantity=product_quantity-$value[product_mount]
                WHERE product_id=$value[product_id]");
            }
          header("location: home.php");
        }  
        else{
            echo mysqli_error($conn);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/order_style.css">
</head>
<body>
    <form method="POST">
        

    <div class="order_container">
    
        <div class="order_item order_item1">
            <div class="order_inf">
                <h1>Thông tin giao hàng</h1>

                <div class="order_name">
                    <input type="text" placeholder="Họ và tên" name="name">
                </div>
                <div class="order_email">
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="order_phone">
                    <input type="text" placeholder="Số điện thoại" name="phone">
                </div>
                <div class="order_address">
                    <input type="text" placeholder="Địa chỉ" name="address"> 
                </div>
                <!-- <div class="frm_province order_frm">
                  <label for="" class="label_add_detail">Tỉnh / Thành</label>
                    <select class="order_add_detail" name="a"> 
                    <option value=null>Chọn Tỉnh/Thành</option>
                    <option value="volvo">Hà Nội</option>
                    <option value="saab">Hồ Chí Minh</option>
                    <option value="opel">Hải Phòng</option>
                    </select>                    
                </div>
           
                 <div class="frm_district order_frm">
                    <label for="" class="label_add_detail">Quận / Huyện</label>
                    <select class="order_add_detail" name="b"> 
                    <option value=null>Chọn Quận/Huyện</option>
                    <option value="volvo">Hà Dông</option>
                    <option value="saab">Bắc Từ Liêm</option>
                    <option value="opel">Nam Từ Liêm</option>
                    </select>                     
                 </div>
                -->
            </div>

            <div class="order_inf">
                <h1>Phương thức thanh toán</h1>
               
                <div class="order_payment">
                    <div class="payment" class="order_payment">
                        <input type="radio" id="payment_bank" name="payment" value="1">
                        
                        <label for="payment_bank" onclick="show()">
                            <img src="../img/icon/money-transfer.png" alt="">
                            <p>Thanh toán qua ngân hàng </p> 
                        </label>
                    </div>
                   
                    <div id="payment_bank_content" style="display: none;">
                    <p>Khi lựa chọn phương thức thanh toán Chuyển khoản qua ngân hàng,
                        bạn vui lòng chuyển 100% giá trị đơn hàng vào tài khoản dưới đây:
                        Chủ tài khoản: Nhà sách Trí Tuệ
                        STK: 19037014304012.<br><br>
                    Ngân hàng Thương mại Cổ phần kỹ thương Việt Nam (TECHCOMBANK)
                        Khi chuyển khoản, vui lòng đề rõ Tên – Mã Đơn hàng –
                         SĐT vào phần Nội dung chuyển khoản.</p>
                </div>

                    <div class="payment" >
                        <input type="radio" id="payment_receive" name="payment" value="2">
                        <label for="payment_receive" onclick="hidden_show()">
                            <img src="../img/icon/cash-on-delivery .png" alt="">
                           <p>Thanh toán khi nhận hàng</p> 
                        </label>
                    </div>
                    <p id="show"></p>
                    
                </div>
            </div>
            <div class="order_inf order_note">
                <h1>Ghi chú</h1>
                <textarea rows="5" cols="" name='note'></textarea>
            </div>
            <div class="order_inf order_purchase">
                <button type="submit" class="order_btn">Đặt hàng</button>
            </div>

       
        </div>
        <div class="order_item ">
            <div class="order_pdt">
                <h1>Sản phẩm</h1>
                <div class="order_list_pdt">
                    <table>
                        <?php foreach($cart as $key=>$value): ?>
                        <tr>
                            <td><a href=""class="order_pdt_img"><img src="../img/product/<?php echo $value['product_image'] ?>" alt=""></a></td>
                            <td><a href="" ><?php echo $value['product_name'] ?></a>  </td>
                            <td><?php echo $value['product_amount'] ?></td>
                            <td><?php echo $value['product_price'] ?></td>
                        </tr>
                        <?php endforeach?>
                    </table>

                </div>
            </div>
            <div class="order_total">
                <h1>Thành tiền</h1>
                <table>
                    <tr>
                        <td class="order_total_title">Tổng tiền sản phẩm</td>
                        <td class="order_money"><?php echo total($cart) ?></td>
                    </tr>
                    <tr>
                        <td class="order_total_title">Phí vận chuyển</td>
                        <td class="order_money"><?php echo delivery_fee(total($cart)) ?></td>
                    </tr>
                    <tr>
                        <td class="order_total_title" style="font-weight: 600;">Tổng cộng</td>
                        <td class="order_money" style="font-weight:600;font-size: 16px;" ><?php echo total($cart)+ delivery_fee(total($cart))  ?></td>
                    </tr>
                </table>
            </div>
 

        </div>
    </div>

    <script>
        function show() {
            var x = document.getElementById("payment_bank_content");
            if (x.style.display==="none") {
              x.style.display = "block";
            }
        }
        function hidden_show() {
            var x = document.getElementById("payment_bank_content");
            if (x.style.display=="block") {
              x.style.display = "none";
            }
        }
     </script>
    </form>
    <?php include 'footer.php'  ?>
</body>
</html>