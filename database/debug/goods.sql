--	This sript must be executed after categories.sql script.

DELETE FROM `goods` WHERE `name` LIKE '%Debug item%';

INSERT INTO `goods` (`name`,`article`,`r_price`,`w_price`,`in_pack`,`packs`,`assort`,`created_at`,`updated_at`)VALUES
	('Debug item 0001', 'ART-0001-debug',10.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0002', 'ART-0002-debug',10.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0003', 'ART-0003-debug',11.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0004', 'ART-0004-debug',12.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0005', 'ART-0005-debug',13.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0006', 'ART-0006-debug',11.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0007', 'ART-0007-debug',12.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0008', 'ART-0008-debug',13.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0009', 'ART-0009-debug',14.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0010', 'ART-0010-debug',15.56,9.00,24,10,0,NOW(),NOW())
	;