<?php

    class Vagas extends Controller{
        public function __construct(){
            $this->vagasModel = $this->model('Vaga');
        }
   

    public function index(){

        $data = [
            'title' => 'Vagas',           
        ];
        
        $vagas = $this->vagasModel->getVagas();

        $this->view('vagas/index', $data);
    }

    public function new(){
        $this->view('vagas/new', $data);
    }

    public function register(){
        
        //Verifica se a requisição é de método POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'titulo' => trim($_POST['titulo']),
                'descricao' => trim($_POST['descricao']),
                'ativo' => trim($_POST['ativo'])
            ];

        }        

        //VALIDAÇÃO DO POST
        if(!empty($data['titulo']) && !empty($data['descricao']) && !empty($data['ativo'])){
            if($this->vagasModel->register($data)){
                $this->view('vagas/index');
            }
        } else {
            die("Ops!Algo deu errado");
        }

    }

}
?>