<?php 
  
  session_start(); // inicio da  sessão

  //  Rotas permitidas
   $rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

   //definir Rotas
   $rota = $_GET['rota'] ?? 'home';

   // verifico o login 
   if(!isset($_SESSION['usuario'])){ // se a sessão atual nao tiver registro do usario manda pra ele para fazer login 
    $rota = "login";
   }

   // se o usuario esta logado e tentar entra no login

   if(isset($_SESSION['usuario']) && $rota === 'login'){
    $rota = 'home';
   }

   // se a rota nao existe
   if (!in_array( $rota,$rotas_permitidas)) {

    $rota = '404';
   }

   //preparando pagina
   $script = null;
   switch ($rota) {
    case '404':
        $script = '404.php';
        break;
    case 'login':
        $script = "login.php";
        break;
        case 'home':
            $script = "home.php";
            break;
   }


   // carregamento de scripts permanentes
   require_once __DIR__ . "/../inc/config.php";
   require_once __DIR__ . "/../inc/database.php";
   //apresentação da pagina

   require_once __DIR__ . "/../inc/header.php";
   require_once __DIR__ . "/../script/$script";
   require_once __DIR__ . "/../inc/footer.php";