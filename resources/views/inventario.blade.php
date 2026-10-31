<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Inventario</title>
    <!-- Iconos de Google Material Symbols con grosor delgado (wght 200) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        /* --- TU CÓDIGO ORIGINAL --- */
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
            font-weight: 500;
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
            font-weight: 400; /* Asegurando texto sin negrita */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .titulo-pagina h1 {
            color: #002B54;
            font-size: 24px;
            font-weight: 500;
        }

        .titulo-pagina p {
            color: #666;
            font-size: 14px;
        }

        /* Buscador y Filtros */
        .bar-busqueda {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-control-search {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .form-control-select {
            width: 250px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
            outline: none;
        }

        /* Tabla estilizada */
        .contenedor-tabla {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
            width: 100%;
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

        th {
            padding: 14px 18px;
            font-weight: 600;
        }
        
        td {
            padding: 14px 18px;
            border-bottom: 1px solid #EAEFF2;
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

        .status-vigente {
            color: #4CAF50;
            font-weight: 500;
            font-size: 12px;
        }

        .btn-modificar {
            background-color: #002347;
            color: #FFCC00;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 12px;
            transition: all 0.2s;
        }

        .btn-modificar:hover {
            background-color: #003366;
        }

        /* --- ESTILOS AÑADIDOS PARA EL MODAL DE EDICIÓN --- */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-card {
            background: white;
            border-radius: 10px;
            width: 90%;
            max-width: 750px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dcdcdc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .modal-header h2 { color: #002B54; font-size: 20px; font-weight: 500; }
        .btn-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #666; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #002B54; margin-bottom: 8px; }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #f9fbfd;
            outline: none;
        }
        
        .form-row-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .form-row-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; }
        textarea.form-control { resize: vertical; min-height: 100px; }

        .form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 25px; }
        .btn-cancelar { background-color: #e0e0e0; color: #444; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; }
        .btn-eliminar { background-color: #ff4d4d; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; }
        .btn-guardar { background-color: #FFCC00; color: #002347; border: none; padding: 10px 22px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; }
    </style>
</head>
<body>

    <!-- Menú Lateral Original -->
    <div class="sidebar">
        <div>
           <a href="/barratareas" class="sidebar-header" title="Volver al Dashboard">
            <h2>BOMBAS GUERRA</h2>
            <p>CONTROL DE INVENTARIOS</p>
                </a>

            <ul class="sidebar-menu">
                <li>
                    <a href="/inventario" class="activo">
                        <span class="material-symbols-outlined">inventory_2</span>
                        Inventario
                    </a>
                </li>
                <li>
                    <a href="registrar_entrada">
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
                <h1>Inventario General</h1>
                <p>Gestión y control de repuestos, bombas hidráulicas y niveles de existencias.</p>
            </div>
        </div>

        <!-- Buscador y Filtro Conectados al Script -->
        <div class="bar-busqueda">
            <input type="text" id="inputBuscar" onkeyup="filtrarRefacciones()" placeholder="Buscar refacción por código, nombre o marca..." class="form-control-search">
            <select id="selectCategoria" onchange="filtrarRefacciones()" class="form-control-select">
                <option value="">Todas las Categorías</option>
            </select>
        </div>

        <!-- Tabla Preparada para el Script -->
        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>P. Compra</th>
                        <th>P. Venta</th>
                        <th>Cant.</th>
                        <th>Stock Min.</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tablaInventario">
                    <!-- Se llena automáticamente con JavaScript -->
                </tbody>
            </table>

            <div class="footer-tabla">
                <span id="contadorRefacciones">Cargando inventario...</span>
                <span>BOMBAS GUERRA S.A. DE C.V.</span>
            </div>
        </div>
    </div>

    <!-- MODAL DE EDICIÓN -->
    <div class="modal-overlay" id="modalEditar">
        <div class="modal-card">
            <div class="modal-header">
                <h2 id="modalTitle">Editar Refacción: REF-000</h2>
                <button class="btn-close" onclick="cerrarModal()">&times;</button>
            </div>

            <form id="formUpdate" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-row-2">
                    <div class="form-group">
                        <label>Nombre de la Refacción</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="text" class="form-control" id="edit_categoria" name="categoria" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Marca / Fabricante</label>
                        <input type="text" class="form-control" id="edit_marca" name="marca" required>
                    </div>
                    <div class="form-group">
                        <label>Precio de Compra ($)</label>
                        <input type="number" step="0.01" class="form-control" id="edit_precio_compra" name="precio_compra" required>
                    </div>
                </div>

                <div class="form-row-4">
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Precio de Venta ($)</label>
                        <input type="number" step="0.01" class="form-control" id="edit_precio_venta" name="precio_venta" required>
                    </div>
                    <div class="form-group">
                        <label>Stock Actual</label>
                        <input type="number" class="form-control" id="edit_cantidad" name="cantidad" required>
                    </div>
                    <div class="form-group">
                        <label>Stock Mín.</label>
                        <input type="number" class="form-control" id="edit_stock_minimo" name="stock_minimo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción / Notas Adicionales</label>
                    <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3"></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal()">Cancelar</button>
                    <button type="button" class="btn-eliminar" onclick="eliminarRefaccion()">Eliminar</button>
                    <button type="submit" class="btn-guardar">Guardar Cambios</button>
                </div>
            </form>

            <form id="formDelete" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <!-- SCRIPT DE FILTRADO Y MODAL (Oculto) -->
    <script>
        const todasLasRefacciones = @json($refacciones);
        let refaccionActualId = null;

        function cargarCategorias() {
            const selectCat = document.getElementById('selectCategoria');
            const categoriasUnicas = [...new Set(todasLasRefacciones.map(r => r.categoria))];
            
            categoriasUnicas.forEach(cat => {
                if(cat) {
                    const option = document.createElement('option');
                    option.value = cat;
                    option.textContent = cat;
                    selectCat.appendChild(option);
                }
            });
        }

        function filtrarRefacciones() {
            const query = document.getElementById('inputBuscar').value.trim().toLowerCase();
            const categoriaSeleccionada = document.getElementById('selectCategoria').value;
            const tbody = document.getElementById('tablaInventario');
            const contador = document.getElementById('contadorRefacciones');

            // NUEVA REGLA: Si el buscador está vacío y no hay categoría seleccionada, la tabla se oculta.
            if (query === '' && categoriaSeleccionada === '') {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="mensaje-vacio">
                            Escriba en el buscador o seleccione una categoría para mostrar las refacciones.
                        </td>
                    </tr>
                `;
                contador.innerText = `Mostrando 0 refacciones en total`;
                return; // Detiene la función aquí para no mostrar nada
            }

            const filtradas = todasLasRefacciones.filter(r => {
                const nombre = r.nombre ? r.nombre.toLowerCase() : '';
                const marca = r.marca ? r.marca.toLowerCase() : '';
                const categoria = r.categoria ? r.categoria.toLowerCase() : '';
                
                const coincideTexto = nombre.includes(query) || marca.includes(query) || categoria.includes(query);
                const coincideCategoria = categoriaSeleccionada === '' || r.categoria === categoriaSeleccionada;

                return coincideTexto && coincideCategoria;
            });

            if (filtradas.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="mensaje-vacio">
                            No se encontraron refacciones con los criterios actuales.
                        </td>
                    </tr>
                `;
            } else {
                tbody.innerHTML = filtradas.map(r => `
                    <tr>
                        <td>${r.nombre}</td>
                        <td>${r.categoria}</td>
                        <td>${r.marca}</td>
                        <td>$${parseFloat(r.precio_compra).toFixed(2)}</td>
                        <td>$${parseFloat(r.precio_venta).toFixed(2)}</td>
                        <td><strong>${r.stock}</strong> pzas</td>
                        <td>${r.stock_minimo ?? 0} pzas</td>
                        <td><span class="status-vigente">● DISPONIBLE</span></td>
                        <td>
                            <button class="btn-modificar" onclick='abrirModalModal(${JSON.stringify(r).replace(/'/g, "&apos;")})'>Modificar</button>
                        </td>
                    </tr>
                `).join('');
            }
            
            contador.innerText = `Mostrando ${filtradas.length} refacciones en total`;
        }

        function abrirModalModal(refaccion) {
            refaccionActualId = refaccion.id; 
            
            document.getElementById('modalTitle').innerText = 'Editar: ' + refaccion.nombre;
            document.getElementById('edit_nombre').value = refaccion.nombre;
            document.getElementById('modalTitle').innerText = 'Editar Refacción: REF-' + String(refaccion.id).padStart(3, '0');
            document.getElementById('edit_nombre').value = refaccion.nombre;
            document.getElementById('edit_categoria').value = refaccion.categoria;
            document.getElementById('edit_marca').value = refaccion.marca;
            document.getElementById('edit_precio_compra').value = refaccion.precio_compra;
            document.getElementById('edit_precio_venta').value = refaccion.precio_venta;
            document.getElementById('edit_cantidad').value = refaccion.stock;
            document.getElementById('edit_stock_minimo').value = refaccion.stock_minimo || 0;
            document.getElementById('edit_descripcion').value = refaccion.descripcion || '';

            document.getElementById('formUpdate').action = '/refacciones/' + refaccion.id;
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modalEditar').style.display = 'none';
        }

        function eliminarRefaccion() {
            if (confirm('¿Estás seguro de que deseas eliminar esta refacción del inventario?')) {
                const formDelete = document.getElementById('formDelete');
                formDelete.action = '/refacciones/' + refaccionActualId;
                formDelete.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            cargarCategorias();
            filtrarRefacciones(); 
        });
    </script>
</body>
</html>