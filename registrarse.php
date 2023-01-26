
<?php
// $dni = '71102795';
// $token = 'apis-token-3501.VfDkZH0nb-Rt2zZhzKPBjAWr6jtd0Q0n';
/*
$json = file_get_contents('https://api.apis.net.pe/v1/dni?numero=71102795');
// Convert to array 
$array = json_decode($json, true);
 var_dump($array); // print arrayCopy
 echo $array["apellidoPaterno"];
*/

?>


<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['registrarUsuario'])){
    //DATOS REPRESENTANTE
   $nombres = $_POST['nombres'];
   $nombres = filter_var($nombres, FILTER_SANITIZE_STRING);
   $apellidos = $_POST['apellidos'];
   $apellidos = filter_var($apellidos, FILTER_SANITIZE_STRING);
   $telefonoRepresentante = $_POST['telefonoRepresentante'];
   $telefonoRepresentante = filter_var($telefonoRepresentante, FILTER_SANITIZE_STRING);
   $correoRepresentante = $_POST['correoRepresentante'];
   $correoRepresentante = filter_var($correoRepresentante, FILTER_SANITIZE_STRING);
   $dni = $_POST['dni'];
   $dni = filter_var($dni, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    //DATOS CONSULTORIO
    $nombreConsultorio = $_POST['nombreConsultorio'];
    $nombreConsultorio = filter_var($nombreConsultorio, FILTER_SANITIZE_STRING);
    $especialidad = $_POST['especialidad'];
    $especialidad = filter_var($especialidad, FILTER_SANITIZE_STRING);
    $emailConsultorio = $_POST['emailConsultorio'];
    $emailConsultorio = filter_var($emailConsultorio, FILTER_SANITIZE_STRING);
    $telefonoConsultorio = $_POST['telefonoConsultorio'];
    $telefonoConsultorio = filter_var($telefonoConsultorio, FILTER_SANITIZE_STRING);

    $departamento = $_POST['departamento'];
    $departamento = filter_var($departamento, FILTER_SANITIZE_STRING);
    $provincia = $_POST['provincia'];
    $provincia = filter_var($provincia, FILTER_SANITIZE_STRING);
    $distrito = $_POST['distrito'];
    $distrito = filter_var($distrito, FILTER_SANITIZE_STRING);
    $direccion = $_POST['direccion'];
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);






   $select_user = $conn->prepare("SELECT * FROM `usuarios` WHERE dni = ? OR emailRepresentante = ?");
   $select_user->execute([$dni, $correoRepresentante]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
    echo '
    <div id="toast-danger" style=" display:flex;justify-content:center;"class="flex items-center  p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">El usuario ya existe</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
</div>
    ';
   }else{
      if($pass != $cpass){
         echo '
         <div id="toast-danger" style=" display:flex;justify-content:center;"class="flex items-center  p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
         <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
             <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
             <span class="sr-only">Error icon</span>
         </div>
         <div class="ml-3 text-sm font-normal">Confirmación de contraseña fallida</div>
         <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
             <span class="sr-only">Close</span>
             <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
         </button>
     </div>
         ';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `usuarios`(nombreConsultorio,nombres, apellidos, dni, especialidad, departamento,provincia,distrito ,emailRepresentante, emailConsultorio,numeroRepresentante,numeroConsultorio,contraseña,Direccion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $insert_user->execute([$nombreConsultorio, $nombres, $apellidos, $dni, $especialidad,$departamento,$provincia,$distrito,$correoRepresentante,$emailConsultorio,$telefonoRepresentante,$telefonoConsultorio,$cpass,$direccion]);
         $select_user = $conn->prepare("SELECT * FROM `usuarios` WHERE emailRepresentante = ? AND contraseña = ?");
         $select_user->execute([$correoRepresentante, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:iniciar-sesion.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Consultorio</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />

    <link rel="icon" type="image/x-icon" href="images/imgLogo/logo-no-back.png">
    <link rel="icon" type="image/x-icon" href="images/imgLogo/logo-no-back.png">


</head>
<body>
<?php
        include 'components/inicio/header.php'

        

      






    ?>
<section style="max-width:800px" class="mx-auto">

<form action="" method="post" style="margin:0 2rem" >
<h1 class="max-w-2xl mb-4 text-2xl md:text-4xl font-bold text-blue-500 flex justify-start py-8">Datos de representante</h1>
    <div class="grid gap-6 mb-6 md:grid-cols-2 pb-4">

        

        <div>
            <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
            <input type="text" name="nombres"id="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" required>
        </div>
        <div>
            <label for="apellidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
            <input type="text" name="apellidos"id="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gonzales" required>
        </div>
          
        <div>
            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de teléfono </label>
            <input type="tel" name="telefonoRepresentante"id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999-415-678" required>
        </div>
        <div>
            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</label>
            <input type="email" name="correoRepresentante"id="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="alpha-Clinicas@gmail.com" required>
        </div>
        <div>
            <label for="dni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dni</label>
            <input type="number" name="dni" id="dni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="78110245" required>
        </div>

        <div>
                                <label class="text-gray-600"> Recuerda que</label>

                                   <p class="text-gray-400">Para iniciar sesión debes proporcionar tu numero de DNI y contraseña</p>
        </div>
    </div>
        <div class="mb-6">Contraseña</label>
        <label for="pass" class="block mb-2 text-sm font-medium text-gray-900">
        <input maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" type="password" name="pass" id="pass" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div> 
        <div class="mb-6">
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Contraseña</label>
        <input maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')"type="password" name="cpass" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>


    


    <h1 class="max-w-2xl mb-4 text-2xl md:text-4xl font-bold text-blue-500 flex justify-start py-8">Datos del consultorio</h1>
  
    <div class="mb-6">
        <label for="nombreConsultorio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Consultorio</label>
        <input type="text" id="nombreConsultorio"  name="nombreConsultorio"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Consultorio Smile" required>
    </div> 
    
    <div class="mb-6">
        <label for="especialidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialidad</label>

                <fieldset>

                <div class="flex items-center mb-4">
                    <input id="country-option-1" type="radio" name="especialidad" value="Medicina General" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Medicina General
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input id="country-option-2" type="radio" name="especialidad" value="Odontología" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Odontología
                    </label>
                </div>

               

                <div class="flex items-center">
                    <input id="option-disabled" type="radio" name="countries" value="China" class="w-4 h-4 border-gray-200 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600" disabled>
                    <label for="option-disabled" class="block ml-2 text-sm font-medium text-gray-300 dark:text-gray-700">
                    Nutrición (proximamente)
                    </label>
                </div>
                </fieldset>
    </div> 

    <div class="grid gap-6 mb-6 md:grid-cols-2 pb-4">

        

<div>
    <label for="emailConsultorio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email  </label>
    <input type="email" name="emailConsultorio" id="emailConsultorio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" required>
</div>
<div>
    <label for="telefonoConsultorio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de teléfono </label>
            <input type="tel" name="telefonoConsultorio" id="telefonoConsultorio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999-415-678"  required>
</div>
  
<div>
    <label for="departamento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento </label>
    <input type="text" name="departamento"id="departamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lima" required>
</div>
<div>
    <label for="provincia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
    <input type="text" name="provincia" id="provincia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lima" required>
</div>
<div>
    <label for="distrito" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Distrito</label>
    <input type="text" name="distrito"id="distrito" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ancon" required>
</div>
<div>
    <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
    <input type="address" name="direccion"id="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Av. Las palmeras 567" required>
</div>


</div>
    







    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
        </div>
        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Estoy de acuerdo con los <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">términos y condiciones</a>.</label>
    </div>
    <button type="submit" name="registrarUsuario" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
</form>


</section>

<script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <?php
include 'components/footer.php'

?>
    
</body>
</html>