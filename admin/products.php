<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};










if(isset($_POST['add_product'])){
   $codigo = $_POST['codigo'];
   $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   
   $precio = $_POST['precio'];
   $precio = filter_var($precio, FILTER_SANITIZE_STRING);
   $categoria = $_POST['categoria'];
   $categoria = filter_var($categoria, FILTER_SANITIZE_STRING);
   $tipo_talla = $_POST['tipo_talla'];
   $tipo_talla = filter_var($tipo_talla, FILTER_SANITIZE_STRING);
   $talla = $_POST['tipo_talla'];
   $talla = filter_var($talla, FILTER_SANITIZE_STRING);

   $talla = $_POST['talla'];
   $talla = filter_var($talla, FILTER_SANITIZE_STRING);
   $largo = $_POST['largo'];
   $largo = filter_var($largo, FILTER_SANITIZE_STRING);
   $contorno = $_POST['contorno'];
   $contorno = filter_var($contorno, FILTER_SANITIZE_STRING);
   $ancho = $_POST['ancho'];
   $ancho = filter_var($ancho, FILTER_SANITIZE_STRING);

   $descripcion = $_POST['descripcion'];
   $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
   $detalles = $_POST['detalles'];
   $detalles = filter_var($detalles, FILTER_SANITIZE_STRING);


   $imagen1 = $_FILES['imagen1']['name'];
   $imagen1 = filter_var($imagen1, FILTER_SANITIZE_STRING);
   $imagen_size1 = $_FILES['imagen1']['size'];
   $imagen_tmp_name1 = $_FILES['imagen1']['tmp_name'];
   $imagen_folder1 = '../uploaded_img/'.$imagen1;

   $imagen2 = $_FILES['imagen2']['name'];
   $imagen2 = filter_var($imagen2, FILTER_SANITIZE_STRING);
   $imagen_size2 = $_FILES['imagen2']['size'];
   $imagen_tmp_name2 = $_FILES['imagen2']['tmp_name'];
   $imagen_folder2 = '../uploaded_img/'.$imagen2;

   $imagen3 = $_FILES['imagen3']['name'];
   $imagen3 = filter_var($imagen3, FILTER_SANITIZE_STRING);
   $imagen_size3 = $_FILES['imagen3']['size'];
   $imagen_tmp_name3 = $_FILES['imagen3']['tmp_name'];
   $imagen_folder3 = '../uploaded_img/'.$imagen3;

   $imagen4 = $_FILES['imagen4']['name'];
   $imagen4 = filter_var($imagen4, FILTER_SANITIZE_STRING);
   $imagen_size4 = $_FILES['imagen4']['size'];
   $imagen_tmp_name4 = $_FILES['imagen4']['tmp_name'];
   $imagen_folder4 = '../uploaded_img/'.$imagen4;

   $select_products = $conn->prepare("SELECT * FROM `productos_somuch` WHERE nombre = ?");
   $select_products->execute([$nombre]);
   $select_products_codigo = $conn->prepare("SELECT * FROM `productos_somuch` WHERE codigo = ?");
   $select_products_codigo->execute([$codigo]);

   if($select_products->rowCount() > 0 || $select_products_codigo->rowCount() > 0){
      $message[] = 'Este producto producto ya existe';
   }else{
      if($imagen_size1 > 2000000 && $imagen_size2 > 2000000 && $imagen_size3 > 2000000 && $imagen_size4 > 2000000    ){
         $message[] = 'Imagen muy grande';
      }else{
         move_uploaded_file($imagen_tmp_name1, $imagen_folder1);
         move_uploaded_file($imagen_tmp_name2, $imagen_folder2);
         move_uploaded_file($imagen_tmp_name3, $imagen_folder3);
         move_uploaded_file($imagen_tmp_name4, $imagen_folder4);

         $insert_product = $conn->prepare("INSERT INTO `productos_somuch`(codigo, nombre, precio,descripcion,detalles,categoria,tipo_talla,talla,largo,contorno,ancho,imagen1,imagen2,imagen3,imagen4) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $insert_product->execute([$codigo, $nombre, $precio, $descripcion,$detalles,$categoria,$tipo_talla, $talla, $largo, $contorno,$ancho,$imagen1, $imagen2, $imagen3, $imagen4]);

         $message[] = 'Nuevo Producto añadido!';
      }

   }

}

if(isset($_GET['codigo'])){

   $codigo_product= $_GET['codigo'];
   $delete_product_image = $conn->prepare("SELECT * FROM `productos_somuch` WHERE codigo= ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['imagen1']);
   $delete_product = $conn->prepare("DELETE FROM `productos_somuch` WHERE codigo = ?");
   $delete_product->execute([$codigo_product]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE codigo = ?");
   $delete_cart->execute([$codigo_product]);
   $delete_favorito= $conn->prepare("DELETE FROM `favoritos` WHERE codigo = ?");
   $delete_favorito->execute([$codigo_product]);


   header('location:products.php');

}




///asdadksjdkasjasdkjasdkjasdkjasd





?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style_admin.css">
   <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

<!--ADD PRODUCT FORM-->
<form action="" method="POST" enctype="multipart/form-data">
    <h2 class="block mb-2 text-4xl">AÑADIR PRODUCTO</h2></br>
   
<div class="mb-6">
        <label for="nombre_producto" class="block mb-2 text-2xl font-medium text-gray-900 ">Nombre de producto</label>
        <input name="nombre" type="nombre_producto" id="nombre_producto" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder="Gorra para mimir" required>
    </div> 
    <div class="mb-6">
        <label for="codigo_producto" class="block mb-2 text-2xl font-medium text-gray-900 ">Código de producto</label>
        <input name="codigo" type="text" id="codigo_producto" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder="A423432" required>
    </div> 
    <div class="mb-6">
        <label for="tipo_talla" class="block mb-2 text-2xl font-medium text-gray-900 ">Tipo de tallas</label>
        <select id="categorias" name="tipo_talla" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      "   required>
               <option value="" disabled selected>Seleccionar--</option>
               <option value="talla_tipo2">28,30,32,34,36</option>
               <option value="talla_tipo1">XS,S,M,L,XL,XXL</option>
              

            </select>    </div> 
     
    

    <div class="grid gap-6 mb-6 md:grid-cols-2">
    <div class="mb-6">
            <label for="categorias" class="block mb-2 text-2xl font-medium text-gray-900 ">Categoría</label>
            <select id="categorias" name="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      "   required>
               <option value="" disabled selected>Categoria--</option>
               <option value="Hombres | Polos">Hombres - Polos</option>
               <option value="Hombres | Poleras">Hombres- Poleras</option>
               <option value=""></option>

               <option value="Mujeres | Polos">Mujeres- Polos</option>
               <option value="Mujeres | Poleras">Mujeres -Poleras</option>
               <option value="Mujeres | Blazers">Mujeres- Blazers</option>
               <option value="Mujeres | Chaquetas">Mujeres- Chaquetas</option>
               <option value="Mujeres | Faldas">Mujeres -Faldas</option>
               <option value="Mujeres | Shorts">Mujeres- Shorts</option>
               <option value="Mujeres | Tops">Mujeres -Tops</option>
               <option value="Indefinido">Sin definir</option>

            </select>
    </div>
    <div class="mb-6">
        <label for="precio-producto" class="block mb-2 text-2xl font-medium text-gray-900 ">Precio(S/.)</label>
        <input name="precio"  id="precio-producto" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder=" 50" required>
    </div>

    
       
           </div>   

           <div class="grid gap-6 mb-6 md:grid-cols-2">
           <div class="mb-6">
        <label for="talla" class="block mb-2 text-2xl font-medium text-gray-900 ">Talla (opcional)</label>
        <input name="talla"  id="talla" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder=" XL,XS,M,S" >
    </div>

    <div class="mb-6">
        <label for="largo" class="block mb-2 text-2xl font-medium text-gray-900 ">Largo (opcional)</label>
        <input name="largo"  id="largo" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder=" 21.5cm" >
    </div>
   
       
           </div> 

           <div class="grid gap-6 mb-6 md:grid-cols-2">
           <div class="mb-6">
        <label for="contorno" class="block mb-2 text-2xl font-medium text-gray-900 ">Contorno (opcional)</label>
        <input name="contorno"  id="contorno" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder=" Contorno A" >
    </div>

    <div class="mb-6">
        <label for="ancho" class="block mb-2 text-2xl font-medium text-gray-900 ">Ancho (opcional)</label>
        <input name="ancho"  id="ancho" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4      " placeholder=" 60cm" required>
    </div>
   
       
           </div> 
    

           




        <!-- <div>
            <label for="codigo_producto" class="block mb-2 text-2xl font-medium text-gray-900 ">Codigo de producto</label>
            <input type="text" id="codigo_producto" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5      " placeholder="A543-123" >
        </div> -->

        <div>
            <label for="descripcion" class="block mb-2 text-2xl font-medium text-gray-900 ">Descripcion</label>
            <textarea type="text" name="descripcion" rows="6" cols="40" id="descripcion" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5      " placeholder="Describir producto" required>
            </textarea>

        </div>

        <div class="my-4">
            <label for="detalles" class="block mb-2 text-2xl font-medium text-gray-900 ">Detalles</label>
            <textarea type="text" name="detalles" rows="4" cols="40" id="descripcion" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5      " placeholder="Detalles de producto" required>
            </textarea>

        </div>
        

        


        
        <div style="margin-top:2rem;margin-bottom:2rem">
            <label class="block mb-2 text-2xl font-medium text-gray-900 " for="file_input">Subir Imagen Principal</label>
            <input id="image_input" type="file" name="imagen1" accept="image/jpg, image/jpeg, image/png, image/webp" required class="block w-full text-2xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " >
        </div>   
        <div style="margin-top:2rem;margin-bottom:2rem">
            <label class="block mb-2 text-2xl font-medium text-gray-900 " for="file_input">Subir Imagen 2 (opcional)</label>
            <input id="image_input" type="file" name="imagen2" accept="image/jpg, image/jpeg, image/png, image/webp"  class="block w-full text-2xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " >
        </div>  
        <div style="margin-top:2rem;margin-bottom:2rem">
            <label class="block mb-2 text-2xl font-medium text-gray-900 " for="file_input">Subir Imagen 3 (opcional)</label>
            <input id="image_input" type="file" name="imagen3" accept="image/jpg, image/jpeg, image/png, image/webp"  class="block w-full text-2xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " >
        </div>
        <div style="margin-top:2rem;margin-bottom:2rem">
            <label class="block mb-2 text-2xl font-medium text-gray-900 " for="file_input">Subir Imagen 4 (opcional)</label>
            <input id="image_input" type="file" name="imagen4"  accept="image/jpg, image/jpeg, image/png, image/webp" class="block w-full text-2xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " >
        </div>     
        
        
    </div>

    

    

    <!-- <label class="block mb-2 text-2xl font-medium text-gray-900 ">Descripción</label>
    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5">
    <div class="w-full max-w-6xl mx-auto rounded-xl bg-white shadow-lg p-5 text-black" x-data="app()" x-init="init($refs.wysiwyg)">
        <div class="border border-gray-200 overflow-hidden rounded-md">
            <div class="w-full flex border-b border-gray-200 text-2xl text-gray-600">
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('bold')">
                    <i class="mdi mdi-format-bold"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('italic')">
                    <i class="mdi mdi-format-italic"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('underline')">
                    <i class="mdi mdi-format-underline"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','P')">
                    <i class="mdi mdi-format-paragraph"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H1')">
                    <i class="mdi mdi-format-header-1"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H2')">
                    <i class="mdi mdi-format-header-2"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H3')">
                    <i class="mdi mdi-format-header-3"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('insertUnorderedList')">
                    <i class="mdi mdi-format-list-bulleted"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('insertOrderedList')">
                    <i class="mdi mdi-format-list-numbered"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyLeft')">
                    <i class="mdi mdi-format-align-left"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyCenter')">
                    <i class="mdi mdi-format-align-center"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyRight')">
                    <i class="mdi mdi-format-align-right"></i>
                </button>
            </div>
            <div class="w-full">
                <iframe x-ref="wysiwyg" class="w-full h-96 overflow-y-auto"></iframe>
            </div>
        </div>
    </div>
    
    
</div>
<label class="block mb-2 text-2xl font-medium text-gray-900 ">Detalles</label>
    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5">
    <div class="w-full max-w-6xl mx-auto rounded-xl bg-white shadow-lg p-5 text-black" x-data="app()" x-init="init($refs.wysiwyg)">
        <div class="border border-gray-200 overflow-hidden rounded-md">
            <div class="w-full flex border-b border-gray-200 text-2xl text-gray-600">
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('bold')">
                    <i class="mdi mdi-format-bold"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('italic')">
                    <i class="mdi mdi-format-italic"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('underline')">
                    <i class="mdi mdi-format-underline"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','P')">
                    <i class="mdi mdi-format-paragraph"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H1')">
                    <i class="mdi mdi-format-header-1"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H2')">
                    <i class="mdi mdi-format-header-2"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H3')">
                    <i class="mdi mdi-format-header-3"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('insertUnorderedList')">
                    <i class="mdi mdi-format-list-bulleted"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('insertOrderedList')">
                    <i class="mdi mdi-format-list-numbered"></i>
                </button>
                <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyLeft')">
                    <i class="mdi mdi-format-align-left"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyCenter')">
                    <i class="mdi mdi-format-align-center"></i>
                </button>
                <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyRight')">
                    <i class="mdi mdi-format-align-right"></i>
                </button>
            </div>
            <div class="w-full">
                <iframe x-ref="wysiwyg" class="w-full h-96 overflow-y-auto"></iframe>
            </div>
        </div>
    </div>
    
    
</div> -->

<button type="submit" value="add product" name="add_product" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl w-full sm:w-auto px-5 py-2.5 text-center   ">Submit</button>




</form>



















</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `productos_somuch` ORDER BY id DESC");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['imagen1']; ?>" alt="">
      <div class="flex">
         <div class="precio"><span>$</span><?= $fetch_products['precio']; ?><span>/-</span></div>
         <div class="categoria"><?= $fetch_products['categoria']; ?></div>
      </div>
      <div class="nombre"><?= $fetch_products['nombre']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Modificar</a>
         <a href="products.php?codigo=<?= $fetch_products['codigo']; ?>" class="delete-btn" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Aun no se añadio ningun producto</p>';
      }  
   ?>

   </div>

</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>