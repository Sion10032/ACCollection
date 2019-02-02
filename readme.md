# ACCollection

## 简介

ACCollection是一个基于laravel的项目，该项目主要目的在于解析各个网站的Anime、Comic资源，并为用户提供搜索，收藏更新提醒等功能。\
PS: 该分支为单站点版本，针对 看漫画 的资源，可以看作一个第三方客户端。\
PS2: master分支存在大量Bug，现将该分支作为主分支。

## 功能

### 后台

- [x] 用户注册，登录
- [x] 收藏功能
- [x] 站点资源爬取
    - [x] [看漫画](https://www.manhuagui.com/)
- [ ] 邮件提醒功能

### 前端

- [ ] 主页
- [x] 收藏页面
- [x] 注册、登录页面
- [x] 搜索页面
- [x] 书籍详情页面
- [ ] 漫画阅读器
    - [x] 顶部状态栏
    - [x] 底部状态栏
    - [x] 快捷跳转上/下一章
    - [ ] 设置页面

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

4. 生产 App key 与 jwt密钥
    ```
    php artisan key:generate
    php artisan jwt:secret
    ```


5. 生成数据库表单
    ```
    php artisan migrate
    ```