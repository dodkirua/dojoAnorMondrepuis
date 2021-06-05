<?php


namespace Model\Manager;


use Model\DB;
use Model\Entity\Address;
use PDOStatement;

class AddressManager extends Manager{
    /**
     * return a Address by id
     * @param int $id
     * @return Address|null
     */
    public static function getById (int $id) : ?Address{
        $request = DB::getInstance()->prepare("SELECT * FROM address where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request);
    }

    /**
     * return a array with all the address
     * @return array
     */
    public static function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM address");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Address(intval($datum['id']), intval($datum['num']), $datum['street'],
                        intval($datum['zip_code']), $datum['city'], $datum['country'], $datum['add']);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $num
     * @param string|null $street
     * @param int|null $zip
     * @param string|null $city
     * @param string|null $country
     * @param string|null $add
     * @return bool
     */
    public static function update(int $id, int $num = null, string $street = null, int $zip = null, string $city =null,
                    string $country = null, string $add = null) : bool{
        if (is_null($num) || is_null($street) || is_null($zip) || is_null($city) || is_null($country) || is_null($add)) {
            $data = self::getById($id);
            if (is_null($num)) {
                $num = $data->getNum();
            }
            if (is_null($street)) {
                $street = $data->getStreet();
            }
            if (is_null($zip)) {
                $zip = $data->getZip();
            }
            if (is_null($city)) {
                $city = $data->getCity();
            }
            if (is_null($country)) {
                $country = $data->getCountry();
            }
            if (is_null($add)) {
                $add = $data->getAdd();
            }
        }
        $request = DB::getInstance()->prepare("UPDATE address
                    SET num = :num, street = :street, zip_code = :zip, city = :city, country = :country, `add` = :add
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":num",$num);
        $request->bindValue(":street",mb_strtolower($street));
        $request->bindValue(":zip",$zip);
        $request->bindValue(":city",mb_strtolower($city));
        $request->bindValue(":country",mb_strtolower($country));
        $request->bindValue(":add",mb_strtolower($add));

        return $request->execute();
    }

    /**
     * insert address in DB
     * @param int $num
     * @param string $street
     * @param int $zip
     * @param string $city
     * @param string $country
     * @param string|null $add
     * @return bool
     */
    public static function add(int $num , string $street, int $zip , string $city, string $country, string $add = null) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO address 
        (num, street, zip_code, city, country, `add`)
        VALUES (:num, :street, :zip_code, :city, :country, :add)
        ");
        $request->bindValue(":num",$num);
        $request->bindValue(":street",mb_strtolower($street));
        $request->bindValue(":zip",$zip);
        $request->bindValue(":city",mb_strtolower($city));
        $request->bindValue(":country",mb_strtolower($country));

        if (is_null($add)) {
            $request->bindValue(":add", null);
        }
        else {
            $request->bindValue(":add", mb_strtolower($add));
        }

        return $request->execute();
    }

    /**
     * delete address by id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM address WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Address|null
     */
    private static function getOne(PDOStatement $request ) : ?Address {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new Address (intval($data['id']), intval($data['num']), $data['street'], intval($data['zip_code']),
                $data['city'], $data['country'], $data['add']);
        }
        return null;
    }

}