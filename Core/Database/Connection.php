<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:58 AM
 */

class Connection
{
    /**
     * @param $config
     * @return PDO
     */
    public static function make($config)
    {
        try{
            return new PDO(
              $config['connection'].';dbname='.$config['name'],
              $config['username'],
              $config['password']
            );
        }catch (PDOException $exception){
            die($exception->getMessage());
        }
    }
}