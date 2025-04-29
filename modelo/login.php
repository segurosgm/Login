<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Sesion</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="jquery-ui-1.14.0.custom/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JQuary  calendario -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <base href="">  -->

</head>

<body>
   

        <?php
        // conexión a la base de datos
        include('conexion.php');

        // Verifica si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['Contrasena'];

            // Prepara la consulta para evitar inyecciones SQL
            $sql = "SELECT * FROM usuarios WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica si el usuario existe
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

        // Verifica la contraseña
                if (password_verify($contrasena, $row['Contrasena'])) {

        // Muestra un mensaje de éxito usando SweetAlert
            echo '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Inicio de sesión exitoso",
                        text: "Bienvenido",
                        confirmButtonText: "Aceptar"
                    }).then(() => {
                        window.location.href = "/Login/home.html"; 
                    });
                </script>';    
                            } else {
        // Mensaje en caso de que la contraseña sea incorrecta 
            echo '
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Contraseña incorrecta",
                        text: "Por favor, inténtalo de nuevo",
                        confirmButtonText: "Aceptar"
                    }).then(() => {
                        window.location.href = "/Login/sesion.html"; // Redirige de vuelta al formulario de login
                    });
                </script>';
                        }
                    } else {

        // Mensaje en caso de que el usuario no exista
                        echo '
                            <script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Usuario no encontrado",
                                    text: "Por favor, verifica tus credenciales",
                                    confirmButtonText: "Aceptar"
                                }).then(() => {
                                    window.location.href = "/Login/sesion.html"; // Redirige de vuelta al formulario de login
                                });
                            </script>';

                    }

            // Cierra la conexión
            $stmt->close();
            $conn->close();
        }
        ?>

    </main>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  <!-- framework para el diseño del formulario  -->  
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   <!-- Libreria JavaScritp para los Mensajes de Alertas  -->


</body>
<script src="js/validaciones.js"></script>

</html>