<?php 
    require_once 'header.php';
  
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = 'SELECT * FROM staff WHERE staff_id=:id';

        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

    }
    
    $message = "";

    if(isset($_POST['submit'])){
        if(isset($_POST['staffNo'])){

            $staff_no = htmlspecialchars($_POST['staffNo']);
            $campus = htmlspecialchars($_POST['campus']);
            $password = htmlspecialchars($_POST['password']);
            $user_id = $_GET['id'];
            $sql = 'UPDATE `staff` SET staff_no=:staff_no,password=:password, campus=:campus WHERE staff_id=:user_id';

            $stmt = $conn->prepare($sql);

            if($stmt->execute([':staff_no'=>$staff_no, ':password'=>$password, ':campus'=>$campus,':user_id'=>$user_id])){
                $message = '<div class="form-group mt-2 mb-2 alert alert-success">
                                <h4>Successfully updated</h4>
                            </div>';

                header('location: ./');
            }
            

        }
        
    }else{
        $message = "";
    }

?>

<div class="container" style="margin-top: 150px; width:50%;">
    <div class="card">
        <div class="card-header">
            <h2>Update profile</h2>
        </div>
        <div class="card-body">
            <form action="edit.php?id=<?= $id;?>" method="post">
                <div class="form-group mt-2 mb-2">
                    <label for="uname">Student number: </label>
                    <input type="text" name="staffNo" value="<?= $user->staff_no; ?>" class='form-control' id="username">
                </div>
                <div class="form-group mt-2 mb-2">
                    <label for="status">Password:</label>
                    <input type="text" name="password" value="<?= $user->password; ?>" id="password" class='form-control'>
                </div>
                <div class="form-group mt-2 mb-2">
                    <label for="status">Campus:</label>
                    <input type="text" name="campus" value="<?= $user->campus; ?>" id="campus" class='form-control'>
                </div>
                <?php echo $message;?>
                <div class="form-group mt-2 mb-2" style="float: right">
                    <input type="submit"  class="btn btn-info form-control" name="submit" value="update">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>