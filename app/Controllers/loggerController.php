<?php

namespace CONTROLLERS;
use DATABASE\FFDatabase;
use PDO;
class categoryController extends \DATABASE\FFDatabaseInternal
{
    public function getIp(){
            if (!empty($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip	= $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip	= $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else{
                $ip	= $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
    }
    public function addIpLog(){
        $ip = $this->getIp();

        //FFDatabase::cfun()->insert("logs", [[""]]);
    }
    public static function cfun()
    {
        return new categoryController();
    }

}