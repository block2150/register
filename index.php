<?php

session_start();

$status = "success";
$messageTitle = "";
$message = "";
$file_path = "./_registrations.json";
$template_path = "./template.html";

$AllFieldsRequired = 1; //1 = yes, 0 = no

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ( $_POST as $key => $value ) {
        if ($value == "") {
            $status = "error";
            $messageTitle = "Sorry, all fields are required";
            $message = "Please make sure you enter something for each field.";
        }
    }

    if ($status == "success") {
            $file = file_get_contents($file_path, true);
            $data = json_decode($file);
            $data[] = $_POST;
            file_put_contents($file_path, json_encode($data));

            $template = file_get_contents($template_path, true);

            foreach ( $_POST as $key => $value ) {
                $template = str_replace("%".$key."%", $value, $template);
            }

            $name = $_POST['first-name'] . " " . $_POST['last-name'];
            $email_address = $_POST['email'];

            // Create the email and send the message
            $to = 'block2150@gmail.com'; // Add your email address in between the '' replacing support@wpsolutiongroup.com - This is where the form will send a message to.

            $email_subject = "Laurel Legacy Regitration:  $name";
            $email_body = $template;

            $headers = "From: register@block2150.com\r\n";
            $headers .= "Reply-To: ". strip_tags($email_address) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to,$email_subject,$email_body,$headers);

            $status = "complete";
    }


}
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Welcome to Laurel Legacy!</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="assets/img/background.png" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Welcome to Laurel Legacy!</h4>
                    <p>
                        We are so excited to help you grow as you get closer to your Heavenly Father and your Savior. 
                    </p>
                </div>
            </div>
            <!-- end news-feed -->


            <!-- begin right-content -->
            <div class="right-content">
                <?php if ($status == "complete") { ?>

                    <!-- begin register-header -->
                    <h1 class="register-header">
                        Thank You!
                        <small>Thank you for registering for Laurel Legacy.  We are so excited to help you grow as you get closer to your Heavenly Father and your Savior.  If you have any questions, please contact your Young Women Leaders.</small>

                    </h1>

                <?php } else { ?>

                    <!-- begin register-header -->
                    <h1 class="register-header">
                        Register
                        <small>Please register below. You will also need to fill out a permission slip and a medical release. These may be obtained at church.</small>

                    </h1>

                    <!-- begin register-content -->
                    <div class="register-content">

                        <!-- end register-header -->
                        <?php if ($status == "error") { ?>
                            <div class="note note-warning">
                                <h4><?php echo $messageTitle; ?></h4>
                                <p><?php echo $message; ?></p>
                            </div>
                        <?php } ?>

                        <form action="index.php" method="POST" class="margin-bottom-0">
                            <label class="control-label">Name</label>
                            <div class="row row-space-10">
                                <div class="col-md-6 m-b-15">
                                    <input type="text" class="form-control" name="first-name" id="first-name" value="<?php echo $_POST['first-name']; ?>" placeholder="First name" />
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <input type="text" class="form-control" name="last-name" id="last-name" value="<?php echo $_POST['last-name']; ?>" placeholder="Last name" />
                                </div>
                            </div>
                            <label class="control-label">Email</label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $_POST['email']; ?>" placeholder="Email address" />
                                </div>
                            </div>
                            <label class="control-label">Address</label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $_POST['address']; ?>" placeholder="Address" />
                                </div>
                            </div>
                            <div class="row row-space-10">
                                <div class="col-md-8 m-b-15">
                                    <input type="text" class="form-control" name="city" id="city" value="<?php echo $_POST['city']; ?>" placeholder="City" />
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $_POST['state']; ?>" placeholder="State" />
                                </div>
                            </div>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $_POST['zip']; ?>" placeholder="Zip" />
                                </div>
                            </div>
                            <label class="control-label">Wad</label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="ward" id="ward" value="<?php echo $_POST['ward']; ?>" placeholder="Ward" />
                                </div>
                            </div>
                            <label class="control-label">School</label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="school" id="school" value="<?php echo $_POST['school']; ?>" placeholder="School" />
                                </div>
                            </div>
                            
                            
                            <div class="register-buttons">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                            </div>
                            <hr />

                            <div class="row m-t-30 p-t-30">
                                <p class="text-center text-inverse">
                                    For more information<br />please contact your Young Women Leaders.
                                </p>
                            </div>
                        </form>
                    </div>
                    <!-- end register-content -->

                <?php } ?>
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/js/apps.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
