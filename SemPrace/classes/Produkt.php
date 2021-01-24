<?php


class Produkt
{
    static function getAll()
    {
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * from produkt");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function get($id)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * from produkt where id_produkt = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() < 1) throw new PDOException("Zadny takovy produkt neni");
            return $stmt->fetch();

        }catch (PDOException $exception){
            throw $exception;
        }
    }

    static function insert($id_umelec, $nazev , $cena, $mnozstvi, $nahled, $popis)
    {
        try {
            $conn = Pripojeni::getPdoInstance();
            $stmt = $conn->prepare("INSERT INTO produkt (nazev, cena, mnozstvi, nahled, popis) VALUES (:nazev, :cena, :mnozstvi, :nahled, :popis)");
            $stmt->bindParam(":nazev", $nazev);
            $stmt->bindParam(":cena", $cena);
            $stmt->bindParam(":mnozstvi", $mnozstvi, PDO::PARAM_INT);
            $stmt->bindParam(":nahled", $nahled, PDO::PARAM_LOB);
            $stmt->bindParam(":popis", $popis);
            $conn->beginTransaction();
            $stmt->execute();
            //insert into katalog
            $id_produkt = $conn->lastInsertId();
            $stmt = $conn->prepare("INSERT INTO katalog (id_umelec, id_produkt) VALUES (:id_umelec, :id_produkt)");
            $stmt->bindParam("id_umelec", $id_umelec, PDO::PARAM_INT);
            $stmt->bindParam("id_produkt", $id_produkt, PDO::PARAM_INT);
            $stmt->execute();
            $conn->commit();
        } catch (PDOException $exception) {
            $conn->rollBack();
            throw $exception;
        }
    }

    static function update($id, $nazev , $cena, $mnozstvi, $popis)
    {
        try{
            $conn = Pripojeni::getPdoInstance();
            $stmt = $conn->prepare("UPDATE produkt SET nazev = :nazev, cena = :cena, mnozstvi = :mnozstvi , popis = :popis WHERE id_produkt = :id ");
            $stmt->bindParam(":nazev", $nazev);
            $stmt->bindParam(":cena", $cena);
            $stmt->bindParam(":mnozstvi", $mnozstvi, PDO::PARAM_INT);
            $stmt->bindParam(":popis", $popis);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $exception){
            throw $exception;
        }
    }

    static function delete($id){
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("DELETE FROM produkt where id_produkt = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}