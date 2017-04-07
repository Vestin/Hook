Hook
----
Hook library
inspired by 
* [ryanhs/hook](https://github.com/ryanhs/hook)
* [Thinkphp Hook](https://github.com/top-think/thinkphp/blob/master/ThinkPHP/Library/Think/Hook.class.php)

Installation
----
```
composer require vestin/hook
```

Example
```DoneTarget
namespace App;
use Vestin\Hook\Target;
class DoneTarget implement Target{
    public function exec(){
        echo 'bye';
    }
}
```
```php
require 'vendor/autoload.php';
use Vestin\Hook\Hook;

Hook::on('init', function(){ echo 'hello'; });
Hook::on('done', 'App\DoneTarget');
/*
 * other code you need
*/
Hook::call('init'); // see 'hello';
Hook::call('done'); // see 'bye';
```

License
----
MIT