<?php


class Produkt_Kategorie
{
    static function get($id_produkt){
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * FROM produkt_kategorie pk JOIN kategorie k on pk.id_kategorie = k.id_kategorie where pk.id_produkt = :id_produkt");
        $stmt->bindParam(":id_produkt", $id_produkt, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function insert($id_kategorie, $id_produkt)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("INSERT INTO produkt_kategorie (id_produkt, id_kategorie) VALUES (:id_produkt, :id_kategorie)");
            $stmt->bindParam(":id_produkt", $id_produkt, PDO::PARAM_INT);
            $stmt->bindParam(":id_kategorie", $id_kategorie, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            return $exception;
        }
    }

    static function delete($id_kategorie, $id_produkt)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("DELETE FROM produkt_kategorie where id_kategorie = :id_kategorie AND id_produkt = :id_produkt");
            $stmt->bindParam(":id_produkt", $id_produkt, PDO::PARAM_INT);
            $stmt->bindParam(":id_kategorie", $id_kategorie, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            return $exception;
        }
    }
}