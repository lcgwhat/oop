DROP TABLE IF EXISTS `account_user`;
CREATE TABLE `account_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(108) NOT NULL DEFAULT '' COMMENT '密码',
  `create_at` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `create_ip_at` varchar(12) NOT NULL DEFAULT '' COMMENT '创建ip',
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='账户';

-- ----------------------------
-- Records of account_user
-- ----------------------------
INSERT INTO `account_user` VALUES ('1', '348437207@qq.com', 'liuchg', '$2y$13$oDFzdJOZ8LTo0oVOMzmw4.HzGM9z/QjFc7C5wO.fzckFb3hHDoCr6', '0', '127.0.0.1');



CREATE TABLE `daily_trace` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `account_id` int(11) NOT NULL COMMENT '账号ID',
  `type` smallint not null comment '类型',
  `trace_date` date DEFAULT NULL COMMENT '日期',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_date` (`account_id`,`trace_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='每日追踪';

CREATE TABLE `stock_logic` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `code` char(6) NOT NULL COMMENT '代码',
                               `name` varchar(16) DEFAULT NULL,
                               `logic` varchar(1024) DEFAULT NULL COMMENT '操作逻辑',
                               `sort` smallint(6) DEFAULT 1 COMMENT '排序',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

// 2023-03-05 多项逻辑分列显示
CREATE TABLE `stock_logic_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_logic_id` bigint(20) NOT NULL COMMENT 'stock_logic 主键',
  `description` varchar(1024) DEFAULT NULL,
  `sort` smallint(6) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='stock 逻辑子项目';

ALTER TABLE `stock_logic`
DROP COLUMN `logic`;




