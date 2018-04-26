<?php
header("Access-Control-Allow-Origin: *");
require 'main.php';
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>Carga de imágenes</title>

	<link href="css/styles.css" media="all" rel="stylesheet" />

    <link rel="shortcut icon"
     href="<?php echo cloudinary_url("http://cloudinary.com/favicon.png",
           array("type" => "fetch")); ?>" />

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.5/js/vendor/jquery.ui.widget.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.5/js/jquery.iframe-transport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.5/js/jquery.fileupload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cloudinary-jquery-file-upload/2.1.2/cloudinary-jquery-file-upload.js"></script>
    <?php echo cloudinary_js_config(); ?>
  </head>

  <body>
    <div class="row">
      <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8 col-md-offset-2">
        <center>
          <div id="logo">
            <!-- This will render the image fetched from a remote HTTP URL using Cloudinary -->
            <!-- <?php echo fetch_image_tag("http://cloudinary.com/images/logo.png") ?> -->
            <img src="logo-cloudinary.png" alt="logo">
          </div>

          <div id='backend_upload'>
            <h1>Seleccione las imágenes que desea subir a Cloudinary</h1>
            <?php if(isset($_GET['vacios']) && $_GET['vacios'] == true): ?>
              <div class="alert alert-danger alert-dismissible ocultar" id="avisovacios" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;Debes llenar todos los campos con <span class="required"> * </span>obligatoriamente
                </p>
              </div>
            <?php endif; ?>
            <form class="form-horizontal" action="upload_backend.php" method="post" enctype="multipart/form-data">
              <input class="form-control" id="fileupload" type="file" name="files[]" multiple accept="image/gif, image/jpeg, image/png">

              <br/>
              <label class="">Carpeta destino <span class="required"> * </span></label>
              <input class="form-control" type="text" name="folder" placeholder="Ingresar nombre carpeta en Cloudinary donde desea cargar la imágen">
              <br/>
              <label>Ingrese el color <span class="required"> * </span></label>
              <input type="text" class="form-control" name="colour" placeholder="Ingresar color">
              <br/>
              <label>Tipo de imágen <span class="required"> * </span></label>
              <select class="form-control" name="type" id="type" onchange="select_type()">
                <option value="">-----</option>
                <option value="top">Top</option>
                <option value="bottom">Bottom</option>
                <option value="set">Set</option>
                <option value="cut">Cut</option>
              </select>
              <br/>
              <div id="oculto">
                <label>Stylecode para la imágen</label>
                <input class="form-control oculto" type="text" name="stylecode" placeholder="Stylecode">
              </div>
              <br/><br/>
              <input class="btn-primary" type="submit" value="Upload" id="btn-upload">
            </form>
          </div>
        </center>
      </div>
    </div>
  </body>

    <script src="js/scripts.js"></script>
</html>
