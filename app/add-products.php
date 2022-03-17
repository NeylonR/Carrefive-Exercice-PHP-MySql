<?php 
session_start();

include_once '_head.php';
isConnected();
include_once '_navbar.php';

try{
    $sqlCategories = 'SELECT * FROM categories ORDER BY label';
    $reqCategories = $db->query($sqlCategories);
    $resultCategories = $reqCategories->fetchAll();
}catch(PDOException $e){
    echo 'Erreur : '. $e;
} 

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
        $message = 'The product your try to add has already been added in the shop.';
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
        $message = 'Invalid image extension.';
    } else if($_GET['error'] == 'invalidImageType'){
        $alert=true;
        $type = 'warning';
        $message = 'Invalid image type';
    } else if($_GET['error'] == 'uploadError'){
        $alert=true;
        $type = 'warning';
        $message = 'Error with the upload of your image.';
    }
}
?>
<main class="main-content position-relative min-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Ajouter un produit.</h6>
            </nav>
        </div>
    </nav>

    <form class="container-fluid py-4" method="POST" action="includes/add-product_post.php" enctype='multipart/form-data'">
        <div class="form-group">
            <label for="nameProduct">Nom du produit*</label>
            <input type="text" class="form-control" id="nameProduct" name="nameProduct" placeholder="Entrez le nom du produit (30 caractères maximum.)" maxlength="30" required>
        </div>
        <div class="form-group">
            <label for="nameCategory">Catégorie</label>
            <select name="nameCategory" id="nameCategory" class="form-select">
                <option value="">Choisir une catégorie.</option>
                <?php
            foreach($resultCategories as $category){
                echo "<option value='".$category['categories_id']."'>".$category['label']."</option>";
            }
        ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description*</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Entrez une description du produit. (242 caractères maximum.)" maxlength="242" required>
        </div>
        <div class="form-group">
            <label for="price">Prix*</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Entrez le prix du produit." maxlength="8" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock*</label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock disponible pour le produit.">
        </div>
        <div class="form-group">
            <label for="dlc">Date Limite de Consommation du produit.</label>
            <input type="date" class="form-control" id="dlc" name="dlc" placeholder="Entrez la dlc du produit.">
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" name="photo" id="photo" accept="image/png, image/jpg, image/jpeg"/>
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
</main>

<?php include_once '_footer.php'; ?>