## 简介

此应用基于ThinkPHP
前台框架使用Bootstrap

## 使用方法

修改 Application\Common\Conf\config.php 

把里面的数据库信息修改为自己的数据库

上传根目录的Cloud-Sms.sql到数据库

如果不需要隐藏URL中index.php，请修改 Application\Common\Conf\config.php 

把里面'URL_MODEL'             =>  '2', 删除即可

需要隐藏的根据环境自己设置需要开启的服务
http://document.thinkphp.cn/manual_3_2.html#url_rewrite

需要添加接口的可以在 Application\Home\Controller\IndexController.class.php 第159行添加给力的接口

部署到服务器之后，监控home/index/cron

希望不要用于非法

## AboutME

初学PHP，代码写的不好...
