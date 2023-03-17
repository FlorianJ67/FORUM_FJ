<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategorieManager;
    
    class CategorieController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $catégorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listSujets.php",
                "data" => [
                    "catégories" => $catégorieManager->findAll(["nom", "DESC"])
                ]
            ];
        
        }

    }