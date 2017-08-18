<?php
    include_once("db_connect.php");
    $stmt = $pdo->prepare("SELECT * FROM departamentos ORDER BY Departamento ASC");
    $stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>
<body>
<div class="container">
    <div class="row">        
        <!--select id="departamento" class="selectpicker" data-show-subtext="true" data-live-search="true"-->
        <select name="" id="departamento">
            <?php 
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            ?>
                <option value="<?php echo $row['IdDepartamento']; ?>">
                    <?php 
                        echo $row['Departamento']; 
                    ?>
                </option>
            <?php 
                } 
            ?>
        </select>
        <select id="provincia">
             
        </select>
        <select id="distrito"></select>
    </div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="scriptubigeo.js"></script>
</body>
</html>