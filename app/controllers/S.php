<?php
    class S extends Controller
    {
        public function index($params) {
            $data = [];
            $link_long = $this->model('SModel');
            $link_long = $link_long->getLinks($params);
            $data['link_long'] = $link_long;

//            var_dump($link_long);
//            die();

            $this->view('s/s', $data);


        }

    }
