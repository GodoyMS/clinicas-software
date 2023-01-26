<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $precio = $_POST['precio'];
   $precio = filter_var($precio, FILTER_SANITIZE_STRING);
   $categoria = $_POST['categoria'];
   $categoria = filter_var($categoria, FILTER_SANITIZE_STRING);
   $codigo = $_POST['codex'];
   $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);

   $old_image = $_POST['old_image'];
   $imagen = $_FILES['imagen1']['name'];
   $imagen = filter_var($imagen, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['imagen1']['size'];
   $imagen_tmp_name1 = $_FILES['imagen1']['tmp_name'];
   $imagen1_folder = '../uploaded_img/'.$imagen;


   $update_product = $conn->prepare("UPDATE `productos_somuch` SET nombre = ?, categoria = ?, precio = ? WHERE id = ?");
   $update_product->execute([$nombre, $categoria, $precio, $pid]);

   $update_product_cart = $conn->prepare("UPDATE `cart` SET name = ?, price = ? WHERE codigo= ?");
   $update_product_cart->execute([$nombre, $precio,$codigo]);

   $update_product_favorito = $conn->prepare("UPDATE `favoritos` SET name = ?, price = ? WHERE codigo= ?");
   $update_product_favorito->execute([$nombre, $precio,$codigo]);




   $message[] = 'Product Actualizado!';

  
   if(!empty($imagen)){
      if($image_size > 2000000){
         $message[] = 'Imagen muy grande!';
      }else{
         $update_image = $conn->prepare("UPDATE `productos_somuch` SET imagen1 = ? WHERE id = ?");
         $update_image->execute([$imagen, $pid]);
         move_uploaded_file($imagen_tmp_name1, $imagen1_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'Imagen actualizada!';
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
   <title>update product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style_admin.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">update product</h1>

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `productos_somuch` WHERE id = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['imagen1']; ?>">
      <input type="hidden" name="codex" value="<?= $fetch_products['codigo']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['imagen1']; ?>" alt="">
      <span>Nuevo Nombre</span>
      <input type="text" required placeholder="enter product name" name="nombre" maxlength="100" class="box" value="<?= $fetch_products['nombre']; ?>">
      <span>Nuevo precio</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="precio" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['precio']; ?>">
      <span>Nueva categoria</span>
      <select name="categoria" class="box" required>
         <option selected value="<?= $fetch_products['categoria']; ?>"><?= $fetch_products['categoria']; ?></option>
         <option value="Hombres | Polos">Hombres - Polos</option>
               <option value="Hombres | Poleras">Hombres- Poleras</option>
               <option value=""></option>

               <option value="Mujeres | Polos">Mujeres- Polos</option>
               <option value="Mujeres | Poleras">Mujeres -Poleras</option>
               <option value="Mujeres | Blazers">Mujeres- Blazers</option>
               <option value="Mujeres | Faldas">Mujeres -Faldas</option>
               <option value="Mujeres | Shorts">Mujeres- Shorts</option>
               <option value="Mujeres | Tops">Mujeres -Tops</option>
               <option value="Indefinido">Sin definir</option>
      </select>
      <span>Actualizar imagen principal</span>
      <input type="file" name="imagen1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>

<!-- update product section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>