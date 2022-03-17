<?php
session_start();
include_once '_head.php';
isConnected();
$productDisplay = fetchProductJoinCategoryAndUser($db, $_GET['id']);
redirectionIfProductDontExist($productDisplay);
include_once '_navbar.php';

$alert = false;
if(isset($_GET['error'])){
    if($_GET['error'] == 'price'){
        $alert=true;
        $type = 'warning';
        $message = 'There is a problem with the price, too many numbers or negative number.';
    } else if($_GET['error'] == 'stock'){
        $alert=true;
        $type = 'warning';
        $message = 'There is a problem with the stock, too many numbers or negative number.';
    }else if($_GET['error'] == 'missingInput'){
        $alert=true;
        $type = 'warning';
        $message = 'You need to fill every "*" field.';
    } else if($_GET['error'] == 'dupe'){
        $alert=true;
        $type = 'warning';
        $message = 'This product name already exist in the shop.';
    } else if($_GET['error'] == 'nameLength'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed name of product is too short or too long';
    }else if($_GET['error'] == 'descriptionLength'){
        $alert=true;
        $type = 'warning';
        $message = 'Your typed description is too short or too long';
    } else if($_GET['error'] == 'invalidImageExtension'){
        $alert=true;
        $type = 'warning';
        $message = 'Failed to update : Invalid image extension.';
    } else if($_GET['error'] == 'invalidImageType'){
        $alert=true;
        $type = 'warning';
        $message = 'Failed to update : Invalid image type';
    } else if($_GET['error'] == 'uploadError'){
        $alert=true;
        $type = 'warning';
        $message = 'Failed to update : Error with the upload of your image.';
    }
}

$resultModifier = fetchProductJoinUser($db, $_GET['id'], 'modifier_id');
$resultCategories = fetchAllCategoryLabel($db);
if(isset($_SESSION['user'])){
    echo '
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
<div class="height d-flex justify-content-center align-items-center mt-5 mb-5 ">
    <div class="card px-5 py-3">
        <div class="d-flex justify-content-between align-items-center p-1">
            <div class="mt-2">';
            if($productDisplay['label']){
                echo '<h5 class="text-uppercase mb-0">'.$productDisplay['label'].'</h5>';
            }
                echo '<div class="pt-3">
                    <h2 class="main-heading mt-0">'.$productDisplay['name'].'</h2>
                </div>
            </div>
            <div class="image p-4"> <img src="'.$productDisplay['image'].'" width="200"> </div>
        </div>
        <h5 class="text-uppercase mb-0">'.$productDisplay['price'].'€</h5>';
        if($productDisplay['dlc']){
            echo '<h5 class="text-uppercase mb-0">DLC : '.$productDisplay['dlc'].'</h5>';
        }
        echo '<div class="d-flex justify-content-between align-items-center mt-2 mb-2">
            <div class="colors"> 
                <div>Stock : '.$productDisplay['stock_quantity'].'</div> 
                <div>Vendu par : <span class="text-capitalize font-weight-bold">'.$productDisplay['username'].' </span></div> 
                <div>Dernière modification par : <span class="text-capitalize font-weight-bold">'.$resultModifier['username'].' </span> le '.$resultModifier['modifier_date'].'.</div> <span></span> 
            </div>
        </div>
        <p>'.$productDisplay['description'].'</p>
        <a href="product.php?id='.$_GET['id'].'" class="p-1">Retour.</a>
    </div>
</div>

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Modifier le produit.</h6>
            </nav>
        </div>
    </nav>
    <h4>';if($alert){ ?>
        <h4 class="text-danger"> <?php echo $message ?></h4>
        <?php }
    echo '</h4>
    <form class="container-fluid py-4" method="POST" action="includes/modify-product_post.php?id='.$_GET['id'].'" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nameProduct">Nom du produit</label>
            <input type="text" class="form-control" id="nameProduct" name="nameProduct" placeholder="Modifier le nom du produit.">
        </div>
        <div class="form-group">
            <label for="nameCategory">Catégorie</label>
            <select name="nameCategory" id="nameCategory" class="form-select">
            <option value="">Choisir une catégorie.</option>';
            foreach($resultCategories as $category){
                echo "<option value='".$category['categories_id']."'>".$category['label']."</option>";
            }
            echo '</select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Modifier une description du produit.">
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Modifier le prix du produit.">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Modifier le stock du produit.">
        </div>
        <div class="form-group">
            <label for="dlc">Date Limite de Consommation du produit.</label>
            <input type="date" class="form-control" id="dlc" name="dlc" placeholder="Entrez la dlc du produit.">
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <!-- <input type="date"  id="photo" name="photo"> -->
            <input type="file" class="form-control" name="photo" id="photo" accept="image/png, image/jpg, image/jpeg"/>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Etes vous sur ?</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>';
}
?>
<?php include_once '_footer.php'; ?>


