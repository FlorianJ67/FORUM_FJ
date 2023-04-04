<?php
    namespace Model\Entities;

    use App\Entity;

    final class Utilisateur extends Entity{

        private $id;
        private $pseudo;
        private $mail;
        private $motDePasse;
        private $dateInscription;
        private $role;
        private $ban;


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
        public function getMotDePasse()
        {
                return $this->motDePasse;
        }

        /**
         * Set the value of mot_de_passe
         *
         * @return  self
         */ 
        public function setMotDePasse($motDePasse)
        {
                $this->motDePasse = $motDePasse;

                return $this;
        }

        public function getDateInscription(){
            $formattedDate = $this->dateInscription->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateInscription($date){
            $this->dateInscription = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        /**
         * Get the value of ban
         */
        public function getBan()
        {
                return $this->ban;
        }

        /**
         * Set the value of ban
         */
        public function setBan($ban): self
        {
                $this->ban = $ban;

                return $this;
        }
    }
