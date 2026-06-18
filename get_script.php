<?php
header("Content-Type: application/json");

$SERVER_SECRET = getenv("OYB_ESP_ANTIBYPASS_7F9A2C1E4D6B8G3H");

$input = json_decode(file_get_contents("php://input"), true);

$key = $input["key"] ?? "";
$secret = $input["secret"] ?? "";

// Protect endpoint
if ($secret !== $SERVER_SECRET) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

// Validate key (replace with your real logic)
if ($key !== "VALID_KEY_EXAMPLE") {
    echo json_encode(["success" => false, "message" => "Invalid key"]);
    exit;
}

// Load main script
$script = file_get_contents(__DIR__ . "/main_script.txt");

echo json_encode([
    "success" => true,
    "script" => $script
]);
