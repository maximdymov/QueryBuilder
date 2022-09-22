<?php

class QueryBuilder
{
    private PDO $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($table, $data)
    {
        $stringKeys = implode(", ", array_keys($data));
        $stringValues = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($stringKeys) VALUES ($stringValues)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function getOne($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $id)
    {
        $dataKeys = array_keys($data);
        $str = '';

        foreach ($dataKeys as $key) {
            $str .= $key . "=:" . $key . ",";
        }

        $keys = rtrim($str, ",");
        $sql = "UPDATE $table SET $keys WHERE id=:id";
        $data['id'] = $id;

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    }
}