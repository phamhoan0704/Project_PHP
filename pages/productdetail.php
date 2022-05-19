<?php
include '../database/connect.php';

if (!empty($id))


    $name = $image = $year = $price = $price_pre = $detail = $quantity = $supplier = $author = $authorname = $suppliername = "";
$sql = "select*from tbl_product where product_id='$id';";
$query = mysqli_query($conn, $sql);
if (!$query) echo "loi";
else {
    while ($product = mysqli_fetch_array($query)) {
        $name = $product['product_name'];
        $img = $product['product_image'];
        $year = $product['product_year'];
        $price = $product['product_price'];
        $price_pre = $product['product_price_pre'];
        $detail = $product['product_detail'];
        $quantity = $product['product_quantity'];
        $supplier_id = $product['supplier_id'];
        $author_id = $product['author_id'];
    }
    $sql2 = "SELECT tbl_supplier.supplier_name,tbl_author.author_name 
from tbl_supplier 
inner join tbl_product on tbl_product.supplier_id = tbl_supplier.supplier_id
inner join tbl_author on tbl_product.author_id =tbl_author.author_id 
WHERE tbl_product.product_id='$id';";
    $query2 = mysqli_query($conn, $sql2);
    while ($result = mysqli_fetch_array($query2)) {
        $authorname = $result['author_name'];
        $suppliername = $result['supplier_name'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../css/productdetail.css">
</head>

<body>
    <div class="container">
        <div class="wapper">
            <div class="product_img">
                <div class="box_img">
                    <img src="../img/<?php echo ".$image" ?>" alt="">
                </div>
            </div>
            <div class="product_infor">
                <div class="product_name">
                    <h2> <?php echo $name ?></h2>

                </div>
                <div class="price">
                    <span><?php echo "$price" ?></span>
                    <del><?php echo "$price_pre" ?></del>
                </div>
                <div class="procduct_detial">
                    <div class="tbl">
                        <div class="row">
                            <strong>Tác Giả</strong>
                            <span><?php echo $authorname ?></span>
                        </div>
                        <div class="row">
                            <strong>Nhà Xuất Bản</strong>
                            <span><?php echo $suppliername ?></span>
                        </div>
                        <div class="row">
                            <strong>Năm Xuất Bản<strong>
                                    <span><?php echo $year ?></span>
                        </div>


                    </div>
                    <div class="summary">
                        <strong>Nội dung:</strong>
                        <div>
                            <p> <?php echo $detail ?></p>

                        </div>
                    </div>
                    <div class="box">
                        <form method="post">
                            <div class="boxwapp">
                                <div class="box2">
                                    <div class="select_quantity">

                                        <input onclick="checksubtract();" type='button' value='-' name="subtract" />
                                        <input id='quantity' min='1' id='quantity' type='text' value='1' name="numproduct" />
                                        <input onclick="checkadd();" type='button' value='+' name="add" />
                                    </div>
                                    <div class="quantity">
                                        <span><?php echo $quantity ?></span>
                                    </div>
                                </div>
                                <div class="btnsubmit">
                                    <input type="button" id="ipt1" value="Thêm vào giỏ hàng" name="addcart">
                                    
                                    <a href="./order.php?id=<?php echo $id?>?action=purchase"><input type="button" id="ipt2" value="Mua ngay" name="ordernow"></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function checksubtract(){
        var result = document.getElementById('quantity'); var qty = result.value; 
                                            if( !isNaN(qty)&&(qty > 1 )) result.value--;return false;
    }
    function checkadd(){
        var result = document.getElementById('quantity'); var qty = result.value;
                                        if(!isNaN(qty)&&(qty< <?php echo $quantity ?>)) result.value++;return false;
    }
</script>