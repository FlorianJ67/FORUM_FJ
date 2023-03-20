<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\SujetManager;
    use Model\Managers\CategorieManager;
    
    class UtilisateurController extends AbstractController implements ControllerInterface{

        public function index(){
          
            $sujetManager = new SujetManager();
            $categorieManager = new CategorieManager();
 
             return [
                 "view" => VIEW_DIR."forum/listSujets.php",
                 "data" => [
                     "categories" => $categorieManager->findAll(["nom", "DESC"]),
                     "sujets" => $sujetManager->findAll(["titre", "DESC"])
                 ]
             ];
         
        }

    }