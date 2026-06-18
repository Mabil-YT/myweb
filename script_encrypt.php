<?php
header("Content-Type: application/json");

$SERVER_SECRET = "OYB_PRIVATE_SERVER_2024_8D1F3A7C9B2E6G4H";

$input = json_decode(file_get_contents("php://input"), true);

$secret = $input["secret"] ?? "";
$script = $input["script"] ?? "";

// Validate server secret
if ($secret !== $SERVER_SECRET) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

// Simple XOR encryption
function xor_encrypt($data, $key) {
    $out = "";
    for ($i = 0; $i < strlen($data); $i++) {
        $out .= chr(ord($data[$i]) ^ ord($key[$i % strlen($key)]));
    }
    return base64_encode($out);
}

$encrypted = xor_encrypt($script, $SERVER_SECRET);

echo json_encode([
    "success" => true,
    "encrypted" => $encrypted
]);
