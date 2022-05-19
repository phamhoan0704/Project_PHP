<?php

$iName = $iPass = $loginErr = "";
    $nameErr = $passErr = "";
//Lưu ý: empty và isset sẽ trả về TRUE nếu biến không tồn tại 
if (isset($_POST['submit_btn'])) {
    
    $iName = $_POST['ipnName'];
    $iPass = $_POST['ipnPass'];
    $patternName = '/^\\w*$/';
    //$patternName = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
    // mật khẩu yêu cầu có ít nhất 1  chữ thường, 1 chữ hoa, 1 số, có tối đa 20 kí tự

    $patternPass = '/((?=.*\\d)(?=.*[a-z])(?=.*[@#$%!]).{4,20})/';

    //Loại bỏ tất cả các thẻ html và php ra khỏi chuỗi. Nếu thẻ nào muốn giữ lại thì strip_tag(chuỗi,"tên thẻ")
    //$iName = strip_tags($iName);
    //thêm các \ trước các kí tự đặc biệt {',",\,...}
    // $iName = addslashes($iName);
    $iPass = strip_tags($iPass);
    $iPass = addslashes($iPass);

    if (empty($iName)) {
        $nameErr = "Họ tên không được bỏ trống!";
    }

    //kiểm tra tên chỉ nhập bằng chữ
    else if (!preg_match($patternName, $iName)) {
        $nameErr = "Không tồn tại tên đăng nhập này";
    }
    if (empty($iPass)) {
        $passErr = "Password không được bỏ trống!";
    } else {
        if (!preg_match($patternPass, $iPass))
            $passErr = "Mật khẩu không đúng";
    }
    //Kết nối đến csdl
    include '../database/connect.php';
    //câu lệnh sql
    
    $sql = "select *from tbl_user where user_name='$iName' and user_password='$iPass' ";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0) {
        $loginErr = "Tên đăng nhập hoặc mật khẩu không đúng";
    } else {
        //Lưu tên đăng nhập và mật khẩu vào session để tiện xử lý sau này
       $_SESSION['user']=$iName;
       if($_GET['action']=='cart'){
        header('location: cart_view.php');

       }
        //thực thi hành động sua khi lưu thông tin
        //=> chuyển hướng trang web tới một tragn index.php
        // header('Location:changepassword.php');
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link rel="stylesheet" href="../css/log_in.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="wapper">
            <div class="tittle">
                <h2>Đăng nhập<h2>
            </div>
            <form method="post" action="">
                <div class="group userip">
                    <div class="loginf">
                        <div class="icon">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="" name="ipnName" placeholder="Tên đăng nhập" autofocus>
                        </div>
                    </div>

                    <div class="messerror"> <span><?php echo $nameErr; ?></span></div>
                </div>
                <div class="group passwordip">
                    <div class="loginf">
                        <div class="icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPassword" placeholder="Mật khẩu" name="ipnPass">
                        </div>
                        <div id="showpass">
                            <button id="btnPassword" type="button">
                                <i class="fa-regular fa-eye" id="btnEye"></i>

                            </button>

                        </div>
                    </div>
                    <div class="messerror">
                        <span>
                            <?php if($passErr=="")
                            echo ("$loginErr");
                            else
                            echo("$passErr");

                         ?></span>
                    </div>
                </div>
                <div class="submit_btn">
                    <button name="submit_btn">Đăng nhập</button>
                </div>
                <span><a>Quên mật khẩu</a></span>
                <span>Bạn đã có tài khoản chưa? Đăng ký <a href="../includes/register.html">Tại đây</a></span>


                </from>
        </div>
    </div>

    <script src="../js/log_in.js"></script>
</body>

</html>