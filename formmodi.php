<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require("bd.php");

    echo $_GET['id'];

    $sql = "SELECT txt_msg FROM msg_table WHERE id_msg=" . $_GET['id'];
    $rep = $conn->query($sql);
    $reponse = $rep->fetch();
    var_dump($reponse);
    ?>

    <form method="POST">
        <input type="text" name="modcom" value="<?php echo $reponse['txt_msg']; ?>">
        <input type="submit" name="enregistrer" value="valider">
    </form>
    <?php
    if (!empty($_POST['enregistrer'])) {
        $sql = "UPDATE msg_table SET txt_msg ='".$_POST['modcom']."'";
        $req = $conn->query($sql);
    }
    ?>
</body>

</html>