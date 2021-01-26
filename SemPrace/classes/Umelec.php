<?php


class Umelec
{
    static function loginUmelec($login, $password)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('SELECT * FROM umelec WHERE login = :login && heslo = MD5(:password)');
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            if ($stmt->rowCount() == 0) throw new PDOException("Spatny login, nebo heslo");
            return $stmt->fetch();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function getAll()
    {
        $stmt = Pripojeni::getPdoInstance()->prepare('SELECT * FROM umelec');
        $stmt->execute();
        return $stmt->fetchALL();
    }

    static function getUmelec($id)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('SELECT * FROM umelec WHERE id_umelec = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() < 1) throw new PDOException("Takovy ucet neexistuje");
            return $stmt->fetch();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function insert($jmeno, $prijmeni, $email, $login, $heslo, $mobil)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('INSERT INTO umelec (jmeno, prijmeni, email, login, heslo, mobil) VALUES (:jmeno, :prijmeni, :email, :login, MD5(:heslo), :mobil)');
            $stmt->bindParam(':jmeno', $jmeno);
            $stmt->bindParam(':prijmeni', $prijmeni);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':heslo', $heslo);
            $stmt->bindParam(':mobil', $mobil);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function update($id, $jmeno, $prijmeni, $email, $login, $mobil)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('UPDATE umelec SET jmeno = :jmeno, prijmeni = :prijmeni, email = :email, login = :login, mobil = :mobil where id_umelec = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':jmeno', $jmeno);
            $stmt->bindParam(':prijmeni', $prijmeni);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':mobil', $mobil);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function updateHeslo($id, $heslo)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('UPDATE umelec SET  heslo = MD5(:heslo) where id_umelec = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':heslo', $heslo);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function updateOpravneni($id, $opraveni)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('UPDATE umelec SET  opravneni = :opravneni where id_umelec = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':opravneni', $opraveni);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function getAvatar($id)
    {
        try {
            $stmt = Pripojeni::getPdoInstance()->prepare('SELECT avatar FROM umelec WHERE id_umelec = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch()["avatar"];
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    static function updateAvatar($id, $avatar)
    {
        try {
            $conn = Pripojeni::getPdoInstance();
            $stmt = $conn->prepare("UPDATE umelec SET avatar = :avatar WHERE id_umelec = :id ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':avatar', $avatar, PDO::PARAM_LOB);
            $conn->beginTransaction();
            $stmt->execute();
            fclose($avatar);
            $conn->commit();
        } catch (PDOException $exception) {
            throw $exception;
        }

    }

}