
DELIMITER //


DROP PROCEDURE IF EXISTS set_debug_categories//




CREATE PROCEDURE set_debug_categories () 
DETERMINISTIC 
BEGIN
	DECLARE v_cat01_id,v_cat02_id,v_cat03_id,v_cat04_id,v_cat05_id 

 			,v_cat_01_02_id,v_cat_01_07_id
					
			,v_cat_03_03_id, v_cat_03_03_03_id
					
	 int(10);

	DECLARE `ex_rollback` BOOL DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `ex_rollback` = 1;

	START TRANSACTION;

		DELETE FROM `categories` WHERE `name` LIKE '%Debug cat%';


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES ('Debug cat 01',NULL,NOW(),NOW());SET v_cat01_id = LAST_INSERT_ID();
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES ('Debug cat 02',NULL,NOW(),NOW());SET v_cat02_id = LAST_INSERT_ID();
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES ('Debug cat 03',NULL,NOW(),NOW());SET v_cat03_id = LAST_INSERT_ID();
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES ('Debug cat 04',NULL,NOW(),NOW());SET v_cat04_id = LAST_INSERT_ID();
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES ('Debug cat 05',NULL,NOW(),NOW());SET v_cat05_id = LAST_INSERT_ID();



		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 05-01',v_cat05_id,NOW(),NOW())
			,('Debug cat 05-02',v_cat05_id,NOW(),NOW())
			,('Debug cat 05-03',v_cat05_id,NOW(),NOW()),
			('Debug cat 05-04',v_cat05_id,NOW(),NOW()),
			('Debug cat 05-05',v_cat05_id,NOW(),NOW()),
			('Debug cat 05-06',v_cat05_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 04-01',v_cat04_id,NOW(),NOW()),
			('Debug cat 04-02',v_cat04_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-01',v_cat01_id,NOW(),NOW());



		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-02',v_cat01_id,NOW(),NOW());SET v_cat_01_02_id = LAST_INSERT_ID();
		
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-03',v_cat01_id,NOW(),NOW()),
			('Debug cat 01-04',v_cat01_id,NOW(),NOW()),
			('Debug cat 01-05',v_cat01_id,NOW(),NOW()),
			('Debug cat 01-06',v_cat01_id,NOW(),NOW())
		;

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-07',v_cat01_id,NOW(),NOW());SET v_cat_01_07_id = LAST_INSERT_ID();

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-08',v_cat01_id,NOW(),NOW()),
			('Debug cat 01-09',v_cat01_id,NOW(),NOW())
		;
		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-07-01',v_cat_01_07_id,NOW(),NOW()),
			('Debug cat 01-07-02',v_cat_01_07_id,NOW(),NOW())
		;

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 02-01',v_cat02_id,NOW(),NOW()),
			('Debug cat 02-03',v_cat02_id,NOW(),NOW()),
			('Debug cat 02-02',v_cat02_id,NOW(),NOW()),
			('Debug cat 02-04',v_cat02_id,NOW(),NOW())
		;

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-02-01',v_cat_01_02_id,NOW(),NOW()),
			('Debug cat 01-02-02',v_cat_01_02_id,NOW(),NOW())
		;

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 01-07-03',v_cat_01_07_id,NOW(),NOW()),
			('Debug cat 01-07-04',v_cat_01_07_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-01',v_cat03_id,NOW(),NOW()),
			('Debug cat 03-02',v_cat03_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-03',v_cat03_id,NOW(),NOW());SET v_cat_03_03_id = LAST_INSERT_ID();


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-03-01',v_cat_03_03_id,NOW(),NOW()),
			('Debug cat 03-03-02',v_cat_03_03_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-03-03',v_cat_03_03_id,NOW(),NOW());SET v_cat_03_03_03_id = LAST_INSERT_ID();

		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-03-03-01',v_cat_03_03_03_id,NOW(),NOW()),
			('Debug cat 03-03-03-02',v_cat_03_03_03_id,NOW(),NOW())
		;


		INSERT INTO `categories` (`name`,`parent_id`,created_at,updated_at)VALUES 
			('Debug cat 03-03-04',v_cat_03_03_id,NOW(),NOW()),
			('Debug cat 03-03-05',v_cat_03_03_id,NOW(),NOW())
		;

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