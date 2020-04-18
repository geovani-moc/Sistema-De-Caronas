<?php
    require_once('php/common.php');
    Session::destroy();
    redirect(base_url('index.php'));
?>