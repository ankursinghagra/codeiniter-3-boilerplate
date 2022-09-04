<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $header; ?>
    

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/lobipanel/lobipanel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/separate/vendor/lobipanel.min.css"> -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/separate/pages/widgets.min.css">
    <!-- Include Font Awesome. -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/font-awesome/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <style type="text/css">
        .section-header {
            padding: 0 0 0px;
        }
        label.col-sm-2.form-control-label {
            padding: 15px;
        }
    </style>


    <?php if (isset($datepicker) && ($datepicker)) { ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style type="text/css">
        .ui-draggable, .ui-droppable { background-position: top;  }
        #ui-datepicker-div{z-index: 10;}
    </style>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/separate/vendor/tags_editor.min.css">
    <?php } ?>

    <?php if (isset($editor) && ($editor)) { ?>
    <!-- Sirtrevor -->
    <link href="<?=site_url().'assets/library/'?>trevor/sir-trevor.css" rel="stylesheet">
    <link href="<?=site_url().'assets/library/'?>trevor/sir-trevor-bootstrap.css" rel="stylesheet">
    <link href="<?=site_url().'assets/library/'?>trevor/sir-trevor-icons.css" rel="stylesheet">
    <!-- /Sirtrevor -->
    <?php } ?>

    <?php if (isset($summernote_editor) && ($summernote_editor)) { ?>
    <link href="<?=site_url().'assets/library/'?>summernote/summernote.css" rel="stylesheet">
    <link href="<?=site_url().'assets/library/'?>summernote/summernote-bs3.css" rel="stylesheet">
    <?php } ?>
    <?php if (isset($froala_editor) && ($froala_editor)) { ?>
    <!-- Include Editor style. -->
    <link href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/froala_style.min.css" rel="stylesheet" type="text/css" />

    <!-- Include Code Mirror style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

    <!-- Include Editor Plugins style. -->
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/char_counter.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/code_view.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/colors.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/emoticons.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/file.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/image.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/image_manager.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/quick_insert.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/table.css">
    <link rel="stylesheet" href="<?=site_url().'assets/library/'?>froala_editor_2.3.5/css/plugins/video.css">
    <?php } ?>

    <?php if(isset($cropping_ratio)){ ?>
    <link href="<?=site_url().'assets/library/'?>cropper/cropper.min.css" rel="stylesheet">
    <?php } ?>

    <?php if(isset($jqv_slug) && ($jqv_slug=='add_blog')){ ?>
    <link href="<?=site_url().'assets/library/'?>summernote/summernote.css" rel="stylesheet">
    <link href="<?=site_url().'assets/library/'?>summernote/summernote-bs3.css" rel="stylesheet">
    <?php } ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=base_url()?>assets/library/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=site_url().'assets/library/'?>jQueryvalidate/jquery.validate.min.js"></script>

    <!-- jQuery Bootstrap Notify -->
    <script src="<?=site_url().'assets'?>/js/lib/bootstrap-notify/bootstrap-notify.min.js"></script>
    
    <!-- sweet alert -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/separate/vendor/sweet-alert-animations.min.css">
    <script src="<?=base_url()?>assets/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
    
  </head>
  <body class="with-side-menu dark-theme">
  <!-- <body class="with-side-menu dark-theme theme-picton-blue"> -->
  <!-- <body class="with-side-menu theme-rebecca-purple"> -->

    <header class="site-header">
        <div class="container-fluid">
            <a href="#" class="site-logo-text">Security</a>
            <!-- <a href="#" class="site-logo"><b>Sapricami CMS</b></a> -->
            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-content">
                <div class="site-header-content-in">
                    <div class="site-header-shown">
                        <?php /* ?>
                        <div class="dropdown dropdown-notification notif">
                            <a href="#"
                               class="header-alarm dropdown-toggle active"
                               id="dd-notification"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <i class="font-icon-alarm"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
                                <div class="dropdown-menu-notif-header">
                                    Notifications
                                    <span class="label label-pill label-danger">4</span>
                                </div>
                                <div class="dropdown-menu-notif-list">
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-1.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Morgan</a> was bothering about something
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-2.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Lioneli</a> had commented on this <a href="#">Super Important Thing</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-3.jpg" alt="">
                                        </div>
                                        <div class="dot"></div>
                                        <a href="#">Xavier</a> had commented on the <a href="#">Movie title</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                    <div class="dropdown-menu-notif-item">
                                        <div class="photo">
                                            <img src="img/photo-64-4.jpg" alt="">
                                        </div>
                                        <a href="#">Lionely</a> wants to go to <a href="#">Cinema</a> with you to see <a href="#">This Movie</a>
                                        <div class="color-blue-grey-lighter">7 hours ago</div>
                                    </div>
                                </div>
                                <div class="dropdown-menu-notif-more">
                                    <a href="#">See more</a>
                                </div>
                            </div>
                        </div>
                        <?php */ ?>
    
                        <div class="dropdown user-menu">
                            <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?=base_url()?>uploads/admins/<?=$user_data['admin_photo']?>" alt="">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                                <a class="dropdown-item" href="<?=base_url(env('ADMIN_FOLDER').'/profile')?>"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?=base_url(env('ADMIN_FOLDER').'/login/logout')?>"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
                            </div>
                        </div>
                        
                        <?php /* ?>
                        <button type="button" class="burger-right">
                            <i class="font-icon-menu-addl"></i>
                        </button>
                        <?php */ ?>

                    </div><!--.site-header-shown-->
    
                    <div class="mobile-menu-right-overlay"></div>
                    <div class="site-header-collapsed">
                        <div class="site-header-collapsed-in">
                            <div class="dropdown dropdown-typical">
                                <a class="external-link" href="<?=base_url()?>" target="_blank">Site Preview <i class="fa fa-external-link"></i></a>
                            </div>
                            <?php /* ?>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-sales" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-wallet"></span>
                                    <span class="lbl">Sales</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-sales">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-marketing" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-cogwheel"></span>
                                    <span class="lbl">Marketing automation</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-marketing">
                                    <a class="dropdown-item" href="#">Current Search</a>
                                    <a class="dropdown-item" href="#">Search for Issues</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Recent issues</div>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                    <div class="dropdown-more">
                                        <div class="dropdown-more-caption padding">more...</div>
                                        <div class="dropdown-more-sub">
                                            <div class="dropdown-more-sub-in">
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Import Issues from CSV</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Filters</div>
                                    <a class="dropdown-item" href="#">My Open Issues</a>
                                    <a class="dropdown-item" href="#">Reported by Me</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Manage filters</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">Timesheet</div>
                                    <a class="dropdown-item" href="#">Subscribtions</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-social" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-share"></span>
                                    <span class="lbl">Social media</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-social">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a href="#" class="dropdown-toggle no-arr">
                                    <span class="font-icon font-icon-page"></span>
                                    <span class="lbl">Projects</span>
                                </a>
                            </div>
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-form-builder" data-target="#" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-pencil"></span>
                                    <span class="lbl">Form builder</span>
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="dd-header-form-builder">
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
                                    <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dd-header-add">
                                    <a class="dropdown-item" href="#">Quant and Verbal</a>
                                    <a class="dropdown-item" href="#">Real Gmat Test</a>
                                    <a class="dropdown-item" href="#">Prep Official App</a>
                                    <a class="dropdown-item" href="#">CATprer Test</a>
                                    <a class="dropdown-item" href="#">Third Party Test</a>
                                </div>
                            </div>
                            <div class="site-header-search-container">
                                <form class="site-header-search closed">
                                    <input type="text" placeholder="Search"/>
                                    <button type="submit">
                                        <span class="font-icon-search"></span>
                                    </button>
                                    <div class="overlay"></div>
                                </form>
                            </div>
                            <?php */ ?>
                        </div><!--.site-header-collapsed-in-->
                    </div><!--.site-header-collapsed-->
                </div><!--site-header-content-in-->
            </div><!--.site-header-content-->
        </div><!--.container-fluid-->
    </header><!--.site-header-->

    <div class="mobile-menu-left-overlay"></div>




