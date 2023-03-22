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
            
            //liste des sujets par catégories (via le <select> dans listSujets)
            if(isset($_POST['categorie'])){

                $categorieSelected = filter_input(INPUT_POST,'categorie',FILTER_SANITIZE_NUMBER_INT);

                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->listSujetsParCategorie($categorieSelected ),
                        "categorieActuel" => $categorieSelected,
                    ]
                ];
            } else {
                $categorieSelected = null;
            } 

            // liste des sujets par catégories (via "la liste des catégories")
            if($id) {
                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->listSujetsParCategorie($id),
                    ]
                ];

            // vue par defaut id=null ou sans id spécifier
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

        public function nouveauSujet($id){
          
            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();
 
            if(isset($_POST['submit'])) {

                $titreSujet = filter_input(INPUT_POST, "titreSujet", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $textMessage = filter_input(INPUT_POST, "textMessage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                $utilisateur = 2;

                if($titreSujet && $textMessage && $utilisateur) {

                    $IdDernierSujetAjouter = $sujetManager->add(["titre" => $titreSujet, "categorie_id" => $id,"utilisateur_id" => $utilisateur]);

                    $messageManager->add(["sujet_id" => $IdDernierSujetAjouter,"utilisateur_id" => $utilisateur,"contenu" => $textMessage]);

                    $this->redirectTo('sujet', 'sujetsThread', $IdDernierSujetAjouter);
                }
            }
         
        }

    }


