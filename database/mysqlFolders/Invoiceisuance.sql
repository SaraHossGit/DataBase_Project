DELIMITER //
CREATE FUNCTION InvoiceIssuance( CustomerID INT,ProductName VARCHAR(50),InvoiceComments VARCHAR(100), Quantity INT,Method VARCHAR(100),InvoiceState BOOL,ProductState BOOL)
RETURNS VARCHAR(100)
NOT DETERMINISTIC
BEGIN 
		Declare Result VARCHAR(100);
		SET @CurrentDate=NOW();
    	SET @ProductID= (SELECT ProdID FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
    	
    	SET @ValidQuantityNew =(SELECT ProdQuantityAvalilableNew FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
        SET @ValidQuantityRef =(SELECT ProdQuantityAvalilableRef FROM PRODUCT WHERE PRODUCT.ProdName=ProductName);
    	SET @ProductPrice =(SELECT ProdPrice FROM PRODUCT WHERE PRODUCT.ProdID=@ProductID);
    	SET @CustomerBalance =( SELECT CusBalance FROM CUSTOMER WHERE CUSTOMER.CusID=CustomerID);
        SET @ProductType="New";
        IF ProductState=1 THEN
			SET @ProductType="New";
		ELSE 
			SET @ProductType="Refurbished";
		END IF;
    
    	IF Method!="Cash" AND @CustomerBalance>0 AND InvoiceState=0 THEN
			SET Result="You can't place any new order untill your balance become zero";
	
    	ELSEIF Quantity>@ValidQuantityNew AND ProductState=1 THEN
			SET Result="there isn't enough quantity";
            
		ELSEIF Quantity>@ValidQuantityRef AND ProductState=0 THEN
			SET Result="there isn't enough quantity";
            
        ELSEIF  InvoiceState=1 THEN
			SET Result="Your invoice has been created ";
			SET @InvoiceNumber=(SELECT InvNumber  FROM INVOICE ORDER BY InvNumber DESC LIMIT 1);
            
			IF Method="Cash" THEN
            
				UPDATE INVOICE
				SET
					InvTotal=InvTotal+(@ProductPrice * Quantity)
				WHERE
					INVOICE.InvNumber=@InvoiceNumber;
                    
                
				
			ELSE 
				UPDATE INVOICE
				SET
					InvTotal=InvTotal+(1.2*@ProductPrice * Quantity)
				WHERE
					INVOICE.InvNumber=@InvoiceNumber;
				UPDATE CUSTOMER
				SET
					CusBalance=CusBalance+(1.2*@ProductPrice * Quantity)
				WHERE
					CUSTOMER.CusID=CustomerID;
				
			END IF;
            
            INSERT INTO PROD_INV(ProdID, InvNumber, PIQuntity,PIStatus) VALUES (@ProductID,@InvoiceNumber,Quantity,@ProductType);
                
			IF @ProductType='NEW' THEN
				UPDATE PRODUCT
				SET
				ProdQuantityAvalilableNew=ProdQuantityAvalilableNew - Quantity
				WHERE
				PRODUCT.ProdID=@ProductID;
			ELSE 
				UPDATE PRODUCT
				SET
				ProdQuantityAvalilableRef=ProdQuantityAvalilableRef - Quantity
				WHERE
				PRODUCT.ProdID=@ProductID;
			END IF;
		ELSE
			SET Result="Your invoice has been created ";
            INSERT INTO INVOICE(CusID ,InvDate,InvTime, InvTotal,InvComments,InvExpShipingTime,InvStatus,InvPaymentMethod)
			VALUES (CustomerID,NOW(),CURRENT_TIME,0,InvoiceComments,DATE_ADD(NOW(),INTERVAL 30 DAY) ,'Processing',Method);
            SET @InvoiceNumber=(SELECT InvNumber  FROM INVOICE ORDER BY InvNumber DESC LIMIT 1);
            
			IF Method="Cash" THEN
            
				UPDATE INVOICE
				SET
					InvTotal=InvTotal+(@ProductPrice * Quantity)
				WHERE
					INVOICE.InvNumber=@InvoiceNumber;
                    
                
				
			ELSE 
				UPDATE INVOICE
				SET
					InvTotal=InvTotal+(1.2*@ProductPrice * Quantity)
				WHERE
					INVOICE.InvNumber=@InvoiceNumber;
				UPDATE CUSTOMER
				SET
					CusBalance=CusBalance+(1.2*@ProductPrice * Quantity)
				WHERE
					CUSTOMER.CusID=CustomerID;
				
			END IF;
            
            INSERT INTO PROD_INV(ProdID, InvNumber, PIQuntity,PIStatus) VALUES (@ProductID,@InvoiceNumber,Quantity,@ProductType);
                
			IF @ProductType='NEW' THEN
				UPDATE PRODUCT
				SET
				ProdQuantityAvalilableNew=ProdQuantityAvalilableNew - Quantity
				WHERE
				PRODUCT.ProdID=@ProductID;
			ELSE 
				UPDATE PRODUCT
				SET
				ProdQuantityAvalilableRef=ProdQuantityAvalilableRef - Quantity
				WHERE
				PRODUCT.ProdID=@ProductID;
			END IF;
			
				
			
        
		END IF;
    
		RETURN Result;
    
END //
DELIMITER ;