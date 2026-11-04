<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Garantías</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #EAEFF2; min-height: 100vh; display: flex; }
        
        /* Menú Lateral */
        .sidebar { width: 260px; background-color: #002347; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 100vh; }
        .sidebar-header { padding: 25px 20px; border-bottom: 2px solid #FFCC00; text-decoration: none; display: block; }
        .sidebar-header h2 { font-size: 16px; color: #FFCC00; letter-spacing: 1px; }
        .sidebar-header p { font-size: 11px; color: #b0c4de; }
        .sidebar-menu { list-style: none; padding: 20px 0; flex-grow: 1; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #cce0ff; text-decoration: none; font-size: 14px; }
        
        /* Corregido: La clase activo ahora resaltará amarillo en CSS */
        .sidebar-menu li a:hover, .sidebar-menu li a.activo { background-color: #003366; color: #FFCC00; border-left: 4px solid #FFCC00; }
        
        .sidebar-footer { padding: 20px; background-color: #001833; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .sidebar-footer .icono-admin { color: #FFCC00; font-size: 32px; }
        .sidebar-footer .info-admin { font-size: 12px; }
        .sidebar-footer .estado { font-size: 10px; color: #4CAF50; }

        /* Contenido Principal */
        .main-content { flex-grow: 1; padding: 30px; }
        .top-header { margin-bottom: 25px; }
        .titulo-pagina h1 { color: #002B54; font-size: 24px; margin-bottom: 4px; }
        .titulo-pagina p { color: #666; font-size: 14px; }
        
        .card-modulo { background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .search-container { display: flex; gap: 15px; margin-bottom: 20px; }
        .search-container input { flex-grow: 1; padding: 12px 15px; border: 1px solid #dcdcdc; border-radius: 6px; font-size: 14px; outline: none; }
        .btn-buscar { background-color: #002B54; color: white; border: none; padding: 0 25px; border-radius: 6px; cursor: pointer; font-weight: bold; display: flex; align-items: center; gap: 8px; }
        .btn-buscar:hover { background-color: #001f3f; }
        
        .lista-vacia { border: 1px dashed #ccc; border-radius: 6px; padding: 40px; text-align: center; color: #888; font-size: 14px; background-color: #fafafa; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <a href="/barratareas" class="sidebar-header">
                <h2>BOMBAS GUERRA</h2>
                <p>CONTROL DE INVENTARIOS</p>
            </a>
            <ul class="sidebar-menu">
                <li><a href="/inventario"><span class="material-symbols-outlined">inventory_2</span> Inventario</a></li>
                <li><a href="/registrar_entrada"><span class="material-symbols-outlined">move_to_inbox</span> Registrar Entrada</a></li>
                <li><a href="/venta_directa"><span class="material-symbols-outlined">shopping_cart</span> Venta Directa</a></li>
                <li><a href="/cotizaciones"><span class="material-symbols-outlined">request_quote</span> Cotizaciones</a></li>
                <li><a href="/ordenes_trabajo"><span class="material-symbols-outlined">build</span> Órdenes de Trabajo</a></li>
                <!-- Clase ACTIVO aplicada correctamente al módulo de Garantías -->
                <li><a href="/garantias" class="activo"><span class="material-symbols-outlined">verified_user</span> Garantías</a></li>
                <li><a href="/historial_movimientos"><span class="material-symbols-outlined">bar_chart</span> Historial y Reportes</a></li>
            </ul>
        </div>
        <a href="/" class="sidebar-footer">
            <span class="material-symbols-outlined icono-admin">account_circle</span>
            <div class="info-admin">
                <strong>Admin Taller</strong>
                <div class="estado">● En Línea</div>
            </div>
        </a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <div class="titulo-pagina">
                <h1>Validación de Garantías</h1>
                <p>Consulta el estado de una reparación ingresando su código único de verificación.</p>
            </div>
        </div>

        <div class="card-modulo">
            <div class="search-container">
                <input type="text" id="codigo_garantia" placeholder="Ingrese el código único de garantía (Ej. BG-X8A2)...">
                <button type="button" class="btn-buscar">
                    <span class="material-symbols-outlined">search</span> Buscar Código
                </button>
            </div>

            <div class="lista-vacia">
                <span class="material-symbols-outlined" style="font-size: 48px; color: #ccc; margin-bottom: 10px;">qr_code_scanner</span>
                <br>Ingrese un código en la barra de búsqueda para verificar la validez y los detalles de la garantía.
            </div>
        </div>
    </div>

</body>
</html>