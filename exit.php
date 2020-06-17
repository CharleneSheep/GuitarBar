<?php
session_start();
function loginOut()
{
    unset($_SESSION['name']);
}
loginOut();
echo "<script>window.location.href='index.php'</script>";
