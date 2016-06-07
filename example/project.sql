# mysql 里有null值的字段,索引无效.
CREATE TABLE product (
  id INT NOT NULL primary key auto_increment,
  category_id int unsigned  NOT NULL,
  brand_id int unsigned  NOT NULL,
  name VARCHAR(60)  NOT NULL,
  serial_number VARCHAR(100)  NOT NULL,
  market_price decimal(10, 2) unsigned  NOT NULL,
  shop_price decimal(10, 2) unsigned  NOT NULL,
  stock int unsigned  NOT NULL,
  on_time int unsigned  NOT NULL,
  orginal_image_path VARCHAR(200)  NOT NULL,
  thumbnail_image_path VARCHAR(200)  NOT NULL,
  description text,
  is_best tinyint(1) unsigned  NOT NULL default '0',
  is_new tinyint(1) unsigned  NOT NULL default '1',
  is_hot tinyint(1) unsigned  NOT NULL default '0'
) engine=innodb default charset utf8;
alter table `product` add unique index `name` (`name`);# 数据库限制字段的唯一性, 产品名称不能重复

CREATE TABLE product_category (
  id int unsigned  NOT NULL primary key auto_increment,
  name VARCHAR(20)  NOT NULL,
  parent_id int unsigned  NOT NULL
) engine=innodb default charset utf8;

CREATE TABLE product_brand (
  id INT NOT NULL primary key auto_increment,
  name VARCHAR(20)  NOT NULL,
  image_path varchar(200)  NOT NULL,
  site VARCHAR(200)  NOT NULL default '',
  description varchar(200)  NOT NULL default '',
  display_order INT NOT NULL default 0,
  is_display tinyint(1)  NOT NULL default 1
);
# 提升: 联合索引
alter table `product_brand` add unique index `product_brand` (`name`);


CREATE TABLE product_attribute_category (
  id INT NOT NULL primary key auto_increment,
  name VARCHAR(20)  NOT NULL
) engine=innodb default charset utf8;
alter table `product_attribute_category` add UNIQUE index `name` (`name`);


CREATE TABLE product_attribute (
  id INT NOT NULL primary key auto_increment,
  category_id int UNSIGNED  NOT NULL,
  name VARCHAR(45)  NOT NULL,
  select_type TINYINT(1) UNSIGNED  NOT NULL,
  optional_value TEXT
) engine=innodb default charset utf8;

CREATE TABLE product_attribute_rel (
  id INT NOT NULL primary key auto_increment,
  product_id int UNSIGNED  NOT NULL,
  attribute_id int UNSIGNED  NOT NULL,
  value VARCHAR(60)  NOT NULL
) engine=innodb default charset utf8;


CREATE TABLE user (
  id INT NOT NULL primary key auto_increment,
  username VARCHAR(16) NOT NULL,
  password VARCHAR(20) NOT NULL
) engine=innodb default charset utf8;
ALTER TABLE user ADD UNIQUE INDEX `username` (`username`);

# 业务逻辑转换成数据结构的能力, 数据承担产品需求和程序代码之间的关系