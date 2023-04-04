<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class MessageManager extends Manager{

        protected $className = "Model\Entities\Message";
        protected $tableName = "message";

        public function __construct(){
            parent::connect();
        }
        public function listMessagesParSujet($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE sujet_id = :id
                        ORDER BY dateDeCreation
                        ";
                return $this->getMultipleResults(
                    DAO::select($sql, ['id' => $id], true), 
                    $this->className
                );
        }

        public function listMessagesParUtilisateur($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE utilisateur_id = :id
                        ORDER BY dateDeCreation DESC
                        LIMIT 5
                        ";

                return $this->getMultipleResults(
                    DAO::select($sql, ['id' => $id], true), 
                    $this->className
                );
        }
        public function supprimerToutLesMessagesParSujetId($id){
            parent::connect();

                $sql = "DELETE FROM ".$this->tableName."
                        WHERE sujet_id = :id
                        ";

                    DAO::delete($sql, ['id' => $id]);
        }
        public function supprimerMessageParId($id){
            parent::connect();

                $sql = "DELETE FROM ".$this->tableName."
                        WHERE id_message = :id
                        ";
                    DAO::delete($sql, ['id' => $id]);
        }

        public function modifierMessageParId($id,$contenu){
            parent::connect();

                $sql = "UPDATE ".$this->tableName."
                        SET contenu = :contenu
                        WHERE id_message = :id";
                        
                    DAO::update($sql, ['id' => $id,'contenu' => $contenu]);
        }
    }