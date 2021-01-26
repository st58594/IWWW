<?php


class Produkt
{
    static function getAll()
    {
        $conn = Pripojeni::getPdoInstance();
        if (!empty($_SESSION["filtr"]) || !empty($_SESSION["id_umelec"])) {
            $id_kategorii = implode(",", $_SESSION["filtr"]);
            if (empty($_SESSION["filtr"])) { // zobraz bez filtru umelcuv katalog
                $stmt = $conn->prepare("SELECT DISTINCT(p.id_produkt), p.*, k.id_umelec FROM produkt p JOIN katalog k on p.id_produkt = k.id_produkt WHERE k.id_umelec = :id_umelec");
                $stmt->bindParam("id_umelec", $_SESSION["id_umelec"], PDO::PARAM_INT);

            } elseif (empty($_SESSION["id_umelec"])) {
                $stmt = $conn->prepare("SELECT DISTINCT(p.id_produkt), p.*, k.id_umelec FROM produkt p JOIN katalog k on p.id_produkt = k.id_produkt JOIN produkt_kategorie pk on pk.id_produkt = p.id_produkt WHERE pk.id_kategorie in ($id_kategorii)");
            } else {
                $stmt = $conn->prepare("SELECT DISTINCT(p.id_produkt), p.*, k.id_umelec FROM produkt p JOIN katalog k on p.id_produkt = k.id_produkt JOIN produkt_kategorie pk on pk.id_produkt = p.id_produkt WHERE pk.id_kategorie in ($id_kategorii) AND k.id_umelec = :id_umelec");
                $stmt->bindParam("id_umelec", $_SESSION["id_umelec"], PDO::PARAM_INT);
            }
        } else {
            $stmt = $conn->prepare("SELECT * from produkt p JOIN katalog k on p.id_produkt = k.id_produkt");
        }

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
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function insert($id_umelec, $nazev, $cena, $mnozstvi, $nahled, $popis)
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

    static function update($id, $nazev, $cena, $mnozstvi, $popis)
    {
        try {
            $conn = Pripojeni::getPdoInstance();
            $stmt = $conn->prepare("UPDATE produkt SET nazev = :nazev, cena = :cena, mnozstvi = :mnozstvi , popis = :popis WHERE id_produkt = :id ");
            $stmt->bindParam(":nazev", $nazev);
            $stmt->bindParam(":cena", $cena);
            $stmt->bindParam(":mnozstvi", $mnozstvi, PDO::PARAM_INT);
            $stmt->bindParam(":popis", $popis);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function updateMnozstvi($minus, $id_produkt)
    {
        try {
            $conn = Pripojeni::getPdoInstance();
            $produkt = Produkt::get($id_produkt);
            $mnozstvi = (int)$produkt["mnozstvi"] - (int)$minus;
            if ($mnozstvi < 0) throw new PDOException("Produkt ".$produkt["nazev"]." neni ".$minus."x na sklade, poslednich ".$produkt["mnozstvi"]. " kusu");

            $stmt = $conn->prepare("UPDATE produkt SET  mnozstvi = :mnozstvi WHERE id_produkt = :id ");
            $stmt->bindParam(":mnozstvi", $mnozstvi, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id_produkt, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function delete($id)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("DELETE FROM produkt where id_produkt = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}