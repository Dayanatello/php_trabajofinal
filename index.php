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

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = (int) $_GET['id'];
    
    if ($action == 'delete' && isset($registros[$id])) {
        unset($registros[$id]);
        file_put_contents($dataFile, serialize(array_values($registros)));
        header("Location: index.php");
        exit;
    }
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            padding: 40px;
            alie
        }
        .container {
            background-color: white;
            width: 900px;
            margin: auto;
            padding: 20px 30px;
            border-radius: 6px;
        }
        h2 {
            margin-bottom: 29px;
            text-align: center;
            font-size: 28px;
        }
        h3 {
            text-align: center;
            font-size: 22px;
            margin-top: 40px;
        }
        input[type="text"] {
            padding: 10px;
            width: 250px;
            margin-right: 15px;
            margin: 10px auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ccc;
        }

        .formulario {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

.formulario input[type="text"],
.formulario button {
    margin: 0; 
}
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .acciones a {
            color: blue;
            text-decoration: underline;
            margin-right: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Gestión de Usuarios</h2>

    <form class="formulario" action="recibe.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="correo" placeholder="Correo Electrónico" required>
        <button type="submit">Agregar Usuario</button>
    </form>

    <h3 style="margin-top: 40px;">Lista de Usuarios</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php
        $id = 0;
        foreach ($registros as $r) {
            echo "<tr>
                <td>$id</td>
                <td>" . htmlspecialchars($r['nombre']) . "</td>
                <td>" . htmlspecialchars($r['correo']) . "</td>
                <td class='acciones'>
                    <a href='recibe.php?action=edit&id=$id'>Editar</a> | 
                    <a href='index.php?action=delete&id=$id' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\")'>Eliminar</a>
                </td>
            </tr>";
            $id++;
        }
        ?>
    </table>
</div>
</body>
</html>

