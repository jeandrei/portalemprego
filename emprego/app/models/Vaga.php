<?php
    class Vaga{
        private $db;
        // Identificador único da vaga         
        public $id;

        // Título da vaga
        public $titulo;

        //Descrição da vaga
        public $descricao;

        //Define se a aga está ativa
        //string(s/n)
        public $ativo;

        //Data de publicação da vaga 
        //tipo string
        public $data;
        
        //instancia o bd
        public function __construct(){
            //vagas é a tabela que vou trabalhar para poder usar sqlbuilder
            $this->db = new Database('vagas');            
        }
        
        /**
         * Método responsável por cadastrar uma nova vaga no banco
         * retorna boolean
         */
        public function register($data){          
            //DEFINIR A DATA
            $this->data = date('Y-m-d H:i:s');
            //insere no banco retornando o id inserido
            $this->id = $this->db->insert([
                'titulo'    => $data['titulo'],
                'descricao' => $data['descricao'],
                'ativo'     => $data['ativo'],
                'data'      => $this->data
            ]);
            

            //INSERIR A VAGA NO BANCO
            
            
            //ATRIBUIR O ID DA VAGA NA INSTANCIA

            //RETORNAR SUCESSO
            return true;   
        }
    }
?>