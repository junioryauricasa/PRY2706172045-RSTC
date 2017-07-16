<?php
    $q = intval($_GET['q']);

    $con = mysqli_connect('localhost','root','','db_resteco');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con,"ajax_demo");
    $sql="SELECT * FROM tb_usuario WHERE intUserId = '".$q."'";
    $result = mysqli_query($con,$sql);

    echo "<table>
    <tr>
      <th>#Cod</th>
      <th>Usuario</th>
      <th>e-Mail</th>
      <th>Tipo</th>
      <th>Estado</th>
    </tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['intUserId'] . "</td>";
        echo "<td>" . $row['nvchUserName'] . "</td>";
        echo "<td>" . $row['nchUserMail'] . "</td>";
        echo "<td>" . $row['intTypeUser'] . "</td>";
        echo "<td>" . $row['bitUserEstado'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($con);
?>