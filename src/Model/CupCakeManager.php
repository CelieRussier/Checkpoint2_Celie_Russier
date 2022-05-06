<?php

namespace App\Model;

class CupCakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public const TABLE_ACCESSORY = 'Accessory';

    public function insert(array $cupcake): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Name, color1, color2, color3, accessory_id) 
        VALUES (:Name, :color1, :color2, :color3, :accessory_id)");

        $statement->bindValue('Name', $cupcake['Name'], \PDO::PARAM_STR);
        $statement->bindValue('color1', $cupcake['color1'], \PDO::PARAM_STR);
        $statement->bindValue('color2', $cupcake['color2'], \PDO::PARAM_STR);
        $statement->bindValue('color3', $cupcake['color3'], \PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $cupcake['accessory_id'], \PDO::PARAM_STR);

        $statement->execute();
    }

    public function listAllCupcakes(string $orderBy = 'Cupcake.Id', string $direction = 'DESC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE .
        ' INNER JOIN ' . static::TABLE_ACCESSORY . ' ON cupcake.accessory_id = Accessory.Id';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll();
    }
}
