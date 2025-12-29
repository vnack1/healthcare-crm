<?php
if (!function_exists('generateMemberCode')) {
    function generateMemberCode($prefix, $currentMaxCode, $level) {
        $nextNumber = intval(substr($currentMaxCode, strlen($prefix), 2)) + 1;
        $formattedNumber = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        switch ($level) {
            case 'distributor':
                return $prefix . $formattedNumber . '000000';
            case 'agent':
                return $prefix . $formattedNumber . '0000';
            case 'user':
                return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            default:
                throw new Exception("Invalid level: $level");
        }
    }
}