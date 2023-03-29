<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class SujetManager extends Manager{

        protected $className = "Model\Entities\Sujet";
        protected $tableName = "sujet";


        public function __construct(){
            parent::connect();
        }

        public function listSujetsParCategorie($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName." s
                        WHERE s.categorie_id = :id
                        ORDER BY s.dateDeCreation
                        ";

                return $this->getMultipleResults(
                    DAO::select($sql, ['id' => $id], true), 
                    $this->className
                );
        }

        public function findSujetParId($id){
            parent::connect();

                $sql = "SELECT *
                        FROM ".$this->tableName." s
                        WHERE s.id_sujet = :id
                        ";

                return $this->getOneOrNullResult(
                    DAO::select($sql, ['id' => $id], false), 
                    $this->className
                );
        }

        public function supprimerSujetParId($id){
            parent::connect();

                $sql = "DELETE FROM ".$this->tableName."
                        WHERE id_sujet = :id
                        ";
                    DAO::delete($sql, ['id' => $id]);
        }

        public function lockSujetParId($id){
            parent::connect();

                $sql = "UPDATE ".$this->tableName."
                        SET etat = 0
                        WHERE id_sujet = :id
                        ";
                    DAO::update($sql, ['id' => $id]);
        }

        public function unlockSujetParId($id){
            parent::connect();

                $sql = "UPDATE ".$this->tableName."
                        SET etat = 1
                        WHERE id_sujet = :id
                        ";
                    DAO::update($sql, ['id' => $id]);
        }

    }