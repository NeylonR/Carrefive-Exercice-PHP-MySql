<?php 
session_start();
include_once '_head.php';
isConnected();
include_once '_navbar.php';

$alert = false;
if(isset($_GET['error'])){
    if($_GET['error'] == 'missingInput'){
        $alert=true;
        $type = 'warning';
        $message = 'You need to fill every "*" field.';
    } else if($_GET['error'] == 'dupe'){
        $alert=true;
        $type = 'warning';
        $message = 'The product had already beed added in the shop.';
    } else if($_GET['error'] == 'nameLength'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed name of product is too short or too long';
    }
}
?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">Créer une catégorie.</h6>
            </nav>
        </div>
    </nav>

    <form class="container-fluid py-4" method="POST" action="includes/add-category_post.php">
        <div class="form-group">
            <label for="nameProduct">Nom de la catégorie*</label>
            <input type="text" class="form-control" id="nameCategory" name="nameCategory" placeholder="Entrez le nom de la catégorie" maxlength="30" required>
        </div>
        <?php if($alert){ ?>
        <h4 class="text-danger"> <?php echo $message ?></h4>
        <?php } ?>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Etes vous sur ?</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- <div>
        <h4>Catégorie déjà existante.</h4>
        <ul>
            <?php ?>
        </ul>
    </div> -->
</main>

<?php 
include_once '_footer.php';
?>