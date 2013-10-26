<?php

    /**
     * Description of User
     *
     * @author mackendy
     */
    
    /** 
     * @Entity(repositoryClass="Models\Repository\UserRepository")
     * @Table(name="users")
     */
    class User {
        
        /**
         * @ManyToOne(tergatEntity="Post")
         * @JoinColumn(name="user_id", referenceColumnName="user_id")
         */
        
        /** 
         * @Id 
         * @Column(type="integer")
         * @GeneratedValue
         */
        protected $user_id;
        
        /** @Column(type="string", length=255)*/
        protected $user_name;
        
        /** @Column(type="string", length=255)*/
        protected $user_password;
        
        /** @Column(type="string", length=255)*/
        protected $user_email;
        
        /** @Column(type="string", length=45)*/
        protected $user_type;
        
        /** @Column(type="integer", length=11)*/
        protected $user_status;
        
        
        public function getUser_id() {
            return $this->user_id;
        }

        public function setUser_id($user_id) {
            $this->user_id = $user_id;
        }

        public function getUser_name() {
            return $this->user_name;
        }

        public function setUser_name($user_name) {
            $this->user_name = $user_name;
        }

        public function getUser_password() {
            return $this->user_password;
        }

        public function setUser_password($user_password) {
            $this->user_password = $user_password;
        }

        public function getUser_email() {
            return $this->user_email;
        }

        public function setUser_email($user_email) {
            $this->user_email = $user_email;
        }

        public function getUser_type() {
            return $this->user_type;
        }

        public function setUser_type($user_type) {
            $this->user_type = $user_type;
        }

        public function getUser_status() {
            return $this->user_status;
        }

        public function setUser_status($user_status) {
            $this->user_status = $user_status;
        }

        }

?>
