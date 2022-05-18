<?php
    include "../database/connect.php";
    $category_id = $_GET['id'];
    //Lấy bảng sp
    $sql = "SELECT tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product
            where category_id = $category_id
        ";
    
    $result = mysqli_query($conn, $sql);
    $data = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $data[] = $row;
        }

        //Lấy dữ liệu category
    $sql1 = "SELECT * From tbl_category";
                    
    $result1 = mysqli_query($conn, $sql1);
    $data1 = array();
    if(mysqli_num_rows($result1) > 0)
        while($row = mysqli_fetch_array($result1, 1))
        {
            $data1[] = $row;
        }
    
    //Lấy dữ liệu số sp
    // $sql1 = "SELECT count(*) as 'number' from tbl_product";
    // $result1 = mysqli_query($conn, $sql);
    // $data1 = array();
    // if(mysqli_num_rows($result1) > 0)
    //     while($row = mysqli_fetch_array($result1, 1))
    //     {
    //         $data1[] = $row;
    //     }
    // $number = $data1[0]['number'];
    // $page = ceil($number / 12);
    mysqli_close($conn);        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product_category.css">
    <link rel="stylesheet" href="../css/product_list.css">

</head>

<body>
    
    <div class="container">
        <div class="breadcrumb">
            <ol class="breadcrumb-arrow">
                <li><a href="home.php" target="_self">Trang chủ</a></li>
                <li><a href="" target="_self">Danh mục</a></li>
                <li>
                    <span>Manga - Comic</span>
                </li>
            </ol>
        </div>
        <div class="content">
            <div class="nav-menu">
                <h4>Danh mục</h4>
                <ul class="nav-menu-list">
                     <?php
                        for($i=0;$i<count($data1);$i++) {
                            echo '<li class="nav-item"><a href="product_category.php?id='.$data1[$i]['category_id'].'">'.$data1[$i]['category_name'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="main-content">
                <div class="main-content-heading">
                    <h1>Tất cả sản phẩm</h1>
                    <div class="browse-tags">
                        <span>Sắp xếp theo:</span>
                        <span class="custom-dropdown">
                            <select class="custom-dropdown__select">
                                <option value="manual">Sản phẩm nổi bật</option>
                                <option value="price-ascending">Giá: Tăng dần</option>
                                <option value="price-descending">Giá: Giảm dần</option>
                                <option value="title-ascending">Tên: A-Z</option>
                                <option value="title-descending">Tên: Z-A</option>
                                <option value="best-selling">Bán chạy nhất</option>
                            </select>
                        </span>
                    </div>
                </div>
                <div class="product-list">
                <?php
                                
                                for($i=0;$i<count($data);$i++) {
                                    echo '
                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- '.$data[$i]['product_discount'].'%</span>
                                        </div>
                                        <a href="" class="product__img" style="background-image: url(../img/product/'.$data[$i]['product_image'].');">
                                        </a>
                                        <div class="product__detail">
                                            <a class="product__name">'.$data[$i]['product_name'].'</a>
                                            <div class="product__price">
                                                <p class="pro-price__new">'.$data[$i]['product_price'].'</p>
                                                <p class="pro-price__old">'.$data[$i]['product_price_pre'].'</p>
                                            </div>
                                        </div>
                                    </div>';
                                    
                                }

                               
                            ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "../Footer/index.php" ?>

</body>

</html>