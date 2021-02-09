<?php
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    redirect('dashboard');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <link rel="stylesheet" href="<?php echo base_url('css\style.css') ?>">

    <title>Register form</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="<?php echo base_url() . 'user/register' ?>" method="post" enctype="multipart/form-data">
                        <h1>Register</h1>

                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>

                        <p class="text-muted"> Please enter details to create new account!</p>

                        <input type="text" name="fname" placeholder="First name" required>
                        <input type="text" name="lname" placeholder="Last name" required>
                        <input type="text" name="uname" placeholder="Username" required>
                        <input type="text" name="email" placeholder="Email ID" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required>

                        <label for="avatar-1" class="white">Upload Profile Picture</label>
                        <input class="white" id="profile_pic" name="profile_pic" type="file" />

                        <input type="submit" name="submit" value="Register">

                        <p class="text-muted">Already have an account? <a href="<?php echo base_url('user/login') ?>">Login </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
$this->load->view('footer.php');
?>

</html>