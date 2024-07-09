<!-- // 実行する場合には、()で渡すという意味を持つ -->

<?php
    include '../classes/User.php';

    $user = new User;

    $user->login($_POST);

?>