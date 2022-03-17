<?php
session_start();
include_once '_head.php';
$productDisplay = fetchProductJoinCategoryAndUser($db, $_GET['id']);
redirectionIfProductDontExist($productDisplay);

include_once '_navbar.php';

$resultModifier = fetchProductJoinUser($db, $_GET['id'], 'modifier_id');
$alert = false;
if(isset($_GET['success'])){
    $alert=true;
    $type = 'success';
    $message = 'Product has been updated.';
}
if(isset($_GET['error'])){
    if($_GET['error'] == 'amount'){
        $alert=true;
        $type = 'danger';
        $message = 'Select a valid amount for your order.';
    } else if($_GET['error'] == 'warning'){
        $alert=true;
        $type = 'danger';
        $message = 'There is a problem with your order, contact a member of the staff.';
    }
}

echo '
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
<div class="height d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="card px-5 py-3">
    <div>';
    if($alert){
        echo '<h4 class="text-'.$type.'">'.$message. '</h4>';
         }
        echo' </div>
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
            <div class="colors">';
            if($productDisplay['stock_quantity'] <= 0){
                echo '<div class="text-danger">Rupture de stock</div>';
                }else{
                    echo '<div>Stock : '.$productDisplay['stock_quantity'].'</div>';
                }
                echo ' 
                <div>Vendu par : <span class="text-capitalize font-weight-bold">'.$productDisplay['username'].' </span></div>';
                if($resultModifier['username']){
                    echo '<div>Dernière modification par : <span class="text-capitalize font-weight-bold">'.$resultModifier['username'].' </span> le '.$resultModifier['modifier_date'].'.</div>';
                }
                
        echo '</div>
        </div>
        <p>'.$productDisplay['description'].'</p> 
        ';
        if(isset($_SESSION['user'])){
            if($productDisplay['stock_quantity'] > 0){
                echo'<form method="post" action="includes/order_post.php?id='.$_GET['id'].'" class="form-group">
                <label for="orderQuantity">Achetez</label>
                <select name="orderQuantity" id="orderQuantity" class="form-select mb-2">
                <option value="">Choisir une quantitée.</option>';
                for($i = 1;$i <= intval($productDisplay['stock_quantity']) && $i <= 500; $i++){
                    echo "<option value='".$i."'>".$i."</option>";
                }
                echo '</select>
                    <button class="d-block btn btn-danger">Commandez</button></form>';
            }
            echo '
            <a href="product_edit.php?id='.$_GET['id'].'" class="p-1">Modifier.</a>';
        }
    echo '<a href="index.php" class="p-1">Retour.</a></div>
</div>
</main>';
?>
<?php include_once '_footer.php'; ?>