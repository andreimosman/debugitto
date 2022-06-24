<?php

namespace AndreiMosman\Debugitto;

Class Debugitto
{

    // Not assigned to any other particular service
    // According https://en.wikipedia.org/wiki/List_of_TCP_and_UDP_port_numbers
    const DEFAULT_PORT = 9900; 

    private $host = 'host.docker.internal';
    private $port = self::DEFAULT_PORT;

    private $enabled = false;
    private $conn;

    private static $instance;

    private function __construct()
    {

    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        if( $this->conn ) fclose( $this->conn );
    }

    public static function getInstance()
    {

        if( !isset(self::$instance) ) 
        {
            self::$instance = new self();
        }

        return self::$instance;

    }

    private function enableDebug()
    {
        $this->enabled = true;
    }

    public function setRemote($host,$port)
    {

        if( $host ) $this->host = $host;
        if( $port ) $this->port = $port;
        
        if( $this->conn ) fclose($conn);
    }

    public static function enable($host='host.docker.internal',$port=9900)
    {
        self::getInstance()->setRemote($host,$port);
        self::getInstance()->enableDebug();
    }

    private function getConn()
    {
        if( $this->conn ) return $this->conn;
        $this->conn = @fsockopen($this->host,$this->port);
        return $this->conn;
    }

    public static function isConnected()
    {
        return self::getInstance()->getConn() !== false;
    }

    private function send($data)
    {
        if( !$this->enabled ) return;
        $conn = $this->getConn();
        if( $conn ) fwrite($conn,$data); 
    }

    private function print_r($data)
    {
        $this->send( print_r($data, true) . "\n" );
    }

    public static function output($data)
    {
        self::getInstance()->send($data);
    }

    public static function d($data)
    {
        self::getInstance()->print_r($data);
    }

}
