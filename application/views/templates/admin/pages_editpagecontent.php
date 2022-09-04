	
<!DOCTYPE html>
<html>
<head>
	<title>Admin | Edit Page Content</title>
	<link rel="stylesheet" href="<?=site_url()?>assets/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?=site_url()?>assets/css/lib/font-awesome/font-awesome.min.css">

	<!-- Sirtrevor -->
    <link href="<?=site_url()?>assets/library/trevor/sir-trevor.css" rel="stylesheet">
	<link href="<?=site_url()?>assets/library/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
	<link href="<?=site_url()?>assets/library/trevor/sir-trevor-icons.css" rel="stylesheet">
    <!-- /Sirtrevor -->

</head>
<body>

<div class="container">

<div class="col-md-12">
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<h3></h3>
				<ul class="breadcrumb">
					<li><a href="<?=base_url(env('ADMIN_FOLDER'))?>/dashboard"><i class="fa fa-home"></i> Dashboard</a>  >  <a href="<?=base_url(env('ADMIN_FOLDER'))?>/pages"><i class="fa fa-list-ul"></i> Pages</a>  >  <i class="fa fa-list-ul"></i> Edit Page Content</li>
				</ul>
			</header>

			<div class="box-typical box-typical-padding">
				<h5 class="m-t-lg with-border">	</h5>

			<div class="row">
				<?php if(isset($message)){echo '<div class="col-md-12">'.$message.'</div>';}?>
				<div class="col-md-12 edit_pane">
					<div class="well"><h3>Page Title: <?=$page['page_title']?></h3></div>
					<form action="" method="post" id="contentForm">
						<textarea class="form-control" id="page_content_json" name="page_content_json" rows="25"><?=$page['page_content_json']?></textarea>
						<br>
						<br>	
						<br>
						<input type="submit" id="save_button" class="btn btn-primary" value="Save">
					</form>
					<br><br>
				</div>
			</div>

			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
</div>
</div>


    <script src="<?=site_url()?>assets/js/lib/jquery/jquery.min.js"></script>
    <script src="<?=site_url()?>assets/library/jQueryvalidate/jquery.validate.min.js"></script>
    <script src="<?=site_url()?>assets/js/lib/bootstrap/bootstrap.min.js"></script>
    <!-- Sirtrevor -->
    <script src="<?=site_url()?>assets/library/trevor/underscore.js"></script>
    <script src="<?=site_url()?>assets/library/trevor/eventable.js"></script>
    <script src="<?=site_url()?>assets/library/trevor/sortable.min.js"></script>
    <script src="<?=site_url()?>assets/library/trevor/sir-trevor.js"></script>
    <script src="<?=site_url()?>assets/library/trevor/sir-trevor-bootstrap.js"></script>
    <script type="text/javascript">
        new SirTrevor.Editor({ el: $('#page_content_json'),
        	//blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "List", "Iframe"]
        	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Button", "List", "Iframe"]
        });
        SirTrevor.setDefaults({
		  	uploadUrl: '<?=base_url(env('ADMIN_FOLDER'))?>/pages/api_sir_trevor_image_upload'
		});
        SirTrevor.onBeforeSubmit();
    </script>
    <script type="text/javascript">
    function formSubmit(){
        SirTrevor.onBeforeSubmit();
        document.getElementById("contentForm").submit();
    }
    </script>
    <!-- /Sirtrevor -->

</body>
</html>