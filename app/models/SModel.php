<?php
    require 'DB.php';

    class SModel
    {
        private $_db = null;

        public function __construct()
        {
            $this->_db = DB::getInstence();
        }

        public function getLinks($params)
        {
            $link_short = $params;
            $result = $this->_db->query("SELECT * FROM `links` WHERE `link_short` = '$link_short' ");
            $links = $result->fetch(PDO::FETCH_ASSOC);
            return $links['link_long'];

        }
    }