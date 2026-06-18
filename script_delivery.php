<?php
header("Content-Type: application/json");

$SERVER_SECRET = "OYB_PRIVATE_SERVER_2024_8D1F3A7C9B2E6G4H";

$input = json_decode(file_get_contents("php://input"), true);

$key = $input["key"] ?? "";
$hwid = $input["hwid"] ?? "";
$secret = $input["secret"] ?? "";

// Validate server secret
if ($secret !== $SERVER_SECRET) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

// TODO: Replace with real validation
if ($key !== "TESTKEY") {
    echo json_encode(["success" => false, "message" => "Invalid key"]);
    exit;
}

// Load your obfuscated script
$script = file_get_contents("main_obfuscated.lua");

// Integrity hash
$hash = hash("sha256", $script . $SERVER_SECRET);

echo json_encode([
    "success" => true,
    "script" => $script,
    "hash" => $hash
]);
