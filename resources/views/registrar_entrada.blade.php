<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Venta Directa</title>
    <!-- Iconos de Google Material Symbols con grosor delgado -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        /* =========================================================
           ESTILOS BASE (Tomados de Inventario.txt)
           ========================================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #EAEFF2;
            min-height: 100vh;
            display: flex;
        }

        /* Menú Lateral (Sidebar) */
        .sidebar {
            width: 260px;
            background-color: #002347;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 2px solid #FFCC00;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s;
        }

        .sidebar-header:hover {
            background-color: #001f3f;
        }

        .sidebar-header h2 {
            font-size: 16px;
            color: #FFCC00;
            letter-spacing: 1px;
        }

        .sidebar-header p {
            font-size: 11px;
            color: #b0c4de;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            flex-grow: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #cce0ff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar-menu li a:hover, .sidebar-menu li a.activo {
            background-color: #003366;
            color: #FFCC00;
            border-left: 4px solid #FFCC00;
        }

        .sidebar-footer {
            padding: 20px;
            background-color: #001833;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
        }

        .sidebar-footer:hover {
            background-color: #001026;
        }

        .sidebar-footer .icono-admin {
            color: #FFCC00;
            font-size: 32px;
        }

        .sidebar-footer .info-admin {
            font-size: 12px;
        }

        .sidebar-footer .estado {
            font-size: 10px;
            color: #4CAF50;
        }

        /* Contenido Principal */
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .titulo-pagina h1 {
            color: #002B54;
            font-size: 24px;
        }

        /* Tablas base */
        .contenedor-tabla {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        thead tr {
            background-color: #F4F7F9;
            color: #444;
            border-bottom: 2px solid #E0E0E0;
        }

        th, td {
            padding: 14px 18px;
        }

        .mensaje-vacio {
            text-align: center;
            padding: 40px !important;
            color: #888;
        }

        /* =========================================================
           ESTILOS ADICIONALES (Específicos para Venta Directa)
           ========================================================= */
        .seccion-titulo {
            font-size: 16px;
            color: #002B54;
            font-weight: bold;
            padding: 20px 20px 15px 20px;
            background-color: white;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Buscador integrado */
        .search-container {
            position: relative;
            padding: 15px 20px;
            background-color: white;
        }

        .search-container span {
            position: absolute;
            left: 32px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 20px;
        }

        .search-container input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }
        
        .search-container input:focus {
            border-color: #003366;
        }

        /* Resumen de Venta */
        .resumen-venta {
            background-color: #002B54;
            border-radius: 8px;
            padding: 25px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .resumen-header {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .resumen-header .icono {
            background: rgba(255,255,255,0.1);
            padding: 10px;
            border-radius: 8px;
            display: flex;
        }

        .resumen-header h3 {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .resumen-header p {
            font-size: 11px;
            color: #b0c4de;
        }

        .resumen-fila {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .resumen-fila p {
            color: #b0c4de;
        }

        .badge-unidades {
            background-color: rgba(255, 204, 0, 0.15);
            color: #FFCC00;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
        }

        .precio-total {
            font-size: 32px;
            color: #FFCC00;
            font-weight: bold;
        }

        .precio-total span {
            font-size: 14px;
            color: white;
            font-weight: normal;
        }

        /* Botones de acción */
        .botones-accion {
            display: flex;
            gap: 15px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            border: none;
            transition: 0.2s;
        }

        .btn-secundario {
            background-color: white;
            color: #666;
            border: 1px solid #ccc;
            flex: 1;
        }

        .btn-secundario:hover {
            background-color: #f9f9f9;
            color: #333;
        }

        .btn-primario {
            background-color: #FFCC00;
            color: #000;
            flex: 2;
        }

        .btn-primario:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>

    <!-- Menú Lateral idéntico al de Inventario.txt pero con rutas actualizadas -->
    <div class="sidebar">
        <div>
           <a href="/barratareas" class="sidebar-header" title="Volver al Dashboard">
            <h2>BOMBAS GUERRA</h2>
            <p>CONTROL DE INVENTARIOS</p>
           </a>

            <ul class="sidebar-menu">
                <li>
                    <a href="/inventario">
                        <span class="material-symbols-outlined">inventory_2</span>
                        Inventario
                    </a>
                </li>
                <li>
                    <a href="/registrar_entrada">
                        <span class="material-symbols-outlined">move_to_inbox</span>
                        Registrar Entrada
                    </a>
                </li>
                <li>
                    <!-- Ruta corregida y clase activo reubicada aquí -->
                    <a href="/venta_directa">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        Venta Directa
                    </a>
                </li>
                <li>
                    <a href="/cotizaciones">
                        <span class="material-symbols-outlined">request_quote</span>
                        Cotizaciones
                    </a>
                </li>
                <li>
                    <a href="/ordenes_trabajo">
                        <span class="material-symbols-outlined">build</span>
                        Órdenes de Trabajo
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="material-symbols-outlined">verified_user</span>
                        Garantías
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="material-symbols-outlined">bar_chart</span>
                        Historial y Reportes
                    </a>
                </li>
            </ul>
        </div>

        <a href="/" class="sidebar-footer" title="Cerrar Sesión / Volver al Login">
            <span class="material-symbols-outlined icono-admin">account_circle</span>
            <div class="info-admin">
                <strong>Admin Taller</strong>
                <div class="estado">● En Línea</div>
            </div>
        </a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="top-header">
            <div class="titulo-pagina">
                <h1>Venta Directa / Carrito de Salidas</h1>
            </div>
        </div>

        <!-- SECCIÓN 1: Selección de Catálogo usando la misma estructura de tabla -->
        <div class="contenedor-tabla">
            <h2 class="seccion-titulo">Selección de Catálogo</h2>
            
            <div class="search-container">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Buscar por ID, Nombre, Marca o N° Parte...">
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Ref / ID</th>
                        <th>Refacción / Marca / N° Parte</th>
                        <th>Precio</th>
                        <th>Disp.</th>
                        <th>Añadir al Carrito</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="mensaje-vacio">
                            No hay refacciones registradas en el catálogo. Se poblará al conectar con la base de datos.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- SECCIÓN 2: Carrito de Salida -->
        <div class="contenedor-tabla">
            <h2 class="seccion-titulo">Carrito de Salida</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>P. Un.</th>
                        <th>Cant.</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="mensaje-vacio">
                            El carrito está vacío. Selecciona una refacción del catálogo para empezar.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- SECCIÓN 3: Resumen de la Venta -->
        <div class="resumen-venta">
            <div class="resumen-header">
                <div class="icono">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
                <div>
                    <h3>ORDEN DE SALIDA</h3>
                    <p>BOMBAS GUERRA POS</p>
                </div>
            </div>

            <div class="resumen-fila">
                <p>Total de Refacciones</p>
                <span class="badge-unidades">0 Unidades</span>
            </div>

            <div class="resumen-fila">
                <p>Monto Total a Cobrar</p>
                <div class="precio-total">$0.00 <span>MXN</span></div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="botones-accion">
            <button class="btn btn-secundario">
                <span class="material-symbols-outlined">delete</span>
                Vaciar Carrito
            </button>
            <button class="btn btn-primario">
                <span class="material-symbols-outlined">payments</span>
                Finalizar Compra
            </button>
        </div>

    </div>

</body>
</html>
