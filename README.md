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
echo ConsoleColor::successLine('success !');


```

it will output:
<div style="background-color:black;">
<pre>
<span style="color:white;">Standard</span>
<span style="color:black;background-color:green;">success !</span>
</pre>
</div>

To see all styles run:

    composer self-test-styles

To see all combinations try this:

    composer self-test-all
