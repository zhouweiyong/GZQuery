CREATE DATABASE gz_query
  CHARSET UTF8;

USE gz_query;

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
  `id`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userName` VARCHAR(80)      NOT NULL,
  `realName` CHAR(20)         NOT NULL,
  `passWord` CHAR(8)          NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;

# 表头
CREATE TABLE gz_header (
  id    INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  gtime CHAR(6) NOT NULL,
  col0  VARCHAR(30),
  col1  VARCHAR(30),
  col2  VARCHAR(30),
  col3  VARCHAR(30),
  col4  VARCHAR(30),
  col5  VARCHAR(30),
  col6  VARCHAR(30),
  col7  VARCHAR(30),
  col8  VARCHAR(30),
  col9  VARCHAR(30),
  col10 VARCHAR(30),
  col11 VARCHAR(30),
  col12 VARCHAR(30),
  col13 VARCHAR(30),
  col14 VARCHAR(30),
  col15 VARCHAR(30),
  col16 VARCHAR(30),
  col17 VARCHAR(30),
  col18 VARCHAR(30),
  col19 VARCHAR(30),
  col20 VARCHAR(30),
  col21 VARCHAR(30),
  col22 VARCHAR(30),
  col23 VARCHAR(30),
  col24 VARCHAR(30),
  col25 VARCHAR(30),
  col26 VARCHAR(30),
  col27 VARCHAR(30),
  col28 VARCHAR(30),
  col29 VARCHAR(30)
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;

# 工资数据
CREATE TABLE gz_data (
  id    INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  gtime CHAR(6) NOT NULL,
  col0  VARCHAR(80),
  col1  VARCHAR(30),
  col2  VARCHAR(30),
  col3  VARCHAR(30),
  col4  VARCHAR(30),
  col5  VARCHAR(30),
  col6  VARCHAR(30),
  col7  VARCHAR(30),
  col8  VARCHAR(30),
  col9  VARCHAR(30),
  col10 VARCHAR(30),
  col11 VARCHAR(30),
  col12 VARCHAR(30),
  col13 VARCHAR(30),
  col14 VARCHAR(30),
  col15 VARCHAR(30),
  col16 VARCHAR(30),
  col17 VARCHAR(30),
  col18 VARCHAR(30),
  col19 VARCHAR(30),
  col20 VARCHAR(30),
  col21 VARCHAR(30),
  col22 VARCHAR(30),
  col23 VARCHAR(30),
  col24 VARCHAR(30),
  col25 VARCHAR(30),
  col26 VARCHAR(30),
  col27 VARCHAR(30),
  col28 VARCHAR(30),
  col29 VARCHAR(30)
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;

# 保存表单列数
CREATE TABLE gz_num (
  id    INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  gtime CHAR(6)    NOT NULL,
  num   TINYINT(3) NOT NULL
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;

# 保存用户登录时间
CREATE TABLE gz_time (
  id        INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  userName  VARCHAR(80) NOT NULL,
  realName  CHAR(20)    NOT NULL,
  loginTime INT(10)     NOT NULL
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;

#每月登录次数
#2018年1月31日修改lnum类型为int
CREATE TABLE gz_lnum (
  id       INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  gtime    CHAR(6) NOT NULL,
  lnum     INT     NOT NULL             DEFAULT 0,
  lastTime INT(10) NOT NULL
)
  ENGINE = MyISAM
  DEFAULT CHARACTER SET = utf8;





