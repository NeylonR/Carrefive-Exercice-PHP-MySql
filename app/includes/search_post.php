<?php 
if(!empty($_POST['search'])){
    $searchInput = trim(htmlspecialchars($_POST['search']));
    $resultDisplay = search($db, $searchInput);
    if(!empty($resultDisplay)){
        echo "<div class='card-header pb-0'>
        <h6>Résultats de votre recherche.</h6>
    </div>";
        displayTable($resultDisplay);
    }else{
        echo "<div class='px-5 py-3'>Your search: '".$_POST['search']."' is not found in our product.</div>";
    }
    
}else{
    echo "<div class='px-5 py-3'>Invalid search.".$_POST['search']."</div>";
}
?>