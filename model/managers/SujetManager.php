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

        public function listSujets(){
            parent::connect();

                $sql = "SELECT *,
                            (SELECT MAX(m.dateDeCreation) FROM message m WHERE s.id_sujet = m.sujet_id) AS dernierMessage,
                            (SELECT COUNT(*) FROM message m WHERE s.id_sujet = m.sujet_id) AS nombreMessage
                        FROM ".$this->tableName." s
                        ORDER BY s.dateDeCreation
                        ";

                        return $this->getMultipleResults(
                            DAO::select($sql, null, true), 
                            $this->className
                        );
        }

        public function listSujetsParCategorie($id){
            parent::connect();

                $sql = "SELECT *,
                            (SELECT MAX(m.dateDeCreation) FROM message m WHERE s.id_sujet = m.sujet_id) AS dernierMessage,
                            (SELECT COUNT(*) FROM message m WHERE s.id_sujet = m.sujet_id) AS nombreMessage
                        FROM ".$this->tableName." s
                        WHERE s.categorie_id = :id
                        ORDER BY s.dateDeCreation
                        ";

                return $this->getMultipleResults(
                    DAO::select($sql, ['id' => $id], true), 
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