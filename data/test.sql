CREATE TABLE `user` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`username`  varchar(64) NULL COMMENT '用户名' ,
`passwor_hash`  varchar(128) NULL ,
`name`  varchar(64) NULL COMMENT '用户名字' ,
`mobi`  varchar(16) NULL COMMENT '手机号码' ,
`email`  varchar(255) NULL COMMENT '邮箱' ,
`status`  int(9) NULL ,
`note`  varchar(255) NULL COMMENT '备注' ,
`create_time`  datetime NULL ON UPDATE CURRENT_TIMESTAMP ,
`update_time`  datetime NULL ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`),
INDEX `email` (`email`) USING BTREE ,
INDEX `name` (`name`) USING BTREE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4
COMMENT='用户'
;

