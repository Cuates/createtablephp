<?php
/**
 * File: server_information.php
 * Created: 07/26/2020
 * Updated: 03/27/2025
 * Programmer: Cuates
 * Updated By: AI Assistant
 * Purpose: Define residing server
 */

// Use strict typing for better type safety
declare(strict_types=1);

// Get Host name
$serverInfo = php_uname('n');

// Define server types and their corresponding URLs
const SERVER_TYPES = [
    'dev' => 'https://development_server',
    'prod' => 'https://production_server'
];

// Determine server type based on hostname
$serverType = 'prod'; // Default to production
foreach (array_keys(SERVER_TYPES) as $type) {
    if (stripos($serverInfo, $type) !== false) {
        $serverType = $type;
        break;
    }
}

// Set server name based on determined type
$serverName = SERVER_TYPES[$serverType];
