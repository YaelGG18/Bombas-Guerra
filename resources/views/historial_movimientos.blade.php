<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Historial y Reportes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #EAEFF2; min-height: 100vh; display: flex; }

        /* Menú Lateral */
        .sidebar { width: 260px; background-color: #002347; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 100vh; }
        .sidebar-header { padding: 25px 20px; border-bottom: 2px solid #FFCC00; text-decoration: none; display: block; transition: background-color 0.2s; }
        .sidebar-header:hover { background-color: #001f3f; }
        .sidebar-header h2 { font-size: 16px; color: #FFCC00; letter-spacing: 1px; }
        .sidebar-header p { font-size: 11px; color: #b0c4de; margin-top: 4px; }
        .sidebar-menu { list-style: none; padding: 20px 0; flex-grow: 1; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #cce0ff; text-decoration: none; font-size: 14px; transition: 0.2s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.activo { background-color: #003366; color: #FFCC00; border-left: 4px solid #FFCC00; }
        .sidebar-footer { padding: 20px; background-color: #001833; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .sidebar-footer:hover { background-color: #001026; }
        .sidebar-footer .icono-admin { color: #FFCC00; font-size: 32px; }
        .sidebar-footer .info-admin { font-size: 12px; }
        .sidebar-footer .estado { font-size: 10px; color: #4CAF50; margin-top: 3px; }

        /* Contenido Principal */
        .main-content { flex-grow: 1; padding: 30px; }
        .top-header { margin-bottom: 20px; }
        .titulo-pagina h1 { color: #002B54; font-size: 24px; margin-bottom: 5px; }
        .titulo-pagina p { color: #666; font-size: 14px; }

        /* Pestañas */
        .tabs-container { display: flex; gap: 30px; margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .tab-btn { background: none; border: none; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 8px; color: #888; font-weight: normal; transition: 0.2s; }
        .tab-btn:hover { color: #555; }
        .tab-btn .punto { font-size: 12px; color: #ccc; }
        .tab-btn.activo { color: #002B54; font-weight: bold; }
        .tab-btn.activo .punto { color: #FFCC00; }

        /* Filtros */
        .filtros-grid { display: grid; grid-template-columns: 200px 200px 1fr; gap: 20px; margin-bottom: 20px; align-items: end; }
        .form-group label { display: block; font-size: 10px; color: #888; text-transform: uppercase; margin-bottom: 5px; font-weight: bold; }
        .input-contenedor { position: relative; }
        .input-contenedor input { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px; color: #333; outline: none; background: white; }
        .input-contenedor.con-icono input { padding-left: 35px; }
        .input-contenedor.con-icono .icono-input { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #888; font-size: 18px; }

        /* Tablas */
        .contenedor-tabla { background-color: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        thead tr { background-color: #F4F7F9; color: #555; border-bottom: 1px solid #E0E0E0; }
        th { font-weight: bold; padding: 12px 20px; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        td { padding: 12px 20px; border-bottom: 1px solid #f0f0f0; color: #333; }
        .mensaje-vacio { text-align: center; padding: 40px !important; color: #888; }

        /* Footer */
        .footer-acciones { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; }
        .nota-auditoria { font-size: 11px; color: #888; font-style: italic; }
        .btn-exportar { background-color: #FFCC00; color: #000; border: none; padding: 10px 20px; border-radius: 6px; font-size: 12px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
        .btn-exportar:hover { background-color: #e6b800; }

        .contenido-tab { display: none; }
        .contenido-tab.activo { display: block; }
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
                <li><a href="/garantias"><span class="material-symbols-outlined">verified_user</span> Garantías</a></li>
                <li><a href="/historial_movimientos" class="activo"><span class="material-symbols-outlined">bar_chart</span> Historial y Reportes</a></li>
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
                <h1>Historial de Movimientos y Reportes</h1>
                <p>Consulta histórica de servicios, auditoría de refacciones instaladas y rendimiento financiero del taller.</p>
            </div>
        </div>

        <!-- Pestañas -->
        <div class="tabs-container">
            <button class="tab-btn {{ $tabActiva == 'ot' ? 'activo' : '' }}" onclick="cambiarTab('ot')" id="btn-tab-ot" type="button">
                <span class="punto">●</span> Reportes de Órdenes de Trabajo (OT)
            </button>
            <button class="tab-btn {{ $tabActiva == 'ventas' ? 'activo' : '' }}" onclick="cambiarTab('ventas')" id="btn-tab-ventas" type="button">
                <span class="punto">●</span> Reporte de Ventas Directas
            </button>
        </div>

        <!-- Filtros Comunes -->
        <form action="/historial_movimientos" method="GET" class="filtros-grid" id="formFiltros">
            <input type="hidden" name="tab" id="inputTab" value="{{ $tabActiva }}">
            <div class="form-group">
                <label>Fecha Inicio</label>
                <div class="input-contenedor">
                    <input type="date" name="fecha_inicio" value="{{ $fechaInicio }}" onchange="this.form.submit()">
                </div>
            </div>
            <div class="form-group">
                <label>Fecha Fin</label>
                <div class="input-contenedor">
                    <input type="date" name="fecha_fin" value="{{ $fechaFin }}" onchange="this.form.submit()">
                </div>
            </div>
            <div class="form-group">
                <label>Búsqueda Rápida</label>
                <div class="input-contenedor con-icono">
                    <span class="material-symbols-outlined icono-input">search</span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por Folio OT, Cliente..." onchange="this.form.submit()">
                </div>
            </div>
        </form>

        <!-- TAB 1: ÓRDENES DE TRABAJO -->
        <div id="tab-ot" class="contenido-tab {{ $tabActiva == 'ot' ? 'activo' : '' }}">
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
                        @forelse($ordenes as $ot)
                            <tr>
                                <td><strong>{{ $ot->folioOT }}</strong></td>
                                <td>{{ $ot->fechaCreacion }}</td>
                                <td>
                                    {{ $ot->nombreCliente }}<br>
                                    <small style="color: #003366; font-weight: bold;">Tel: {{ $ot->telefono }}</small>
                                </td>
                                <td>${{ number_format($ot->refaccionesTotal, 2) }}</td>
                                <td>${{ number_format($ot->costoManoObra, 2) }}</td>
                                <td><strong>${{ number_format($ot->totalGeneral, 2) }}</strong></td>
                                <td>
                                    @if($ot->estadoOT == 'En Proceso')
                                        <span style="color: #d97706; font-weight: bold;">En Proceso</span>
                                    @elseif($ot->estadoOT == 'Terminado')
                                        <span style="color: #065f46; font-weight: bold;">Terminado</span>
                                    @else
                                        <span style="color: #991b1b; font-weight: bold;">Cancelado</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="mensaje-vacio">
                                    Utilice los filtros de fecha o la búsqueda rápida para consultar las órdenes de trabajo.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: VENTAS DIRECTAS -->
        <div id="tab-ventas" class="contenido-tab {{ $tabActiva == 'ventas' ? 'activo' : '' }}">
            <div class="contenedor-tabla">
                <table>
                    <thead>
                        <tr>
                            <th>Folio Ticket</th>
                            <th>Fecha</th>
                            <th>Cliente (Mostrador)</th>
                            <th>Cant. Artículos</th>
                            <th>Total ($)</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas as $v)
                            <tr>
                                <td><strong>{{ $v->folioTicket }}</strong></td>
                                <td>{{ $v->created_at }}</td>
                                <td>{{ $v->clienteMostrador }}</td>
                                <td>{{ $v->cantidadArticulos }} unids.</td>
                                <td><strong>${{ number_format($v->total, 2) }}</strong></td>
                                <td><span style="color: #065f46; font-weight: bold;">Completado</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="mensaje-vacio">
                                    Utilice los filtros de fecha o la búsqueda rápida para consultar las ventas directas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer común de acciones -->
        <div class="footer-acciones">
            <p class="nota-auditoria">* Toda reimpresión o exportación queda registrada bajo auditoría de Admin Taller.</p>
            <button class="btn-exportar" id="btn-accion-exportar" onclick="window.print()">
                <span class="material-symbols-outlined" style="font-size: 18px;">picture_as_pdf</span> 
                <span id="btnTextoExportar">Exportar Venta Directa a PDF</span>
            </button>
        </div>

    </div>

    <!-- Script para cambiar entre pestañas -->
    <script>
        function cambiarTab(tab) {
            document.getElementById('btn-tab-ot').classList.remove('activo');
            document.getElementById('btn-tab-ventas').classList.remove('activo');
            document.getElementById('tab-ot').classList.remove('activo');
            document.getElementById('tab-ventas').classList.remove('activo');

            document.getElementById('btn-tab-' + tab).classList.add('activo');
            document.getElementById('tab-' + tab).classList.add('activo');

            document.getElementById('inputTab').value = tab;

            const btnTexto = document.getElementById('btnTextoExportar');
            if (tab === 'ot') {
                btnTexto.textContent = 'Exportar OT a PDF';
            } else {
                btnTexto.textContent = 'Exportar Venta Directa a PDF';
            }
        }
    </script>
</body>
</html>