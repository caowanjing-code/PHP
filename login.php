 
<?php
	header("Content-Type: text/html;charset=utf-8");
	//建立连接
	$conn = mysqli_connect('localhost','cao','19990811cao');
	if($conn){
		//数据库连接成功
		$select = mysqli_select_db($conn,"db");		//选择数据库
		if($select){
			if(isset($_POST["subl"])){
				$username = $_POST["username"];
				$password = $_POST["password"];
				if($username == ""||$password == ""){
					//用户名or密码为空
					//弹窗提示信息并返回登陆页面
					echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名或密码不能为空！"."\"".")".";"."</script>";
					echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."login.html"."\""."</script>";
					exit;
				}
				//sql语句
				$sql_select = "select username,password from userinfo where username = '$username' and password = '$password'";
				// echo '$sql_select';
				//设置编码
				mysqli_query($conn,'SET NAMES UTF8');
				//执行sql语句
				$return = mysqli_query($conn,$sql_select);
				$row = mysqli_fetch_array($return); 
				//查询用户是否在数据库里面
				if($username !== $row['username']){
					echo  '<script>alert("用户名不存在");history.go(-1);</script>';
				}

				//用户密码正确
				else if($username == $row['username']&&  $password == $row['password']){
					//跳转登陆成功页面
					echo "登录成功!";
					echo '<script>window.location="./weibo/pinglun.html";</script>';
					setcookie("username",$username,time()+24*3600*2);
					setcookie("password",$password,time()+24*3600*2);
					
				}//密码错误情况
				else {
					if($username == $row['username']&&  $password !== $row['password']){
						setcookie("username",'',time()-1);
						setcookie("password",'',time()-1);
						echo '<script>alert("用户名与密码不匹配");history.go(-1);</script>';
					}
				}  
			}
		}
		//关闭数据库
		mysqli_close($conn);
	}else{		
		//连接错误处理
		die('Could not connect: .mysql_error()');
	}	
	if(!isset($_COOKIE['username'])){
		if(isset($_POST['submit'])){
			//判断用户是否提交表单
		$select = mysqli_select_db($conn,"db");		//选择数据库
		}

	}


 
?>