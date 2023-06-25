<?php
namespace App\Core;

abstract class Sql{

    private $pdo;
    private $table;

    public function __construct(){
        //Mettre en place un SINGLETON
        try{
            $this->pdo = new \PDO("pgsql:host=database;port=5432;dbname=esgi" , "esgi" , "Test1234" );
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = "esgi_".$this->table;
    }

    public function getList(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" ORDER BY id DESC');
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetail(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" WHERE id='.$this->getId());
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkEmail(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" WHERE email=\'' . $this->getEmail() . '\'');
        // print_r($queryPrepared);die;
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // public function checkEmail(): array
    // {
    //     $query = 'SELECT * FROM public."' . $this->table . '" WHERE email = :email';
        
    //     $stmt = $this->pdo->prepare($query);

    //     $stmt->bindParam(':email', $this->getEmail(), \PDO::PARAM_ARRAY);
    //     $stmt->execute();
        
    //     $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    //     return $result;
    // }


    public function checkLogin(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" WHERE email='.$this->getEmail().' AND password='.$this->getPassword().' AND status='.$this->getStatus());
        
        print_r($queryPrepared);
        die;
        
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);

        $columnsToDeleted =get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);

        if(is_numeric($this->getId()) && $this->getId()>0)
        {
            $columnsUpdate = [];
            foreach ($columns as $key=>$value) { $columnsUpdate[]= $key."=:".$key; }
            $queryPrepared = $this->pdo->prepare('UPDATE "public"."'.$this->table.'" SET '.implode(",",$columnsUpdate).' WHERE id='.$this->getId());
        }else{
            $columnString = implode(',', array_keys($columns));
            $valueString = implode(',', array_fill(0, count($columns), '?'));
            // print_r($columns);die;
        // print_r(array_values($columns));
        // die;
            $queryPrepared = $this->pdo->prepare('INSERT INTO "public"."'.$this->table.'" ('.$columnString.') VALUES ('.$valueString.')');
            // print_r($queryPrepared);die;
        }
        $queryPrepared->execute(array_values($columns));
    }

    public function delete() {
        $queryPrepared = $this->pdo->prepare('DELETE FROM "public"."'.$this->table.'" WHERE id='.$this->getId());
        $queryPrepared->execute();
    }

    public function status() {
        $queryPrepared = $this->pdo->prepare('UPDATE "public"."'.$this->table.'" SET status='.$this->getStatus().' WHERE id='.$this->getId());
        $queryPrepared->execute();
    }
}