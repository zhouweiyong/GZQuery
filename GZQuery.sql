CREATE DATABASE gz_query
  CHARSET UTF8;

# 管理员
CREATE TABLE gz_admin (
  id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  admin_name CHAR(20) NOT NULL,
  admin_pwd  CHAR(20) NOT NULL
)
  ENGINE MYISAM
  CHARSET UTF8;

INSERT INTO gz_admin (admin_name, admin_pwd) VALUES
  ("admin", "admin");

# 员工用户名和密码
CREATE TABLE `gz_user` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name`  VARCHAR(80)      NOT NULL,
  `user_pwd`   VARCHAR(20)      NOT NULL,
  `user_email` VARCHAR(80)      NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;