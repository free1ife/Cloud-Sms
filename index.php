<?php 
require dirname(__FILE__).'/init.php';
switch($_GET['action']){
    case 'login':
    include _ROOT_.'templates/login.php';
    break;
    case 'reg':
    include _ROOT_.'templates/reg.php';
    break;
    case 'logout':
    setcookie('name','',time()-1);
	setcookie('pass','',time()-1);
	header('Location:index.php?action=login');
    break;
    case 'cloud':
    include _ROOT_.'templates/header.php';
    include _ROOT_.'templates/cloud.php';
    include _ROOT_.'templates/footer.php';
	break;
    default:
    if($M->iCookie()){
	header('Location:index.php?action=cloud');
        exit();
	}
    $path = _ROOT_.'templates/'.$_GET['action'].'.php';
	if(file_exists($path)){
		include _ROOT_.'templates/header.php';
		include $path;
		include _ROOT_.'templates/footer.php';
    }else{
    	include _ROOT_.'templates/login.php';
    }
}
