DROP DATABASE IF EXISTS carrefive;
CREATE DATABASE carrefive CHARACTER SET utf8;
USE carrefive;

CREATE TABLE carrefive.user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (25) NOT NULL,
    password VARCHAR (512) NOT NULL
);

CREATE TABLE carrefive.product (
    product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    description TEXT NOT NULL,
    price FLOAT NOT NULL,
    image VARCHAR (512),
    dlc DATE
);

ALTER TABLE carrefive.user ADD UNIQUE(`username`);
ALTER TABLE carrefive.product ADD UNIQUE(`name`);
ALTER TABLE carrefive.product ADD stock_quantity INT NOT NULL;
ALTER TABLE carrefive.product ADD seller_id INT DEFAULT NULL;
ALTER TABLE carrefive.product ADD modifier_id INT DEFAULT NULL;
ALTER TABLE carrefive.product ADD modifier_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

INSERT INTO carrefive.product (name,description,price,dlc) VALUES
('PANZANI Coquillettes', 'Des coquillettes panzani !', 0.76, '2025-11-09'),
('MAGNUM Classic x4', 'Boite de 4 magnums classic', 2.34, '2022-05-09'),
('CARRE5 500 Feuilles A4', 'Rame de papier A4 90gr', 4.01, null),
('PAIC Citron', 'Du liquide vaisselle', 1.76, null);

CREATE TABLE carrefive.order (
    order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    amount INT NOT NULL,
    buyer_id INT NOT NULL,
    product_ordered_id INT NOT NULL
);

ALTER TABLE `order` ADD CONSTRAINT fk_buyer_id FOREIGN KEY (buyer_id) REFERENCES user(id);
ALTER TABLE `order` ADD CONSTRAINT fk_product_id FOREIGN KEY (product_ordered_id) REFERENCES product(product_id) ON DELETE CASCADE;
ALTER TABLE `product` ADD CONSTRAINT fk_seller_id FOREIGN KEY (seller_id) REFERENCES user(id);
ALTER TABLE `product` ADD CONSTRAINT fk_modifier_id FOREIGN KEY (modifier_id) REFERENCES user(id);

