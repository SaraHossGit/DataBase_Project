use e_shopper;
SET GLOBAL log_bin_trust_function_creators = 1;
DELIMITER //
CREATE FUNCTION ProdcutReturn(InvoiceNumber INT, ProductName VARCHAR(50), Quantity INT)
RETURNS VARCHAR(100)
NOT DETERMINISTIC
BEGIN 
	Declare Result VARCHAR(100);
	SET @CurrentDate=NOW();
    SET @ProductID= (SELECT ProdID FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
    SET @InvoiceDate= (SELECT InvDate FROM INVOICE WHERE INVOICE.InvNumber=InvoiceNumber);
    SET @ValidQuantity =(SELECT PIQuntity FROM PROD_INV WHERE PROD_INV.ProdID=@ProductID);
    Set @DiffDate = DATEDIFF( @CurrentDate, @InvoiceDate );
    Set @ProductPrice =(SELECT ProdPrice FROM PRODUCT WHERE PRODUCT.ProdID=@ProductID);
    SET @Method =(SELECT InvPaymentMethod FROM INVOICE WHERE INVOICE.InvNumber=InvoiceNumber);
    
    IF @Method!="Cash" THEN
		SET Result="Products only could be returned for Cash payment method";
	
    ELSEIF Quantity> @ValidQuantity THEN
		SET Result="the Input quantity is not valid";
        
	ELSEIF @DiffDate<15 THEN
		SET Result="Your request is accepted";
        
        UPDATE PRODUCT
        SET
			ProdQuantityAvalilableNew=ProdQuantityAvalilableNew+Quantity
		WHERE 
			PRODUCT.ProdID=@ProductID;
		
        UPDATE INVOICE
        SET
			InvTotal=InvTotal- (@ProductPrice * Quantity)
		WHERE
			INVOICE.InvNumber=@InvoiceNumber;
            
		UPDATE PROD_INV
        SET
			PIQuntity=PIQuntity-Quantity
		WHERE 
			PROD_INV.ProdID=@ProductID AND PROD_INV.InvNumber=@InvoiceNumber;
			
		
			
        
	ELSEIF @DiffDate>15 AND @DiffDate<30 THEN 
		SET Result="Your request is accepted";
        
        UPDATE PRODUCT
        SET
			ProdQuantityAvalilableRef=ProdQuantityAvalilableRef+Quantity
		WHERE 
			PRODUCT.ProdID=@ProductID;
		
        UPDATE INVOICE
        SET
			InvTotal=InvTotal- (ProductPrice * Quantity * 0.85)
		WHERE
			INVOICE.InvNumber=@InvoiceNumber;
            
		UPDATE PROD_INV
        SET
			PIQuntity=PIQuntity-Quantity
		WHERE 
			PROD_INV.ProdID=@ProductID AND PROD_INV.InvNumber=@InvoiceNumber;
        
    ELSE 
	    SET Result="Your request has passed the allowed duration (30 days)";
        
	END IF;
    
    RETURN Result;
    
END //
DELIMITER ;

set @str = ProdcutReturn(105,'Samsung Galaxy 10',2);
select @str;