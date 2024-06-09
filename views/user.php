<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | User</title>
</head>

<body>
    <?= $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]); ?>
    <main class="p-5">
        <?php
        if (!$isUser) {
            $render("404");
            die();
        }
        $usersAction = new Users();
        function notFound($user)
        {
            if (sizeof($user) === 0) {
                echo "<h1>Couldn't find the user.</h1>";
                die();
            }
        }

        if (isset($params[0])) {
            $isMyProfile = false;
            $user = $usersAction->getUser($params[0]);
            if (!isset($user[0])) return notFound($user);
            $user = $user[0];
        } else {
            $isMyProfile = true;
            $user = $_SESSION["user"];
        };
        notFound($user);

        $user["books"] = $usersAction->getUsersBooks($user["id"]);
        ?>

        <?php echo $twig->render("userProfile.twig", ["user" => $user, "isMyProfile" => $isMyProfile]) ?>
    </main>
    <?php echo $twig->render("footer.twig") ?>
</body>

</html>