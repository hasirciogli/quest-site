<?php

namespace CONTROLLERS;
use PDO;
class categoryController extends \DATABASE\FFDatabaseInternal
{

    public function addCategory($name, $code)
    {
        $db = $this->init();

        if ($db) {


            $v = $db->connection->prepare("SELECT * FROM categories WHERE category_code='" . $code . "'");
            $v2 = $v->execute([]);
            $v3 = $v->fetchAll(PDO::FETCH_ASSOC);

            if ($v->rowCount() > 0) {
                return [false, "Code allready defined"];
            }

            $v = $db->connection->prepare("INSERT INTO categories (category_name, category_code) VALUES ('" . $name . "', '" . $code . "')");
            try {
                $v2 = $v->execute([]);
            } catch (Exception $e) {
                return [false, $e];
            }


            if ($v2)
                return [true, "Successfully added to database..."];
            else
                return [false, "null hata"];
        } else
            return [false, "null hata"];
    }

    public static function cfun()
    {
        return new categoryController();
    }

}