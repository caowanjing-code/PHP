<?php
  header("Content-type: text/html; charset=utf-8");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $telphone = $_POST['telphone'];
    if ($telphone == ''){
      echo '<script>alert("电话号码不能为空！");history.go(-1);</script>';
      exit(0);
    }
    if ($username == ''){
      echo '<script>alert("请输入用户名！");history.go(-1);</script>';
      exit(0);
    }
    if ($password == ''){
      echo '<script>alert("请输入密码");history.go(-1);</script>';
      exit(0);
    }
    if ($password != $re_password){
      echo '<script>alert("密码与确认密码应该一致");history.go(-1);</script>';
      exit(0);
    }else if($password == $re_password){
      $conn = new mysqli('localhost','cao','19990811cao','db');
      if ($conn->connect_error){
        echo '数据库连接失败！';
        exit(0);
      }
      else {
        $sql = "select username from userinfo where username = '$_POST[username]'";
        $result = $conn->query($sql);
        $number = mysqli_num_rows($result);
        if ($number) {
          // 微博用户名不能重复
          echo '<script>alert("该用户名已经存在，请重新输入");history.go(-1);</script>';
        } 

        // 手机号码不能重复
        else {
          $sql_tel = "select username from userinfo where telphone = '$_POST[telphone]'";
          $res_tel = $conn->query($sql_tel);
          $tel_number=mysqli_num_rows($res_tel);
          if ($tel_number) {
            echo '<script>alert("该电话号码已经存在,请重新填一个");history.go(-1);</script>';
          }else{
            $sql_insert = "insert into userinfo (username,password,telphone) values('$username','$password','$telphone')";
					//插入数据
					$ret = mysqli_query($conn,$sql_insert);
					$row = mysqli_fetch_array($ret); 
					//跳转注册成功页面
          echo "注册成功!";
          // 跳转登录页面
					header("Location:login.html");
          }
          
        }
      }
    }else{
      echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
?>