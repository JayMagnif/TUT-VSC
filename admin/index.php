<?php 
    require_once '../db.php';
    $id = $_SESSION['user_id'];
    $sql = 'SELECT * FROM students';

    $stmt = $conn->prepare($sql);

    $stmt->execute();
    $_user = $stmt->fetch(PDO::FETCH_OBJ);
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);


    $sqll = 'SELECT * FROM userinfo';

    $stmtt = $conn->prepare($sqll);

    $stmtt->execute();
    $usersInfo = $stmtt->fetchAll(PDO::FETCH_OBJ);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jay">
    <link rel="icon" href="../images/logos/tut_logo_white.png">

    <title>TUT VSC | Admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-top-fixed.css" rel="stylesheet">
  </head>

  <body>

<?php include_once('header.php');?>
    <main role="main" class="container pt-4">
      <div class="jumbotron">
        <h1>Administrator panel</h1>
        <p class="lead">This page allows you as a staff and administrator to view all students registered to the system. You can also view all created virtual student cards. Press a button below to show a relevant table</p>
        <a class="btn btn-md btn-primary" id="sMembers" href="#" role="button">Members &raquo;</a>
        <a class="btn btn-md btn-info" id="sCards" href="#" role="button">Student cards &raquo;</a>
      </div>

      <section id="studentsSection" style="display: none;">
        <div class="d-flex align-items-center p-3 text-white-50 bg-purple rounded box-shadow">
          <img class="mr-3" src="../images/logos/tut_logo_white.png" alt="" width="70" height="70">
          <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Registered members</h6>
            <small>realtime update</small>
          </div>
        </div>
  
        <div class="p-3 bg-white rounded box-shadow">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student No.</th>
                  <th>Title</th>
                  <th>Picture</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($users as $user): ?>
                <tr>
                  <td><?= $user->student_id; ?></td>
                  <td><?= $user->student_no; ?></td>
                  <td>student</td>
                  <td><img src="<?php echo ($user->picture == '')?'../images/avatar.webp': '../'.$user->picture ;?>" class="rounded-circle" alt="Picture" width="50" height="50"></td>
                  <td>
                      <a href="../<?= $user->picture; ?>" class="btn btn-info">view</a>    
                      <a onclick="return confirm('Are you sure you want to delete this student?')" href="delete.php?id=<?= $user->student_id; ?>" class="btn btn-danger">Delete</a>    
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <small class="d-block text-right mt-3">
            <a href="#">All members</a>
          </small>
        </div>
      </section>

      <section class="mt-4" id="cardsSection" style="display: none;">
        <div class="d-flex align-items-center p-3 text-white-50 bg-purple rounded box-shadow">
          <img class="mr-3" src="../images/logos/tut_logo_white.png" alt="" width="70" height="70">
          <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Created student cards</h6>
            <small>All virtual student card history</small>
          </div>
        </div>
  
        <div class="p-3 bg-white rounded box-shadow">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Picture</th>
                  <th>Transport</th>
                  <th>Campus</th>
                  <th>Residence</th>
                  <th>Unique id</th>
                  <th>Email</th>
                  <th>Verified?</th>
                  <th>Action</th> 
                </tr>
              </thead>
              <tbody>
              <?php foreach($usersInfo as $userInfo): ?>
                <tr>
                    <td><?= $userInfo->user_id; ?></td>
                    <td><img src="<?php echo ($userInfo->qr_link == '')?'../images/avatar.webp': '../'.$userInfo->qr_link ;?>" class="rounded-circle mx-auto d-block" alt="Picture" width="<?php echo ($userInfo->qr_link == '')?'50': '150';?>" height="50"></td>
                    <td><?= $userInfo->transport; ?></td>
                    <td><?= $userInfo->campus; ?></td>
                    <td><?= $userInfo->residence; ?></td>
                    <td><?= $userInfo->token; ?></td>
                    <td><?= $userInfo->email; ?></td>
                    <td><img src="../images/unverified.jpg" class="rounded-circle" alt="Picture" width="30" height="30"></td>
                    <td>
                        <a href="../<?= $userInfo->qr_link; ?>" class="btn btn-info">view</a>    
                        <a onclick="return confirm('Are you sure you want to delete this user?')" href="delete.php?id=<?= $userInfo->user_id; ?>" class="btn btn-danger">Delete</a>    
                    </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <small class="d-block text-right mt-3">
            <a href="#">All student cards</a>
          </small>
        </div>
      </section>

    </main>

    <script>window.jQuery || document.write('<script src="./js/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script>
      let sOpen = false;
      let cOpen = false;
      $("#sMembers").click((e)=>{
        e.preventDefault();
        if(sOpen){
          $("#studentsSection").hide(100);
          sOpen = false;
          $('#sMembers').html("Members &raquo;");
        }else{
          $("#studentsSection").show(100);
          sOpen = true;
          $('#sMembers').html("Members &laquo;");
        }
        
      })

      $("#sCards").click((e)=>{
        e.preventDefault();
        if(cOpen){
          $('#cardsSection').hide(100);
          cOpen = false;
          $('#sCards').html("Student cards &raquo;");
        }else{
          $('#cardsSection').show(100);
          cOpen = true;
          $('#sCards').html("Student cards &laquo;");
        }
      })
    </script>
  </body>
</html>
