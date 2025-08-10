<?php

class Database
{
    private static $instance = null;
    private $connection = null;
    
    private function __construct()
    {
        $this->connect();
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function connect()
    {
        $app = App::getInstance();
        $config = $app->config('database');
        
        try {
            $this->connection = new mysqli(
                $config['host'],
                $config['username'], 
                $config['password'],
                $config['database']
            );
            
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset($config['charset']);
            
            // Initialize database table if needed
            $this->initializeTable();
            
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }
    
    private function initializeTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS trading_journal_entries (
                id VARCHAR(255) PRIMARY KEY,
                market ENUM('XAUUSD', 'EU', 'GU') NOT NULL,
                session ENUM('LO', 'NY', 'AS') NOT NULL,
                date DATE NOT NULL,
                time TIME NULL,
                direction ENUM('LONG', 'SHORT') NOT NULL,
                entry_price DECIMAL(10, 5) NULL,
                exit_price DECIMAL(10, 5) NULL,
                outcome ENUM('W', 'L', 'BE', 'C') NULL,
                pl_percent DECIMAL(8, 2) NULL,
                rr DECIMAL(8, 2) NULL,
                tf JSON NULL,
                chart_htf TEXT NULL,
                chart_ltf TEXT NULL,
                comments TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_date (date),
                INDEX idx_market (market),
                INDEX idx_session (session),
                INDEX idx_outcome (outcome)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        if (!$this->connection->query($sql)) {
            error_log("Error creating table: " . $this->connection->error);
        }
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
    
    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
    
    public function query($sql)
    {
        return $this->connection->query($sql);
    }
    
    public function escape($value)
    {
        return $this->connection->real_escape_string($value);
    }
    
    public function getLastInsertId()
    {
        return $this->connection->insert_id;
    }
    
    public function getAffectedRows()
    {
        return $this->connection->affected_rows;
    }
    
    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
    
    public function __destruct()
    {
        $this->close();
    }
}