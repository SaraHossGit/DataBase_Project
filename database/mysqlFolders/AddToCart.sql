DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `AddToCart`(`CustID` INT, `ProID` INT, `Quant` INT) RETURNS varchar(100) CHARSET utf8mb4
BEGIN 
	Declare Result VARCHAR(100);
     SET @ProdQ = (SELECT ProdQuantityAvalilableNew FROM PRODUCT WHERE PRODUCT.ProdID=ProID );
     
    
    IF Quant> @ProdQ THEN
    	SET Result="Sorry, but we don't have enough quantity in stock!";
    ELSE
    	INSERT INTO cart (CusID, ProdID, Quantity, prodStatus) values (CustID, ProID, Quant, Status)
    	ON DUPLICATE KEY UPDATE CusID=CustID , ProdID=ProID , Quantity = Quant, prodStatus=Status;
        SET Result="Added to cart Successfully";
    END IF;
        RETURN Result;
    
END$$
DELIMITER ;