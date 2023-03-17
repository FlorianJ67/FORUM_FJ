<?php
    namespace Model\Entities;

    use App\Entity;

    final class Utilisateur extends Entity{

        private $id;
        private $pseudo;
        private $mail;
        private $mot_de_passe;
        private $dateInscription;


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
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of mail
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

        /**
         * Get the value of mot_de_passe
         */ 
        public function getMdp()
        {
                return $this->mot_de_passe;
        }

        /**
         * Set the value of mot_de_passe
         *
         * @return  self
         */ 
        public function setMdp($mot_de_passe)
        {
                $this->mot_de_passe = $mot_de_passe;

                return $this;
        }

        public function getCreationdate(){
            $formattedDate = $this->dateInscription->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationdate($date){
            $this->dateInscription = new \DateTime($date);
            return $this;
        }


    }
