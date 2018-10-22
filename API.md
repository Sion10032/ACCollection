# API


要求验证的API需要在header中添加
```
'authorization': 'Bearer ' + token
```
可以默认使用
```
{
    'authorization': 'Bearer ' + token,
    'Content-Type': 'application/x-www-form-urlencoded'
}
```
作为header。（PUT请求一定要加上'Content-Type'）

## auth

- POST /api/auth/register \
    Request:
    ```
    {
        'name' : 'name',
        'email' : 'email@email.email',
        'password' : 'password'
    }
    ```
    Response:
    ```
    // 注册成功返回201，失败返回404
    {
        'message' : 'message',
        'status_code' : 201/404,
    }
    ```

- POST /api/auth/login \
    Request:
    ```
    {
        'email' : 'email@email.email',
        'password' : 'password'
    }
    ```
    Response:
    ```
    // 登录成功返回200并且返回token，否则返回401且不返回token
    {
        'token' : 'token',
        'message' : 'message',
        'status_code' : 200/401
    }
    ```

- GET /api/auth/logout (要求验证)\
    Response:
    ```
    {
        'status_code' : 200,
        'message' : 'Logged out Successfully'
    }
    ```

- GET /api/user (要求验证)\
    Response:
    ```
    {
        'status_code' : 200,
        'user_data' : {
            'id': id,
            'name': 'name',
            'email': "email@email.email",
            'created_at': "2018-10-21 14:20:04",
            'updated_at': "2018-10-21 14:20:04"
        }
    }
    ```


## Favorite (要求验证)

- GET /favorites \
    Response:
    ```
    [
        {
            'id': 2,
            'lastChapter': 1,
            'userId': 1,
            'resId': 2
        },
        ...
    ]
    ```

- GET /favorites/{id} \
    Response:
    ```
    {
        'id': 2,
        'lastChapter': 1,
        'userId': 1,
        'resId': 2
    }
    ```

- POST /favorites \
    Request:
    ```
    {
        'url': 'url',
        'name': 'name',
        'lastChapter': lastChapter(int)
    }
    ```
    Response:
    ```
    // 成功返回201，失败返回404
    {
        'message' : 'message',
        'status_code' : 201/404
    }
    ```

- PUT /favorites/{id} \
    Resquest:
    ```
    // 一般传id和lastChapter就行了
    {
        'id': 2,
        'lastChapter': 1,
        'userId': 1,
        'resId': 2
    }
    ```

- DELETE /favorites/{id} \
    Response:
    ```
    {
        'message' : 'message',
        'status_code' : 200
    }
    ```


## Resource

- GET /resources \
    Response:
    ```
    [
        {
            'id': 2,
            'name': 'test',
            'bid': '12312',
            'lastChapter': 8
        },
        ...
    ]
    ```

- GET /resources/{id} \
    Response:
    ```
    {
        'id': 2,
        'name': 'test',
        'bid': '12312',
        'lastChapter': 8
    }
    ```

- POST /resources \
    Request:
    ```
    {
        'name': 'test',
        'bid': '12312',
        'lastChapter': 8
    }
    ```
    Response:
    ```
    // 成功返回201，失败返回404
    {
        'message' : 'message',
        'status_code' : 201/404
    }
    ```

- PUT /resources/{id} \
    Resquest:
    ```
    {
        'id': 2,
        'name': 'test',
        'bid': '12312',
        'lastChapter': 8
    }
    ```

- DELETE /resources/{id} \
    Response:
    ```
    {
        'message' : 'message',
        'status_code' : 200
    }
 

## SMH

封面图片url: 'https://cf.hamreus.com/cpic/b/' + bid + '.jpg'

- GET /api/SMH/search/{name} \
    Response:
    ```
    [
        {
            'name': 'name',
            'bid': 'bid'
        },
        ...
    ]
    ```

- GET /api/SMH/book/{bid} \
    Response:
    ```
    {
        'bid': 'bid',
        'name': 'name',
        'dir': [
            {
                'cateName': 'cateName',
                'menuList': [
                    {
                        'name': '外传10',
                        'cid': '390614',
                        'page': '21'
                    },
                    ...
                ]
            },
            ...
        ]
    }
    ```

- GET /api/SMH/book/{bid}/chapter/{cid} \
    Respoense:
    ```
    {
        'path': 'path',
        'file':[
            'filename', 'filename', ...
        ],
        'parm': 'parm'
    }
    ```
    path + file + parm就是图片地址，需要在header中加上
    ```
    'Referer': 'https://www.manhuagui.com/comic/' + bid + '/' + cid + '.html'
    ```