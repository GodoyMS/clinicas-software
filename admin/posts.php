<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


if(isset($_POST['añadir_post_instagram'])){
   $instagram = $_POST['instagram'];
   $instagram = filter_var($instagram, FILTER_SANITIZE_STRING);
  
 

   $select_posts = $conn->prepare("SELECT * FROM `posts_instagram`");
   $select_posts->execute();
   $insert_post_instagram = $conn->prepare("INSERT INTO `posts_instagram` (instagram) VALUES (?)");
   $insert_post_instagram->execute([$instagram]);

   

}

if(isset($_POST['añadir_post_facebook'])){
    $facebook = $_POST['facebook'];
    $facebook = filter_var($facebook, FILTER_SANITIZE_STRING);
   
  
 
    $select_posts_facebook = $conn->prepare("SELECT * FROM `posts_facebook`");
    $select_posts_facebook->execute();
    $insert_post_facebook = $conn->prepare("INSERT INTO `posts_facebook` (facebook) VALUES (?)");
    $insert_post_facebook->execute([$facebook]);
 
    
 
 }

 if(isset($_POST['añadir_post_tiktok'])){
    $tiktok = $_POST['tiktok'];
    $tiktok = filter_var($tiktok, FILTER_SANITIZE_STRING);
    $id_video_tiktok = $_POST['id_video_tiktok'];
    $id_video_tiktok= filter_var($id_video_tiktok, FILTER_SANITIZE_STRING);
   
  
 
    $select_posts_tiktok = $conn->prepare("SELECT * FROM `posts_tiktok`");
    $select_posts_tiktok->execute();
    $insert_post_tiktok = $conn->prepare("INSERT INTO `posts_tiktok` (tiktok, id_video) VALUES (?, ?)");
    $insert_post_tiktok->execute([$tiktok,$id_video_tiktok]);
 
    
 
 }

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `productos_somuch` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['imagen1']);
   $delete_product = $conn->prepare("DELETE FROM `productos_somuch` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}




///asdadksjdkasjasdkjasdkjasdkjasd





?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Posts redes sociales</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style_admin.css">
   <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->
<section class="add-products"><!--ADD PRODUCT FORM-->
<form action="" method="POST" >
    <h2 class="block mb-2 text-4xl">AÑADIR POST INSTAGRAM</h2></br>
   
    <div class="mb-6">
        <label for="instagram" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Instagram Link POST</label>
        <input required name="instagram" type="instagram" id="instagram" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://www.instagram.com/p/Cl89fdLOWNgXy8mgYJUpMERad3PV5dD1B4TEvY0/" >
    </div>
   
    

<button type="submit" value="añadir_post_instagram" name="añadir_post_instagram" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publicar</button>

</form>

<form action="" method="POST" >
    <h2 class="block mb-2 text-4xl">AÑADIR POST FACEBOOK</h2></br>
   
    
    <div class="mb-6">
        <label for="facebook" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Link source</label>
        <input placeholder="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FRaizonDota%2Fposts%2Fpfbid0ojDs4dptXHi9NGBFsKVMCayAaEMn6NiedyRXXu29EChqo6gdPjECoWpc3KzcsZznl&show_text=true&width=500" required name="facebook"  id="facebook" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </input>

    </div>  
    
    

<button required type="submit" value="añadir_post_facebook" name="añadir_post_facebook" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publicar</button>




</form>

<form action="" method="POST" >
    <h2 class="block mb-2 text-4xl">AÑADIR POST TIKTOK</h2></br>
   
     
    <div class="mb-6">
        <label for="tiktok" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Url Video</label>
        <input required type="text" name="tiktok"" id="tiktok" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder='https://www.tiktok.com/@kimrubi11/video/7174453212043431174' >
        </input>
        <label for="id_video_tiktok" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">ID video</label>
        <input required type="text" name="id_video_tiktok"  id="id_video_tiktok" class="disabled bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder='7174453212043431174' >
        </input>

    </div> 
    

<button type="submit" value="añadir_post_tiktok" name="añadir_post_tiktok" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publicar</button>




</form>


















</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">
            <!--INSTAGRAM-->
   <div class="box-container">

   <?php
      $show_post_instagram=$conn->prepare("SELECT * FROM `posts_instagram` ORDER BY id DESC");
      $show_post_instagram->execute();
      if($show_post_instagram->rowCount() > 0){

      
      while($fetch_post_instagram = $show_post_instagram->fetch(PDO::FETCH_ASSOC)){
        ?>
        <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="<?=$fetch_post_instagram['instagram'];?>?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="<?=$fetch_post_instagram['instagram'];?>?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">Ver esta publicación en Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="<?=$fetch_post_instagram['instagram'];?>?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">Una publicación compartida por DAVIANNY I ALVAREZ👑 (@davi_alvarez14)</a></p></div></blockquote> <script async src="//www.instagram.com/embed.js"></script>
            
    <?php
      }
    }
      ?>
    </div>

    <!--FACEBOOK-->
    <div class="box-post-facebook" style="justify-center">

   <?php
      $show_post_facebook=$conn->prepare("SELECT * FROM `posts_facebook` ORDER BY id DESC");
      $show_post_facebook->execute();
      if($show_post_facebook->rowCount() > 0){

      
      while($fetch_post_facebook = $show_post_facebook->fetch(PDO::FETCH_ASSOC)){
        echo '
        <iframe src="'.$fetch_post_facebook['facebook'].'" width="300" height="713" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        ';
        ?>
            
    <?php
      }
    }
      ?>
    </div>

    <style>
      

.box-post-facebook{
   display:grid;
   grid-template-columns: repeat(1, minmax(0, 1fr));
   gap:1rem;
}
.box-post-facebook iframe{
   width:300px;
   height:300px;

   
}

}
@media (min-width:700px) {
  

.box-post-facebook{
   display:grid;
   grid-template-columns: repeat(2, minmax(0, 1fr));
   gap:1rem;
}
.box-post-facebook iframe{
   width:330px;
   height:330px;

   
}
   
}

