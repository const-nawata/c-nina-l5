
DELIMITER //


DROP PROCEDURE IF EXISTS set_debug_categories//




CREATE PROCEDURE set_debug_categories () 
DETERMINISTIC 
BEGIN
	DECLARE v_cat01_id,v_cat02_id,v_cat03_id,v_cat04_id,v_cat05_id 

 			,v_cat_01_02_id,v_cat_01_07_id
					
			,v_cat_03_01_id,v_cat_03_03_id
				,v_cat_03_03_03_id
					
	 int(10);

	DECLARE `ex_rollback` BOOL DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `ex_rollback` = 1;

	START TRANSACTION;

		DELETE FROM `categories` WHERE `name` LIKE '%Debug cat%';


		INSERT INTO `categories` (`name`,created_at,updated_at)VALUES
					('Debug cat 01',NOW(),NOW()),
					('Debug cat 02',NOW(),NOW()),
					('Debug cat 03',NOW(),NOW()),
					('Debug cat 04',NOW(),NOW()),
					('Debug cat 05',NOW(),NOW()),
					('Debug cat 06',NOW(),NOW()),
					('Debug cat 07',NOW(),NOW()),
					('Debug cat 08',NOW(),NOW()),
					('Debug cat 09',NOW(),NOW()),
					('Debug cat 10',NOW(),NOW()),
					('Debug cat 11',NOW(),NOW()),
					('Debug cat 12',NOW(),NOW()),
					('Debug cat 13',NOW(),NOW()),
					('Debug cat 14',NOW(),NOW()),
					('Debug cat 15',NOW(),NOW()),
					('Debug cat 16',NOW(),NOW()),
					('Debug cat 17',NOW(),NOW()),
					('Debug cat 18',NOW(),NOW()),
					('Debug cat 19',NOW(),NOW()),
					('Debug cat 20',NOW(),NOW())
	;


--	TREE

	DELETE FROM `categorytree` ;


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%01%' LIMIT 1),NULL,0);SET v_cat01_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%02%' LIMIT 1),NULL,1);SET v_cat02_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%03%' LIMIT 1),NULL,2);SET v_cat03_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%04%' LIMIT 1),NULL,4);SET v_cat04_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%05%' LIMIT 1),NULL,3);SET v_cat05_id = LAST_INSERT_ID();


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%06%' LIMIT 1),v_cat01_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%07%' LIMIT 1),v_cat01_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%08%' LIMIT 1),v_cat01_id,0)
	;


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%06%' LIMIT 1),v_cat02_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%07%' LIMIT 1),v_cat02_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%08%' LIMIT 1),v_cat02_id,0)
	;



	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%12%' LIMIT 1),v_cat03_id,0);SET v_cat_03_01_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%15%' LIMIT 1),v_cat_03_01_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%16%' LIMIT 1),v_cat_03_01_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%17%' LIMIT 1),v_cat_03_01_id,0)
	;


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%13%' LIMIT 1),v_cat03_id,0);


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%14%' LIMIT 1),v_cat03_id,0);SET v_cat_03_03_id = LAST_INSERT_ID();

	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%18%' LIMIT 1),v_cat_03_03_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%19%' LIMIT 1),v_cat_03_03_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%20%' LIMIT 1),v_cat_03_03_id,0)
	;


	INSERT INTO `categorytree` (`category_id`,`parent_id`,`rank`)VALUES
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%09%' LIMIT 1),v_cat04_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%10%' LIMIT 1),v_cat04_id,0),
		((SELECT `id` FROM `categories` WHERE `name` LIKE '%11%' LIMIT 1),v_cat04_id,0)

;

















-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 05-01',v_cat05_id,NOW(),NOW())
-- 			,('Debug cat 05-02',v_cat05_id,NOW(),NOW())
-- 			,('Debug cat 05-03',v_cat05_id,NOW(),NOW()),
-- 			('Debug cat 05-04',v_cat05_id,NOW(),NOW()),
-- 			('Debug cat 05-05',v_cat05_id,NOW(),NOW()),
-- 			('Debug cat 05-06',v_cat05_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 04-01',v_cat04_id,NOW(),NOW()),
-- 			('Debug cat 04-02',v_cat04_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-01',v_cat01_id,NOW(),NOW());
-- 
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-02',v_cat01_id,NOW(),NOW());SET v_cat_01_02_id = LAST_INSERT_ID();
-- 		
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-03',v_cat01_id,NOW(),NOW()),
-- 			('Debug cat 01-04',v_cat01_id,NOW(),NOW()),
-- 			('Debug cat 01-05',v_cat01_id,NOW(),NOW()),
-- 			('Debug cat 01-06',v_cat01_id,NOW(),NOW())
-- 		;
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-07',v_cat01_id,NOW(),NOW());SET v_cat_01_07_id = LAST_INSERT_ID();
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-08',v_cat01_id,NOW(),NOW()),
-- 			('Debug cat 01-09',v_cat01_id,NOW(),NOW())
-- 		;
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-07-01',v_cat_01_07_id,NOW(),NOW()),
-- 			('Debug cat 01-07-02',v_cat_01_07_id,NOW(),NOW())
-- 		;
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 02-01',v_cat02_id,NOW(),NOW()),
-- 			('Debug cat 02-03',v_cat02_id,NOW(),NOW()),
-- 			('Debug cat 02-02',v_cat02_id,NOW(),NOW()),
-- 			('Debug cat 02-04',v_cat02_id,NOW(),NOW())
-- 		;
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-02-01',v_cat_01_02_id,NOW(),NOW()),
-- 			('Debug cat 01-02-02',v_cat_01_02_id,NOW(),NOW())
-- 		;
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 01-07-03',v_cat_01_07_id,NOW(),NOW()),
-- 			('Debug cat 01-07-04',v_cat_01_07_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-01',v_cat03_id,NOW(),NOW()),
-- 			('Debug cat 03-02',v_cat03_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-03',v_cat03_id,NOW(),NOW());SET v_cat_03_03_id = LAST_INSERT_ID();
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-03-01',v_cat_03_03_id,NOW(),NOW()),
-- 			('Debug cat 03-03-02',v_cat_03_03_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-03-03',v_cat_03_03_id,NOW(),NOW());SET v_cat_03_03_03_id = LAST_INSERT_ID();
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-03-03-01',v_cat_03_03_03_id,NOW(),NOW()),
-- 			('Debug cat 03-03-03-02',v_cat_03_03_03_id,NOW(),NOW())
-- 		;
-- 
-- 
-- 		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
-- 			('Debug cat 03-03-04',v_cat_03_03_id,NOW(),NOW()),
-- 			('Debug cat 03-03-05',v_cat_03_03_id,NOW(),NOW())
-- 		;

	IF `ex_rollback` THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;

-- SELECT v_cat01_id AS cat01_id;
END//  



CALL set_debug_categories//
DROP PROCEDURE IF EXISTS set_debug_categories//

  DELIMITER ;