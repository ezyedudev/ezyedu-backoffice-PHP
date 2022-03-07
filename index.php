<?php include "assets/inc/meta.php"; 
session_start();
if(isset($_POST["login"])){
				
	$pageURL 	= $_SERVER['HTTP_REFERER']."dashboard.php";

	$url 		= "https://dev-api.ezy-edu.com/api/auth/login";
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	$data 		= $email.':'.$password;
	$key 		= base64_encode($data);
	$user_agent	=	$_SERVER['HTTP_USER_AGENT'];
	$headers = array(
						'Content-Type: application/json',
						'Authorization: '. $key,
						'role:1'
					);
	
	$ch = curl_init($url);
	
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
       
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			
			$response = curl_exec($ch);
			
			curl_close($ch);
			
	$result = json_decode($response, true);
	//var_dump($response); exit;
	//echo '<pre>'; print_r($result); exit;
	if($result['session'] != ''){
		
		$_SESSION["session_key"] 	= $result['session'];
		header('Location: '.$pageURL);
		die();
	}
	
}

?>

<body class="login-page" style="min-height: 466px;">
<div class="login-box">

<div class="card card-outline card-primary">
<div class="card-header text-center">
<a href="" class="h1"><b>EzyEdu</b>Admin</a>
</div>
<div class="card-body">
<p class="login-box-msg">Sign in to start your session</p>
<form action="" method="post">
<div class="input-group mb-3">
<input type="email" class="form-control" placeholder="Email" name="email">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" placeholder="Password" name="password">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
</div>

</div>
</form>

</div>

</div>

</div>

</body>
</html>