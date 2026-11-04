<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Órdenes de Trabajo</title>
    <!-- Iconos de Google Material Symbols con grosor delgado -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #EAEFF2; min-height: 100vh; display: flex; }

        /* Menú Lateral (Sidebar) */
        .sidebar { width: 260px; background-color: #002347; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 100vh; flex-shrink: 0; }
        .sidebar-header { padding: 25px 20px; border-bottom: 2px solid #FFCC00; text-decoration: none; display: block; transition: background-color 0.2s; }
        .sidebar-header:hover { background-color: #001f3f; }
        .sidebar-header h2 { font-size: 16px; color: #FFCC00; letter-spacing: 1px; }
        .sidebar-header p { font-size: 11px; color: #b0c4de; }
        .sidebar-menu { list-style: none; padding: 20px 0; flex-grow: 1; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #cce0ff; text-decoration: none; font-size: 14px; transition: 0.2s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.activo { background-color: #003366; color: #FFCC00; border-left: 4px solid #FFCC00; }
        .sidebar-footer { padding: 20px; background-color: #001833; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .sidebar-footer:hover { background-color: #001026; }
        .sidebar-footer .icono-admin { color: #FFCC00; font-size: 32px; }
        .sidebar-footer .info-admin { font-size: 12px; }
        .sidebar-footer .estado { font-size: 10px; color: #4CAF50; }

        /* Contenido Principal */
        .main-content { flex-grow: 1; padding: 30px; min-width: 0; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .titulo-pagina h1 { color: #002B54; font-size: 24px; margin-bottom: 4px; }
        .titulo-pagina p { color: #666; font-size: 14px; }

        /* Tarjetas de Contadores */
        .grid-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px; }
        .card-stat { background-color: white; border-radius: 8px; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px; }
        .card-stat .numero { font-size: 28px; font-weight: bold; color: #002B54; }
        .card-stat .label h4 { font-size: 13px; color: #333; }
        .card-stat .label p { font-size: 11px; color: #888; }

        /* Buscador */
        .bar-busqueda { display: flex; gap: 10px; margin-bottom: 20px; }
        .bar-busqueda input { flex-grow: 1; padding: 10px 15px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; outline: none; }
        .btn-filtrar { background-color: #002B54; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 5px; font-weight: bold; }
        .btn-filtrar:hover { background-color: #001f3f; }

        /* Tabla de Órdenes */
        .contenedor-tabla { background-color: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow-x: auto; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        thead tr { background-color: #F4F7F9; color: #444; border-bottom: 2px solid #E0E0E0; }
        th, td { padding: 14px 16px; border-bottom: 1px solid #eee; }
        .mensaje-vacio { text-align: center; padding: 40px !important; color: #888; }
        .footer-tabla { padding: 15px 20px; background-color: #F4F7F9; color: #666; font-size: 12px; border-top: 1px solid #E0E0E0; display: flex; justify-content: space-between; }

        .badge-estado { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .estado-proceso { background-color: #fef3c7; color: #d97706; }
        .estado-terminado { background-color: #d1fae5; color: #065f46; }
        .estado-cancelado { background-color: #fee2e2; color: #991b1b; }

        .btn-modificar { background-color: #002347; color: #FFCC00; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 12px; }
        .btn-modificar:hover { background-color: #003366; }

        .btn-crear-ot { background-color: #FFCC00; color: #002347; border: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; }
        .btn-crear-ot:hover { background-color: #e6b800; }

        /* Modales */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 1000; }
        .modal-card { background: white; border-radius: 10px; width: 90%; max-width: 800px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #dcdcdc; padding-bottom: 15px; margin-bottom: 20px; }
        .modal-header h2 { color: #002B54; font-size: 20px; }
        .btn-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #666; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; color: #002B54; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #dcdcdc; border-radius: 6px; font-size: 14px; outline: none; }
        .form-row-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }

        .alert { padding: 12px; border-radius: 6px; margin-bottom: 15px; font-size: 13px; font-weight: bold; background-color: #d4edda; color: #155724; }
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
                <li><a href="/ordenes_trabajo" class="activo"><span class="material-symbols-outlined">build</span> Órdenes de Trabajo</a></li>
                <li><a href="/garantias"><span class="material-symbols-outlined">verified_user</span> Garantías</a></li>
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
                <h1>Gestión de Órdenes de Trabajo</h1>
                <p>Seguimiento de reparaciones activas, diagnóstico hidráulico y asignación de refacciones en taller.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <!-- Tarjetas de Estado -->
        <div class="grid-stats">
            <div class="card-stat">
                <div class="numero">{{ $totalOrdenes }}</div>
                <div class="label"><h4>Total Registradas</h4><p>Historial completo</p></div>
            </div>
            <div class="card-stat">
                <div class="numero" style="color: #e67e22;">{{ $enProceso }}</div>
                <div class="label"><h4>En Proceso</h4><p>Reparaciones activas</p></div>
            </div>
            <div class="card-stat">
                <div class="numero" style="color: #27ae60;">{{ $terminado }}</div>
                <div class="label"><h4>Terminado</h4><p>Servicio concluido</p></div>
            </div>
            <div class="card-stat">
                <div class="numero" style="color: #c0392b;">{{ $cancelado }}</div>
                <div class="label"><h4>Cancelado</h4><p>Sin cargos aplicados</p></div>
            </div>
        </div>

        <!-- Buscador -->
        <form action="/ordenes_trabajo" method="GET" class="bar-busqueda">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por Folio OT, Cliente, Teléfono o Falla...">
            <button type="submit" class="btn-filtrar">
                <span class="material-symbols-outlined">search</span> Buscar
            </button>
        </form>

        <!-- Tabla -->
        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Folio OT</th>
                        <th>Fecha</th>
                        <th>Cliente / Tel.</th>
                        <th>Falla / Diagnóstico</th>
                        <th>Mano de Obra</th>
                        <th>Estado</th>
                        <th>Acción</th>
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
                            <td>{{ $ot->diagnosticoFalla }}</td>
                            <td>${{ number_format($ot->costoManoObra, 2) }}</td>
                            <td>
                                @if($ot->estadoOT == 'En Proceso')
                                    <span class="badge-estado estado-proceso">En Proceso</span>
                                @elseif($ot->estadoOT == 'Terminado')
                                    <span class="badge-estado estado-terminado">Terminado</span>
                                @else
                                    <span class="badge-estado estado-cancelado">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn-modificar" onclick='abrirModalEditar(@json($ot))'>Modificar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="mensaje-vacio">
                                {{ request('search') ? 'No se encontraron órdenes de trabajo.' : 'Utilice el buscador superior para consultar las órdenes de trabajo.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="footer-tabla">
                <span>Mostrando {{ count($ordenes) }} registros encontrados</span>
                <span>BOMBAS GUERRA S.A. DE C.V.</span>
            </div>
        </div>

        <!-- Botón Inferior para Crear OT Directamente -->
        <div style="margin-top: 20px;">
            <button class="btn-crear-ot" onclick="abrirModalCrear()">
                <span class="material-symbols-outlined">add_circle</span> Crear Nueva Orden de Trabajo
            </button>
        </div>
    </div>

    <!-- MODAL DE EDICIÓN (Modificar diagnóstico, mano de obra y estado; nombre, teléfono y folio bloqueados) -->
    <div class="modal-overlay" id="modalEditar">
        <div class="modal-card">
            <div class="modal-header">
                <h2 id="modalTitle">Modificar Orden de Trabajo</h2>
                <button class="btn-close" onclick="cerrarModalEditar()">&times;</button>
            </div>
            <form id="formUpdate" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Folio OT (Fijo)</label>
                        <input type="text" class="form-control" id="edit_folio" disabled style="background: #e9ecef;">
                    </div>
                    <div class="form-group">
                        <label>Nombre del Cliente (Fijo)</label>
                        <input type="text" class="form-control" id="edit_cliente" disabled style="background: #e9ecef;">
                    </div>
                </div>

                <div class="form-group">
                    <label>Diagnóstico / Falla</label>
                    <textarea class="form-control" id="edit_diagnostico" name="diagnosticoFalla" rows="3" required></textarea>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Costo Mano de Obra ($)</label>
                        <input type="number" step="0.01" class="form-control" id="edit_mano_obra" name="costoManoObra" required>
                    </div>
                    <div class="form-group">
                        <label>Estado de la OT</label>
                        <select class="form-control" id="edit_estado" name="estadoOT" required>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Terminado">Terminado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" class="btn-filtrar" style="background: #ccc; color: #333;" onclick="cerrarModalEditar()">Cancelar</button>
                    <button type="submit" class="btn-filtrar" style="background: #FFCC00; color: #002347;">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>


    <!-- MODAL DE CREACIÓN DIRECTA DE OT (Estilo Cotización) -->
    <div class="modal-overlay" id="modalCrearOT">
        <div class="modal-card" style="max-width: 900px;">
            <div class="modal-header">
                <h2>Crear Nueva Orden de Trabajo Directa</h2>
                <button class="btn-close" onclick="cerrarModalCrear()">&times;</button>
            </div>
            <form action="{{ route('ordenes_trabajo.store') }}" method="POST" id="formCrearOT">
                @csrf
                <input type="hidden" name="refacciones" id="inputRefaccionesJson">

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Teléfono del Cliente</label>
                        <input type="text" class="form-control" name="telefono" placeholder="Ej. 4771234567" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Cliente</label>
                        <input type="text" class="form-control" name="nombreCliente" placeholder="Ej. Juan Pérez" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Falla / Diagnóstico Técnico</label>
                    <textarea class="form-control" name="diagnosticoFalla" rows="2" placeholder="Describa la falla..." required></textarea>
                </div>

                <!-- Buscador de Refacciones -->
                <div class="form-group">
                    <label>Seleccionar Refacciones del Inventario</label>
                    <input type="text" id="buscadorRef" class="form-control" placeholder="Buscar refacción por nombre o marca..." onkeyup="filtrarCatalogoModal()">
                </div>

                <div style="max-height: 180px; overflow-y: auto; border: 1px solid #ddd; margin-bottom: 15px; border-radius: 6px;">
                    <table style="font-size: 12px;" id="tablaCatalogoModal">
                        <thead>
                            <tr style="background: #f1f1f1;">
                                <th>Refacción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refacciones as $ref)
                            <tr class="fila-catalogo">
                                <td>{{ $ref->nombre }}</td>
                                ${{ number_format($ref->precioVentaActual, 2) }}
                                <td><strong>{{ $ref->cantidadStock }}</strong></td>
                                <td>
                                    <button type="button" class="btn-modificar" onclick="agregarItemCarrito({{ $ref->idRefaccion }}, '{{ $ref->nombre }}', {{ $ref->precioVentaActual }}, {{ $ref->cantidadStock }})">Añadir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Carrito Seleccionado -->
                <label style="font-size: 13px; font-weight: bold; color: #002B54; margin-bottom: 6px; display:block;">Refacciones en la Orden</label>
                <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ddd; margin-bottom: 15px; border-radius: 6px;">
                    <table style="font-size: 12px;">
                        <thead>
                            <tr style="background: #f1f1f1;">
                                <th>Refacción</th>
                                <th>Precio U.</th>
                                <th>Cant.</th>
                                <th>Subtotal</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody id="carritoBody">
                            <tr><td colspan="5" style="text-align: center; color: #888;">No hay refacciones añadidas.</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Costo Mano de Obra ($)</label>
                        <input type="number" step="0.01" class="form-control" name="costoManoObra" id="inputManoObra" value="0.00" oninput="calcularTotalGeneral()" required>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <label>Total Estimado</label>
                        <div style="font-size: 24px; font-weight: bold; color: #002B54;" id="totalGeneralText">$0.00</div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 15px;">
                    <button type="button" class="btn-filtrar" style="background: #ccc; color: #333;" onclick="cerrarModalCrear()">Cancelar</button>
                    <button type="submit" class="btn-crear-ot">Crear OT</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script de Modales y Carrito -->
    <script>
        // Modal Edición
        function abrirModalEditar(ot) {
            document.getElementById('edit_folio').value = ot.folioOT;
            document.getElementById('edit_cliente').value = ot.nombreCliente;
            document.getElementById('edit_diagnostico').value = ot.diagnosticoFalla;
            document.getElementById('edit_mano_obra').value = ot.costoManoObra;
            document.getElementById('edit_estado').value = ot.estadoOT;
            document.getElementById('formUpdate').action = '/ordenes_trabajo/' + ot.idOT;
            document.getElementById('modalEditar').style.display = 'flex';
        }
        function cerrarModalEditar() {
            document.getElementById('modalEditar').style.display = 'none';
        }

        // Modal Creación Directa OT
        function abrirModalCrear() {
            document.getElementById('modalCrearOT').style.display = 'flex';
        }
        function cerrarModalCrear() {
            document.getElementById('modalCrearOT').style.display = 'none';
        }

        let carritoOT = [];

        function filtrarCatalogoModal() {
            let filtro = document.getElementById('buscadorRef').value.toLowerCase();
            let filas = document.querySelectorAll('.fila-catalogo');
            filas.forEach(fila => {
                let texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        }

        function agregarItemCarrito(idRef, nombre, precio, stockMax) {
            let item = carritoOT.find(p => p.id_refaccion === idRef);
            if (item) {
                if (item.cantidad + 1 > stockMax) {
                    alert('Stock insuficiente.');
                    return;
                }
                item.cantidad++;
            } else {
                carritoOT.push({ id_refaccion: idRef, nombre, precio, cantidad: 1, stockMax });
            }
            renderCarritoOT();
        }

        function cambiarCantOT(idRef, cambio) {
            let item = carritoOT.find(p => p.id_refaccion === idRef);
            if (!item) return;
            if (item.cantidad + cambio > item.stockMax) {
                alert('Alcanzaste el stock máximo.');
                return;
            }
            item.cantidad += cambio;
            if (item.cantidad <= 0) {
                carritoOT = carritoOT.filter(p => p.id_refaccion !== idRef);
            }
            renderCarritoOT();
        }

        function renderCarritoOT() {
            let tbody = document.getElementById('carritoBody');
            tbody.innerHTML = '';
            if (carritoOT.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: #888;">No hay refacciones añadidas.</td></tr>`;
                document.getElementById('inputRefaccionesJson').value = '[]';
                calcularTotalGeneral();
                return;
            }

            carritoOT.forEach(p => {
                let subtotal = p.precio * p.cantidad;
                tbody.innerHTML += `
                    <tr>
                        <td><strong>${p.nombre}</strong></td>
                        <td>$${p.precio.toFixed(2)}</td>
                        <td>
                            <button type="button" style="padding:2px 6px;" onclick="cambiarCantOT(${p.id_refaccion}, -1)">-</button>
                            <span style="margin:0 5px; font-weight:bold;">${p.cantidad}</span>
                            <button type="button" style="padding:2px 6px;" onclick="cambiarCantOT(${p.id_refaccion}, 1)">+</button>
                        </td>
                        <td>$${subtotal.toFixed(2)}</td>
                        <td><button type="button" style="background:#ff4d4d; color:white; border:none; padding:3px 6px; border-radius:4px;" onclick="carritoOT = carritoOT.filter(x => x.id_refaccion !== ${p.id_refaccion}); renderCarritoOT();">X</button></td>
                    </tr>
                `;
            });

            document.getElementById('inputRefaccionesJson').value = JSON.stringify(carritoOT);
            calcularTotalGeneral();
        }

        function calcularTotalGeneral() {
            let subtotalMat = carritoOT.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
            let manoObra = parseFloat(document.getElementById('inputManoObra').value) || 0;
            let total = subtotalMat + manoObra;
            document.getElementById('totalGeneralText').innerText = '$' + total.toFixed(2);
        }
    </script>
</body>
</html>