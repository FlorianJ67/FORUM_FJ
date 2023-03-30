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

            // vue par defaut sans id spécifier
            } else {
                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->findAll(["titre", "DESC"]),
                    ]
                ];
            }

        }

        public function sujetsThread($id){
          
            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();

            if($id) {
                return [
                    "view" => VIEW_DIR."forum/listMessages.php",
                    "data" => [
                        "messages" => $messageManager->listMessagesParSujet($id),
                        "sujet" => $sujetManager->findSujetParId($id)
                    ]
                ];
            } 

        }

        public function nouveauSujet($id){
          
            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();
            $categorieManager = new CategorieManager();
 
            if(isset($_SESSION["user"])) {

                if(isset($_POST['submit'])) {

                    // titre
                    $titreSujet = filter_input(INPUT_POST, "titreSujet", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    // 1er message
                    $textMessage = filter_input(INPUT_POST, "textMessage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    // utilisateur
                    $utilisateur = Session::getUser()->getId();

                    if($titreSujet && $textMessage && $utilisateur) {
                        // id du sujet créer     //création du sujet
                        $IdDernierSujetAjouter = $sujetManager->add(["titre" => $titreSujet, "categorie_id" => $id,"utilisateur_id" => $utilisateur, "etat" => 1]);
                        // création du 1er message
                        $messageManager->add(["sujet_id" => $IdDernierSujetAjouter,"utilisateur_id" => $utilisateur,"contenu" => $textMessage]);

                        $this->redirectTo("sujet", "sujetsThread", $IdDernierSujetAjouter);
                    }
                }
            } else {
                return [
                    "view" => VIEW_DIR."forum/listSujets.php",
                    "data" => [
                        "categories" => $categorieManager->findAll(["nom", "DESC"]),
                        "sujets" => $sujetManager->findAll(["titre", "DESC"]),
                        "error" => "Aucun utilisateur n'est connecté"   
                    ]
                ];

            }
    
        }
        
        public function nouveauMessage($id){
          
            $messageManager = new MessageManager();
 
            if(isset($_POST['submit'])) {

                // message
                $textMessage = filter_input(INPUT_POST, "textMessage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // utilisateur
                $utilisateur = Session::getUser()->getId();

                if($textMessage && $utilisateur) {
                    // création du message
                    $messageManager->add(["sujet_id" => $id, "utilisateur_id" => $utilisateur, "contenu" => $textMessage]);

                    $this->redirectTo('sujet', 'sujetsThread', $id);
                }
            }
        }
        public function modifierMessage($id){
          
            $messageManager = new MessageManager();

            // message qui sera modifié
            $message = $messageManager->findOneById($id);
 
            if(isset($_POST['submit'])) {
                if(isset($_SESSION["user"])){
                    // contenu
                    $textMessage = filter_input(INPUT_POST, "textMessage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    // utilisateur
                    $utilisateur = Session::getUser();
                    // si le role de l'utilisateur est: admin  ou  modérateur    OU que l'utilisateur est l'auteur du message
                    if ((($utilisateur->getRole() === ("admin" || "moderateur")) || ($utilisateur->getId() == $message->getUtilisateur()->getId())) && $textMessage && $utilisateur) {
                        // modification du message
                        $messageManager->modifierMessageParId($id,$textMessage);
                    }
                }
                // redirection au sujet une fois le message modifié
                $this->redirectTo('sujet', 'sujetsThread', $message->getSujet()->getId());
            }
            // redirection vers la page pour modifier le message

            return [
                "view" => VIEW_DIR."forum/modifierMessage.php",
                "data" => [
                    "message" => $message
                ]
            ];
        }
        public function supprimerSujet($id){

            $sujetManager = new SujetManager();
            $messageManager = new MessageManager();

            // utilisateur
            $utilisateur = Session::getUser();
            $sujet = $sujetManager->findOneById($id);

            // on vérifie si l'utilisateur a les droits
            if (($utilisateur->getRole() === ("admin" || "moderateur")) || ($utilisateur->getId() === $sujet->getUtilisateur()->getId())) {
                
                $messageManager->supprimerToutLesMessagesParSujetId($id);
                $sujetManager->supprimerSujetParId($id);
            } 

            $this->redirectTo('sujet','sujetsParCategorie');
        }
        public function supprimerMessage($id){

            $messageManager = new MessageManager();

            // utilisateur
            $utilisateur = Session::getUser();
            $message = $messageManager->findOneById($id);

            // on vérifie si l'utilisateur a les droits
            if (($utilisateur->getRole() === ("admin" || "moderateur")) || ($utilisateur->getId() === $message->getUtilisateur()->getId())) {

                $idSujet = $messageManager->findOneById($id)->getSujet()->getId();
                $messageManager->supprimerMessageParId($id);
            }
            $this->redirectTo('sujet','sujetsThread', $idSujet);
        }
        public function lockSujet($id){
          
            $sujetManager = new SujetManager();

            $utilisateur = Session::getUser();
            $sujet = $sujetManager->findOneById($id);

            // on vérifie si l'utilisateur a les droits
            if (($utilisateur->getRole() === ("admin" || "moderateur")) || ($utilisateur->getId() === $sujet->getUtilisateur()->getId())) {

                if($sujet->getEtat() == true || $sujet->getEtat() == 1) {
                    $sujetManager->lockSujetParId($id);
                } else {
                    $sujetManager->unlockSujetParId($id);
                }
            }
            $this->redirectTo('sujet','sujetsParCategorie');
        }
    }