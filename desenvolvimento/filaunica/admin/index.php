<?php
// URL ROOT
require_once '../inc/db.inc.php';
//require_once '../inc/helpers.inc.php';
  $pdo->exec("set names utf8");
  $sql = "SELECT id,comprovanteres,comprovante_res_nome,comprovanteres_tipo  FROM fila WHERE id = 25";
  
	$stmt = $pdo->prepare($sql);
  $stmt->execute(array());
  $result = $stmt->fetch();

  $tipo = $result['comprovanteres_tipo'];
  $conteudo = $result['comprovanteres'];
  header("Content-Type: $tipo");
  echo $conteudo;


  //var_dump($stmt);
  //exit();
  /*
  foreach($result as $resultado)
   {
     $tipo = $resultado['comprovanteres_tipo'];
     $conteudo = $resultado['comprovanteres'];
     header("Content-Type: $tipo");
     echo $conteudo;
   } 
 */
 ?>