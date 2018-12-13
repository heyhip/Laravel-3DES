# Laravel 3DES

Laravel 3DES加密解密，和java,ios互通，使用openssl，必须有openssl扩展

### 安装方法 ###

```php
composer require youthage/laravel-3des
```

### 配置方法 ###

.env 配置加密key和iv,如下

```php
DES3_KEY=ABCDEFGHIJKLMNOPQRSTUVWX
DES3_IV=12345678
```

### 使用方法 ###


```php
<?php

namespace App\Http\Controllers;

use DES3;
class IndexController extends Controller
{
    public function index()
    {
        // 加密
        $encrypt = DES3::encrypt(111);
        echo $encrypt;

        // 解密
        $decrypt = DES3::decrypt($encrypt);
        echo $decrypt;
    }
}

```

