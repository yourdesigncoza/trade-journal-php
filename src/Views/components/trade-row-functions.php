<?php
// Helper functions for trade row rendering - declared only once

if (!function_exists('formatTradeDate')) {
    function formatTradeDate($dateString) {
        return $dateString ? date('m/d/Y', strtotime($dateString)) : '';
    }
}

if (!function_exists('getOutcomeBadge')) {
    function getOutcomeBadge($outcome) {
        $badges = [
            'W' => '<span class="badge badge-phoenix badge-phoenix-success">Win <i class="fas fa-check ms-1"></i></span>',
            'L' => '<span class="badge badge-phoenix badge-phoenix-danger">Loss <i class="fas fa-times ms-1"></i></span>',
            'BE' => '<span class="badge badge-phoenix badge-phoenix-warning">Break Even <i class="fas fa-minus ms-1"></i></span>',
            'C' => '<span class="badge badge-phoenix badge-phoenix-secondary">Cancelled <i class="fas fa-ban ms-1"></i></span>'
        ];
        
        return $badges[$outcome] ?? '<span class="badge badge-phoenix badge-phoenix-secondary">Pending</span>';
    }
}

if (!function_exists('getDirectionBadge')) {
    function getDirectionBadge($direction) {
        if (!$direction) return '';
        
        $class = $direction === 'LONG' ? 'badge-phoenix-success' : 'badge-phoenix-danger';
        return '<span class="badge badge-phoenix ' . $class . '">' . $direction . '</span>';
    }
}

if (!function_exists('formatTimeframes')) {
    function formatTimeframes($tf) {
        if (!$tf) return '-';
        
        $tf_array = is_string($tf) ? json_decode($tf, true) : $tf;
        if (!$tf_array) return '-';
        
        $badges = [];
        foreach ($tf_array as $timeframe) {
            $badges[] = '<span class="badge badge-phoenix badge-phoenix-info me-1">' . htmlspecialchars($timeframe) . '</span>';
        }
        
        return implode('', $badges);
    }
}
?>