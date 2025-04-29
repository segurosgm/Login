<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="/GM/css/styles.css" type="text/css">
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
    <script src="js/validaciones.js"></script> <!-- Script para validación del formulario -->
  
</head>
<body>
    <header class="container-fluid">
        <div class="container flex justify-between">
            <center><img class="img-fluid" src="../img/logo2.jpg" alt="logo GMK Seguros Especialistas en Riesgos y 
            Seguros"></center>
            <!-- class="img-fluid" es el responsive desde boostrap -->
        </div>
    </header>


    
    <?php
    // conexión a la base de datos
    include('conexion.php');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos']; // Nuevo campo de apellidos
        $tipo_documento = $_POST['tipo_documento']; // Tipo de documento seleccionado
        $numero_identidad = $_POST['numero_identidad']; // Número de identificación
        $correo = $_POST['correo'];
        $numero_telefono = $_POST['telefono']; // Número de teléfono
        $contrasena = $_POST['contrasena'];
        $contrasena2 = $_POST['contrasena2'];
      


 // Verificar si el Usuario ya existe
 $sql = "SELECT * FROM usuarios WHERE usuario = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s", $usuario);
 $stmt->execute();
 $result = $stmt->get_result();

 if ($result->num_rows > 0) {
 
     echo '
     <script>
         Swal.fire({
             icon: "error",
             title: "El Usuario ya está registrado",
             text: "Por favor, inténtalo de nuevo",
             confirmButtonText: "Aceptar"
         }).then(() => {
             window.location.href = "../registro.html"; // Redirige a la página de bienvenida
         });
     </script>';
       
        } else {
 // Verificar si la cedula ya existe
 $sql = "SELECT * FROM usuarios WHERE numero_identidad = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s", $numero_identidad);
 $stmt->execute();
 $result = $stmt->get_result();

 if ($result->num_rows > 0) {
 echo '
     <script>
         Swal.fire({
             icon: "error",
             title: "El Documento ya está registrado",
             text: "Por favor, inténtalo de nuevo",
             confirmButtonText: "Aceptar"
         }).then(() => {
             window.location.href = "../registro.html"; // Redirige a la página de bienvenida
         });
     </script>';
            
            } else {
// Verificar si el correo ya existe
$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    echo '
    <script>
        Swal.fire({
            icon: "error",
            title: "El correo electrónico ya está registrado",
            text: "Por favor, inténtalo de nuevo",
            confirmButtonText: "Aceptar"
        }).then(() => {
            window.location.href = "../registro.html"; // Redirige a la página de bienvenida
        });
    </script>';
 } else {
 // Verificar si el Telefono ya existe
 $sql = "SELECT * FROM usuarios WHERE telefono = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s", $numero_telefono);
 $stmt->execute();
 $result = $stmt->get_result();

 if ($result->num_rows > 0) {
 
     echo '
     <script>
         Swal.fire({
             icon: "error",
             title: "El Telefono ya está registrado",
             text: "Por favor, inténtalo de nuevo",
             confirmButtonText: "Aceptar"
         }).then(() => {
             window.location.href = "../registro.html"; // Redirige a la página de bienvenida
         });
     </script>';
 } else {

// Verificar si Contraseña son iguales
if ($contrasena !== $contrasena2) {
    echo '
    <script>
        Swal.fire({
            icon: "error",
            title: "La contraseña no Coinciden",
            text: "Por favor, inténtalo de nuevo",
            confirmButtonText: "Aceptar"
        }).then(() => {
            window.location.href = "../registro.html"; // Redirige a la página de bienvenida
        });
    </script>';
} else {
 // Hashear  encriptar la contraseña antes de almacenarla
       $contrasena_hash = password_hash( $contrasena,  PASSWORD_DEFAULT);
                // Insertar el nuevo usuario, incluyendo todos los datos nuevos
                $sql = "INSERT INTO usuarios (usuario, nombre, apellidos, correo, contrasena, contrasena2,  tipo_documento, numero_identidad, telefono) 
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? )";
                $stmt = $conn->prepare(query: $sql);
                $stmt->bind_param("sssssssss", $usuario, $nombre, $apellidos, $correo, $contrasena_hash, $contrasena2, $tipo_documento, $numero_identidad, $numero_telefono);


                if ($stmt->execute()) {

                echo '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Usuario Registrado Exitosamente",
                            text: "Bienvenido",
                            confirmButtonText: "Aceptar"
                        }).then(() => {
                            window.location.href = "../home.html"; // Redirige a la página de bienvenida
                        });
                    </script>';


                } else {
                      
                    echo '
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al registrar usuario",
                            text: "Por favor, inténtalo de nuevo",
                            confirmButtonText: "Aceptar"
                        }).then(() => {
                            window.location.href = "../registro.html"; // Redirige de vuelta al formulario de login
                        });
                    </script>';

                    $stmt->error;
                }
            }
            $stmt->close();
        }
    }
}
}
}
    $conn->close();
    ?>


    <br><br>
    <footer>
        <p>© 2024 GMK Seguros. Todos los derechos reservados.</p>
    </footer>
</body>

</html>