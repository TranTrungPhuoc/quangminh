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

    public function getList($table='', $sort='sort', $value_sort='ASC', $limit=100): array
    {
        $newTable = ($table != '') ? $table : $this->table;
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$newTable.'" ORDER BY '.$sort.' '.$value_sort. ' LIMIT '.$limit);
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetail($table='', $id=''): array
    {
        $newTable = ($table != '') ? $table : $this->table;
        $newId = ($id != '') ? $id : $this->getId();
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$newTable.'" WHERE id='.$newId);
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetailSlug($table='', $slug=''): array
    {
        $newTable = ($table != '') ? $table : $this->table;
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$newTable.'" WHERE slug='."'".$slug."'");
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkEmail(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" WHERE status=TRUE AND email=\'' . $this->getEmail() . '\'');
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkLogin(): array
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "public"."'.$this->table.'" WHERE email='.$this->getEmail().' AND password='.$this->getPassword().' AND status='.$this->getStatus());
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
            $queryPrepared = $this->pdo->prepare('INSERT INTO "public"."'.$this->table.'" ('.$columnString.') VALUES ('.$valueString.')');
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

    public function sort() {
        $queryPrepared = $this->pdo->prepare('UPDATE "public"."'.$this->table.'" SET sort='.$this->getSort().' WHERE id='.$this->getId());
        $queryPrepared->execute();
    }
}