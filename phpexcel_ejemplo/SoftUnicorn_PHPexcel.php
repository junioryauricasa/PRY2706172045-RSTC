<?php
  
  error_reporting(E_ALL);
  include_once 'Classes/PHPExcel.php';

  // Connection data (server_address, database, name, poassword)
  $hostdb = 'localhost';
  $namedb = 'test';
  $userdb = 'root';
  $passdb = '';

  try {
      // Connect and create the PDO object
      $conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
      /////////////////////////////////////////////////////////////
      $objXLS = new PHPExcel();
      $objSheet = $objXLS->setActiveSheetIndex(0);
      ////////////////////TITULOS///////////////////////////
      $objSheet->setCellValue('A1', 'ID');
      $objSheet->setCellValue('B1', 'Nombre');
      $objSheet->setCellValue('C1', 'Apellido');
      $numero=1;

      // Define and perform the SQL SELECT query
      $sql = "SELECT * FROM alumnos";
      $result = $conn->query($sql);

      // If the SQL query is succesfully performed ($result not false)
      if($result !== false) {

        // Parse the result set
        foreach($result as $row) {
            //echo $row['id']. ' - '. $row['Nombre']. ' - '. $row['Apellido']. ' - '. $row['Sexo']. '<br />';
            $numero++;
            $objSheet->setCellValue('A'.$numero, $row['id']);
            $objSheet->setCellValue('B'.$numero, $row['Nombre']);
            $objSheet->setCellValue('C'.$numero, $row['Apellido']);
        }
      }

      $objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
      $objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
      $objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
      $objXLS->getActiveSheet()->setTitle('documento');
      $objXLS->setActiveSheetIndex(0);
      $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
      $objWriter->save(__DIR__ . "\Regiones.xls");
      echo 'Archivo Guardado en '.(__DIR__ . "\Regiones.xls");

  }
  catch(PDOException $e) {
      echo $e->getMessage();
  }
?>