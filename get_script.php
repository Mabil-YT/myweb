<?php
header("Content-Type: application/json");

// Your private server secret
$SERVER_SECRET = "OYB_ESP_ANTIBYPASS_7F9A2C1E4D6B8G3H";

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Extract fields
$secret = $input["secret"] ?? "";

// Validate server secret
if ($secret !== $SERVER_SECRET) {
    echo json_encode([
        "success" => false,
        "message" => "Unauthorized"
    ]);
    exit;
}

// Load your script file (TXT instead of LUA)
$scriptPath = __DIR__ . "/main_script.txt";

if (!file_exists($scriptPath)) {
    echo json_encode([
        "success" => false,
        "message" => "Script file not found"
    ]);
    exit;
}

$script = file_get_contents($scriptPath);

// Create integrity hash
$hash = hash("sha256", $script . $SERVER_SECRET);

// Return JSON
echo json_encode([
    "success" => true,
    "script" => $script,
    "hash" => $hash
]);
