
DELIMITER //
CREATE FUNCTION UpdateProduct (ProductName VARCHAR(100), CategoryName VARCHAR (150) , ProductImageLink VARCHAR(150) , ManufacturerName VARCHAR(150), TechnicalSpecs VARCHAR(200),  
Price Double , QuantityAvalilableNew INT, QuantityAvalilableRef INT, Discount Double)
RETURNS varchar(100)
NOT DETERMINISTIC
BEGIN 
	Declare Result VARCHAR(100);
	SET @ProductID = (SELECT ProID FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
    Set @MANUFCATURERID = (Select ManID from MANUFCATURER where MANUFCATURER.ManName = ManufacturerName);
	Set @CatID = (Select SubCatID from SUB_CATEGORIES where SUB_CATEGORIES.SubCatName = CategoryName);
	UPDATE product 
	SET  ProdName = ProductName, SubCatID = CatID , ProdImageLink =ProductImageLink, ManID = MANUFCATURERID, ProdTechnicalSpecs = TechnicalSpecs,
	ProdPrice = Price , ProdQuantityAvalilableNew = QuantityAvalilableNew , ProdQuantityAvalilableRef = QuantityAvalilableRef, ProdDiscount  = Discount
	WHERE ProdID = ProductID ;
    return '1';
END //
DELIMITER ;

