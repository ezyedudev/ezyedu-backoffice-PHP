<?php include('header.php'); 
session_start();
if(isset($_POST["login"])){
		
	$pageURL 	= "https://$_SERVER[HTTP_HOST]/dashboard";
	
	$url 		= "https://dev-api.ezy-edu.com/api/auth/login";
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	$data 		= $email.':'.$password;
	$key 		= base64_encode($data);
	$user_agent	=	$_SERVER['HTTP_USER_AGENT'];
	$pageURL    = 
	$headers = array(
						'Content-Type: application/json',
						'Authorization: '. $key,
						'role:1'
					);
		
	$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($ch);
			curl_close($ch);
			
	$result = json_decode($response, true);
	if($result['session'] != ''){
		echo $pageURL; exit;
		$_SESSION["session_key"] 	= $result['session'];
		header('Location: '.$pageURL);
		die();
	}
	
}
?>
<body class="gray-bg  pace-done pace-done">
<div class="pace  pace-inactive pace-inactive">
<div class="pace-progress"  style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity">
</div></div>
<div id="wrapper">

  <div class="text-center">
    <div>
      <h1 class="logo-name m-t-lg">EzyEdu</h1>
    </div>
    <div class="middle-box loginscreen  animated fadeInDown">

        
       <form novalidate="" class="" method="post">
    <div class="form-group">
        <input class="form-control ng-untouched ng-pristine " name="email" placeholder="Email" type="email">
        <!---->
    </div>
    <div class="form-group">
        <input class="form-control ng-untouched ng-pristine" name="password" placeholder="Password" type="password">
        <!---->
    </div>
    <div class="form-group">
        <button class="btn btn-primary block full-width m-b" name="login" type="submit" >
            Login
        </button>
    </div>
</form>
<?php include('footer.php'); ?>