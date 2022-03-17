<?php
session_start();
include '_head.php';
if(isset($_SESSION['user'])){
    header('location: index.php');
}
$alert = false;
if(isset($_GET['error'])){
    if($_GET['error'] == 'wrongId'){
        $alert=true;
        $type = 'warning';
        $message = 'Wrong Id or Password, try again.';
    } else if($_GET['error'] == 'missingInput'){
        $alert=true;
        $type = 'warning';
        $message = 'You need to fill every field.';
    }
}
?>
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->

            <!-- End Navbar -->
        </div>
    </div>
</div>
<main class="main-content mt-0 ps">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                <p class="mb-0">Enter your username and password to sign in</p>
                            </div>
                        
                            <div class="card-body">
                                <form role="form" action="includes/signIn_post.php" method="POST">
                                    <label>Username*</label>
                                    <div class="mb-3">
                                        <input required type="text" class="form-control" placeholder="Type your username..."
                                            aria-label="username" aria-describedby="username-addon" name="username">
                                    </div>
                                    <label>Password*</label>
                                    <div class="mb-3">
                                        <input required type="password" class="form-control" placeholder="Password"
                                            aria-label="Password" aria-describedby="password-addon" name="password">
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <?php if($alert){ ?>
                                    <h4 class="text-danger"> <?php echo $message ?></h4>
                                    <?php } ?>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="sign-up.php" class="text-info text-gradient font-weight-bold">Sign
                                        up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</main>
<?php
include_once '_footer.php';
?>