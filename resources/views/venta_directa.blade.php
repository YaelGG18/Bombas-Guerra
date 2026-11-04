<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Venta Directa</title>
    <!-- Iconos de Google Material Symbols con grosor delgado -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        body {
            background-color: #EAEFF2;
            min-height: 100vh;
            display: flex;
        }

        /* Menú Lateral */
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

        /* Contenido Principal con flex adecuado */
        .main-content {
            flex: 1;
            min-width: 0; /* Previene que las tablas expandan el contenedor */
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

        /* Contenedores de Tablas con Scroll Interno si es necesario */
        .contenedor-tabla {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow-x: auto;
            margin-bottom: 25px;
            width: 100%;
        }

        .seccion-titulo {
            font-size: 16px;
            color: #002B54;
            font-weight: bold;
            padding: 20px;
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

        /* Botones de acción dentro de la tabla */
        .btn-add {
            background-color: #002347;
            color: #FFCC00;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
        }

        .btn-add:hover {
            background-color: #003366;
        }

        .btn-qty {
            background: #EAEFF2;
            border: 1px solid #ccc;
            width: 26px;
            height: 26px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-qty:hover {
            background: #ddd;
        }

        .btn-del {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-del:hover {
            background: #cc0000;
        }

        /* Resumen de Venta */
        .resumen-venta {
            background-color: #002B54;
            border-radius: 8px;
            padding: 25px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 100%;
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

        .btn-primario:disabled {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
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
                    <a href="/venta_directa" class="activo">
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
                <h1>Venta Directa / Carrito de Salidas</h1>
            </div>
        </div>

        <!-- Selección de Catálogo -->
        <div class="contenedor-tabla">
            <div class="seccion-titulo">Selección de Catálogo</div>
            <div class="search-container">
                <span class="material-symbols-outlined">search</span>
                <input type="text" id="buscarInput" placeholder="Buscar por ID, Nombre, Marca o Categoría...">
            </div>
            <table id="tablaCatalogo">
    <thead>
        <tr>
            <th>Ref / ID</th>
            <th>Refacción / Marca / Categoría</th>
            <th>Precio</th>
            <th>Disp.</th>
            <th>Añadir al Carrito</th>
        </tr>
    </thead>
    <tbody>
        @forelse($refacciones as $refaccion)
        <!-- Agregamos style="display: none;" para que nazcan ocultas -->
        <tr class="fila-producto" style="display: none;">
            <td>#{{ $refaccion->id }}</td>
            <td>
                <strong>{{ $refaccion->nombre }}</strong><br>
                <small style="color: #666;">{{ $refaccion->marca }} - {{ $refaccion->categoria }}</small>
            </td>
            <td>${{ number_format($refaccion->precio_venta, 2) }}</td>
            <td><strong>{{ $refaccion->stock }}</strong></td>
            <td>
                <button class="btn-add" onclick="agregarAlCarrito({{ $refaccion->id }}, '{{ $refaccion->nombre }}', {{ $refaccion->precio_venta }}, {{ $refaccion->stock }})">
                    <span class="material-symbols-outlined" style="font-size: 16px;">add_shopping_cart</span> Añadir
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="mensaje-vacio">
                No hay refacciones registradas con stock disponible.
            </td>
        </tr>
        @endforelse

        <!-- Fila de aviso cuando no hay texto ingresado -->
        <tr id="mensajeInicial">
            <td colspan="5" class="mensaje-vacio">
                Escribe en el buscador para consultar el catálogo de refacciones.
            </td>
        </tr>
    </tbody>
</table>
        </div>

        <!-- Carrito de Salida -->
        <div class="contenedor-tabla">
            <div class="seccion-titulo">Carrito de Salida</div>
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
                <tbody id="carritoBody">
                    <tr>
                        <td colspan="6" class="mensaje-vacio">
                            El carrito está vacío. Selecciona una refacción del catálogo para empezar.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Resumen de Orden -->
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
                <span class="badge-unidades" id="totalUnidades">0 Unidades</span>
            </div>

            <div class="resumen-fila">
                <p>Monto Total a Cobrar</p>
                <div class="precio-total" id="totalMonto">$0.00 <span>MXN</span></div>
            </div>

            <div class="botones-accion">
                <button class="btn btn-secundario" onclick="vaciarCarrito()">
                    <span class="material-symbols-outlined">delete</span> Vaciar carrito
                </button>
                <button class="btn btn-primario" id="btnFinalizar" onclick="procesarVenta()" disabled>
                    <span class="material-symbols-outlined">check_circle</span> Finalizar compra
                </button>
            </div>
        </div>
    </div>

    <script>
        let carrito = [];

        // Buscador en tiempo real (Oculto si el input está vacío)
document.getElementById('buscarInput').addEventListener('keyup', function() {
    let filtro = this.value.trim().toLowerCase();
    let filas = document.querySelectorAll('#tablaCatalogo tbody tr.fila-producto');
    let mensajeInicial = document.getElementById('mensajeInicial');

    if (filtro === '') {
        // Si el buscador está vacío, ocultamos todas las refacciones
        filas.forEach(fila => fila.style.display = 'none');
        if (mensajeInicial) mensajeInicial.style.display = '';
    } else {
        // Si hay texto escrito, ocultamos el mensaje inicial y mostramos las refacciones coincidentes
        if (mensajeInicial) mensajeInicial.style.display = 'none';
        
        filas.forEach(fila => {
            let texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(filtro) ? '' : 'none';
        });
    }
});

        // Agregar producto
        function agregarAlCarrito(id, nombre, precio, stockMax) {
            let item = carrito.find(p => p.id === id);

            if (item) {
                if (item.cantidad + 1 > stockMax) {
                    alert('No hay suficiente stock disponible para añadir más.');
                    return;
                }
                item.cantidad++;
            } else {
                carrito.push({ id, nombre, precio, cantidad: 1, stockMax });
            }

            renderizarCarrito();
        }

        // Cambiar cantidad (+ / -)
        function cambiarCantidad(id, cambio) {
            let item = carrito.find(p => p.id === id);
            if (!item) return;

            if (item.cantidad + cambio > item.stockMax) {
                alert('Alcanzaste el stock máximo disponible.');
                return;
            }

            item.cantidad += cambio;

            if (item.cantidad <= 0) {
                eliminarDelCarrito(id);
            } else {
                renderizarCarrito();
            }
        }

        // Eliminar fila individual
        function eliminarDelCarrito(id) {
            carrito = carrito.filter(p => p.id !== id);
            renderizarCarrito();
        }

        // Vaciar todo el carrito
        function vaciarCarrito() {
            if (carrito.length === 0) return;
            if (confirm('¿Vaciar todo el carrito?')) {
                carrito = [];
                renderizarCarrito();
            }
        }

        // Dibujar carrito en pantalla
        function renderizarCarrito() {
            let tbody = document.getElementById('carritoBody');
            tbody.innerHTML = '';
            
            let totalMonto = 0;
            let totalUnidades = 0;

            if (carrito.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="mensaje-vacio">
                            El carrito está vacío. Selecciona una refacción del catálogo para empezar.
                        </td>
                    </tr>`;
                document.getElementById('btnFinalizar').disabled = true;
            } else {
                carrito.forEach(p => {
                    let subtotal = p.precio * p.cantidad;
                    totalMonto += subtotal;
                    totalUnidades += p.cantidad;

                    tbody.innerHTML += `
                        <tr>
                            <td>#${p.id}</td>
                            <td><strong>${p.nombre}</strong></td>
                            <td>$${p.precio.toFixed(2)}</td>
                            <td>
                                <button class="btn-qty" onclick="cambiarCantidad(${p.id}, -1)">-</button>
                                <span style="margin: 0 6px; font-weight: bold;">${p.cantidad}</span>
                                <button class="btn-qty" onclick="cambiarCantidad(${p.id}, 1)">+</button>
                            </td>
                            <td><strong>$${subtotal.toFixed(2)}</strong></td>
                            <td>
                                <button class="btn-del" onclick="eliminarDelCarrito(${p.id})">✕</button>
                            </td>
                        </tr>
                    `;
                });
                document.getElementById('btnFinalizar').disabled = false;
            }

            document.getElementById('totalUnidades').innerText = `${totalUnidades} Unidades`;
            document.getElementById('totalMonto').innerHTML = `$${totalMonto.toFixed(2)} <span>MXN</span>`;
        }

        // Enviar venta a Laravel
        function procesarVenta() {
            if (carrito.length === 0) return;

            if (!confirm('¿Confirmar e ir a cobrar la salida de refacciones?')) return;

            fetch("{{ route('venta_directa.procesar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ productos: carrito })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error inesperado al procesar la venta.');
            });
        }
    </script>

</body>
</html>