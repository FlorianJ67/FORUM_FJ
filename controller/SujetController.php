<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\SujetManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\MessageManager;
    
    class SujetController extends AbstractController implements ControllerInterface{

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

        public function sujetsParCategorie($id){
          
            $sujetManager = new SujetManager();
            $categorieManager = new CategorieManager();
 
            if($id) {
                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->listSujetsParCategorie($id),
                    ]
                ];
            } else {
                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->findAll(["titre", "DESC"])
                    ]
                ];
            }

         
        }

        public function sujetsThread($id){
          
            $messageManager = new MessageManager();

            if($id) {
                return [
                    "view" => VIEW_DIR."forum/listMessages.php",
                    "data" => [
                        "messages" => $messageManager->listMessagesParSujet($id)
                    ]
                ];
            } 

         
        }

    }


