<?php
require_once 'config.php';
// Set the content type to JSON
header('Content-Type: application/json');
// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        // Baca data
        $stmt = $pdo->query('SELECT * FROM mahasiswa');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        break;
    case 'POST':
        // Insert data
        $data = json_decode(file_get_contents('php://input'), true);
        $nim = $data['NIM'];
        $NamaLengkap = $data['NamaLengkap'];
        $jurusan = $data['jurusan'];

        $stmt = $pdo->prepare('INSERT INTO mahasiswa (NIM,NamaLengkap,jurusan) VALUES (?, ?, ?)');
        $stmt->execute([$nim, $NamaLengkap, $jurusan]);

        echo json_encode(['message' => 'Data telah ditambah!']);
        break;
    case 'PUT':
        // Update data
        parse_str(file_get_contents('php://input'), $data);
        $nim = $data['NIM'];
        $NamaLengkap = $data['NamaLengkap'];
        $jurusan = $data['jurusan'];

        $stmt = $pdo->prepare('UPDATE mahasiswa SET NIM=?,NamaLengkap=?, jurusan=? WHERE NIM=?');
        $stmt->execute([$nim, $NamaLengkap, $jurusan]);

        echo json_encode(['message' => 'Data telah di Update !']);
        break;
    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(['error' => 'Method tidak diizinkan!']);
        break;
}
?>
