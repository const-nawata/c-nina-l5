--	This sript must be executed after categories.sql script.


DELIMITER //

DROP PROCEDURE IF EXISTS set_debug_products//
CREATE PROCEDURE set_debug_products () 
DETERMINISTIC 
BEGIN
	DECLARE v_n_products int DEFAULT 131;
	DECLARE v_n int DEFAULT 0;
	DECLARE v_name, v_article varchar (200);
	DECLARE v_ret, v_wh, v_prc float;

	DELETE FROM `products` WHERE `name` LIKE '%Debug item%';


	SET v_name		= 'Debug item ';
	SET v_article	= 'ART-';

	WHILE v_n < v_n_products DO
		 
		SET v_ret	= RAND()*100;
		SET v_prc	= 5+RAND()*5;
		SET v_wh	= v_ret - (v_ret/100)*v_prc;

		INSERT INTO `products` (`name`,`article`,`unit_id`,`rprice`,`wprice`,`inpack`,`packs`,`assort`,`created_at`,`updated_at`)VALUES(
			CONCAT(v_name,LPAD(v_n,5,'0'))
			,CONCAT(v_article,LPAD(v_n,5,'0'),'-debug')
			,(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1)
			,v_ret				--	`rprice`
			,v_wh				--	`wprice`
			,24					--	`in_pack`
			,FLOOR(RAND()*20)	--	`packs`
			,FLOOR(RAND()*24)	--	`assort`
			,NOW(),NOW()

		);


-- 		SELECT v_ret, v_wh, v_prc;

		SET v_n = v_n + 1;
	END WHILE;
END//




CALL set_debug_products//
DROP PROCEDURE IF EXISTS set_debug_products//

  DELIMITER ;