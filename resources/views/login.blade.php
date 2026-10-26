<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOMBAS GUERRA - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* Franja izquierda amarilla */
        .franja-amarilla {
            width: 10%;
            background-color: #FFCC00;
            height: 100%;
        }

        /* Contenedor principal azul */
        .contenedor-principal {
            width: 90%;
            background-color: #003366;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Tarjeta del login */
        .caja-login {
            background-color: #001F3F;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            text-align: center;
            color: white;
        }

        .caja-login h1 {
            font-size: 22px;
            margin-bottom: 25px;
        }

        .grupo-campo {
            text-align: left;
            margin-bottom: 20px;
        }

        .grupo-campo label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #ccc;
        }

        .grupo-campo input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #1a3a5c;
            background-color: #002B54;
            color: white;
            font-size: 14px;
        }

        /* Botones */
        .btn-ingresar {
            width: 100%;
            padding: 10px;
            background-color: #FFCC00;
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-olvide {
            width: 100%;
            padding: 10px;
            background-color: #e0e0e0;
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Franja izquierda -->
    <div class="franja-amarilla"></div>

    <!-- Panel principal -->
    <div class="contenedor-principal">
        
        <div class="caja-login">
            <h1>BOMBAS GUERRA</h1>

            <form action="/barratareas" method="GET">
                <div class="grupo-campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">
                </div>

                <button type="submit" class="btn-ingresar">INGRESAR</button>
                <button type="button" class="btn-olvide">OLVIDÉ MI CONTRASEÑA</button>
            </form>
        </div>

    </div>

</body>
</html>