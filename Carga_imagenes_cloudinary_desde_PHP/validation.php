<?php

  $folder = $_POST['folder'];
  $colour = $_POST['colour'];
  $type = $_POST['type'];
  $stylecode = $_POST['stylecode'];

  if ($folder == "" || $type == "" || $colour == "")
  {
    header("Location: upload.php?vacios=true");
    exit;
  }
  else
  {
    $size = $_FILES['files']['size'];

    $total = array_sum($size);

    $result = ($total / 1048576);

    echo "<p style='color: red;'>Recuerde que si sus archivos sobrepasan los 8 MB no se podrán cargar</p><br/>";

    echo "<p>Sus archivos pesan " . number_format($result, 2, ',', '') . " MB aproximadamente.</p>";

    echo "<p><strong>Desea continuar con la carga de los archivos?</strong></p>";

    echo "<a href='upload_backend.php'>SI</a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href='upload.php'>No</a>";
  }



?>
