<?php

class TradingJournal
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function getAllEntries()
    {
        $sql = "SELECT * FROM trading_journal_entries ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        
        if (!$result) {
            error_log("Error fetching entries: " . $this->db->getConnection()->error);
            return [];
        }
        
        $entries = [];
        while ($row = $result->fetch_assoc()) {
            $entries[] = $this->formatEntry($row);
        }
        
        return $entries;
    }
    
    public function getEntry($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM trading_journal_entries WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $this->formatEntry($row);
        }
        
        return null;
    }
    
    public function addEntry($data)
    {
        $id = $this->generateId();
        $createdAt = date('Y-m-d H:i:s');
        
        $sql = "
            INSERT INTO trading_journal_entries (
                id, market, session, date, time, direction,
                entry_price, exit_price, outcome, pl_percent, rr,
                tf, chart_htf, chart_ltf, comments
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        
        $stmt = $this->db->prepare($sql);
        
        $tf = !empty($data['tf']) ? json_encode($data['tf']) : null;
        
        $stmt->bind_param("ssssssddsddssss",
            $id,
            $data['market'],
            $data['session'],
            $data['date'],
            $data['time'] ?? null,
            $data['direction'],
            $data['entryPrice'] ?? null,
            $data['exitPrice'] ?? null,
            $data['outcome'] ?? null,
            $data['plPercent'] ?? null,
            $data['rr'] ?? null,
            $tf,
            $data['chartHtf'] ?? null,
            $data['chartLtf'] ?? null,
            $data['comments'] ?? null
        );
        
        if ($stmt->execute()) {
            return array_merge($data, [
                'id' => $id,
                'createdAt' => $createdAt
            ]);
        }
        
        throw new Exception("Failed to save entry to database: " . $stmt->error);
    }
    
    public function updateEntry($id, $updates)
    {
        $setClause = [];
        $values = [];
        $types = "";
        
        $allowedFields = [
            'market' => 's',
            'session' => 's', 
            'date' => 's',
            'time' => 's',
            'direction' => 's',
            'entryPrice' => 'd',
            'exitPrice' => 'd',
            'outcome' => 's',
            'plPercent' => 'd',
            'rr' => 'd',
            'tf' => 's',
            'chartHtf' => 's',
            'chartLtf' => 's',
            'comments' => 's'
        ];
        
        $fieldMapping = [
            'entryPrice' => 'entry_price',
            'exitPrice' => 'exit_price',
            'plPercent' => 'pl_percent',
            'chartHtf' => 'chart_htf',
            'chartLtf' => 'chart_ltf'
        ];
        
        foreach ($updates as $field => $value) {
            if (array_key_exists($field, $allowedFields)) {
                $dbField = $fieldMapping[$field] ?? $field;
                
                if ($field === 'tf' && !empty($value)) {
                    $value = json_encode($value);
                } elseif (in_array($field, ['entryPrice', 'exitPrice', 'plPercent', 'rr']) && $value === '') {
                    $value = null;
                }
                
                $setClause[] = "$dbField = ?";
                $values[] = $value;
                $types .= $allowedFields[$field];
            }
        }
        
        if (empty($setClause)) {
            return null;
        }
        
        $sql = "UPDATE trading_journal_entries SET " . implode(', ', $setClause) . " WHERE id = ?";
        $values[] = $id;
        $types .= "s";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            return $this->getEntry($id);
        }
        
        return null;
    }
    
    public function deleteEntry($id)
    {
        $stmt = $this->db->prepare("DELETE FROM trading_journal_entries WHERE id = ?");
        $stmt->bind_param("s", $id);
        
        return $stmt->execute() && $stmt->affected_rows > 0;
    }
    
    private function formatEntry($row)
    {
        return [
            'id' => $row['id'],
            'market' => $row['market'],
            'session' => $row['session'],
            'date' => $row['date'],
            'time' => $row['time'],
            'direction' => $row['direction'],
            'entryPrice' => $row['entry_price'] ? (float)$row['entry_price'] : null,
            'exitPrice' => $row['exit_price'] ? (float)$row['exit_price'] : null,
            'outcome' => $row['outcome'],
            'plPercent' => $row['pl_percent'] ? (float)$row['pl_percent'] : null,
            'rr' => $row['rr'] ? (float)$row['rr'] : null,
            'tf' => $row['tf'] ? json_decode($row['tf'], true) : null,
            'chartHtf' => $row['chart_htf'],
            'chartLtf' => $row['chart_ltf'],
            'comments' => $row['comments'],
            'createdAt' => $row['created_at']
        ];
    }
    
    private function generateId()
    {
        return time() . substr(md5(mt_rand()), 0, 8);
    }
}