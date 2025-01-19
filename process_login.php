<?php

if(!isset($_POST["email"]) || empty($_POST["email"]))
{
    die("You have incorrectly entered your email.");
}

if(!isset($_POST["password"]) || empty($_POST["password"]))
{
    die("You have incorrectly entered your password.");
}

$email = $_POST["email"];
$password = $_POST["password"];
$base = mysqli_connect("localhost", "root", "", "web_shop");
$result = $base -> query("SELECT * FROM korisnici WHERE email = '$email'");
$user = $result -> fetch_assoc();
$verified_password = password_verify($password, $user['sifra']);

if (isset($user["email"]) && $verified_password == true)
{
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    header("Location: index.php");
}
else
{
    echo "You have incorrectly entered your email or password.";
}
