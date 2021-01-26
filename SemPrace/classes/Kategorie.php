<?php


class Kategorie
{
    static function getAll()
    {
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * from kategorie");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function get($id_produkt, $id_kategorie): bool
    {
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * from produkt_kategorie where id_produkt = :id_produkt AND id_kategorie = :id_kategorie");
        $stmt->bindParam(":id_produkt", $id_produkt, PDO::PARAM_INT);
        $stmt->bindParam(":id_kategorie", $id_kategorie, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() != 0;
    }

    static function insert($nazev)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("INSERT INTO kategorie (nazev) VALUES (:nazev)");
            $stmt->bindParam(":nazev", $nazev);
            $stmt->execute();
        } catch (PDOException $exception) {
            return $exception;
        }
    }

    static function update($id, $nazev)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("UPDATE kategorie set nazev = :nazev where id_kategorie = :id");
            $stmt->bindParam(":nazev", $nazev);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            return $exception;
        }
    }

    static function delete($id)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("DELETE FROM kategorie where id_kategorie = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            return $exception;
        }
    }
}