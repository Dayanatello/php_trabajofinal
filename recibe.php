<?php
$dataFile = 'datos.txt';
$registros = [];

if (file_exists($dataFile)) {
    $registros = unserialize(file_get_contents($dataFile));
} else {
    $registros = [
        ['nombre' => 'carlos', 'correo' => 'carlos@gmail.com'],
        ['nombre' => 'jose', 'correo' => 'jose@gmail.com'],
        ['nombre' => 'manuel', 'correo' => 'manuel@gmail.com'],
        ['nombre' => 'pedro', 'correo' => 'pedro@gmail.com'],
        ['nombre' => 'raul', 'correo' => 'raul@gmail.com'],
        ['nombre' => 'saul', 'correo' => 'saul@gmail.com'],
        ['nombre' => 'diana', 'correo' => 'diana@gmail.com'],
        ['nombre' => 'laura', 'correo' => 'laura@gmail.com'],
        ['nombre' => 'ximena', 'correo' => 'ximena@gmail.com']
    ];
    file_put_contents($dataFile, serialize($registros));
}

if (isset($_POST['nombre']) && isset($_POST['correo'])) {
    $nuevo = [
        'nombre' => $_POST['nombre'],
        'correo' => $_POST['correo']
    ];
    $registros[] = $nuevo;
    file_put_contents($dataFile, serialize($registros));
    header("Location: index.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = (int) $_GET['id'];

    if ($action == 'edit' && isset($registros[$id])) {
        $nombre = $registros[$id]['nombre'];
        $correo = $registros[$id]['correo'];
        
    }

    if ($action == 'delete' && isset($registros[$id])) {
        unset($registros[$id]);
        file_put_contents($dataFile, serialize(array_values($registros)));
        header("Location: index.php");
        exit;
    }
}
?>
