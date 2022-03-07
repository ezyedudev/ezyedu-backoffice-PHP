<?php include "assets/inc/meta.php"; 
session_start();

$key = $_SESSION["session_key"];
$url 		= "https://dev-api.ezy-edu.com/api/user";

	$user_agent	=	$_SERVER['HTTP_USER_AGENT'];
	$headers = array(
						'Content-Type: application/json',
						'Authorization: '. $key						
					);
	
	$ch = curl_init($url);
	
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
       
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			
			$response = curl_exec($ch);
			curl_close($ch);
			
	$result = json_decode($response, true);
	$users = $result['data'];
	//var_dump($response); exit;
	//echo '<pre>'; print_r($result['data']); exit;
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/img/logo.png" alt="EzyEduLogo" height="60" width="60">
  </div>

 
<?php include "assets/inc/sidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Register Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th>Register Date</th>
                    <th>Activated</th>
					
                  </tr>
                  </thead>
                  <tbody>
				  <?php foreach ($users as $row){ $imgbaseurl = "https://dpzt0fozg75zu.cloudfront.net/";//echo '<pre>'; print_r($row);?>
                  <tr>
                    <td><img src="<?php echo $imgbaseurl.$row['image']?>" class="img-circle elevation-2" width="60px" height="60px" alt="User Image"></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['student_points'];?></td>
                    <td> <?php echo $row['student_points'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                  </tr>
				  <?php } ?>
				   </tbody>
                  <tfoot>
                  <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th>Register Date</th>
                    <th>Activated</th>
					
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>      
         
        </div>
      </div>
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include "assets/inc/footer.php"; ?>
 
 <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
</body>
</html>
