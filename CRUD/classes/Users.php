<?php


class Users
{
    static function getId($login): int{
        $stmt = Connection::getPdoInstance()->prepare("select * from uzivatele where login = :login");
        $stmt->bindParam(":login", $login);
        $stmt->execute();
        return $stmt->fetch()["id"];
    }
}