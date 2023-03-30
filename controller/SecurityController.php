<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UtilisateurManager;
    use Model\Managers\SujetManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\MessageManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
 
             return [
                 "view" => VIEW_DIR."forum/login.php",

             ];   
         }

        public function ajoutUtilisateur(){
            // Manager
            $utilisateurManager = new UtilisateurManager();
            $messageManager = new MessageManager();
 
            if(isset($_POST['submit'])) {
                // Récupération:
                // -email
                $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
                // -pseudo
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // -mot de passe
                $mdp1 = filter_input(INPUT_POST, "mdp1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // -mot de passe vérification
                $mdp2 = filter_input(INPUT_POST, "mdp2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                // On vérifie si les champs n'existe pas déjà en BDD et que les mots de passe sont bien identique

                // variable qui stock les erreurs pour en afficher plusieurs si nécessaire
                $error = null;
                
                // on verifie le mail
                if ($mail) {
                    if ($utilisateurManager->checkUtilisateurParMail($mail)) {
                        $error = "Le mail est déjà utilisé";
                    }                    
                }

                // on verifie le pseudo
                if ($pseudo) {
                    if ($utilisateurManager->checkUtilisateurPseudo($pseudo)) {
                        if ($error) {
                            $error .= "<br>Le pseudo existe déjà";
                        } else {
                            $error = "Le pseudo existe déjà";
                        }
                    }                    
                }

            
                // on compare le mdp et le 'vérifier' mdp
                if(isset($mdp1) && isset($mdp2)) {
                    if($mdp1 == (null || '') || $mdp2 == (null || '')) {
                        $motDePasse = null;
                        if ($error) {
                            $error .= "<br>Les mots de passes ne correspondent pas";
                        } else {
                            $error = "Les mots de passes ne correspondent pas";
                        }
                    } else if($mdp1 == $mdp2) {
                        // si ils sont identique on crée le mdp hasher
                        $motDePasse = password_hash($mdp1, PASSWORD_DEFAULT);
                    } else {
                        $motDePasse = null;

                        if ($error) {
                            $error .= "<br>Les mots de passes ne correspondent pas";
                        } else {
                            $error = "Les mots de passes ne correspondent pas";
                        }
                    }   
                }
        
                if ($error) {
                    return [
                        "view" => VIEW_DIR."forum/register.php",
                        "data" => [
                            "error" => $error
                        ]
                    ];
                }

                if($pseudo && $mail && $motDePasse) {
                    // on créer le nouvel utilisateur et on récupère son ID
                    $newUser = $utilisateurManager->add(["pseudo" => $pseudo,"mail" => $mail,"motDePasse" => $motDePasse]);
                    
                    return [
                        "view" => VIEW_DIR . "forum/detailUtilisateur.php",
                        "data" => [
                            "user" => $utilisateurManager->findOneById($newUser),
                            "messages" => $messageManager->listMessagesParUtilisateur($newUser)
                        ]
                    ];
                }
            } else {
                return [
                    "view" => VIEW_DIR."forum/register.php",
                ];                 
            }
 
        }


        public function connexionUtilisateur(){
            $utilisateurManager = new UtilisateurManager();
            $messageManager = new MessageManager();

            if( isset($_POST['submit'])) {

                $email = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                $motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($email && $motDePasse) {
                    
                    $utilisateur = $utilisateurManager->checkUtilisateurParMail($email);
                    
                    if ($utilisateur) {
                        
                        $hash = $utilisateur->getMotDePasse();

                        if(password_verify($motDePasse, $hash)) {

                            Session::setUser($utilisateur);

                            return [
                                "view" => VIEW_DIR . "forum/detailUtilisateur.php",
                                "data" => [
                                    "user" => $utilisateur,
                                    "messages" => $messageManager->listMessagesParUtilisateur($utilisateur->getId())
                                ]
                            ];

                        }
                    } else {
                        $error = "aucun mail ne correspond";
                        return [
                            "view" => VIEW_DIR."forum/login.php",
                            "data" => [
                                "error" => $error
                            ]
                        ];                  
                    }
                }
            } 

        }

        public function deconnexionUtilisateur(){

            $categorieManager = new CategorieManager();
            $sujetManager = new SujetManager();

            session_destroy();

            $this->redirectTo("sujet","index");
        }

    }