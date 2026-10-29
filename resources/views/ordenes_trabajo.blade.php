<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Órdenes de Trabajo</title>
    <!-- Iconos de Google Material Symbols con grosor delgado -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
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
            margin-bottom: 4px;
        }

        .titulo-pagina p {
            color: #666;
            font-size: 14px;
        }

        .btn-crear {
            background-color: #FFCC00;
            color: #002347;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-crear:hover {
            background-color: #e6b800;
        }

        /* Tarjetas de Contadores */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .card-stat {
            background-color: white;
            border-radius: 8px;
            padding: 18px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-stat .numero {
            font-size: 28px;
            font-weight: bold;
            color: #002B54;
        }

        .card-stat .label h4 {
            font-size: 13px;
            color: #333;
        }

        .card-stat .label p {
            font-size: 11px;
            color: #888;
        }

        /* Buscador */
        .bar-busqueda {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .bar-busqueda input {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-filtrar {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Tabla de Órdenes */
        .contenedor-tabla {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13px;
        }

        thead tr {
            background-color: #F4F7F9;
            color: #444;
            border-bottom: 2px solid #E0E0E0;
        }

        th, td {
            padding: 14px 16px;
        }

        .mensaje-vacio {
            text-align: center;
            padding: 40px !important;
            color: #888;
        }

        .footer-tabla {
            padding: 15px 20px;
            background-color: #F4F7F9;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #E0E0E0;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    <!-- Menú Lateral -->
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
                    <a href="/ordenes_trabajo" class="activo">
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
                <h1>Gestión de Órdenes de Trabajo</h1>
                <p>Seguimiento de reparaciones activas, diagnóstico hidráulico y asignación de refacciones en taller.</p>
            </div>
        </div>

        <!-- Tarjetas de Estado de Órdenes -->
        <div class="grid-stats">
            <div class="card-stat">
                <div class="numero">0</div>
                <div class="label">
                    <h4>Órdenes registradas</h4>
                    <p>Listado completo</p>
                </div>
            </div>

            <div class="card-stat">
                <div class="numero" style="color: #e67e22;">0</div>
                <div class="label">
                    <h4>En Proceso</h4>
                    <p>Reparaciones activas</p>
                </div>
            </div>

            <div class="card-stat">
                <div class="numero" style="color: #27ae60;">0</div>
                <div class="label">
                    <h4>Terminado</h4>
                    <p>Servicio concluido</p>
                </div>
            </div>

            <div class="card-stat">
                <div class="numero" style="color: #c0392b;">0</div>
                <div class="label">
                    <h4>Cancelado</h4>
                    <p>Sin cargos aplicados</p>
                </div>
            </div>
        </div>

        <!-- Buscador -->
        <div class="bar-busqueda">
            <input type="text" placeholder="Buscar por Folio OT, Cliente o Teléfono...">
            <button class="btn-filtrar">
                <span class="material-symbols-outlined">filter_list</span> Filtrar
            </button>
        </div>

        <!-- Tabla Limpia de Órdenes de Trabajo -->
        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Folio OT</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Falla / Diagnóstico</th>
                        <th>Monto Refacciones</th>
                        <th>Mano de Obra</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="mensaje-vacio">
                            No hay órdenes de trabajo registradas. Se poblará al conectar con la base de datos.
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="footer-tabla">
                <span>Mostrando 0 órdenes en total</span>
                <span>BOMBAS GUERRA S.A. DE C.V.</span>
            </div>
        </div>
    </div>

</body>
</html>