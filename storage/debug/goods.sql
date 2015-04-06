--	This sript must be executed after categories.sql script.

DELETE FROM `goods` WHERE `name` LIKE '%Debug item%';

INSERT INTO `goods` (`name`,`article`,`unit_id`,`r_price`,`w_price`,`in_pack`,`packs`,`assort`,`created_at`,`updated_at`)VALUES
	('Debug item 0001', 'ART-0001-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),10.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0002', 'ART-0002-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),10.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0003', 'ART-0003-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),11.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0004', 'ART-0004-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),12.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0005', 'ART-0005-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),13.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0006', 'ART-0006-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),11.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0007', 'ART-0007-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),12.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0008', 'ART-0008-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),13.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0009', 'ART-0009-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),14.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0010', 'ART-0010-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())

	
	,('Debug item 0021', 'ART-0021-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0022', 'ART-0022-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0023', 'ART-0023-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0024', 'ART-0024-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0025', 'ART-0025-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0026', 'ART-0026-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0027', 'ART-0027-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0028', 'ART-0028-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0029', 'ART-0029-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	,('Debug item 0030', 'ART-0030-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())

	,('Debug item 0035', 'ART-0035-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())

	,('Debug item 0045', 'ART-0045-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())


	,('Debug item 0085', 'ART-0085-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())

	,('Debug item 0076', 'ART-0076-debug',(SELECT `id` FROM `units` WHERE `const` LIKE '%pcs%' LIMIT 1),15.56,9.00,24,10,0,NOW(),NOW())
	
	;