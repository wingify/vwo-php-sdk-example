<?php
require_once('vendor/autoload.php');
use vwo\Logger\LoggerInterface;

/**
 * Class CustomLogger
 */
Class CustomLogger implements LoggerInterface{

    /**
     * @param $message
     * @param $level
     * @return string
     */
    public function addLog($message,$level){
        //do code for writing logs to your files/databases
        //throw new Exception('my test');
        //return $x;

    }

}


