<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Document</title>
</head>

<body>
    <?php
    require("bd.php");

//     $req=$conn->query("SELECT * FROM user_table");
//  $reponse=$req->fetch();
// var_dump($reponse);

    $login = $_POST['identifiant'];
    $req = $conn->prepare("SELECT login_user,id_user FROM user_table where login_user = ? ");
    $req->execute(array($login));
    $reponse = $req->fetch();
    var_dump($reponse);

    //var_dump($reponse);
    //echo $reponse['login_user'];

    if (empty($reponse['login_user'])) {
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-y');

        $req = $conn->prepare("INSERT into user_table (login_user,date_crea, date_con) values(?, ?, ?) ");
        $req->execute(array($login, $date, $date));

        echo " <h1>hello " . $login . " Compte " . "<h2> ajouté </h2> </h1>";
    } else {

        echo " <h1>hello " . $reponse['login_user'] . "</h1>";
    }


    ?>
    <div class="deux">
        <form action="#" method="POST">
            <h1> POST </h1>
            <p1> new message:</p1>
            <br>
            <input type="hidden" name="identifiant" value="<?php echo $login; ?>">

            <textarea name="identifiantp"></textarea>
            <br>
            <input type="submit" name="boutonp" value="Poster">
        </form>
    </div>

    <?PHP

    var_dump($_POST);
    if (!empty($_POST['boutonp'])) {
        date_default_timezone_set('Europe/Paris');
        $date = date('y-m-d');

        $commentaire = $_POST['identifiantp'];

        $req = $conn->prepare("INSERT into msg_table (user_msg,txt_msg, date_msg) values(?, ?, ?) ");
        var_dump($reponse);
        $req->execute(array($reponse['id_user'], $commentaire, $date));
        $reponse2 = $req->fetch();
    }
    ?>



    <div class="deux">
        <h1> READ </h1>

        <p> <?php //echo  $_POST['identifiant'];
            $sql = "SELECT * FROM msg_table,user_table WHERE id_user=user_msg  ";
            $req = $conn->query($sql);
            $reponse = $req->fetch();

            //var_dump($reponse);

            while ($reponse = $req->fetch()) {

                echo $reponse['login_user'] . " à ecrit le" . $reponse['date_msg'];
                echo " " . $reponse['txt_msg'];
                if ($login == $reponse['login_user']) {
            ?>
        <form method="POST">
            <a href="formmodi.php?id=<?php echo $reponse['id_msg']; ?>">modifier</a>
        </form>
<?php
                }
                echo '<br>';
            }


            //var_dump($tab);
?>
<br>
<?php //echo  $reponse['txt_msg']; 
?>
</p>
    </div>

    <!-- BOnuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuus -->





</body>

</html>