<?php 
function displayTable($arraySql){
    foreach($arraySql as $product){
        echo'
        <tr>
            <td>
                <p class="text-xs font-weight-bold mb-0 text-center">
                '.$product["product_id"].'
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">'.$product["label"].'</h6>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <a href="product.php?id='.$product["product_id"].'"><h6 class="mb-0 text-sm">'.$product["name"].'</h6></a>
                    </div>
                </div>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">'.$product["price"].'€
                </p>
            </td>
            <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">'.$product["dlc"].'</span>
            </td>
            <td class="align-middle text-center">';
            if($product['stock_quantity'] <= 0){
                echo '<span class="text-secondary text-danger text-xs font-weight-bold">Rupture</span>';
                } else{
                    echo '<span class="text-secondary text-xs font-weight-bold">'.$product["stock_quantity"].'</span>';
                }
            $flex = isset($_SESSION['user'])?'d-flex': '';           
            echo '</td>
            <td class="align-middle text-center '.$flex.' align-items-center justify-content-center">
                <a href="product.php?id='.$product["product_id"].'"
                    class="text-secondary font-weight-bold text-xs text-primary mx-1"
                    data-toggle="tooltip" data-original-title="Show product">
                    Afficher
                </a>';
            if(isset($_SESSION['user'])){
                echo '
                <a href="product_edit.php?id='.$product["product_id"].'" class="text-secondary font-weight-bold text-xs mx-2"
                    data-toggle="tooltip" data-original-title="Edit product">
                    Modifier
                </a>
                <form action="includes/productDelete_post.php" method="post">
                <input type="hidden" name="product_id" value="'.$product['product_id'].'";>
                <input type="hidden" name="csrf_token" value="'.$_SESSION['token'].'">
                <input class="text-danger form-control btn-outline-danger" type="submit" value="Delete product" />
                </form>
            </td>';
            }
        echo '</tr>';
    }
}

function redirectionIfProductDontExist($resultOfFetch){
    if(!$resultOfFetch){
        header('location:index.php');
        exit();
    }
}

function exportCSV($array, $filename = 'export.csv', $delimiter = ';')
{
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    // clean output buffer
    ob_end_clean();

    $handle = fopen('php://output', 'w');

    // use keys as column titles
    fputcsv($handle, array_keys($array['0']), $delimiter);

    foreach ($array as $value) {
        $value['modifier_date'] = date('j/M/Y : h:m:s', strtotime($value['modifier_date']));
        fputcsv($handle, $value, $delimiter);
    }

    fclose($handle);
    exit();
}
?>