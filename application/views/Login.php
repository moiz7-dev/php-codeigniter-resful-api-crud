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
    
    <title>login form</title>
</head>

<body>
    <div class="container">
        <?php $register_url = base_url() . 'user/register'; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="<?php echo base_url() . 'user/login' ?>" method="post">
                        <h1>Login</h1>

                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['registered'])) {
                            echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('registered') . '</div>';
                            unset($_SESSION['registered']);
                        }
                        if (isset($_SESSION['no_session'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('no_session') . '</div>';
                            unset($_SESSION['no_session']);
                        }
                        ?>


                        <p class="text-muted"> Please enter your login and password!</p>
                        <input type="text" name="name" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <input type="submit" name='submit' value="Login">
                        <p class="text-muted">Don’t have an account? <a href="<?php echo $register_url; ?>">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>