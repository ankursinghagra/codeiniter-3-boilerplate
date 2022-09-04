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
    <link href="<?=site_url().'assets/login/'?>css/gaia.css" rel="stylesheet">
    <link href="<?=site_url().'assets/login/'?>css/fonts/pe-icon-7-stroke.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Cambo|Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">


  </head>
  <body>
		
        <div class="section section-signin">

            <div class="image-container hidden-sm hidden-xs ">
                <div class="filter filter-color-black"  style="background-image: url('<?=base_url()?>/assets/login/img/header-9.jpg')">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="content">
                            <div class="title-area">
                                <h1 class="title-modern">Guard Management System</h1>
                            </div>
                            <h5>An Employee management system for security providers. </h5>
                            <h5 class="subtitle">Secure</h5>
                            <p>
                            </p>
                            <h5 class="subtitle">Fast</h5>
                            <p>
                            </p>
                            <h5 class="subtitle">Responsive</h5>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-container">
                <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 text-center">
                  <form method="post">
                    <div class="title-area">
                        <h2>Welcome</h2>
                        <div class="separator separator-danger">✻</div>
                    </div>

                    <?php if(isset($message)){echo $message;} ?>

                    <label><h4 class="text-gray">Your email</h4></label>
                    <div class="form-group">
                        <input class="form-control form-control-plain" type="email" name="email" value="owner@domain.com">
                    </div>

                    <label><h4 class="text-gray">Your password</h4></label>
                    <div class="form-group">
                         <input type="password" name="password" class="form-control form-control-plain" value="password">
                    </div>
                    <div class="form-group">
                         <input type="checkbox" name="remember_me" >
                         <label><h5 class="text-gray">Remember Me</h5></label>
                    </div>

                    <div class="footer">
                        <input type="submit" class="btn btn-danger btn-round btn-fill btn-wd" value="Sign In" />
                        <p class="text-gray info"><a href="<?=base_url()?>login/forget_password">Forgot Password?</a></p>
                    </div>
                  </form>
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