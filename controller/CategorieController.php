<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategorieManager;
    
    class CategorieController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nom", "DESC"])
                ]
            ];
        
        }

        public function nouvelleCategorie(){
            // Manager
            $categorieManager = new CategorieManager();
 
            if(isset($_POST['submit'])) {
                // Récupération:
                // -nom
                $nom = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // -utilisateur
                $utilisateur = Session::getUser();

                if($nom && $utilisateur && $utilisateur->getRole() == "admin") {
                    // création du message
                    $categorieManager->add(["nom" => $nom]);

                    $this->redirectTo('categorie');
                }
            }
        }

    }