<!-- navbar -->
<?php echo $navbar; ?>
<!-- /navbar -->

<!-- content -->
<div class="page-content">
    <div class="container">
        <header class="section-header">
            <div class="box-typical box-typical-padding">
                <h3><?php if(isset($page_data['page_title'])){echo $page_data['page_title'];} ?></h3>
                <?php if(isset($page_data['breadcrumb'])): ?>
                <ol class="breadcrumb breadcrumb-simple">
                    <?php foreach ($page_data['breadcrumb'] as $breadcrumb) : ?>
                        <?php if ($breadcrumb['active']):?>
                        <li class="active"><?=$breadcrumb['title']?></li>
                        <?php else: ?>
                        <li><a href="<?=base_url()?><?=$breadcrumb['link']?>"><?=$breadcrumb['title']?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
                <?php endif; ?>
            </div>
        </header>
    </div>
    <div class="container">
    <?php echo $content; ?>
    <!-- footer -->
    <?php echo $footer; ?>
    <!-- /footer -->
    </div>
</div>
<!-- /content -->

    <?php if(isset($cropping_ratio)): ?>
        <div class="modal fade bd-example-modal-lg"
             tabindex="-1"
             role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                            <i class="font-icon-close-2"></i>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Image Crop And Upload</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="<?=base_url()?>dashboard/ajax_img_save">
                                    <div class="form-group">
                                        <p>Please Choose Image: </p>
                                        <input class='file' type="file" class="form-control" name="images" id="images" placeholder="Please choose your image">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <div id="loader" style="display: none;">
                                            Please wait image uploading to server....
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div id="uploaded_images" class="uploaded-images">
                                    <div id="error_div">
                                    </div>
                                    <div id="success_div" class="col-lg-12">
                                        <img id="cropbox" class="img-responsive" src="">
                                        <br><br>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><!--.modal-->

                
    <?php endif; ?>

    
    <script src="<?=base_url()?>assets/js/lib/tether/tether.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/bootstrap/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/js/lib/jqueryui/jquery-ui.min.js"></script>

    <?php if(isset($cropping_ratio)){ ?>
    <script src="<?=site_url().'assets/'?>library/jQueryForm/jquery.form.min.js"></script>
    <script src="<?=site_url().'assets/'?>library/cropper/cropper.min.js"></script>
    <script type="text/javascript">
        function updateCoords(c){jQuery('#x').val(c.x);jQuery('#y').val(c.y);jQuery('#w').val(c.width);jQuery('#h').val(c.height);$('#upload_end_status').html('<div class="label label-success">Image Selected</div>')};

        function checkCoords(){if(parseInt(jQuery('#w').val())>0) return true;alert('Please select a crop region then press submit.');return false;};

        (function() {
        $('#imageform').ajaxForm({
          beforeSubmit: function() {count = 0;val = $.trim( $('#images').val() );if( val == '' ){count= 1;$( "#images" ).next('span').html( "Please select your images" );} if(count == 0){for (var i = 0; i < $('#images').get(0).files.length; ++i) { img = $('#images').get(0).files[i].name; var extension = img.split('.').pop().toUpperCase(); if(extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){count= count+ 1} } if( count> 0) $( "#images" ).next('span').html( "Please select valid images" );}if( count> 0){ return false; } else {$( "#images" ).next('span').html( "" );}},
          
          beforeSend:function(){ $('#loader').show();$('#image_upload').hide();},
          success: function(msg) {},
          complete: function(xhr) {$('#loader').hide();$('#images').val('');$('#images').hide();$('#error_div').html('');result = xhr.responseText; result = $.parseJSON(result);
              base_path = '<?=main_url()?>';
            if( result.success ){ name = base_path+'uploads/cache/'+result.success;
                  /*html = '';
                  html+= '<image id="cropbox" class="img-responsive" src="'+name+'">';
                  $('#uploaded_images #success_div').append( html );*/
                  $('#cropbox').attr('src',name);$('#orignal_path').val(name);$('#file_name').val(result.success);
                  //jcrop
                  jQuery('#cropbox').cropper({
                      aspectRatio: <?=$cropping_ratio?>,
                      move: updateCoords,
                      crop: updateCoords,
                      preview: '#preview1'
                  });

              } else if( result.error ){
                  error = result.error
                  html = '';
                  html+='<p>'+error+'</p>';
                  $('#uploaded_images #error_div').append( html );
              }
              $('#error_div').delay(5000).fadeOut('slow'); }});  })();  
    </script>
    <?php }?>


    <?php if (isset($datepicker) && ($datepicker)) { ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $( function() {
            $( ".datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
        } );
        </script>
    <?php } ?>
    <?php if (isset($tag_editor) && ($tag_editor)) { ?>
        <script src="<?=site_url().'assets/'?>js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
        <script>
        $( function() {
            $( ".tag_editor" ).tagEditor();
        } );
        </script>
    <?php } ?>

    <script src="<?=site_url().'assets/'?>js/app.js"></script>

    <?php if (isset($summernote_editor) && ($summernote_editor)) { ?>
        <script src="<?=site_url().'assets/third_party/'?>summernote/summernote.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $('.editor').summernote({height: 300});
            });
        </script>
    <?php } ?>
    <?php if (isset($tinymce_editor) && ($tinymce_editor)) { ?>
        <script src="<?=site_url().'assets/'?>third_party/tinymce/tinymce.min.js"></script>
        <script src="<?=site_url().'assets/'?>third_party/tinymce/jquery.tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
              selector: "textarea",
              image_class_list: [
                {title: 'img-responsive', value: 'img-responsive'}
              ],
              images_upload_url: '<?=base_url()?>admin/dashboard/upload_tinymce',
              image_advtab: true,
              plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste jbimages"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
              // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
              //theme:'advanced',
              relative_urls: false
            });
        </script>
    <?php } ?>
    <?php if (isset($froala_editor) && ($froala_editor)) { ?>
      <!-- Include JS files. -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/froala_editor.min.js"></script>

      <!-- Include Code Mirror. -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

      <!-- Include Plugins. -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/align.min.js"></script>
      <!--   
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/char_counter.min.js"></script> -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/code_beautifier.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/code_view.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/colors.min.js"></script>
      <!--   
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/emoticons.min.js"></script> 
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/entities.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/file.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/font_family.min.js"></script> 
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/font_size.min.js"></script>
      -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/fullscreen.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/image.min.js"></script>
      <!--   <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/image_manager.min.js"></script> 
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/inline_style.min.js"></script>
      -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/line_breaker.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/link.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/lists.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/paragraph_format.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/paragraph_style.min.js"></script>
      <!--   <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/quick_insert.min.js"></script> -->
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/quote.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/table.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/save.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/url.min.js"></script>
      <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/video.min.js"></script>

      <!-- Initialize the editor. -->
      <script>
          $(function() {
              $('.editor').froalaEditor({
                imageUploadURL: '<?=base_url()?>/admin/dashboard/upload_froala',
                imageUploadParams: {
                    id: 'my_editor'
                }
              })
          });
    </script>
    <?php } ?>

    


  </body>
</html>