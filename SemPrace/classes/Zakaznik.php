<?php


class Zakaznik
{
    static function get($email): bool
    {
        $stmt = Pripojeni::getPdoInstance()->prepare("SELECT * FROM zakaznik where email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() != 0;
    }

    static function insert($email, $jmeno, $prijmeni, $adresa, $mobil)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("INSERT INTO zakaznik (email, jmeno, prijmeni, adresa, mobil) VALUES (:email, :jmeno, :prijmeni, :adresa, :mobil)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":jmeno", $jmeno);
            $stmt->bindParam(":prijmeni", $prijmeni);
            $stmt->bindParam(":adresa", $adresa);
            $stmt->bindParam(":mobil", $mobil);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function update($email, $jmeno, $prijmeni, $adresa, $mobil)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare("UPDATE zakaznik SET email = :email, jmeno = :jmeno, prijmeni = :prijmeni, adresa = :adresa, mobil = :mobil");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":jmeno", $jmeno);
            $stmt->bindParam(":prijmeni", $prijmeni);
            $stmt->bindParam(":adresa", $adresa);
            $stmt->bindParam(":mobil", $mobil);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

}