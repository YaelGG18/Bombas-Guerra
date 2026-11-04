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
        .sidebar { width: 260px; background-color: #002347; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 100vh; flex-shrink: 0; }
        .sidebar-header { padding: 25px 20px; border-bottom: 2px solid #FFCC00; text-decoration: none; display: block; }
        .sidebar-header h2 { font-size: 16px; color: #FFCC00; letter-spacing: 1px; }
        .sidebar-header p { font-size: 11px; color: #b0c4de; }
        .sidebar-menu { list-style: none; padding: 20px 0; flex-grow: 1; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #cce0ff; text-decoration: none; font-size: 14px; }
        .sidebar-menu li a:hover, .sidebar-menu li a.activo { background-color: #003366; color: #FFCC00; border-left: 4px solid #FFCC00; }
        .sidebar-footer { padding: 20px; background-color: #001833; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .sidebar-footer .icono-admin { color: #FFCC00; font-size: 32px; }
        .sidebar-footer .info-admin { font-size: 12px; }
        .sidebar-footer .estado { font-size: 10px; color: #4CAF50; }

        /* Contenido Principal */
        .main-content { flex-grow: 1; padding: 30px; min-width: 0; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .titulo-pagina h1 { color: #002B54; font-size: 24px; margin-bottom: 4px; }
        .titulo-pagina p { color: #666; font-size: 14px; }

        /* Tarjetas de Estadísticas */
        .grid-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; max-width: 750px; }
        .card-stat { background-color: white; border-radius: 8px; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px; }
        .card-stat .numero { font-size: 28px; font-weight: bold; color: #002B54; }
        .card-stat .label h4 { font-size: 13px; color: #333; }
        .card-stat .label p { font-size: 11px; color: #888; }

        /* Buscador */
        .bar-busqueda { display: flex; gap: 10px; margin-bottom: 20px; }
        .bar-busqueda input { flex-grow: 1; padding: 10px 15px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; outline: none; }
        .btn-filtrar { background-color: #002B54; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 5px; font-weight: bold; }
        .btn-filtrar:hover { background-color: #001f3f; }

        /* Tabla */
        .contenedor-tabla { background-color: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow-x: auto; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        thead tr { background-color: #F4F7F9; color: #444; border-bottom: 2px solid #E0E0E0; }
        th, td { padding: 14px 16px; border-bottom: 1px solid #eee; }
        .mensaje-vacio { text-align: center; padding: 40px !important; color: #888; }
        .footer-tabla { padding: 15px 20px; background-color: #F4F7F9; color: #666; font-size: 12px; border-top: 1px solid #E0E0E0; display: flex; justify-content: space-between; }

        .badge-vigente { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; background-color: #d1fae5; color: #065f46; }
        .badge-vencida { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; background-color: #fee2e2; color: #991b1b; }

        .btn-crear { background-color: #FFCC00; color: #002347; border: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; }
        .btn-crear:hover { background-color: #e6b800; }

        .btn-imprimir { background-color: #002347; color: #FFCC00; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 12px; display: inline-flex; align-items: center; gap: 4px; }
        .btn-imprimir:hover { background-color: #003366; }

        /* Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 1000; }
        .modal-card { background: white; border-radius: 10px; width: 90%; max-width: 500px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #dcdcdc; padding-bottom: 15px; margin-bottom: 20px; }
        .modal-header h2 { color: #002B54; font-size: 18px; }
        .btn-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #666; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; color: #002B54; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #dcdcdc; border-radius: 6px; font-size: 14px; outline: none; }

        .alert { padding: 12px; border-radius: 6px; margin-bottom: 15px; font-size: 13px; font-weight: bold; background-color: #d4edda; color: #155724; }
        .alert-error { padding: 12px; border-radius: 6px; margin-bottom: 15px; font-size: 13px; font-weight: bold; background-color: #f8d7da; color: #721c24; }

        /* Estilo para impresión de ticket térmico */
        @media print {
            body * { visibility: hidden; }
            #ticketImpresion, #ticketImpresion * { visibility: visible; }
            #ticketImpresion { position: absolute; left: 0; top: 0; width: 100%; padding: 10px; font-family: monospace; font-size: 12px; color: black; background: white; }
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
                <li><a href="/inventario"><span class="material-symbols-outlined">inventory_2</span> Inventario</a></li>
                <li><a href="/registrar_entrada"><span class="material-symbols-outlined">move_to_inbox</span> Registrar Entrada</a></li>
                <li><a href="/venta_directa"><span class="material-symbols-outlined">shopping_cart</span> Venta Directa</a></li>
                <li><a href="/cotizaciones"><span class="material-symbols-outlined">request_quote</span> Cotizaciones</a></li>
                <li><a href="/ordenes_trabajo"><span class="material-symbols-outlined">build</span> Órdenes de Trabajo</a></li>
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

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="top-header">
            <div class="titulo-pagina">
                <h1>Gestión de Garantías</h1>
                <p>Control de pólizas y códigos de verificación para reparaciones concluidas.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="grid-stats">
            <div class="card-stat">
                <div class="numero">{{ $totalGarantias }}</div>
                <div class="label"><h4>Total Registradas</h4><p>Pólizas emitidas</p></div>
            </div>
            <div class="card-stat">
                <div class="numero" style="color: #27ae60;">{{ $vigentesCount }}</div>
                <div class="label"><h4>Vigentes</h4><p>Garantías activas</p></div>
            </div>
            <div class="card-stat">
                <div class="numero" style="color: #c0392b;">{{ $vencidasCount }}</div>
                <div class="label"><h4>Vencidas</h4><p>Pólizas expiradas</p></div>
            </div>
        </div>

        <!-- Buscador -->
        <form action="/garantias" method="GET" class="bar-busqueda">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por Código de Garantía, Folio OT o Cliente...">
            <button type="submit" class="btn-filtrar">
                <span class="material-symbols-outlined">search</span> Buscar
            </button>
        </form>

        <!-- Tabla -->
        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Código Garantía</th>
                        <th>Folio OT</th>
                        <th>Cliente / Tel.</th>
                        <th>Fecha Inicio</th>
                        <th>Vigencia</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($garantias as$gar)
                        @php
                            $fechaVencimiento = \Carbon\Carbon::parse($gar->fechalinicio)->addDays($gar->vigenciaDias)->toDateString();
                        @endphp
                        <tr>
                            <td><strong>{{ $gar->codigoVerificacion }}</strong></td>
                            <td>{{ $gar->folioOT }}</td>
                            <td>
                                {{ $gar->nombreCliente }}<br>
                                <small style="color: #003366; font-weight: bold;">Tel: {{ $gar->telefono }}</small>
                            </td>
                            <td>{{ $gar->fechalinicio }}</td>
                            <td>{{ $gar->vigenciaDias }} días</td>
                            <td><strong style="color: #002B54;">{{ $fechaVencimiento }}</strong></td>
                            <td>
                                @if($gar->estadoGarantia == 'Vigente')
                                    <span class="badge-vigente">Vigente</span>
                                @else
                                    <span class="badge-vencida">Vencida</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn-imprimir" onclick="imprimirTicket('{{ $gar->codigoVerificacion }}', '{{$gar->folioOT }}', '{{ $gar->nombreCliente }}', '{{$gar->fechalinicio }}', '{{ $gar->vigenciaDias }}', '{{$fechaVencimiento }}')">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">print</span> Imprimir
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="mensaje-vacio">
                                {{ request('search') || request('ot') ? 'No se encontraron garantías registradas.' : 'Utilice el buscador superior o emita una nueva garantía.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="footer-tabla">
                <span>Mostrando {{ count($garantias) }} registros</span>
                <span>BOMBAS GUERRA S.A. DE C.V.</span>
            </div>
        </div>

        <!-- Botón Inferior -->
        <div style="margin-top: 20px;">
            <button class="btn-crear" onclick="abrirModalGarantia()">
                <span class="material-symbols-outlined">add_circle</span> Emitir Nueva Garantía
            </button>
        </div>
    </div>

    <!-- TICKET OCULTO PARA IMPRESIÓN TÉRMICA -->
    <div id="ticketImpresion" style="display: none;">
        <div style="text-align: center; font-weight: