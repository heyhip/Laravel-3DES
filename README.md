# Laravel 3DES

Laravel 3DES加密解密，和java,ios互通

### 安装方法 ###

```php
composer require YouthAge/Laravel-3DES
```

### 配置方法 ###

app.php 配置如下：

providers中添加

```php
\laraveldes3\Des3Provider::class,
```

aliases中添加

```php
'DES3' => laraveldes3\Des3Facade::class,
```

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

