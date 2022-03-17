<?php
function deleteProductWithOrder($db, $product_id){
    try{
        $sqlDeleteOrder = 'DELETE `order` FROM `order` INNER JOIN product ON order.order_id = product.product_id WHERE product_id = :product_id; 
        DELETE FROM product WHERE product_id = :product_id;';
        $reqDeleteOrder = $db->prepare($sqlDeleteOrder);
        return $reqDeleteOrder->execute(array(
            "product_id"=>$product_id
        ));
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
}

function addProductInsert($db, $nameProduct, $nameCategory, $description, $price, $photo, $dlc, $stock, $resultUsername){
    try{
        $sqlInsert = 'INSERT INTO product (name, category_id, description, price, image, dlc, stock_quantity, seller_id) VALUES (:name, :category_id, :description, :price, :image, :dlc, :stock_quantity, :seller_id)';
        $reqInsert = $db->prepare($sqlInsert);
        return $reqInsert->execute(array(
            'name'=>$nameProduct,
            'category_id'=>$nameCategory,
            'description'=>$description,
            'price'=>$price,
            'image'=>$photo,
            'dlc'=>$dlc,
            'stock_quantity'=>$stock,
            'seller_id'=>$resultUsername['id']
        ));
    } catch(PDOException $e){
        echo "Erreur à l'insertion : " .$e;
    }
}

function insertCategory($db, $nameCategory){
    try{
        $sqlInsert = 'INSERT INTO categories (label) VALUES (:label)';
        $reqInsert = $db->prepare($sqlInsert);
        return $reqInsert->execute(array(
            'label'=>$nameCategory
        ));
    } catch(PDOException $e){
        echo "Erreur à l'insertion : " .$e;
    }
}

function insertOrder($db, $amount, $buyer_id, $product){
    try{
        $sqlOrder = 'INSERT INTO `ORDER` (amount, buyer_id, product_ordered_id) VALUES (:amount, :buyer_id, :product_ordered_id)';
        $reqOrder = $db->prepare($sqlOrder);
        $reqOrder->execute(array(
            'amount'=>$amount,
            'buyer_id'=>$buyer_id,
            'product_ordered_id'=>$product
        ));
        return $order_id = $db->lastInsertId();
    } catch(PDOException $e){
        echo "Erreur : " .$e;
    } 
}

function search($db, $postSearch){
    try{
        $sqlDisplay = 'SELECT * FROM product LEFT JOIN categories ON product.category_id = categories.categories_id WHERE name LIKE "%":name"%"';
        $reqDisplay = $db->prepare($sqlDisplay);
        $reqDisplay->bindValue(':name',$postSearch, pdo::PARAM_STR);
        $reqDisplay->execute();
        return $resultDisplay = $reqDisplay->fetchAll();
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
}

function signUp($db, $username, $password){
    try{
        $sqlInsert = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $reqInsert = $db->prepare($sqlInsert);
        return $resultInsert = $reqInsert->execute(array(
            'username' => $username,
            'password' => $password
        ));
    } catch(PDOException $e){
        echo "Erreur : " . $e;
    }
}

function fetchAllCategoryLabel($db){
    try{
        $sqlCategories = 'SELECT * FROM categories ORDER BY label';
        $reqCategories = $db->query($sqlCategories);
        return $resultCategories = $reqCategories->fetchAll();
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    } 
}

function fetchAllProductCategory($db){
    try{
        $sqlDisplay = 'SELECT * FROM product LEFT JOIN categories ON product.category_id = categories.categories_id';
        $reqDisplay = $db->query($sqlDisplay);
        return $resultDisplay = $reqDisplay->fetchAll();
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
}

function fetchProductJoinCategoryAndUser($db, $product_id){
    try{
        $sqlDisplay = 'SELECT * FROM product 
        LEFT JOIN categories ON product.category_id = categories.categories_id  
        LEFT JOIN user ON product.seller_id = user.id
        WHERE product_id = :id';
        $reqDisplay = $db->prepare($sqlDisplay);
        $reqDisplay->execute(array(
            "id"=>$product_id
        ));
        return $productDisplay = $reqDisplay->fetch();
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
}

function fetchProductJoinUser($db, $product_id, $leftJoinOn){  
    try{
        $sqlDisplay = 'SELECT * FROM product LEFT JOIN user ON product.';
        $sqlDisplay .= $leftJoinOn;
        $sqlDisplay .= ' = user.id WHERE product_id = :product_id';
        $reqDisplay = $db->prepare($sqlDisplay);
        $reqDisplay->execute(array(
            'product_id'=>$product_id
        ));
        return $resultDisplay = $reqDisplay->fetch();
        
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
}

function fetchLabel($db, $nameCategory){
    try{
        $sqlVerif = 'SELECT label FROM categories WHERE label = :label';
        $reqVerif = $db->prepare($sqlVerif);
        $reqVerif->execute(array(
            'label'=>$nameCategory
        ));
        return $resultVerif = $reqVerif->fetch();
    } catch(PDOException $e){
        echo "Erreur à la vérification : " .$e;
    }
}

function fetchNamePrice($db, $nameProduct){
    try{
        $sqlVerif = 'SELECT name, price FROM product WHERE name = :name';
        $reqVerif = $db->prepare($sqlVerif);
        $reqVerif->execute(array(
            'name'=>$nameProduct
        ));
        return $resultVerif = $reqVerif->fetch();
    } catch(PDOException $e){
        echo "Erreur à la vérification : " .$e;
    }
}

function fetchProductOrder($db, $order_id){
    try{
        $sqlOrderProduct = 'SELECT * FROM product LEFT JOIN `order` ON product.product_id = order.product_ordered_id WHERE order.order_id = :order_id';
        $reqOrderProduct = $db->prepare($sqlOrderProduct);
        $reqOrderProduct->execute(array(
            'order_id'=>$order_id
        )); 
        return $resultOrderProduct = $reqOrderProduct->fetch();
    } catch(PDOException $e){
        echo "Erreur : " .$e;
    } 
}

function fetchProduct($db, $product_id){
    try{
        $sqlGetProduct = 'SELECT * FROM product WHERE product_id = :product_id';
        $reqGetProduct = $db->prepare($sqlGetProduct);
        $reqGetProduct->execute(array(
        'product_id'=>$product_id
    ));
    return $resultGetProduct = $reqGetProduct->fetch();
    }catch(PDOException $e){
        echo "Erreur : ".$e;
    }
}

function fetchUser($db,$username){
    try{
        $sqlVerif = 'SELECT * FROM user WHERE username = :username';
        $reqVerif = $db->prepare($sqlVerif);
        $reqVerif->bindValue(':username', $username, PDO::PARAM_STR);
        $reqVerif->execute();
        return $resultVerif = $reqVerif->fetch();
    }catch(PDOException $e){
        echo "Erreur : ".$e;
    }
}

function isConnected(){
    if(!isset($_SESSION['user'])){
        header('location: sign-in.php');
    }
}

function fetchAllProduct($db){
    try{
        $sqlDisplay = 'SELECT * FROM product 
        LEFT JOIN categories ON product.category_id = categories.categories_id  
        LEFT JOIN user ON product.seller_id = user.id';
        $reqDisplay = $db->query($sqlDisplay);
        return $reqDisplay->fetchAll();
    }catch(PDOException $e){
        echo 'Erreur : '. $e;
    }
    
}
function updateDB($db, $dbCol, $varToPush){
    try{
        $sqlInsert = 'UPDATE product SET '. $dbCol.' = :'.$dbCol.' WHERE product_id = :id';
        $reqInsert = $db->prepare($sqlInsert);
        return $reqInsert->execute(array(
            $dbCol=>$varToPush,
            'id'=>$_GET['id']
        ));
    } catch(PDOException $e){
        echo "Erreur à l'insertion : " .$e;
    }
}