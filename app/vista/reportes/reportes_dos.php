<?php
require_once '../../modelo/ReportesConsumidoresDB.php';

$model = new ReportesConsumidoresDB();
$consumidores = $model->obtenerTodosConsumidores();
$model->cerrarConexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Consumidores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
            cursor: pointer; /* Indica que las cabeceras son interactivas */
        }
        th.sorted-asc::after {
            content: " ▲";
        }
        th.sorted-desc::after {
            content: " ▼";
        }
        .search-container {
            margin-bottom: 10px;
        }
        .search-input {
            margin-right: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Reportes de Consumidores</h1>
    <div class="search-container">
        <input type="text" id="searchId" class="search-input" placeholder="Buscar por ID Usuario">
        <input type="text" id="searchName" class="search-input" placeholder="Buscar por Nombre Usuario">
    </div>
    <table id="productoresTable">
        <thead>
            <tr>
                <th data-column="idUsuario">ID Usuario</th>
                <th data-column="nombreUsuario">Nombre Usuario</th>
                <th data-column="peces">Soles</th>
                <th data-column="tiburones">Puntaje</th>
                <th data-column="tiempo">Tiempo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consumidores as $consumidor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($consumidor->idUsuario); ?></td>
                    <td><?php echo htmlspecialchars($consumidor->nombreUsuario); ?></td>
                    <td><?php echo htmlspecialchars($consumidor->peces); ?></td>
                    <td><?php echo htmlspecialchars($consumidor->tiburones); ?></td>
                    <td><?php echo htmlspecialchars($consumidor->tiempo); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="reportes_index.php"><button>Regresar a Reportes</button></a>

    <script>
        // Ordenar la tabla
        document.querySelectorAll('th').forEach(header => {
            header.addEventListener('click', () => {
                const table = header.closest('table');
                const index = Array.from(header.parentNode.children).indexOf(header);
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                const ascending = !header.classList.contains('sorted-asc');

                rows.sort((a, b) => {
                    const aText = a.children[index].textContent.trim();
                    const bText = b.children[index].textContent.trim();
                    const aValue = isNaN(aText) ? aText : parseFloat(aText);
                    const bValue = isNaN(bText) ? bText : parseFloat(bText);

                    return ascending ? (aValue > bValue ? 1 : -1) : (aValue < bValue ? 1 : -1);
                });

                rows.forEach(row => table.querySelector('tbody').appendChild(row));

                document.querySelectorAll('th').forEach(th => th.classList.remove('sorted-asc', 'sorted-desc'));
                header.classList.add(ascending ? 'sorted-asc' : 'sorted-desc');
            });
        });

        // Filtrar por ID Usuario
        document.getElementById('searchId').addEventListener('input', (event) => {
            filterTable(event.target.value, 0);
        });

        // Filtrar por Nombre Usuario
        document.getElementById('searchName').addEventListener('input', (event) => {
            filterTable(event.target.value, 1);
        });

        function filterTable(value, column) {
            const rows = document.querySelectorAll('#productoresTable tbody tr');
            rows.forEach(row => {
                const cellText = row.children[column].textContent.toLowerCase();
                row.style.display = cellText.includes(value.toLowerCase()) ? '' : 'none';
            });
        }
    </script>
</body>
</html>