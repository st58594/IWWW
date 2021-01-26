<?php


class Polozka
{
    static function getAll($id_objednavka){
        $stmt = Pripojeni::getPdoInstance()->prepare("Select polozka.mnozstvi, polozka.cena, produkt.nazev, id_objednavka, produkt.id_produkt from polozka join produkt on polozka.id_produkt = produkt.id_produkt where id_objednavka = :id_objednavka");
        $stmt->bindParam(":id_objednavka", $id_objednavka, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}