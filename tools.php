<?php

namespace Tools {

    class dataBase
    {
        private $user = 'root';
        private $host = 'localhost';
        private $pass = '1111';

        /**
         * @return string
         */
        public function getUser()
        {
            return $this->user;
        }

        /**
         * @return string
         */
        public function getHost()
        {
            return $this->host;
        }

        /**
         * @return string
         */
        public function getPass()
        {
            return $this->pass;
        }
    }
}