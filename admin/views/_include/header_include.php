<?php

if( isset($_SESSION['auth_user']) ){
    $auth_user = (object) $_SESSION['auth_user'];
}else{
    redirect_back(false);
    show_alert_message('You Must Login to View Admin Dashboard', 'info');
    redirect('../../index.php');
}