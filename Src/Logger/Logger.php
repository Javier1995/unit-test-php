<?php
namespace App\Logger;

use App\Helpers\App;
use ReflectionClass;
use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgument;

class Logger implements LoggerInterface {
    
   
    public function debug(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }
    
    public function info(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }
    
    public function notice(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }
    
    public function warning(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }
    
    public function error(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::ERROR, $message, $context);
    }
    
    public function critical(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }
    
    public function alert(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }
    
    public function emergency(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }
    
    public function log(string $level, string $message ,array $context = [])
    {
        $object = new ReflectionClass(LogLevel::class);
        $validLogLevels = $object->getConstants();

        if(!in_array( $level, $validLogLevels )){
            throw new InvalidLogLevelArgument($level, $validLogLevels);
        }

        $this->addRecord($level, $message, $context);
    }
        

    private function addRecord(
            string $level, 
            string $message, 
            array $context = []
        ){
        $application = new App;
        $date = $application->getServerTime()->format('Y-m-d H:i:s');
        $logPath = $application->getLogPath();
        $env = $application->getEnvironment();
        $details = sprintf(
            "%s - Level: %s - Message: %s - Context: %s",
            $date, $level, $message, json_encode($context)
        ).PHP_EOL;

        $fileName = sprintf("%s/%s-%s.log", $logPath, $env, date("j.h.Y"));

        file_put_contents($fileName,$details, FILE_APPEND);
        
    }
    

}