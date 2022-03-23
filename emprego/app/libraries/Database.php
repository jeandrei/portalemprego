<?php
/**
 * PDO Database Class
 * Connect to database
 * Create prepared statemants
 * Bind values
 * Retun rows and results
 */

 class Database { 
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //toda vez que preparamos um a sql vamos usar o dbh
    private $dbh;
    private $stmt;
    private $error;
    //tabela a ser manipulação pelo query builder que monta instrução sql
    private $table; 

    public function __construct($table = null) {       
        $this->table = $table;
        $this->setConnection();        
       
    }

    //Método responsável por criar uma conexão como banco de dados
    private function setConnection(){         
        // Set DSN DATABASE SERVER NAME
         $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;       
         $options = array(
             // persistent connections increase performance checking the connection to the database
             PDO::ATTR_PERSISTENT => true,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         );
     
         // Ceate PDO instance
         try{
             $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
             $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         } catch(PDOException $e){
             $this->error = $e->getMessage();
             echo $this->error;
         }
    }


    //Método responsável por inserir dados no banco
    //Retorna o id inserido
    public function insert($values){        
        //DADOS DA QUERY array_keys traz as chaves de um array
        $fields = array_keys($values); 
        //array_pad cria um array com x posições
        //caso não tenha o número de posições desejadas o array_pad
        //cria colocando o valor que queremos
        //exemplo array_pad([], 3, '?'). iria criar um array de 
        //3 posições todos com ? dentro
        //logo na linha abaixo estamos criando um array com o número
        //de posições constantes no array $field, logo se no array
        //$field tiver 3 posições irá criar um arrai com ?,?,?
        $binds = array_pad([], count($fields),'?');        
        //MONTA A QUERY
        //implode pega os valores do array $fields e separa com virgula
        $query = 'INSERT INTO ' .$this->table. ' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        //executa o insert
        $this->execute($query,array_values($values));

        //Retorna o id inserido
        return $this->dbh->lastInsertId();
    }


     // Prepare statement with query
     public function execute($query, $params = []) {        
        try{
            $this->stmt = $this->dbh->prepare($query);          
            $this->stmt->execute($params);
            return $this->stmt;
        } catch(PDOException $e){
             $this->error = $e->getMessage();             
         }
        
    }

    //Método responsável por executar uma consulta no banco
    public function select($where = null, $order = null, $limit = null){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $where = strlen($order) ? 'ORDER BY '.$order : '';
        $where = strlen($limit) ? 'LIMIT '.$limit : '';
        $query = 'SELECT * FROM '.$this->table.' '.$where.' '.$order. ' '. $limit;
    }



    // Prepare statement with query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values
     public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;                                 
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statemant
    public function execute_antiga(){
        return $this->stmt->execute();
    }

    //Get result set as array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get a single record as object
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}