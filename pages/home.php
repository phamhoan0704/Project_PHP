<?php
    include 'header.php';
    include "../database/connect.php";
    //Lấy sp theo Sách mới
    $sql = "
    SELECT tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    FROM tbl_product;
    ";

    $result = mysqli_query($conn, $sql);
    $data = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $data[] = $row;
        }


    //Lấy sp theo Sách bán chạy
    $sql1 = "
    SELECT tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    FROM tbl_product;
    ";

    $result1 = mysqli_query($conn, $sql1);
    $data1 = array();
    if(mysqli_num_rows($result1) > 0)
        while($row = mysqli_fetch_array($result1, 1))
        {
            $data1[] = $row;
        }
    
    //Lấy sp theo Sách hot deal
    

    $sql2 = "
    SELECT tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    FROM tbl_product
    Order by product_discount desc;
    ";

    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    if(mysqli_num_rows($result2) > 0)   
        while($row = mysqli_fetch_array($result2, 1))
        {
            $data2[] = $row;
        }


    mysqli_close($conn);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/product_list.css">
    <link rel="stylesheet" href="../css/home.css">
    
</head>

<body>
    
    <div id="main">
        <div class="home-hero-container">
            <div id="slideShow" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slideShow" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slideShow" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slideShow" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#slideShow" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="">
                            <img src="../img/Slide/slideshow_1.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="">
                            <img src="../img/Slide/slideshow_2.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="">
                            <img src="../img/Slide/slideshow_3.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="">
                            <img src="../img/Slide/slideshow_4.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
                <button class="carousel-control-prev carousel-control" type="button" data-bs-target="#slideShow" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
                <button class="carousel-control-next carousel-control" type="button" data-bs-target="#slideShow" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
            </div>
        </div>
        <div class="content">
            <div class="home-policy">
                <div class="home-policy-list">
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_1.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            ƯU ĐÃI<br>VẬN CHUYỂN
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_2.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            THỂ LOẠI SÁCH<br>PHONG PHÚ
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_3.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            KHUYẾN MẠI<br>HẤP DẪN
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_4.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            HOTLINE<br>03 2838 3979<br>03 3319 3979
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-tabs">
                <div class="home-tab-title">
                    <div class="home-tab-item active">
                        <span>SÁCH MỚI</span>
                    </div>
                    <div class="home-tab-item">
                        <span>SÁCH BÁN CHẠY</span>
                    </div>
                    <div class="home-tab-item">
                        <span>HOT DEAL</span>
                    </div>
                    <div class="line"></div>
                </div>


                <!-- Tab content -->
                <div class="home-tab-content">
                    <!-- Sách mới -->
                    <div class="home-tab-pane active">
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
                            <!-- <div class="product-block">
                                <div class="product__sale">
                                    <span class="sale-lable">15%</span>
                                </div>
                                <a href="" class="product__img" style="background-image: url(./assets/img/product/product01.jpg);">
                                </a>
                                <div class="product__detail">
                                    <a class="product__name">Xưởng phép thuật - Tập 1</a>
                                    <div class="product__price">
                                        <p class="pro-price__new">42,000đ</p>
                                        <p class="pro-price__old">50,000đ</p>
                                    </div>
                                </div>
                            </div>

                            <div class="product-block">
                                <div class="product__sale">
                                    <span class="sale-lable">15%</span>
                                </div>
                                <a href="" class="product__img" style="background-image: url(./assets/img/product/product04.jpg);">
                                </a>
                                <div class="product__detail">
                                    <a class="product__name">Vị thần lang thang - Tập 21</a>
                                    <div class="product__price">
                                        <p class="pro-price__new">42,000đ</p>
                                        <p class="pro-price__old">50,000đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-block">
                                <div class="product__sale">
                                    <span class="sale-lable">15%</span>
                                </div>
                                <a href="" class="product__img" style="background-image: url(../img/product/product07.jpg);">
                                </a>
                                <div class="product__detail">
                                    <a class="product__name">Horimiya 1</a>
                                    <div class="product__price">
                                        <p class="pro-price__new">42,000đ</p>
                                        <p class="pro-price__old">50,000đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-block">
                                <div class="product__sale">
                                    <span class="sale-lable">15%</span>
                                </div>
                                <a href="" class="product__img" style="background-image: url(../img/product/product01.jpg);">
                                </a>
                                <div class="product__detail">
                                    <a class="product__name">Horimiya 1</a>
                                    <div class="product__price">
                                        <p class="pro-price__new">42,000đ</p>
                                        <p class="pro-price__old">50,000đ</p>
                                    </div>
                                </div>
                            </div>-->

                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách bán chạy -->
                        <div class="product-list">
                            <?php    
                                for($i=0;$i<count($data1);$i++) {
                                    echo '
                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- '.$data1[$i]['product_discount'].'%</span>
                                        </div>
                                        <a href="" class="product__img" style="background-image: url(../img/product/'.$data2[$i]['product_image'].');">
                                        </a>
                                        <div class="product__detail">
                                            <a class="product__name">'.$data1[$i]['product_name'].'</a>
                                            <div class="product__price">
                                                <p class="pro-price__new">'.$data1[$i]['product_price'].'</p>
                                                <p class="pro-price__old">'.$data1[$i]['product_price_pre'].'</p>
                                            </div>
                                        </div>
                                    </div>';
                                    
                                }

                               
                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="" class="btn-more">Xem thêm</a>
                        </div>   
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách hot deal -->
                        <div class="product-list">
                            <?php    
                                for($i=0;$i<count($data2);$i++) {
                                    echo '
                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- '.$data2[$i]['product_discount'].'%</span>
                                        </div>
                                        <a href="" class="product__img" style="background-image: url(../img/product/'.$data2[$i]['product_image'].');">
                                        </a>
                                        <div class="product__detail">
                                            <a class="product__name">'.$data2[$i]['product_name'].'</a>
                                            <div class="product__price">
                                                <p class="pro-price__new">'.$data2[$i]['product_price'].'</p>
                                                <p class="pro-price__old">'.$data2[$i]['product_price_pre'].'</p>
                                            </div>
                                        </div>
                                    </div>';
                                    
                                }

                               
                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="" class="btn-more">Xem thêm</a>
                        </div> 
                    </div>
                </div>
            </div>

        </div>

        <div class="home-new-banner">
            <div class="hnb-list">
                <div class="hnb-item">
                    <a href="" class="hnb-item-link">
                        <img class="hnb-item-img " src="../img/new-banner/hnb_img_2.jpg " alt=" ">
                    </a>
                </div>
                <div class="hnb-item ">
                    <a href=" " class="hnb-item-link ">
                        <img class="hnb-item-img " src="../img/new-banner/hnb_img_1.jpg " alt=" ">
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="../js/home_tab.js "></script>
</body>
</html>