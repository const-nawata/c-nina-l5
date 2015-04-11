--	This sript must be executed after categories.sql script.
-- 
-- DELETE FROM `goods` WHERE `name` LIKE '%Debug item%';
-- 
-- INSERT INTO `goods` (`name`,`article`,`unit_id`,`r_price`,`w_price`,`in_pack`,`packs`,`assort`,`created_at`,`updated_at`)VALUES
-- 	('Debug item 0001', 'ART-0001-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),10.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0002', 'ART-0002-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),10.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0003', 'ART-0003-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),11.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0004', 'ART-0004-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),12.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0005', 'ART-0005-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),13.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0006', 'ART-0006-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),11.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0007', 'ART-0007-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),12.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0008', 'ART-0008-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),13.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0009', 'ART-0009-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),14.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0010', 'ART-0010-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 
-- 	
-- 	,('Debug item 0021', 'ART-0021-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0022', 'ART-0022-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0023', 'ART-0023-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0024', 'ART-0024-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0025', 'ART-0025-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0026', 'ART-0026-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0027', 'ART-0027-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0028', 'ART-0028-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0029', 'ART-0029-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	,('Debug item 0030', 'ART-0030-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 
-- 	,('Debug item 0035', 'ART-0035-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 
-- 	,('Debug item 0045', 'ART-0045-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 
-- 
-- 	,('Debug item 0085', 'ART-0085-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 
-- 	,('Debug item 0076', 'ART-0076-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
-- 	
-- 	;
-- 
-- 


DELIMITER //

DROP PROCEDURE IF EXISTS set_debug_goods//
CREATE PROCEDURE set_debug_goods () 
DETERMINISTIC 
BEGIN
	DECLARE v_n_goods int DEFAULT 200;
	DECLARE v_n int DEFAULT 0;
	DECLARE v_name, v_article varchar (200);
	DECLARE v_ret, v_wh, v_prc float;



	DELETE FROM `goods` WHERE `name` LIKE '%Debug item%';


	SET v_name		= 'Debug item ';
	SET v_article	= 'ART-debug ';

	WHILE v_n < v_n_goods DO
		 
		SET v_ret	= RAND()*100;
		SET v_prc	= 5+RAND()*5;
		SET v_wh	= v_ret - (v_ret/100)*v_prc;

		INSERT INTO `goods` (`name`,`article`,`unit_id`,`r_price`,`w_price`,`in_pack`,`packs`,`assort`,`created_at`,`updated_at`)VALUES(
			CONCAT(v_name,v_n)
			,CONCAT(v_article,v_n)
			,(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1)
			,v_ret				--	`r_price`
			,v_wh				--	`w_price`
			,24					--	`in_pack`
			,FLOOR(RAND()*20)	--	`packs`
			,FLOOR(RAND()*24)	--	`assort`
			,NOW(),NOW()

		);


-- 		SELECT v_ret, v_wh, v_prc;



		SET v_n = v_n + 1;
	END WHILE;



END//




CALL set_debug_goods//
DROP PROCEDURE IF EXISTS set_debug_goods//

  DELIMITER ;