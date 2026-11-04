<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Cotizaciones</title>
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

        /* Layout Grid para el módulo */
        .grid-cotizacion {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card-modulo {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #002B54;
        }

        .card-header h3 {
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 13px;
            background-color: #f9fbfd;
            outline: none;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        /* Buscador del catálogo */
        .search-box {
            position: relative;
            margin-bottom: 15px;
        }

        .search-box input {
            padding-left: 35px;
        }

        .search-box span {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 20px;
        }

        /* Contenedores vacíos de listas */
        .lista-vacia {
            border: 1px dashed #ccc;
            border-radius: 6px;
            padding: 30px;
            text-align: center;
            color: #888;
            font-size: 13px;
            background-color: #fafafa;
        }

        /* Lista de refacciones dinámica */
        .lista-refacciones {
            max-height: 300px; 
            overflow-y: auto; 
            padding-right: 5px;
        }

        .item-refaccion {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 12px; 
            border-bottom: 1px solid #eee; 
            background: #fff; 
            margin-bottom: 5px; 
            border-radius: 6px; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .btn-add-pieza {
            background: #002B54; 
            color: #FFCC00; 
            border: none; 
            border-radius: 4px; 
            width: 30px; 
            height: 30px; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center;
        }

        .btn-add-pieza:hover {
            background: #001f3f;
        }

        /* Resumen de costos */
        .resumen-filas {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .monto-box h4 {
            font-size: 11px;
            color: #777;
            text-transform: uppercase;
        }

        .monto-box p {
            font-size: 20px;
            font-weight: bold;
            color: #002B54;
        }

        .btn-aprobar {
            width: 100%;
            background-color: #FFCC00;
            color: #002347;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .btn-aprobar:hover {
            background-color: #e6b800;
        }
        
        /* Estilos para las alertas de Laravel */
        .alerta {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .alerta-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alerta-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
                    <a href="/cotizaciones" class="activo">
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
                <h1>Cotizaciones</h1>
                <p>Gestión de presupuestos, diagnóstico hidráulico y selección de refacciones.</p>
            </div>
        </div>

        <!-- ALERTAS DE LARAVEL -->
        @if(session('success'))
            <div class="alerta alerta-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alerta alerta-error">{{ session('error') }}</div>
        @endif

        <!-- FORMULARIO ENVOLVIENDO TODO EL CONTENIDO DEL GRID -->
        <form action="{{ route('cotizacion.generar') }}" method="POST">
            @csrf <!-- Token Obligatorio -->

            <div class="grid-cotizacion">
                
                <!-- Columna Izquierda -->
                <div>
                    <!-- Datos del Trabajo y Cliente -->
                    <div class="card-modulo">
                        <div class="card-header">
                            <span class="material-symbols-outlined">person</span>
                            <h3>Datos del Trabajo y Cliente</h3>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label for="telefono">Número Telefónico</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ej. 477 123 4567">
                            </div>
                            <div class="form-group">
                                <label for="cliente">Nombre del Cliente</label>
                                <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Nombre completo o empresa" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="diagnostico">Falla / Diagnóstico Técnico</label>
                            <textarea id="diagnostico" name="falla" class="form-control" placeholder="Describa la falla reportada por el cliente o el diagnóstico de la bomba..." required></textarea>
                        </div>
                    </div>

                    <!-- Catálogo de Refacciones -->
                    <div class="card-modulo">
                        <div class="card-header">
                            <span class="material-symbols-outlined">category</span>
                            <h3>Catálogo de Refacciones</h3>
                        </div>

                        <div class="search-box">
                            <span class="material-symbols-outlined">search</span>
                            <!-- Este input no lleva name porque solo se usará con JavaScript para buscar -->
                            <input type="text" id="buscador_refacciones" class="form-control" placeholder="Buscar refacción por nombre...">
                        </div>

                        <!-- Contenedor dinámico de piezas -->
                        <div class="lista-refacciones">
                            @forelse($refacciones as $refaccion)
                                <div class="item-refaccion" data-nombre="{{ strtolower($refaccion->nombre) }}">
                                    <div style="flex-grow: 1;">
                                        <strong style="color: #002B54; font-size: 14px;">{{ $refaccion->nombre }}</strong><br>
                                        <small style="color: #666;">Stock disponible: {{ $refaccion->cantidadStock ?? 0 }}</small>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-weight: bold; color: #4CAF50;">${{ number_format($refaccion->precio, 2) }}</span>
                                        <button type="button" class="btn-add-pieza" title="Agregar a cotización">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="lista-vacia">
                                    No hay piezas registradas en el inventario.
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <!-- Desglose de Refacciones Seleccionadas -->
                    <div class="card-modulo">
                        <div class="card-header">
                            <span class="material-symbols-outlined">shopping_bag</span>
                            <h3>Desglose de Refacciones Seleccionadas</h3>
                        </div>

                        <div class="lista-vacia">
                            Aún no se han seleccionado refacciones para esta cotización.
                        </div>
                    </div>

                    <!-- Resumen de Costos y Mano de Obra -->
                    <div class="card-modulo">
                        <div class="card-header">
                            <span class="material-symbols-outlined">receipt_long</span>
                            <h3>Resumen de Costos y Mano de Obra</h3>
                        </div>

                        <div class="resumen-filas">
                            <div class="monto-box">
                                <h4>Subtotal Refacciones</h4>
                                <p>$0.00</p>
                            </div>
                            <div class="form-group" style="margin-bottom: 0; width: 140px;">
                                <label for="mano_obra">Mano de Obra ($)</label>
                                <input type="number" step="1" min="0" id="mano_obra" name="mano_obra" class="form-control" placeholder="0.00" value="0.00">
                            </div>
                            <div class="monto-box">
                                <h4>Total Cotización</h4>
                                <p>$0.00</p>
                            </div>
                        </div>
                        
                        <!-- Input oculto para enviar el JSON de las refacciones seleccionadas -->
                        <input type="hidden" name="refacciones" id="refacciones_hidden" value="[]">

                        <!-- Botón Submit -->
                        <button type="submit" class="btn-aprobar">
                            <span class="material-symbols-outlined">check_circle</span>
                            Aprobar cotización y crear orden de trabajo
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Script para el buscador en tiempo real -->
    <script>
        document.getElementById('buscador_refacciones').addEventListener('input', function(e) {
            let filtro = e.target.value.toLowerCase();
            let items = document.querySelectorAll('.item-refaccion');

            items.forEach(item => {
                let nombre = item.getAttribute('data-nombre');
                if (nombre.includes(filtro)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>