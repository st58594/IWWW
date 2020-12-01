<?php


class Products
{
    static function getAll() : array {
        $stmt = Connection::getPdoInstance()->prepare("select * from products");
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    static function getBy($productId): array{
        $stmt = Connection::getPdoInstance()->prepare("select * from products where id = :id");
        $stmt -> bindParam(":id", $productId);
        $stmt -> execute();
        return $stmt->fetch();
    }

}