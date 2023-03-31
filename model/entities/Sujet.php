<?php
    namespace Model\Entities;

    use App\Entity;

    final class Sujet extends Entity{

        private $id;
        private $titre;
        private $utilisateur;
        private $dateDeCreation;
        private $etat;
        private $categorie;

        private $dernierMessage;
        private $nombreMessage;

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
         * Get the value of titre
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of utilisateur
         */ 
        public function getUtilisateur()
        {
                return $this->utilisateur;
        }

        /**
         * Set the value of utilisateur
         *
         * @return  self
         */ 
        public function setUtilisateur($utilisateur)
        {
                $this->utilisateur = $utilisateur;

                return $this;
        }

                /**
         * Get the value of utilisateur
         */ 
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Set the value of utilisateur
         *
         * @return  self
         */ 
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;

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
         * Get the value of etat
         */ 
        public function getEtat()
        {
                return $this->etat;
        }

        /**
         * Set the value of etat
         *
         * @return  self
         */ 
        public function setEtat($etat)
        {
                $this->etat = $etat;

                return $this;
        }

        public function getDernierMessage()
        {
                return $this->dernierMessage;
        }

        public function setDernierMessage($dernierMessage)
        {
                $this->dernierMessage = $dernierMessage;

                return $this;
        }

        public function getNombreMessage()
        {
                return $this->nombreMessage;
        }

        public function setNombreMessage($nombreMessage)
        {
                $this->nombreMessage = $nombreMessage;

                return $this;
        }

    }
