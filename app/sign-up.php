<?php
session_start();
include_once '_head.php';
if(isset($_SESSION['user'])){
    header('location: index.php');
}
$alert = false;
if(isset($_GET['error'])){
    if($_GET['error'] == 'nameLength'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed username is too short or too long';
    }else if($_GET['error'] == 'passLength'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed password is too short or too long';
    }else if($_GET['error'] == 'passwordConfirmation'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed passwords do not match.';
    } else if($_GET['error'] == 'missingInput'){
        $alert=true;
        $type = 'warning';
        $message = 'You need to fill every field.';
    } else if($_GET['error'] == 'userDupe'){
        $alert=true;
        $type = 'warning';
        $message = 'This username is already used.';
    } else if($_GET['error'] == 'warning'){
        $alert=true;
        $type = 'warning';
        $message = 'Error with the database, try again.';
    }
}
?>

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                        project for free.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Register with</h5>
                    </div>

                    <div class="card-body">
                        <form role="form text-left" action="includes/signUp_post.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                    aria-describedby="username-addon" name="username">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                    aria-describedby="password-addon" name="password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Re-type your password"
                                    aria-label="Confirm password" aria-describedby="password-addon" name="password2">
                            </div>
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    checked="">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                        and Conditions</a>
                                </label>
                            </div>
                            <?php if($alert){ ?>
                                    <h4 class="text-danger"> <?php echo $message ?></h4>
                                    <?php } ?>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="sign-in.php"
                                    class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once '_footer.php';
?>