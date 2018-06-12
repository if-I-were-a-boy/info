/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/16
 * Time: 上午9:09
 */
/**
用户信息表
*/


CREATE TABLE userInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '主键',
`tel` char(11) not null COMMENT '手机号码',
`push` varchar(50) COMMENT '发表的内推',
`interview` varchar(50) COMMENT '发表的面试经验',
`pic`  varchar(50) COMMENT '个人头像',
`time`  int not null COMMENT '时间戳',
`date`  char(10) not null COMMENT '日期',
`pushsave` varchar(100) COMMENT '内推信息收藏',
`interviewsave` varchar(100) COMMENT '面试经验收藏',
`enable` tinyint not null COMMENT '其他',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户信息表';

／**
资源管理表
*／



CREATE TABLE sourceInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '主键',
`title` varchar(100) not null COMMENT '文章标题',
`time`  int not null COMMENT '时间戳',
`date`  char(10) not null COMMENT '日期',
`text` varchar(50) not null COMMENT '文章的文字详细信息',
`pic`  varchar(50) COMMENT '文章的图片',
`expire` int not null COMMENT '过期的时间',
`from_who` varchar(50) not null COMMENT '来源--发布者',
`detail` varchar(50) not null COMMENT '文章的详细信息url',
`others` varchar(50) COMMENT '备注',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源表';
/**
 * 内推信息表
 */
CREATE TABLE pushInfo (
    `id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '主键',
`title` varchar(100) not null COMMENT '帖子的标题',
`time`  int not null COMMENT '时间戳',
`date`  char(10) not null COMMENT '日期',
`detail` varchar(50) not null COMMENT '帖子的详细信息',
`enable` tinyint not null COMMENT '其他',
`expire` int not null COMMENT '过期的时间',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内推信息表';


CREATE TABLE experInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '主键',
`title` varchar(100) not null COMMENT '帖子的标题',
`time`  int not null COMMENT '时间戳',
`date`  char(10) not null COMMENT '日期',
`detail` varchar(50) not null COMMENT '帖子的详细信息',
`enable` tinyint not null COMMENT '其他',
`expire` int not null COMMENT '过期的时间',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='面试经验表';

CREATE TABLE managerInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '管理员编号',
`time`  int not null COMMENT '注册具体时间',
`date`  char(10) not null COMMENT '注册日期',
`nickname` varchar(30) not null COMMENT '账号',
`pass` char(32) not null COMMENT '密码',
`level` tinyint not null COMMENT '等级',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员信息表';


alter table userInfo add nickname varchar(30)  not null;

CREATE TABLE advertInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '广告编号',
`title` varchar(100) not null COMMENT '广告标题',
`detail` varchar(50) not null COMMENT '广告的详细信息url',
`source` int not null COMMENT '发布人编号',
`type` int not null COMMENT '广告类型',
`pic`  varchar(50) COMMENT '广告logo',
`date`  char(10) not null COMMENT '发布时间日期',
`time`  int not null COMMENT '发布时间具体时间',
`expire` int not null COMMENT '过期的时间',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告信息表';



CREATE TABLE admainInfo (
`id` INT UNSIGNED not null AUTO_INCREMENT COMMENT '管理员id',
`pic`  varchar(50) COMMENT '管理员头像',
`time`  int not null COMMENT '注册的时间时间',
`date`  char(10) not null COMMENT '注册的日期',

`enable` tinyint not null COMMENT '其他',
primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户信息表';

