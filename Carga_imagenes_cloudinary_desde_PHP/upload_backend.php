<?php
require 'main.php';
function create_photo($file_path, $orig_name )
{
  $folder = $_POST['folder'];
  //
  // echo "<pre>";
  // var_dump($file_path);
  // exit;
  if ($file_path == "" || $folder == "")
  {
    header("Location: upload.php?vacios=true");
  }
  else
  {
    $result = \Cloudinary\Uploader::upload($file_path, array(
      "tags" => $orig_name,
      "public_id" => $folder . "/" . $orig_name,
      "image_metadata" => false
    ));
    {
    }
    unlink($file_path);
    error_log("Upload result: " . \PhotoAlbum\ret_var_dump($result));
    // $photo = \PhotoAlbum\create_photo_model($result);
    return $result;

  }
}
$files = $_FILES["files"];
$files = is_array($files) ? $files : array( $files );
$files_data = array();
foreach ($files["tmp_name"] as $index => $value) {
  array_push($files_data, create_photo($value, $files["name"][$index]));
}
?>
<html>
<head>
  <link href="style.css" media="all" rel="stylesheet"/>
  <title>Carga Satisfactoria!</title>
</head>
<body>

  <h1>Las imágenes han sido cargadas correctamente</h1>
  <h2>Detalles de la carga</h2>
  <?php
  foreach ($files_data as $file_data) {
    \PhotoAlbum\array_to_table($file_data);
  }
  ?>
  <br/>
  <?php echo cl_image_tag($file_data['public_id'], array_merge($thumbs_params, array( "crop" => "fill", "class" => "img-responsive", "alt" => "responsive image" ))); ?>
  <br/>
  <br/>
  <a href="upload.php" class="back_link">Volver</a>
</body>
</html>
