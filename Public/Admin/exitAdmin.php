<?php
session_start();
function loginOut()
{
    unset($_SESSION['name']);
}
loginOut();
echo "<script>window.location.href='AdminLogin.php'</script>";
