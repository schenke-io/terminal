# terminal
PHP classes for simple terminal functionality


### ConsoleColor
To install just run:

      composer require schenke-io/console

Just call the static method and 

```php
<?php

use SchenkeIo\Terminal\ConsoleColor;

echo "Standard\n";
echo ConsoleColor::successLine('+ super !');


```

it will output:

```diff
Standard
+ super !
```



To see all styles run:

    composer self-test-styles

To see all combinations try this:

    composer self-test-all
