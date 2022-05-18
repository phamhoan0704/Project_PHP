<?php 
    include '../../Database/connect.php';
    session_start();
    $od_id=$_GET['id'];

    $query_order_detail=mysqli_query($conn,"SELECT* FROM tbl_order WHERE order_id=$od_id");
    $order_result=mysqli_fetch_array($query_order_detail);


    $sql_order_detail="SELECT *FROM tbl_order_detail INNER JOIN tbl_product 
    ON tbl_product.product_id=tbl_order_detail.product_id
    WHERE order_id=$od_id";
    $order_detail=mysqli_query($conn,$sql_order_detail);
    while ($row = mysqli_fetch_array($order_detail)){
        $pdt_detail[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="../css/order_detail_style.css">
</head>
<body>
    <div class="order_detail_container">        
        <div class="order_detail_customer">
            <h1>Thông tin người nhận</h1>
            <table>
                <tr>
                    <td class="">Họ tên:</td>
                    <td class="">
                        <p><?php echo $order_result['order_name'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="">Email:</td>
                    <td class="">
                        <p><?php echo $order_result['order_email'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="">Số điện thoại:</td>
                    <td class="">
                        <p><?php echo $order_result['order_phone'] ?></p>
                   </td>
                </tr>
                <tr>
                    <td class="">Địa chỉ</td>
                    <td class="">
                        <p><?php echo $order_result['order_address'] ?></p>
                   </td>
                </tr>
                <tr>
                    <td class="">Ghi chú</td>
                    <td class="">
                        <p><?php echo $order_result['order_note'] ?></p>
                   </td>
                </tr>
            </table>
        </div>
        <div class="order_status">
            <h1>Trạng thái đơn hàng </h1>
            <table>
                <tr>
                    <td class="order_status_date"><p>2/5/2022</p> </td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/shopping-bag.png" alt="">
                        <p>Đặt hàng</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>3/5/2022</p></td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/pack.png" alt="">
                        <p>Đang chuẩn bị hàng</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>3/5/2022</p> </td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/delivery-truck.png" alt="">
                        <p>Đơn hàng đang được vận chuyển</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>5/5/2022</p></td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/accept.png" alt="">
                        <p>Giao hàng thành công</p>
                    </td>
                </tr>

            </table>
        </div>
        <div class="order_pdt">
            <div class="order_list_pdt">
                <table>
                    <?php foreach($pdt_detail as $value): ?>
                    <tr>
                        <td><a href=""class="order_pdt_img"><img src="../img/product/<?php echo $value['product_image'] ?>" alt=""></a></td>
                        <td><a href=""><?php echo $value['product_name'] ?> </a>  </td>
                        <td><?php echo $value['order_quantity'] ?></td>
                        <td><p><?php echo $value['order_price'] ?></p></td>
                    </tr>

                    <?php endforeach ?>
                    <tr>
                        <td colspan="3">Phí vận chuyển</td>
                        <td><p><?php echo $order_result['order_delivery']?></p> </td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng cộng</td>
                        <td><p><?php echo $order_result['order_total']  ?></p> </td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</body>
</html>