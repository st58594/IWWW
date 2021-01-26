<?php


class Objednavka
{
    static function getAll($id_umelec){
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * FROM objednavka o join zakaznik z on z.email = o.email_zakaznik where id_umelec = :id_umelec order by stav, datum_objednani ASC ");
        $stmt->bindParam(":id_umelec", $id_umelec);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function insert($arr, $email, $jmeno, $prijmeni, $adresa, $mobil, $celkova_cena, $id_umelec){
        try {
            $conn = Pripojeni::getPdoInstance();
            $conn->beginTransaction();
            if (Zakaznik::get($email)){
                Zakaznik::update($email, $jmeno, $prijmeni, $adresa, $mobil);
            }else{
                Zakaznik::insert($email, $jmeno, $prijmeni, $adresa, $mobil);
            }

            $objednavka = $conn->prepare("INSERT INTO objednavka (datum_objednani, celkova_cena, id_umelec, email_zakaznik) VALUES (NOW(), :celkova_cena, :id_umelec, :email_zakaznik)");
            $objednavka->bindParam(":celkova_cena", $celkova_cena);
            $objednavka->bindParam(":id_umelec", $id_umelec);
            $objednavka->bindParam(":email_zakaznik", $email);
            $objednavka->execute();
            $id_objednavka = $conn->lastInsertId();

            $polozka = $conn->prepare("INSERT INTO polozka (cena, mnozstvi, id_produkt, id_objednavka) VALUES (:cena, :mnozstvi, :id_produkt, :id_objednavka)");
            $polozka->bindParam(":id_objednavka", $id_objednavka);
            foreach ($arr as $key=>$value) {
                $produkt = Produkt::get($key);
                $polozka->bindParam(":id_produkt", $produkt["id_produkt"]);
                $polozka->bindParam(":mnozstvi", $value["amount"]);
                $polozka->bindParam(":cena", $produkt["cena"]);
                Produkt::updateMnozstvi($value["amount"],$produkt["id_produkt"]);
                $polozka->execute();
            }
            $conn->commit();
        }catch (PDOException $exception){
            $conn->rollBack();
            throw $exception;
        }
    }

    static function updateStav($stav, $id_objednavky){
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("UPDATE objednavka SET stav = :stav, datum_zmeny = NOW() where id_objednavka = :id_objednavky");
            $stmt -> bindParam(":stav", $stav);
            $stmt ->bindParam(":id_objednavky", $id_objednavky);
            $stmt->execute();
        }catch (PDOException $exception){
            throw $exception;
        }
    }
}