<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Historial y Reportes</title>
    <!-- Iconos de Google Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        /* =========================================================
           ESTILOS BASE
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
            margin-left: 260px;
        }

        .top-header {
            margin-bottom: 20px;
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

        /* =========================================================
           PESTAÑAS (TABS)
           ========================================================= */
        .tabs-container {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .tab-btn {
            background: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #888;
            font-weight: normal;
            transition: 0.2s;
        }

        .tab-btn:hover {
            color: #555;
        }

        .tab-btn .punto {
            font-size: 12px;
            color: #ccc;
        }

        .tab-btn.activo {
            color: #002B54;
            font-weight: bold;
        }

        .tab-btn.activo .punto {
            color: #FFCC00;
        }

        /* =========================================================
           FILTROS
           ========================================================= */
        .filtros-grid {
            display: grid;
            grid-template-columns: 200px 200px 1fr;
            gap: 20px;
            margin-bottom: 20px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-contenedor {
            position: relative;
        }

        .input-contenedor input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            color: #333;
            outline: none;
        }

        .input-contenedor.con-icono input {
            padding-left: 35px;
        }

        .input-contenedor.con-icono .icono-input {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 18px;
        }

        /* =========================================================
           TABLAS
           ========================================================= */
        .contenedor-tabla {
            background-color: white;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 12px;
        }

        thead tr {
            background-color: #F4F7F9;
            color: #777;
            border-bottom: 1px solid #E0E0E0;
        }

        th {
            font-weight: bold;
            padding: 12px 20px;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        /* Fila seleccionada */
        tr.seleccionada {
            background-color: #FFF9C4 !important; /* Amarillo muy pálido */
        }

        /* Etiquetas de estado */
        .status {
            font-weight: bold;
            font-size: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
            text-transform: uppercase;
        }
        .status-vigente { color: #27ae60; }
        .status-entregado { color: #2980b9; }
        .status-cancelado { color: #c0392b; }

        /* =========================================================
           PANEL DE DETALLES INFERIOR
           ========================================================= */
        .detalle-expediente {
            background-color: #F9FAFC;
            border: 1px solid #E0E0E0;
            border-top: none;
            border-radius: 0 0 8px 8px;
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            gap: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.02);
        }

        .detalle-info {
            flex: 2;
        }

        .detalle-certificado {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .badge-preview {
            background-color: #002B54;
            color: #FFCC00;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            text-transform: uppercase;
            margin-right: 10px;
            font-weight: bold;
        }

        .detalle-titulo {
            font-size: 16px;
            color: #002B54;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .seccion-texto {
            margin-bottom: 15px;
        }

        .seccion-texto h4 {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .seccion-texto p, .seccion-texto ul {
            font-size: 12px;
            color: #444;
            line-height: 1.5;
        }

        .seccion-texto ul {
            padding-left: 20px;
            list-style-type: none;
        }
        
        .seccion-texto ul li::before {
            content: "•";
            color: #002B54;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
        }

        .grid-costos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 15px;
        }

        .valor-destacado {
            font-size: 14px;
            font-weight: bold;
            color: #000;
        }

        /* Tarjeta del Sello */
        .caja-sello {
            background-color: white;
            border: 1px solid #FFCC00;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
        }

        .sello-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .sello-header .icono-escudo {
            background-color: #002B54;
            color: #FFCC00;
            padding: 6px;
            border-radius: 6px;
            display: flex;
        }

        .sello-header h4 {
            font-size: 12px;
            color: #002B54;
        }

        .codigo-caja {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
        }

        .codigo-caja p {
            font-size: 9px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .codigo-caja h3 {
            font-size: 15px;
            color: #002B54;
            letter-spacing: 1px;
        }

        /* Footer de la página */
        .footer-acciones {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .nota-auditoria {
            font-size: 11px;
            color: #888;
            font-style: italic;
        }

        .btn-exportar {
            background-color: #FFCC00;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-exportar:hover {
            background-color: #e6b800;
        }

        /* Ocultar contenido inactivo */
        .contenido-tab {
            display: none;
        }
        
        .contenido-tab.activo {
            display: block;
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
                    <a href="/garantias">
                        <span class="material-symbols-outlined">verified_user</span>
                        Garantías
                    </a>
                </li>
                <li>
                    <a href="/reportes" class="activo">
                        <span class="material-symbols-outlined">bar_chart</span>
                        Reportes
                    </a>
                </li>
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

    <!-- Contenido Principal -->
    <div class="main-content">
        
        <div class="top-header">
            <div class="titulo-pagina">
                <h1>Historial de Movimientos y Reportes</h1>
                <p>Consulta histórica de servicios, auditoría de refacciones instaladas y rendimiento financiero del taller.</p>
            </div>
        </div>

        <!-- Pestañas -->
        <div class="tabs-container">
            <button class="tab-btn activo" onclick="cambiarTab('ot')" id="btn-tab-ot">
                <span class="punto">●</span> Reportes de Órdenes de Trabajo (OT)
            </button>
            <button class="tab-btn" onclick="cambiarTab('ventas')" id="btn-tab-ventas">
                <span class="punto">●</span> Reporte de Ventas Directas
            </button>
        </div>

        <!-- Filtros Comunes -->
        <div class="filtros-grid">
            <div class="form-group">
                <label>Fecha Inicio</label>
                <div class="input-contenedor">
                    <input type="date" value="2026-01-01">
                </div>
            </div>
            <div class="form-group">
                <label>Fecha Fin</label>
                <div class="input-contenedor">
                    <input type="date" value="2026-01-31">
                </div>
            </div>
            <div class="form-group">
                <label>Búsqueda Rápida</label>
                <div class="input-contenedor con-icono">
                    <span class="material-symbols-outlined icono-input">search</span>
                    <input type="text" placeholder="Buscar por Folio OT, Cliente, Falla...">
                </div>
            </div>
        </div>

        <!-- ==========================================
             TAB 1: ÓRDENES DE TRABAJO
             ========================================== -->
        <div id="tab-ot" class="contenido-tab activo">
            
            <div class="contenedor-tabla">
                <table>
                    <thead>
                        <tr>
                            <th>Folio OT</th>
                            <th>Fecha</th>
                            <th>Cliente / Titular</th>
                            <th>Refacciones ($)</th>
                            <th>Mano Obra ($)</th>
                            <th>Total ($)</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="seleccionada">
                            <td><strong>OT-2026-042</strong></td>
                            <td>15 Ene 2026</td>
                            <td>Agrícola El Milagro S.A.</td>
                            <td>$535.00</td>
                            <td>$150.00</td>
                            <td><strong>$685.00</strong></td>
                            <td><span class="status status-vigente">● VIGENTE</span></td>
                        </tr>
                        <tr>
                            <td><strong>OT-2026-041</strong></td>
                            <td>12 Ene 2026</td>
                            <td>Sistemas de Riego Bajío</td>
                            <td>$420.00</td>
                            <td>$120.00</td>
                            <td><strong>$540.00</strong></td>
                            <td><span class="status status-entregado">● ENTREGADO</span></td>
                        </tr>
                        <tr>
                            <td><strong>OT-2026-040</strong></td>
                            <td>08 Ene 2026</td>
                            <td>Constructora Del Norte</td>
                            <td>$850.00</td>
                            <td>$250.00</td>
                            <td><strong>$1100.00</strong></td>
                            <td><span class="status status-entregado">● ENTREGADO</span></td>
                        </tr>
                        <tr>
                            <td><strong>OT-2026-039</strong></td>
                            <td>05 Ene 2026</td>
                            <td>Minera Sierra Gorda</td>
                            <td>$180.00</td>
                            <td>$80.00</td>
                            <td><strong>$260.00</strong></td>
                            <td><span class="status status-cancelado">● CANCELADO</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Panel de Detalles OT -->
            <div class="detalle-expediente">
                <div class="detalle-info">
                    <div class="detalle-titulo">
                        <span class="badge-preview">VISTA PREVIA DE EXPEDIENTE</span>
                        Detalle Técnico del Servicio: OT-2026-042
                    </div>

                    <div class="seccion-texto">
                        <h4>DIAGNÓSTICO TÉCNICO OFICIAL</h4>
                        <p>Bomba sumergible de pozos profundos presenta sobrecalentamiento y pérdida de presión en régimen continuo. Se detecta daño por cavitación en rodete y desgaste excesivo en sellos mecánicos.</p>
                    </div>

                    <div class="seccion-texto">
                        <h4>DESGLOSE DE REFACCIONES UTILIZADAS</h4>
                        <ul>
                            <li>1x Rodete de Bronce Fundido B-62 ($350.00)</li>
                            <li>2x Sello Mecánico de Silicio 1.5" ($170.00)</li>
                            <li>1x O-Ring de Vitón Kit ($15.00)</li>
                        </ul>
                    </div>

                    <div class="grid-costos">
                        <div class="seccion-texto">
                            <h4>COSTO MANO DE OBRA</h4>
                            <p class="valor-destacado">$150.00 MXN</p>
                        </div>
                        <div class="seccion-texto">
                            <h4>SELLO DE COBERTURA DE GARANTÍA ACTIVA</h4>
                            <p class="valor-destacado">Garantía Taller: 90 Días Válida (Hasta 15 Abr 2026)</p>
                        </div>
                    </div>
                </div>

                <div class="detalle-certificado">
                    <div class="caja-sello">
                        <div class="sello-header">
                            <div class="icono-escudo">
                                <span class="material-symbols-outlined" style="font-size: 16px;">shield</span>
                            </div>
                            <h4>Sello de Seguridad OT<br><span style="font-size:9px; color:#888; font-weight:normal;">CÓDIGO ANTIFALSIFICACIÓN</span></h4>
                        </div>
                        <div class="codigo-caja">
                            <p>CÓDIGO GARANTÍA OFICIAL</p>
                            <h3>BG-8A92-F92B-2026</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
             TAB 2: VENTAS DIRECTAS
             ========================================== -->
        <div id="tab-ventas" class="contenido-tab">
            
            <div class="contenedor-tabla">
                <table>
                    <thead>
                        <tr>
                            <th>Folio Ticket</th>
                            <th>Fecha</th>
                            <th>Cliente (Mostrador)</th>
                            <th>Cant. Artículos</th>
                            <th>Descuento</th>
                            <th>Total ($)</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="seleccionada">
                            <td><strong>TK-99215</strong></td>
                            <td>15 Ene 2026</td>
                            <td>Público en General</td>
                            <td>3 Pzas</td>
                            <td>$0.00</td>
                            <td><strong>$385.00</strong></td>
                            <td><span class="status status-entregado">● PAGADO</span></td>
                        </tr>
                        <tr>
                            <td><strong>TK-99214</strong></td>
                            <td>14 Ene 2026</td>
                            <td>Taller Mecánico Hernández</td>
                            <td>1 Pza</td>
                            <td>$20.00</td>
                            <td><strong>$1,450.00</strong></td>
                            <td><span class="status status-entregado">● PAGADO</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Panel de Detalles Ventas -->
            <div class="detalle-expediente">
                <div class="detalle-info">
                    <div class="detalle-titulo">
                        <span class="badge-preview">TICKET DE VENTA</span>
                        Resumen de Venta Directa: TK-99215
                    </div>

                    <div class="seccion-texto">
                        <h4>ARTÍCULOS VENDIDOS</h4>
                        <ul>
                            <li>2x Balero SKF 6305-2RS ($240.00)</li>
                            <li>1x Capacitador de Arranque 200uF ($145.00)</li>
                        </ul>
                    </div>

                    <div class="grid-costos">
                        <div class="seccion-texto">
                            <h4>TIPO DE PAGO</h4>
                            <p class="valor-destacado">Tarjeta de Débito</p>
                        </div>
                        <div class="seccion-texto">
                            <h4>GARANTÍA APLICABLE</h4>
                            <p class="valor-destacado">30 Días (Defecto de Fábrica)</p>
                        </div>
                    </div>
                </div>

                <div class="detalle-certificado">
                    <div class="caja-sello">
                        <div class="sello-header">
                            <div class="icono-escudo">
                                <span class="material-symbols-outlined" style="font-size: 16px;">receipt_long</span>
                            </div>
                            <h4>Comprobante de Venta<br><span style="font-size:9px; color:#888; font-weight:normal;">FOLIO INTERNO</span></h4>
                        </div>
                        <div class="codigo-caja">
                            <p>TICKET REGISTRADO</p>
                            <h3>TK-99215-2026</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer común de acciones -->
        <div class="footer-acciones">
            <p class="nota-auditoria">* Toda reimpresión o exportación queda registrada bajo auditoría de Admin Taller.</p>
            <button class="btn-exportar" id="btn-accion-exportar">
                <span class="material-symbols-outlined" style="font-size: 18px;">picture_as_pdf</span> 
                <span>Exportar OT a PDF</span>
            </button>
        </div>

    </div>

    <!-- Script para cambiar entre pestañas -->
    <script>
        function cambiarTab(tab) {
            // Quitar clase activo de todos los botones y contenidos
            document.getElementById('btn-tab-ot').classList.remove('activo');
            document.getElementById('btn-tab-ventas').classList.remove('activo');
            document.getElementById('tab-ot').classList.remove('activo');
            document.getElementById('tab-ventas').classList.remove('activo');

            // Agregar clase activo al seleccionado
            document.getElementById('btn-tab-' + tab).classList.add('activo');
            document.getElementById('tab-' + tab).classList.add('activo');

            // Cambiar el texto del botón de exportar según la pestaña[span_6](start_span)[span_6](end_span)[span_7](start_span)[span_7](end_span)
            const btnTexto = document.querySelector('#btn-accion-exportar span:last-child');
            if (tab === 'ot') {
                btnTexto.textContent = 'Exportar OT a PDF';
            } else {
                btnTexto.textContent = 'Exportar Venta Directa a PDF';
            }
        }
    </script>
</body>
</html>
