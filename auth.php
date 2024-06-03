<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Auth</title>
</head>

<?php

$msgsReg = array();
$msgsLog = array();
$db = new DB();
$usersAction = new Users();

if (isset($_POST["email"])) { // Register
    if ($_POST["password1"] != $_POST["password2"]) {
        return $msgsReg[] = array("content" => "The incorrect password!", "status" => "bad");
    } else {
        $res = $usersAction->createUser($_POST["name"], $_POST["email"], $_POST["password1"]);
        if ($res) {
            $msgsReg[] = array("content" => "Account is created successfully!", "status" => "good");
        } else {
            $msgsReg[] = array("content" => "Something went wrong!", "status" => "bad");
        }
    }
} elseif (!isset($_POST["email"]) && isset($_POST["name"])) { // Login
    try {
        $res = $usersAction->logIn($_POST["name"], $_POST["password"]);
        $_SESSION["user"] = $res;
        $actions = new Actions();
        
        $token = $actions->generateToken($res);
        setcookie("token", $token, time() + 86400 * 7, "/");
    } catch (Exception $e) {
        $msgsLog[] = array("content" => $e->getMessage(), "status" => "bad");
    }
}
function fill($field)
{
    if (isset($_POST[$field])) {
        echo $_POST[$field];
    }
}
?>

<body>
    <?php echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]); ?>
    <article class="d-flex justify-content-around align-items-center" style="height: 100vh;">
        <section class=" d-flex flex-column align-items-center mu5 border p-3 rounded">
            <div class="mb-4 d-flex flex-column align-items-center">
                <h1>Make&nbsp;an&nbsp;account</h1>
                <?php
                foreach ($msgsReg as $msg) {
                    $text;
                    if ($msg["status"] == "bad") {
                        $text = "text-danger";
                    } else {
                        $text = "text-success";
                    }
                ?>
                    <p class="<?php echo $text ?>">
                        <?php echo $msg["content"] ?></p>
                <?php } ?>
            </div>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="d-flex flex-column">
                <input class="form-control" type="text" name="name" value="<?php fill("name"); ?>" placeholder="Name">
                <br>
                <input class="form-control" type="email" name="email" value="<?php fill("email") ?>" placeholder="E-mail">
                <br>
                <input class="form-control" type="password" name="password1" placeholder="Password">
                <br>
                <input class="form-control" type="password" name="password2" placeholder="Password Verify">
                <br>
                <input class="btn btn-primary" class="mt-4" type="submit" value="Submit">
            </form>
        </section>
        <section class="d-flex flex-column align-items-center mu5 border p-3 rounded">
            <div class="mb-3 d-flex flex-column align-items-center">
                <h1>Log in</h1>
                <?php
                foreach ($msgsLog as $msg) {
                    $text;
                    if ($msg["status"] == "bad") {
                        $text = "text-danger";
                    } else {
                        $text = "text-success";
                    }
                ?>
                    <p class="<?php echo $text ?>">
                        <?php echo $msg["content"] ?></p>
                <?php } ?>
            </div>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <input class="form-control" type="text" name="name" value="<?php fill("name"); ?>" placeholder="Name">
                <br>
                <input class="form-control" type="password" name="password" placeholder="Password">
                <br>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </section>
    </article>
</body>

</html>