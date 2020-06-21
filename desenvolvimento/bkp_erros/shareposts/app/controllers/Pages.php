<?php
    class Pages extends Controller{
        public function __construct(){
            // 1 Chama o model
          //$this->postModel = $this->model('Post');
        }

        public function index(){
            // Posso passar valores aqui pois no view está definido um array para isso
            // public function view($view, $data = []){
                // 2 Chama um método
                //$posts = $this->postModel->getPosts();
                
                // 3 coloca os valores no array
                $data = [
                'title' => 'SharePosts',
                'description'=> 'Simple Social Network build on the MVC PHP framework'
            ];

            // 4 Chama o view passando os dados
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Us',
                'description'=> 'App to share posts with other users'
            ];
            $this->view('pages/about', $data);           
        }
}