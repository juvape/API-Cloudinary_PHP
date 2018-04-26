<?php
require 'main.php';
function create_photo($file_path, $orig_name )
{
  $folder = $_POST['folder'];
  $colour = $_POST['colour'];
  $type = $_POST['type'];
  $stylecode = $_POST['stylecode'];

  if ($file_path == "" || $folder == "" || $type == "")
  {
    header("Location: upload.php?vacios=true");
  }
  else
  {
    switch ($type) {
      case 'top':
        $result = \Cloudinary\Uploader::upload($file_path, array(
          "tags" => "",
          "public_id" => $folder . "/" . substr($orig_name, 0, 9),
          "image_metadata" => false,
          "context" => array
              (
                "stylecode" => substr($orig_name, 0, 9),
                "imagetype" => "high res",
                "grouped" => "false",
                "colour" => $colour
              ),
        ));
        break;

        case 'bottom':
        $result = \Cloudinary\Uploader::upload($file_path, array(
          "tags" => "",
          "public_id" => $folder . "/" . trim(str_replace('.jpg', "", $orig_name)),
          "image_metadata" => false,
          "context" => array
              (
                "stylecode" => strtoupper($stylecode),
                "imagetype" => "high res",
                "grouped" => "true",
                "colour" => $colour
              ),
        ));
        break;

        case 'set':
        $result = \Cloudinary\Uploader::upload($file_path, array(
          "tags" => "",
          "public_id" => $folder . "/" . trim(str_replace('.jpg', "", $orig_name)),
          "image_metadata" => false,
          "context" => array
              (
                "stylecode" => strtoupper($stylecode),
                "imagetype" => "high res",
                "grouped" => "true",
                "colour" => $colour
              ),
        ));
        break;

        case 'cut':
        $result = \Cloudinary\Uploader::upload($file_path, array(
          "tags" => "",
          "public_id" => $folder . "/" . substr($orig_name, 0, 9),
          "image_metadata" => false,
          "context" => array
              (
                "stylecode" => substr($orig_name, 0, 9),
                "imagetype" => "high res",
                "grouped" => "true",
                "colour" => $colour
              ),
        ));
        break;

      default:
        header('Location: upload.php');
        break;
    }

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
