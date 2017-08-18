<?php
include_once('db_connect.php');

if(isset($_POST['cid'])) {
    $stmt = $pdo->prepare("SELECT * FROM provincias WHERE IdDepartamento=:cid ORDER BY Provincia ASC");
    $stmt->execute(array(':cid' => $_POST['cid']));
    echo '
        <option value="0">Selecciona Provincia</option>
    ';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['IdProvincia'] . '">' . $row['Provincia'] . '</option>';
    }
}

if(isset($_POST['sid'])) {
    $stmt = $pdo->prepare("SELECT * FROM distritos WHERE IdProvincia=:sid ORDER BY Distrito ASC");
    $stmt->execute(array(':sid' => $_POST['sid']));
    echo '
        <option value="0">Selecciona Distrito</option>
    ';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['IdDistrito'] . '">' . $row['Distrito'] . '</option>';
    }
}


?>