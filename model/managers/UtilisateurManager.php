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


    }