<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Registrar Entrada</title>
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
            flex-shrink: 0;
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
            width: calc(100% - 260px);
        }

        .top-header {
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

        /* Tarjeta Formulario Responsive (Aprovecha el 100% del ancho) */
        .card-formulario {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #002B54;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #f9fbfd;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #003366;
            background-color: #fff;
        }

        /* Filas con múltiples columnas */
        .form-row-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-row-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Botones de acción */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-cancelar {
            background-color: #e0e0e0;
            color: #444;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-cancelar:hover {
            background-color: #d0d0d0;
        }

        .btn-guardar {
            background-color: #FFCC00;
            color: #002347;
            border: none;
            padding: 10px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            transition: background-color 0.2s;
        }

        .btn-guardar:hover {
            background-color: #e6b800;
        }

        /* Adaptabilidad (Media Queries) */
        @media (max-width: 992px) {
            .form-row-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .form-row-2, .form-row-4 {
                grid-template-columns: 1fr;
            }
            .main-content {
                padding: 15px;
            }
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
                    <a href="/registrar_entrada" class="activo">
                        <span class="material-symbols-outlined">move_to_inbox</span>
                        Registrar Entrada
                    </a>
                </li>
                <li>
                    <a href="venta_directa">
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
                    <a href="/garantias">
                        <span class="material-symbols-outlined">verified_user</span>
                        Garantías
                    </a>
                </li>
                <li>
                    <a href="/historial_movimientos">
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
                <h1>Registrar Entrada de Refacción</h1>
                <p>Ingrese la información detallada del repuesto o bomba hidráulica para ingresarlo al inventario general.</p>
            </div>
        </div>

        <!-- Formulario Responsive -->
        <div class="card-formulario">
           <form action="/registrar_entrada" method="POST">
             @csrf
                
                <!-- Nombre de la Refacción -->
                <div class="form-group">
                    <label for="nombre">Nombre de la Refacción</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Sello Mecánico Silicio 1/2" required>
                </div>

                <!-- Tipo / Categoría y Marca -->
                <div class="form-row-2">
                    <div class="form-group">
                        <label for="categoria">Tipo de Pieza / Categoría</label>
                        <input type="text" id="categoria" name="categoria" class="form-control" placeholder="Ej. Sello, Bomba, Rotor" required>
                    </div>

                    <div class="form-group">
                        <label for="marca">Marca / Fabricante</label>
                        <input type="text" id="marca" name="marca" class="form-control" placeholder="Ej. Guerra, Pedrollo, York" required>
                    </div>
                </div>

                <!-- Precios y Cantidades -->
                <div class="form-row-4">
                    <div class="form-group">
                        <label for="precio_compra">Precio Compra ($)</label>
                        <input type="number" step="0.01" min="0" id="precio_compra" name="precio_compra" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="form-group">
                        <label for="precio_venta">Precio Venta ($)</label>
                        <input type="number" step="0.01" min="0" id="precio_venta" name="precio_venta" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad a Ingresar</label>
                        <input type="number" min="1" id="cantidad" name="cantidad" class="form-control" placeholder="1" required>
                    </div>

                    <div class="form-group">
                        <label for="stock_minimo">Stock Mínimo</label>
                        <input type="number" min="0" id="stock_minimo" name="stock_minimo" class="form-control" placeholder="0" required>
                    </div>
                </div>

                <!-- Descripción / Notas -->
                <div class="form-group">
                    <label for="descripcion">Descripción / Notas Adicionales</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Escribe detalles adicionales de la pieza o su aplicación..."></textarea>
                </div>

                <!-- Botones -->
                <div class="form-actions">
                    <a href="/inventario" class="btn-cancelar">Cancelar</a>
                    <button type="submit" class="btn-guardar">Guardar Entrada</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>