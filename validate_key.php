<?php
header("Content-Type: application/json");

$SERVER_SECRET = "OYB_PRIVATE_SERVER_2024_8D1F3A7C9B2E6G4H";

// Read JSON
$input = json_decode(file_get_contents("php://input"), true);

$key = $input["key"] ?? "";
$hwid = $input["hwid"] ?? "";
$secret = $input["secret"] ?? "";

// Validate server secret
if ($secret !== $SERVER_SECRET) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

// TODO: Replace this with your real key validation logic
// For now, accept any key that equals "TESTKEY"
if ($key === "TESTKEY") {
    echo json_encode(["success" => true, "valid" => true]);
} else {
    echo json_encode(["success" => false, "valid" => false, "message" => "Invalid key"]);
}
