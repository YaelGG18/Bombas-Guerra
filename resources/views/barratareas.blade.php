<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Dashboard</title>
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
            width: 100vw;
        }

        /* Barra superior azul */
        .barra-superior {
            background-color: #003366;
            height: 60px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            color: white;
            border-bottom: 3px solid #FFCC00;
        }

        .marca-header h2 {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .marca-header p {
            font-size: 11px;
            color: #b0c4de;
        }

        .usuario-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .usuario-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .usuario-header {
            text-align: right;
            font-size: 13px;
        }

        .usuario-header .estado {
            font-size: 11px;
            color: #4CAF50;
        }

        .icono-admin {
            font-size: 38px !important;
            color: #FFCC00;
        }

        /* Contenedor del contenido principal */
        .contenido-principal {
            padding: 40px 50px;
        }

        .titulo-seccion {
            margin-bottom: 35px;
        }

        .titulo-seccion h1 {
            color: #002B54;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .titulo-seccion p {
            color: #555;
            font-size: 15px;
        }

        /* Cuadrícula para los 7 apartados */
        .grid-modulos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Estilo de cada tarjeta */
        .tarjeta-modulo {
            background-color: #003366;
            color: white;
            padding: 25px;
            border-radius: 10px;
            border-top: 4px solid #FFCC00;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: block;
        }

        .tarjeta-modulo:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .tarjeta-modulo .icono-tarjeta {
            background-color: #002347;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .tarjeta-modulo .icono-tarjeta span {
            color: #FFCC00;
            font-size: 24px;
        }

        .tarjeta-modulo h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .tarjeta-modulo p {
            font-size: 13px;
            color: #cce0ff;
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <div class="barra-superior">
        <div class="marca-header">
            <h2>BOMBAS GUERRA</h2>
            <p>CONTROL DE INVENTARIOS</p>
        </div>

        <a href="/" class="usuario-link" title="Cerrar sesión / Volver al Login">
            <div class="usuario-header">
                <strong>Bienvenido, Administrador</strong>
                <div class="estado">● Servidor Local: En Línea</div>
            </div>
            <span class="material-symbols-outlined icono-admin">account_circle</span>
        </a>
    </div>

    <!-- Contenido principal y apartados -->
    <div class="contenido-principal">
        <div class="titulo-seccion">
            <h1>Panel Principal de Control</h1>
            <p>Selecciona un módulo para trabajar.</p>
        </div>

        <!-- Los 7 Módulos principales con texto directo -->
        <div class="grid-modulos">
            
            <a href="/inventario" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">inventory_2</span>
                </div>
                <h3>Inventario y Stock</h3>
                <p>Consulta de refacciones, piezas disponibles y mínimos.</p>
            </a>

            <a href="/registrar_entrada" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">move_to_inbox</span>
                </div>
                <h3>Registrar Entrada</h3>
                <p>Ingreso de mercancía.</p>
            </a>

            <a href="/venta_directa" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
                <h3>Venta Directa</h3>
                <p>Venta mostrador de refacciones al instante.</p>
            </a>

            <a href="/cotizaciones" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">request_quote</span>
                </div>
                <h3>Cotizaciones</h3>
                <p>Presupuestos de reparación y piezas.</p>
            </a>

            <a href="/ordenes_trabajo" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">build</span>
                </div>
                <h3>Órdenes de Trabajo</h3>
                <p>Reparaciones y trabajos activos en taller.</p>
            </a>

            <a href="/garantias" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <h3>Garantías</h3>
                <p>Registro de reclamos y devoluciones.</p>
            </a>

            <a href="/historial_movimientos" class="tarjeta-modulo">
                <div class="icono-tarjeta">
                    <span class="material-symbols-outlined">bar_chart</span>
                </div>
                <h3>Historial y Reportes</h3>
                <p>Movimientos, salidas y ventas registradas.</p>
            </a>

        </div>
    </div>

</body>
</html>