<?php

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

$user = $SESSION['user'];

unset(aifp_controller::$collection_user[$user]);

session_destroy();

$smarty->assign('message','log out avvenuto con successo, Arriverderci!');
