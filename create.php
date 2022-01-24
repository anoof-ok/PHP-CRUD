<?php

$pdo=new PDO('mysql:host=localhost;port=3306;dbname=school','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$errors=[];
$name="";
$address="";
$stream="";
$phone="";




if($_SERVER['REQUEST_METHOD'] ==='POST') {
  $name=$_POST['name'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $stream=$_POST['stream'];
  $image=$_FILES['image'] ?? null;
  $imagepath="";


  if(!$name){
    $errors[]="name is required";
  
  }
 
    
  if(!$stream){
    $errors[]="stream is required";
  }


  
if(!is_dir('images')){
  mkdir('images');
}


if(empty($errors)){

  //image
  
  if ($image && $image['tmp_name']){
    $imagepath='images/'.randomString(8).'/'.$image['name'];
    mkdir(dirname($imagepath));

    move_uploaded_file($image['tmp_name'],$imagepath);
  }


$statment=$pdo->prepare("INSERT INTO school_one(image,name,address,phone,stream)
VALUES(:image,:name,:address,:phone,:stream)");
$statment->bindValue(':image',$imagepath);
$statment->bindValue(':name',$name);
$statment->bindValue(':address',$address);
$statment->bindValue(':phone',$phone);
$statment->bindValue(':stream',$stream);
$statment->execute();
header('Location: index.php');
}


}


function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str = $characters[$index];
    }

    return $str;
}

?>



<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <h1>craeate student</h1>
    <?php if(!empty($errors)){ ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) { ?>
        <div><?php echo $error?></div>
      <?php } ?>
    </div>
    <?php } ?>
      
      <!--form-->
      <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>image</label><br>
    <input type="file" name='image'>
  </div>
  <div class="form-group">
    <label>name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
  </div>
  <div class="form-group">
    <label>address</label>
    <textarea type="text" class="form-control" name="address" value="<?php echo $address ?>"> </textarea>
  </div>
  <div class="form-group">
    <label>phone</label>
    <input name = 'phone' type="text"  class="form-control" value="<?php echo $phone ?>">
  </div>
  <div class="form-group">
    <label>stream</label>
    <input name = 'stream' type="text"  class="form-control" value="<?php echo $stream?>" >
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>