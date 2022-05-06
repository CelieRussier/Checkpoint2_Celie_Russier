<?php

namespace App\Model;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function insert(array $accessory): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name, url) 
        VALUES (:name, :url)");

        $statement->bindValue('name', $accessory['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $accessory['url'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function listAllAccessories(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
