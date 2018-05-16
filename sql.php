/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/16
 * Time: 上午9:09
 */
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