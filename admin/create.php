<?php 
    require_once 'header.php';
    $message = '';
    if(isset($_POST['submit'])){
        if(isset($_POST['uname']) && isset($_POST['password'])){

            $uname = htmlspecialchars($_POST['uname']);
            $password = htmlspecialchars($_POST['password']);

            $sql = 'INSERT INTO `users`(`username`, `user_password`, `user_status`) VALUES (:uname, :password,0)';

            $stmt = $conn->prepare($sql);

            if($stmt->execute([':uname'=>$uname, ':password'=>$password])){
                $message = '<div class="form-group mt-2 mb-2 alert alert-success">
                                <h4>Successfully logged in</h4>
                            </div>';
            }
            

        }
       
    }else{
        $message = "";
    }

    if(isset($_POST['view'])){
        header('location: ./');
    }

?>

<div class="container" style="margin-top: 150px; width:50%;">
    <div class="card">
        <div class="card-header">
            <h2>Create User</h2>
        </div>
        <div class="card-body">
            <form action="create.php" method="post">
                <div class="form-group mt-2 mb-2">
                    <label for="uname">Email:</label>
                    <input type="text" name="uname" class='form-control' id="username">
                </div>
                <div class="form-group mt-2 mb-2">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="userPass" class='form-control'>
                </div>
                <?php echo $message;?>
                <div class="form-group mt-2 mb-2" style="float: right">
                    <input type="submit"  class="btn btn-info form-control" name="submit" value="Create user">
                </div><div class="form-group mt-2 mb-2" style="float: left">
                    <input type="submit"  class="btn btn-info form-control" name="view" value="View users">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>