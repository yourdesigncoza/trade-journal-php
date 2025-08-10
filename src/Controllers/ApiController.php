<?php

class ApiController extends BaseController
{
    private $tradingJournal;
    
    public function __construct()
    {
        $this->handleCors();
        $this->tradingJournal = new TradingJournal();
    }
    
    public function getEntries()
    {
        try {
            $entries = $this->tradingJournal->getAllEntries();
            $this->jsonResponse(['success' => true, 'entries' => $entries]);
        } catch (Exception $e) {
            error_log("API Error: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'error' => 'Server error'], 500);
        }
    }
    
    public function getEntriesHtml()
    {
        try {
            $entries = $this->tradingJournal->getAllEntries();
            
            if (empty($entries)) {
                $html = '
                    <tr>
                        <td colspan="13" class="text-center py-4">
                            <i class="fas fa-chart-line fs-1 text-body-tertiary mb-3 d-block"></i>
                            <h6 class="text-body-secondary fs-7">No trades found</h6>
                            <p class="text-body-tertiary mb-0 fs-8">Start by adding your first trade entry above.</p>
                        </td>
                    </tr>';
            } else {
                // Include helper functions once
                include_once __DIR__ . '/../Views/components/trade-row-functions.php';
                
                ob_start();
                foreach ($entries as $trade) {
                    include __DIR__ . '/../Views/components/trade-row.php';
                }
                $html = ob_get_clean();
            }
            
            $this->jsonResponse(['success' => true, 'html' => $html]);
        } catch (Exception $e) {
            error_log("API HTML Error: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'error' => 'Server error'], 500);
        }
    }
    
    public function createEntry()
    {
        try {
            $data = $this->getJsonInput();
            
            if (!$data) {
                $this->jsonResponse(['success' => false, 'error' => 'Invalid JSON data'], 400);
                return;
            }
            
            // Validate required fields
            $required = ['market', 'session', 'date', 'direction'];
            $missing = $this->validateRequired($data, $required);
            
            if (!empty($missing)) {
                $this->jsonResponse([
                    'success' => false, 
                    'error' => 'Missing required fields: ' . implode(', ', $missing)
                ], 400);
                return;
            }
            
            // Sanitize input
            $data = $this->sanitizeInput($data);
            
            $newEntry = $this->tradingJournal->addEntry($data);
            
            $this->jsonResponse([
                'success' => true,
                'entry' => $newEntry,
                'storageType' => 'MySQL'
            ]);
            
        } catch (Exception $e) {
            error_log("API Create Error: " . $e->getMessage());
            $this->jsonResponse([
                'success' => false, 
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updateEntry()
    {
        try {
            $id = $_GET['id'] ?? null;
            
            if (!$id) {
                $this->jsonResponse(['success' => false, 'error' => 'ID required'], 400);
                return;
            }
            
            $data = $this->getJsonInput();
            
            if (!$data) {
                $this->jsonResponse(['success' => false, 'error' => 'Invalid JSON data'], 400);
                return;
            }
            
            // Sanitize input
            $data = $this->sanitizeInput($data);
            
            $updatedEntry = $this->tradingJournal->updateEntry($id, $data);
            
            if ($updatedEntry) {
                $this->jsonResponse(['success' => true, 'entry' => $updatedEntry]);
            } else {
                $this->jsonResponse(['success' => false, 'error' => 'Entry not found'], 404);
            }
            
        } catch (Exception $e) {
            error_log("API Update Error: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'error' => 'Server error'], 500);
        }
    }
    
    public function deleteEntry()
    {
        try {
            $id = $_GET['id'] ?? null;
            
            if (!$id) {
                $this->jsonResponse(['success' => false, 'error' => 'ID required'], 400);
                return;
            }
            
            $deleted = $this->tradingJournal->deleteEntry($id);
            
            if ($deleted) {
                $this->jsonResponse(['success' => true]);
            } else {
                $this->jsonResponse(['success' => false, 'error' => 'Entry not found'], 404);
            }
            
        } catch (Exception $e) {
            error_log("API Delete Error: " . $e->getMessage());
            $this->jsonResponse(['success' => false, 'error' => 'Server error'], 500);
        }
    }
}