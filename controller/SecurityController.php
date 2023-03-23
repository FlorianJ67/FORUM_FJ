<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UtilisateurManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
 
             return [
                 "view" => VIEW_DIR."forum/register.php",

             ];   
         }

        public function ajoutUtilisateur(){
          
            $utilisateurManager = new UtilisateurManager();
 
            if(isset($_POST['submit'])) {
                // on filtre les input

                $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // on enregistre le mdp et le 'vérifier' mdp
                $mdp1 = filter_input(INPUT_POST, "mdp1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $mdp2 = filter_input(INPUT_POST, "mdp2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // on verifie le mail

                if ($utilisateurManager->checkUtilisateurMail($mail)) {
                    return [
                        "view" => VIEW_DIR."forum/register.php",
                        "data" => [
                            "error" => "Le mail est déjà utilisé"
                        ]
                    ];
                }
    
                // on verifie le pseudo
                if ($utilisateurManager->checkUtilisateurPseudo($pseudo)) {
                    return [
                        "view" => VIEW_DIR."forum/register.php",
                        "data" => [
                            "error" => "Le pseudo existe déjà"
                        ]
                    ];
                }
            }
                // on compare le mdp et le 'vérifier' mdp
                if($mdp1 == $mdp2) {
                    // si ils sont identique on crée le mdp hasher
                    $motDePasse = password_hash($mdp1, PASSWORD_DEFAULT);
                } else {
                    $motDePasse = null;
                    return [
                        "view" => VIEW_DIR."forum/register.php",
                        "data" => [
                            "error" => "Les mots de passes ne correspondent pas"
                        ]
                    ];  
                }

                if($pseudo && $mail && $motDePasse) {

                    $idUser = $utilisateurManager->add(["pseudo" => $pseudo,"mail" => $mail,"motDePasse" => $motDePasse]);

                    $this->redirectTo('utilisateur', 'detailUtilisateur', $idUser);
                }
         
        }

        public function connexionUtilisateur(){
          
            $utilisateurManager = new UtilisateurManager();
 
            if(isset($_POST['submit'])) {
                // on filtre les input

                $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $motDePasse = password_hash($mdp, PASSWORD_DEFAULT);


            }
         
        }

    }