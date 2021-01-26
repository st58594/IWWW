<?php


class Katalog
{
    static function getAll($id_umelec)
    {
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * FROM katalog k JOIN produkt p ON p.id_produkt = k.id_produkt WHERE id_umelec = :id_umelec");
        $stmt->bindParam(":id_umelec", $id_umelec, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();

    }
}