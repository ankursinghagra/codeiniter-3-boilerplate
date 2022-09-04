<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin</title>

    <!-- Bootstrap -->
    <link href="<?=site_url().'assets/login/'?>css/bootstrap.min.css" rel="stylesheet">
   <!--  <link href="<?=site_url().'assets/login/'?>css/gaia.css" rel="stylesheet"> -->
    <!-- <link href="<?=site_url().'assets/login/'?>css/fonts/pe-icon-7-stroke.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--     Fonts and icons     -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Cambo|Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->


  </head>
  <body>
    <div style="margin-top:30px;"></div>
    <div class="container">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Forget Password</div>
          <div class="panel-body">
            <p>
              Enter your email to get password reset link
            </p>
            <p><?php echo validation_errors(); ?><?php if(isset($message)){echo $message;} ?></p>
            <form method="post">              
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email Address">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Request">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--   core js files    -->
    <script src="<?=site_url().'assets/login/'?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=site_url().'assets/login/'?>js/bootstrap.min.js" type="text/javascript"></script>

    <!--  js library for devices recognition -->
    <script type="text/javascript" src="<?=site_url().'assets/login/'?>js/modernizr.js"></script>
    <!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
    <script type="text/javascript" src="<?=site_url().'assets/login/'?>js/gaia.js"></script>

  </body>
</html>