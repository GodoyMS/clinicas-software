<?php

    

if(isset($_POST['favoritos'])){

    if($user_id == ''){
       header('location:login.php');
    }else{
 
       $pid_fav = $_POST['pid'];
       $pid_fav = filter_var($pid_fav, FILTER_SANITIZE_STRING);
       $nombre_fav = $_POST['nombre'];
       $nombre_fav = filter_var($nombre_fav, FILTER_SANITIZE_STRING);
       $precio_fav = $_POST['precio'];
       $precio_fav= filter_var($precio_fav, FILTER_SANITIZE_STRING);
       $imagen1_fav = $_POST['imagen1'];
       $imagen1_fav = filter_var($imagen1_fav, FILTER_SANITIZE_STRING);
      
       $codigo_fav = $_POST['codigo'];
       $codigo_fav = filter_var($codigo_fav, FILTER_SANITIZE_STRING);
       $categoria_fav = $_POST['categoria'];
       $categoria_fav = filter_var($categoria_fav   , FILTER_SANITIZE_STRING);
 
       
      
 
       $check_favorite_number = $conn->prepare("SELECT * FROM `favoritos` WHERE name = ? AND user_id = ?");
       $check_favorite_number->execute([$nombre_fav, $user_id]);
 
       if($check_favorite_number->rowCount() > 0){
          echo '
          <div style="margin:auto;z-index:9999;left:0;right:0" id="toast-undo" class="flex  absolute  items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
             <div class="text-sm font-normal">
                Ya agregaste este producto a favoritos.
             </div>
             <div class="flex items-center ml-auto space-x-2">
                <button type="button" class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-undo" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
             </div>
          </div>
          ';
       }else{
          $insert_cart = $conn->prepare("INSERT INTO `favoritos`(user_id, pid, name, price, image,codigo,categoria) VALUES(?,?,?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid_fav, $nombre_fav, $precio_fav, $imagen1_fav,$codigo_fav,$categoria_fav]);
          echo '
          <div  style="margin:auto;z-index:9999;left:0;right:0" id="toast-success" class="flex absolute items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
     <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
         <span class="sr-only">Check icon</span>
     </div>
     <div class="ml-3 text-sm font-normal">Agregada con éxito a favoritos.</div>
     <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
         <span class="sr-only">Close</span>
         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
     </button>
 </div>
          ';
          
       }
 
    }
 
 }
    
?>

<?php

    

if(isset($_POST['favoritos_categoria'])){

    if($user_id == ''){
       header('location:login.php');
    }else{
 
       $pid_fav = $_POST['pid'];
       $pid_fav = filter_var($pid_fav, FILTER_SANITIZE_STRING);
       $nombre_fav = $_POST['nombre'];
       $nombre_fav = filter_var($nombre_fav, FILTER_SANITIZE_STRING);
       $precio_fav = $_POST['precio'];
       $precio_fav= filter_var($precio_fav, FILTER_SANITIZE_STRING);
       $imagen1_fav = $_POST['imagen1'];
       $imagen1_fav = filter_var($imagen1_fav, FILTER_SANITIZE_STRING);
      
       $codigo_fav = $_POST['codigo'];
       $codigo_fav = filter_var($codigo_fav, FILTER_SANITIZE_STRING);
       $categoria_fav = $_POST['categoria'];
       $categoria_fav = filter_var($categoria_fav   , FILTER_SANITIZE_STRING);
 
       
      
 
       $check_favorite_number = $conn->prepare("SELECT * FROM `favoritos` WHERE name = ? AND user_id = ?");
       $check_favorite_number->execute([$nombre_fav, $user_id]);
 
       if($check_favorite_number->rowCount() > 0){
          echo '
          <div style="margin:auto;z-index:9999;left:0;right:0" id="toast-undo" class="flex  absolute  items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
             <div class="text-sm font-normal">
                Ya agregaste este producto a favoritos.
             </div>
             <div class="flex items-center ml-auto space-x-2">
                <button type="button" class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-undo" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
             </div>
          </div>
          ';
       }else{
          $insert_cart = $conn->prepare("INSERT INTO `favoritos`(user_id, pid, name, price, image,codigo,categoria) VALUES(?,?,?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid_fav, $nombre_fav, $precio_fav, $imagen1_fav,$codigo_fav,$categoria_fav]);
          echo '
          <div  style="margin:auto;z-index:9999;left:0;right:0" id="toast-success" class="flex absolute items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
     <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
         <span class="sr-only">Check icon</span>
     </div>
     <div class="ml-3 text-sm font-normal">Agregada con éxito a favoritos.</div>
     <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
         <span class="sr-only">Close</span>
         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
     </button>
 </div>
          ';
          
       }
 
    }
 
 }
    
?>