@media (min-width:1024px) {


.box-post-facebook{
   display:grid;
   grid-template-columns: repeat(3, minmax(0, 1fr));
   gap:1rem;
}
.box-post-facebook iframe{
   width:300px;
   height:300px;

   
}


   
}


@media (min-width:1300px) {


.box-post-facebook{
   display:grid;
   grid-template-columns: repeat(3, minmax(0, 1fr));
   gap:1rem;
}
.box-post-facebook iframe{
   width:300px;
   height:300px;

   
}


   
}



@media (min-width:1660px) {

.box-post-facebook{
   display:grid;
   grid-template-columns: repeat(3, minmax(0, 1fr));
   gap:1rem;
}
.box-post-facebook iframe{
   width:300px;
   height:300px;

   
}


   
}



</style>



    <!--TIKTOK-->

    <div class="box-container">

        <?php
        $show_post_tiktok=$conn->prepare("SELECT * FROM `posts_tiktok` ORDER BY id DESC");
        $show_post_tiktok->execute();
        if($show_post_tiktok->rowCount() > 0){

        
        while($fetch_post_tiktok = $show_post_tiktok->fetch(PDO::FETCH_ASSOC)){
            echo '
            <blockquote class="tiktok-embed" cite="'.$fetch_post_tiktok['tiktok'].'" data-video-id="'.$fetch_post_tiktok['id_video'].'" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@vereyamelycv" href="https://www.tiktok.com/@vereyamelycv?refer=embed">@vereyamelycv</a> okño<a title="contenido" target="_blank" href="https://www.tiktok.com/tag/contenido?refer=embed">#contenido</a> <a title="parati" target="_blank" href="https://www.tiktok.com/tag/parati?refer=embed">#parati</a> <a title="fyp" target="_blank" href="https://www.tiktok.com/tag/fyp?refer=embed">#fyp</a> <a title="paratodos" target="_blank" href="https://www.tiktok.com/tag/paratodos?refer=embed">#paratodos</a> <a title="ruskayacumbia" target="_blank" href="https://www.tiktok.com/tag/ruskayacumbia?refer=embed">#ruskayacumbia</a> <a target="_blank" title="♬ sonido original - ▶️♡RoDdy♡ArIeL☆@ERmagiCs♧" href="https://www.tiktok.com/music/sonido-original-7137994921801321222?refer=embed">♬ sonido original - ▶️♡RoDdy♡ArIeL☆@ERmagiCs♧</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>      
            ';
            ?>
                
        <?php
        }
        }
        ?>
        </div>


</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>