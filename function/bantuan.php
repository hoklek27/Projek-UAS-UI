<?php


//Cek apa user telah Login
function cekLogin()
{

    if (isset($_SESSION['user_name'])) {
        return true;
    }
    return false;
}

