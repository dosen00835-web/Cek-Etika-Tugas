<?php
header('Content-Type: application/json');
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teks_tugas = $_POST['teks_tugas'] ?? '';
    $q1 = $_POST['q1'] ?? '';
    $q2 = $_POST['q2'] ?? '';
    $q3 = $_POST['q3'] ?? '';
    $q4 = $_POST['q4'] ?? '';
    $status = $_POST['status'] ?? '';
    $pesan = $_POST['pesan'] ?? '';
    $teks_parafrase = $_POST['teks_parafrase'] ?? '';

    $stmt = $conn->prepare("INSERT INTO hasil_cek (teks_tugas, q1, q2, q3, q4, status, pesan, teks_parafrase) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $teks_tugas, $q1, $q2, $q3, $q4, $status, $pesan, $teks_parafrase);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Metode tidak valid']);
}
?>
