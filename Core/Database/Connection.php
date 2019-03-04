<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:58 AM
 */

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
    /**
     * @return PDO
     */
    public static function make()
    {
        $config = app()->get('config')['database'];

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