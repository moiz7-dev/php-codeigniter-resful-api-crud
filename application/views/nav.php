<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() . 'css/nav_style.css' ?>">
    <style>
        a,
        a:hover {
            text-decoration: none !important;
            color: whitesmoke !important;
        }
    </style>
    <title>Hello, world!</title>
</head>
<?php   //session checks
if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    $this->session->set_flashdata('no_session', 'You need to be logged in to access this page.');
    redirect('user/login');
}
$logout_btn = "";
$sign_btn = '';
if (isset($_SESSION['user_name'])) {
    $img_url = '';

    if (!$_SESSION['profile_img']) { //If profile pic not set
        $img_url = base_url() . '/profiles/default.jpg';
    } else {
        $profile_img = $_SESSION['profile_img'];    //If profile pic is set
        $img_url = base_url() . $profile_img;
    }

    $logout_url = base_url() . 'user/logout';
    $dashboard_url = base_url() . 'company';
    $profile_edit_url = base_url() . 'user/profile';

    $logout_btn = "<li class='nav-item active'>
                    <a class='nav-link' href='$dashboard_url'>Company</a>
                </li></ul>
                <a href='$profile_edit_url'><img src='$img_url' height='35' width='35' alt='' />
                <div class='nav-link'>Hey, " . $_SESSION['user_name'] . "</a></div>
                <a class='nav-link' id='logout' style='border: 1px solid whitesmoke; border-radius: 5px' href='$logout_url'> Logout</a>";
    $sign_btn = '';
}

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() . 'dashboard' ?>">C R U D</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item asd active">
                    <a class="nav-link" href="<?= base_url() . 'dashboard' ?>">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item asd active">
                    <a class="nav-link" href="<?= base_url() . 'employee' ?>">Employees<span class="sr-only">(current)</span></a>
                </li>


                <?php echo $sign_btn ?>

                <?php echo $logout_btn ?>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>