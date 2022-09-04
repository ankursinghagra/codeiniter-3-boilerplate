<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>Change Password</title>

	   	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
  	</head>
  	<body>

  		<div class="container">
  			<div class="row">
  				<br><br>
    			<div class="col-md-6 col-md-offset-3">
    				<?php if (isset($success)&&($success==true)): ?>
    				<div>
    					<div class="alert alert-success">
    						<h3>Password Changed</h3>
    					</div>
    				</div>
    				<?php else: ?>
    				<form method="post">
    					<?php echo validation_errors(); ?>
    					<div class="form-group">
    						<label>New Password</label>
    						<input type="password" name="password_one" class="form-control">
    					</div>
    					<div class="form-group">
    						<label>Repeat New Password</label>
    						<input type="password" name="password_two" class="form-control">
    					</div>
    					<div class="form-group">
    						<button class="btn btn-primary">Set Password</button>
    					</div>
    				</form>
    				<?php endif ?>
    			</div>
  			</div>
  		</div>

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	</body>
</html>