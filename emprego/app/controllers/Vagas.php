<?php

    class Vagas extends Controller{
        public function __construct(){
            $this->vagasModel = $this->model('Vaga');
        }
   

    public function index(){

        $data = [
            'title' => 'Vagas',
            'vagas' =>  $this->vagasModel->getVagas()       
        ];       

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
                flash('vagas', 'Cadastro realizado com sucesso!', 'alert alert-success'); 
                redirect('vagas/index');
            }
        } else {
            die("Ops!Algo deu errado");
        }

    }



    public function edit($id){

         //VALIDAÇÃO DO ID
        if(!is_numeric($id)){
            flash('vagas', 'Id inválido!', 'alert alert-danger'); 
            $this->view('vagas/index');
            exit();
        }

        
        //Verifica se a requisição é de método POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){           
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'titulo' => trim($_POST['titulo']),
                'descricao' => trim($_POST['descricao']),
                'ativo' => trim($_POST['ativo'])
            ];

            $this->vagasModel->update($data);            
            redirect('vagas/index');

        } else {
            if($data = $this->vagasModel->getVaga($id)){               
                $this->view('vagas/edit',$data);
            } else {
                flash('vagas', 'Id inválido!', 'alert alert-danger'); 
                $this->view('vagas/index');
            }
            
        }       

    }

    public function delete($id){

        //VALIDAÇÃO DO ID
       if(!is_numeric($id)){
           flash('vagas', 'Id inválido!', 'alert alert-danger'); 
           $this->view('vagas/index');
           exit();
       }
       
       if(isset($_POST['delete'])){
            $this->vagasModel->delete($id);
            flash('vagas', 'Vaga excluida com sucessso!', 'alert alert-success'); 
            redirect('vagas/index');
       }else{
        $data=['id'=>$id];
        $this->view('vagas/confirm',$data);
        exit();
       }     
   }







   
}
?>