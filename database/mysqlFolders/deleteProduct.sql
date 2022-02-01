# delete product

DELIMITER //
CREATE FUNCTION DeleteProduct(ProductName varchar(30))
RETURNS VARCHAR(100)
NOT DETERMINISTIC
BEGIN 
	Declare Result VARCHAR(100);
    DELETE FROM product WHERE product.ProdName = ProductName;
    return '1';
    
END //
DELIMITER ;
