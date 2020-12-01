<?php


class Orders
{
     static function createOrder($userID, $arr){
        $stmt = Connection::getPdoInstance()->prepare("Insert into orders (users_fk)value (:userID)");
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();
        $orderID = Connection::getPdoInstance()->lastInsertId();
        $stmt = Connection::getPdoInstance()->prepare("Insert into cart (orders_fk, products_fk, amount, price)
                                                                    value (:orderID, :productID, :amount, :price)");
        foreach ($arr as $key=>$value) {
            $item = Products::getBy($key);
            $stmt->bindParam(":orderID", $orderID);
            $stmt->bindParam(":productID", $item["id"]);
            $stmt->bindParam(":amount", $value["amount"]);
            $stmt->bindParam(":price", $item["price"]);
            $stmt->execute();
        }

    }
    static function getOrders($userID): array
    {
        $stmt = Connection::getPdoInstance()->prepare("Select * from orders where users_fk= :userID");
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getOrderCart($orderID): array
    {
        $stmt = Connection::getPdoInstance()->prepare(
            "SELECT p.name, c.price, p.img, c.amount FROM cart c
            join products p on p.id = c.products_fk
            WHERE c.orders_fk = :orderID");
        $stmt->bindParam(":orderID", $orderID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}