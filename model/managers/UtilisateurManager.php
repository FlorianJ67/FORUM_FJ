<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UtilisateurManager extends Manager{

        protected $className = "Model\Entities\Utilisateur";
        protected $tableName = "utilisateur";


        public function __construct(){
            parent::connect();
        }


        public function listInfoUtilisateur($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE utilisateur_id = :id
                        ";

                return $this->getMultipleResults(
                    DAO::select($sql, ['id' => $id], true), 
                    $this->className
                );
        }

        public function checkUtilisateurParMail($utilisateurMail){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE mail = :utilisateurMail
                        ";

                return $this->getOneOrNullResult(
                    DAO::select($sql, ['utilisateurMail' => $utilisateurMail], false), 
                    $this->className
                );
        }

        public function checkUtilisateurPseudo($utilisateurPseudo){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE pseudo = :utilisateurPseudo
                        ";

                return $this->getOneOrNullResult(
                    DAO::select($sql, ['utilisateurPseudo' => $utilisateurPseudo], false), 
                    $this->className
                );
        }

        public function checkUtilisateurMotDePasse($utilisateurMail){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE mail = :utilisateurMail
                        ";

                return $this->getOneOrNullResult(
                    DAO::select($sql, ['utilisateurMail' => $utilisateurMail], false), 
                    $this->className
                );
        }



    }