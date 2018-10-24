# ACCollection

## 简介

ACCollection是一个基于laravel的项目，该项目主要目的在于解析各个网站的Anime、Comic资源，并为用户提供搜索，收藏更新提醒等功能。

## 功能

### 后台

- [x] 用户注册，登录
- [x] 收藏功能
- [ ] 站点资源爬取
    - [x] [看漫画](https://www.manhuagui.com/)
    - [ ] [Dilidili](http://www.dilidili.wang/)
    - [ ] ...
- [ ] 邮件提醒功能
- [ ] 多站点支持

### 前端

- [ ] All

## 使用方法

1. 克隆仓库到本地/服务器
    ```
    git clone https://github.com/Sion10032/ACCollection
    ```

2. 安装依赖
    ```
    composer install
    ```

3. 创建配置文件并修改
    ```
    cp .env.example .env
    vi .env
    ```

4. 生成数据库表单
    ```
    php artisan migrate
    ```