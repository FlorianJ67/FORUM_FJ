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
                        ORDER BY a.dateDeCreation
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

    }