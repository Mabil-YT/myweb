<?php
header("Content-Type: application/json");

$SERVER_SECRET = "OYB_PRIVATE_SERVER_2024_8D1F3A7C9B2E6G4H";

$input = json_decode(file_get_contents("php://input"), true);

$hwid = $input["hwid"] ?? "";
$secret = $input["secret"] ?? "";

// Validate server secret
if ($secret !== $SERVER_SECRET) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

// TODO: Replace with real HWID storage
$allowed_hwids = ["EXAMPLE_HWID_HASH"];

if (in_array($hwid, $allowed_hwids)) {
    echo json_encode(["success" => true, "allowed" => true]);
} else {
    echo json_encode(["success" => false, "allowed" => false, "message" => "HWID not registered"]);
}
