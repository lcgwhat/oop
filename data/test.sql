CREATE TABLE `account_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(72) NOT NULL DEFAULT '' COMMENT '密码',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip_at` varchar(12) NOT NULL DEFAULT '' COMMENT '创建ip',
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='账户';



CREATE TABLE `daily_trace` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `account_id` int(11) NOT NULL COMMENT '账号ID',
  `trace_date` date DEFAULT NULL COMMENT '日期',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_date` (`account_id`,`trace_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='每日追踪';

