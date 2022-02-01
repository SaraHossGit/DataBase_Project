DELIMITER //
CREATE FUNCTION Add_Product (ProductName VARCHAR(100), CategoryName VARCHAR (150) , ProductImageLink VARCHAR(150) , ManufacturerName VARCHAR(150), TechnicalSpecs VARCHAR(200),  
Price Double , QuantityAvalilableNew INT, QuantityAvalilableRef INT, Discount Double)

RETURNS varchar(100)
NOT DETERMINISTIC
BEGIN 
	Declare Result VARCHAR(100);	
	SET @ProductID = (SELECT ProID FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
    	Set @MANUFCATURERID = (Select ManID from MANUFCATURER where MANUFCATURER.ManName = ManufacturerName);
	Set @CatID = (Select SubCatID from SUB_CATEGORIES where SUB_CATEGORIES.SubCatName = CategoryName);
	INSERT INTO product (ProdName, SubCatID, ProdImageLink,  ManID, ProdTechnicalSpecs, ProdPrice, ProdQuantityAvalilableNew, ProdQuantityAvalilableRef, ProdDiscount)
		VALUES(ProductName, CatID, ProductImageLink  , MANUFCATURERID, TechnicalSpecs,  Price, QuantityAvalilableNew, QuantityAvalilableRef,Discount);

    RETURN '1';
END //
DELIMITER ;
