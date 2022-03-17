<?php
session_start();
include_once '_head.php';
isConnected();
include_once '_navbar.php';

echo '
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
    <div class="height d-flex flex-column justify-content-center align-items-center mt-5 ">
        <div class="card text-center px-5 py-5">';
        $resultProductOrder = fetchProductOrder($db, $_GET['order_id']);
        echo 'Votre commande de '.$resultProductOrder['amount'].' '.$resultProductOrder['name'].' à été validé, votre numéro de commande est le suivant : '.$resultProductOrder['order_id'].'. 
        <a href="index.php">Retour à l\'accueil</a>
        </div>
    </div>
</main>
';
?>
<?php include_once '_footer.php'; ?>


