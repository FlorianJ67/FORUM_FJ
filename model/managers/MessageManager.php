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

        public function dernierMessagesParSujet($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName."
                        WHERE sujet_id = :id
                        ORDER BY dateDeCreation DESC
                        LIMIT 1
                        ";

                return $this->getOneOrNullResult(
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


    }