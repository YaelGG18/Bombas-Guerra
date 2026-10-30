<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Garantías</title>
    <!-- Iconos de Google Material Symbols con grosor delgado -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        /* =========================================================
           ESTILOS BASE (Mantenidos de todo el sistema)
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
            position: fixed;
            left: 0;
            top: 0;
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
            margin-top: 4px;
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
            margin-top: 3px;
        }

        /* Contenido Principal */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 260px; /* Compensa el fixed del sidebar */
        }

        .top-header {
            margin-bottom: 25px;
        }

        .titulo-pagina h1 {
            color: #002B54;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .titulo-pagina p {
            color: #666;
            font-size: 14px;
        }

        /* Buscador integrado */
        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-container span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 20px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        
        .search-container input:focus {
            border-color: #003366;
        }

        /* =========================================================
           ESTILOS ESPECÍFICOS DE GARANTÍAS
           ========================================================= */
        
        /* Tabla de Garantías */
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
            font-size: 12px; /* Letra un poco más pequeña para ajustar columnas */
        }

        thead tr {
            background-color: #F4F7F9;
            color: #555;
            border-bottom: 1px solid #E0E0E0;
        }

        th {
            font-weight: bold;
            padding: 14px 15px;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #fcfcfc;
        }

        .codigo-verif {
            font-weight: bold;
            color: #002B54;
        }

        .codigo-sub {
            display: block;
            font-size: 10px;
            color: #888;
            font-weight: normal;
        }

        /* Etiquetas de estado (Pills) */
        .status {
            font-weight: bold;
            font-size: 11px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .status-vigente { color: #27ae60; }
        .status-caducado { color: #c0392b; }

        /* Botón de tabla */
        .btn-imprimir {
            background-color: #002B54;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: 0.2s;
        }

        .btn-imprimir:hover {
            background-color: #001f3f;
        }

        .btn-imprimir span {
            font-size: 14px;
        }

        /* Sección de Resumen Inferior */
        .contenedor-resumen {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 25px;
            display: flex;
            gap: 30px;
        }

        .resumen-detalles {
            flex: 1.5;
        }

        .resumen-certificado {
            flex: 1;
        }

        .resumen-titulo {
            font-size: 16px;
            color: #002B54;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .badge-selected {
            background-color: #002B54;
            color: #FFCC00;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            margin-right: 10px;
            text-transform: uppercase;
        }

        /* Grid interno de detalles */
        .detalles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .detalle-item h4 {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .detalle-item p {
            font-size: 13px;
            color: #333;
            font-weight: bold;
        }

        .detalle-item p.desc-larga {
            font-weight: normal;
            line-height: 1.5;
            color: #555;
        }

        .cobertura-vigencia {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 5px;
        }

        .confirmada {
            color: #27ae60;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
            background-color: rgba(39, 174, 96, 0.1);
            padding: 4px 10px;
            border-radius: 4px;
        }

        /* Caja de Certificado (Sin QR) */
        .caja-certificado {
            border: 2px solid #FFCC00;
            border-radius: 8px;
            padding: 20px;
            background-color: #fdfdfd;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .certificado-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .certificado-header .icono-escudo {
            background-color: #002B54;
            color: #FFCC00;
            padding: 8px;
            border-radius: 6px;
            display: flex;
        }

        .certificado-header h4 {
            font-size: 13px;
            color: #002B54;
            margin-bottom: 2px;
        }

        .certificado-header p {
            font-size: 10px;
            color: #666;
        }

        .codigo-caja {
            background-color: white;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 15px;
        }

        .codigo-caja p {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .codigo-caja h3 {
            font-size: 18px;
            color: #002B54;
            letter-spacing: 1px;
        }

        .texto-legal {
            font-size: 11px;
            color: #666;
            line-height: 1.4;
            text-align: justify;
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

            <!-- Lista de Módulos -->
            <ul class="sidebar-menu">
                <li>
                    <a href="/inventario">
                        <span class="material-symbols-outlined">inventory_2</span>
                        Inventario General
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
                        Cotizaciones y OT
                    </a>
                </li>
                <li>
                    <!-- Garantías marcado como Activo -->
                    <a href="/garantias" class="activo">
                        <span class="material-symbols-outlined">verified_user</span>
                        Garantías
                    </a>
                </li>
                <li>
                    <a href="/reportes">
                        <span class="material-symbols-outlined">bar_chart</span>
                        Reportes
                    </a>
                </li>
            </ul>
        </div>

        <a href="/" class="sidebar-footer" title="Cerrar Sesión">
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
                <h1>Gestión y Almacenamiento de Garantías</h1>
                <p>Registro oficial de certificados, verificación de autenticidad de refacciones y vigencia de servicios de taller.</p>
            </div>
        </div>

        <!-- Buscador general -->
        <div class="search-container">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="Buscar por Folio OT, N° Ticket Venta, Cliente o Código...">
        </div>

        <!-- Tabla Principal de Garantías -->
        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Folio / N° Ticket</th>
                        <th>Código Verif.</th>
                        <th>Cliente / Titular</th>
                        <th>Fecha Inicio</th>
                        <th>Vigencia</th>
                        <th>Tipo</th>
                        <th>Piezas Reemplazadas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fila 1 (Activa) -->
                    <tr>
                        <td><strong>OT-2026-042</strong></td>
                        <td class="codigo-verif">
                            BG-0492F <span class="codigo-sub">Código Oficial</span>
                        </td>
                        <td>Agrícola El Milagro S.A.</td>
                        <td>15 Ene 2026</td>
                        <td>90 Días</td>
                        <td>Servicio OT</td>
                        <td>Rodete de Bronce B-62, Sello Silicio 1.5"</td>
                        <td><span class="status status-vigente">● VIGENTE</span></td>
                        <td>
                            <button class="btn-imprimir">
                                <span class="material-symbols-outlined">print</span> Imprimir
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Fila 2 (Caducada) -->
                    <tr>
                        <td><strong>TK-99214</strong></td>
                        <td class="codigo-verif">
                            BG-4811S <span class="codigo-sub">Código Oficial</span>
                        </td>
                        <td>Constructora Del Norte</td>
                        <td>10 Nov 2025</td>
                        <td>180 Días</td>
                        <td>Refacción</td>
                        <td>Bomba Sumergible 5HP Trifásica</td>
                        <td><span class="status status-caducado">● CADUCADO</span></td>
                        <td>
                            <button class="btn-imprimir">
                                <span class="material-symbols-outlined">print</span> Imprimir
                            </button>
                        </td>
                    </tr>

                    <!-- Fila 3 -->
                    <tr>
                        <td><strong>OT-2026-039</strong></td>
                        <td class="codigo-verif">
                            BG-2D99X <span class="codigo-sub">Código Oficial</span>
                        </td>
                        <td>Sistemas de Riego Bajío</td>
                        <td>02 Ene 2026</td>
                        <td>120 Días</td>
                        <td>Servicio OT</td>
                        <td>Bobinado Estator 5HP, Baleros SKF 63...</td>
                        <td><span class="status status-vigente">● VIGENTE</span></td>
                        <td>
                            <button class="btn-imprimir">
                                <span class="material-symbols-outlined">print</span> Imprimir
                            </button>
                        </td>
                    </tr>

                    <!-- Fila 4 -->
                    <tr>
                        <td><strong>TK-99088</strong></td>
                        <td class="codigo-verif">
                            BG-9C55M <span class="codigo-sub">Código Oficial</span>
                        </td>
                        <td>Minera Sierra Gorda</td>
                        <td>18 Dic 2025</td>
                        <td>90 Días</td>
                        <td>Refacción</td>
                        <td>Válvula de Retención de Bronce 2"</td>
                        <td><span class="status status-vigente">● VIGENTE</span></td>
                        <td>
                            <button class="btn-imprimir">
                                <span class="material-symbols-outlined">print</span> Imprimir
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sección Inferior: Resumen de Garantía Seleccionada -->
        <div class="contenedor-resumen">
            
            <!-- Detalles Lado Izquierdo -->
            <div class="resumen-detalles">
                <div class="resumen-titulo">
                    <span class="badge-selected">SELECTED</span>
                    Resumen de Garantía OT-2026-042
                </div>

                <div class="detalles-grid">
                    <div class="detalle-item">
                        <h4>Titular del Servicio</h4>
                        <p>Agrícola El Milagro S.A.</p>
                    </div>
                    <div class="detalle-item">
                        <h4>Técnico Responsable</h4>
                        <p>Guerra</p>
                    </div>
                </div>

                <div class="detalle-item" style="margin-bottom: 15px;">
                    <h4>Materiales / Mano de Obra Cubierta</h4>
                    <p class="desc-larga">Reconstrucción completa de rodete impulsor en aleación de bronce de alta densidad, maquinado en torno de precisión y balanceado dinámico. Ajuste y cambio de sellos mecánicos Viton de 1.5 pulgadas para resistencia térmica avanzada.</p>
                </div>

                <div class="detalle-item">
                    <h4>Período de Cobertura</h4>
                    <div class="cobertura-vigencia">
                        <p>15 Ene 2026 — 15 Abr 2026 (90 Días)</p>
                        <div class="confirmada">
                            <span class="material-symbols-outlined" style="font-size: 16px;">verified</span> 
                            VIGENCIA CONFIRMADA
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificado Lado Derecho (SIN CÓDIGO QR) -->
            <div class="resumen-certificado">
                <div class="caja-certificado">
                    <div class="certificado-header">
                        <div class="icono-escudo">
                            <span class="material-symbols-outlined">shield</span>
                        </div>
                        <div>
                            <h4>CERTIFICADO DE AUTENTICIDAD</h4>
                            <p>SELLO DE SEGURIDAD ANTIFALSIFICACIÓN</p>
                        </div>
                    </div>

                    <div class="codigo-caja">
                        <p>CÓDIGO BG-ANTIFALSIFICACIÓN</p>
                        <h3>BG-8A92-F92B-2026</h3>
                    </div>

                    <p class="texto-legal">
                        Este certificado digital avala garantías sobre los componentes validados en su interior con repuestos legítimos de Bombas Guerra. El código asignado es único e intransferible.
                    </p>
                </div>
            </div>

        </div>

    </div>

</body>
</html>
