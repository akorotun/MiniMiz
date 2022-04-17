<?php
    class Home extends Controller
    {
        public function index() {
            if (isset($_POST['link_long'])) {
                $links = $this->model('LinksModel');
                $links->setData($_POST['link_long'], $_POST['link_short']);

                //проверяем ссылку короткую в базе - обращаемся к функции validLink() в LinksModel
                $isValid = $links->validLink();
                if ($isValid == "Верно")
                    $links->addLinks();// обращаемся к функции addLinks в LinksModel
                //если были ошибки, то в элемент message укажем ту ошибку, которая была записана в переменную $isValid
                else
                    $data['message'] = $isValid;
            }

            $user_links = $this->model('LinksModel');

            if (isset($_POST['id'])) {
//                var_dump($_POST['id']);
//                die();

                $id_links = $this->model('LinksModel');
                $id_links->deleteLinks($_POST['id']);

            }

            $data['links'] = $user_links->getLinks();
            $this->view('home/index', $data);

        }

    }