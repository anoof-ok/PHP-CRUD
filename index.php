<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=school','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$search=$_GET['search'] ?? '';
if ($search){
  $statemnt=$pdo->prepare('SELECT * FROM school_one WHERE name LIKE :name ORDER BY id');
  $statemnt->bindValue(':name',"%$search%");
  


}else{
  $statemnt=$pdo->prepare('SELECT * FROM school_one ORDER BY id');
}

$statemnt->execute();
$students=$statemnt->fetchAll(PDO::FETCH_ASSOC);













?>

<!doctype html>
<html lang="en">
  <head>
    <title>Product crud</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="a.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <h1>students</h1>
    <p>
     <a href="create.php" class="btn btn-outline-secondary">create</a>
    </p>
    <form>
    <div class="input-group mb-3" style="width: 600px;">
  <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo $search ?>">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit">Search</button>
  </div>
</div>
    </form>

  <table class="table " style="width: 800px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">name</th>
      <th scope="col">address</th>
      <th scope="col">phone</th>
      <th scope="col">stram</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($students as $i=>$std){ ?>
      <tr>
        <th scope="row"><?php echo $i+1 ?></th>
        <td>
        
          <img src="<?php echo $std['image'] ?>" class="img_tb">
                
        </td>
        <td><?php echo $std['name'] ?></td>
        <td><?php echo $std['address'] ?></td>
        <td><?php echo $std['phone'] ?></td>
        <td><?php echo $std['stream'] ?></td>
        <td>
          
          <a href="edit.php?id=<?php echo $std['id']?>" class="btn btn-outline-primary">Edit</a>
          
          <form method="post" action="delete.php" style="display: inline-block">
            <input type="hidden" name="id" value="<?php echo $std['id'] ?>">
            <button type="submit" class="btn btn-outline-danger">Delete</button>
          </form>
        </td>
        
      </tr>
    

    <?php } ?>
  </tbody>
</table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>