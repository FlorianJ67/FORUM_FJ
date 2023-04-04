<?php
    namespace Model\Entities;

    use App\Entity;

    final class Message extends Entity{

        private $id;
        private $contenu;
        private $utilisateur;
        private $dateDeCreation;
        private $sujet;

        private $countMessage;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

                /**
         * Get the value of id
         */ 
        public function getContenu()
        {
                return $this->contenu;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setContenu($contenu)
        {
                $this->contenu = $contenu;

                return $this;
        }

        
                /**
         * Get the value of id
         */ 
        public function getUtilisateur()
        {
                return $this->utilisateur;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setUtilisateur($utilisateur)
        {
                $this->utilisateur = $utilisateur;

                return $this;
        }

        
                /**
         * Get the value of id
         */ 
        public function getSujet()
        {
                return $this->sujet;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setSujet($sujet)
        {
                $this->sujet = $sujet;

                return $this;
        }


        public function getDateDeCreation(){
            $formattedDate = $this->dateDeCreation->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateDeCreation($date){
            $this->dateDeCreation = new \DateTime($date);
            return $this;
        }


        /**
         * Get the value of countMessage
         */
        public function getCountMessage()
        {
                return $this->countMessage;
        }

        /**
         * Set the value of countMessage
         */
        public function setCountMessage($countMessage): self
        {
                $this->countMessage = $countMessage;

                return $this;
        }
    }
