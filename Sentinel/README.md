# PHP-Sentinel
Minimal PHP template engine.

** Sentinel ** let's you seperate your frontend code from your backend code.

It's basic, simple and easy to use.

Installation, Configuration & Setup:

Create a config.php file and setup Sentinel

```php
require_once __DIR__.'/Sentinel/SentinelAutoload.php';

$SentinelConfig = array('binder' => ['{{','}}'], 'dir' => '/path/to/template');

try {

    $Sentinel = new Sentinel\Sentinel($SentinelConfig);
    
} catch(Sentinel\Exception\Config $e) {

    echo $e->getMessage();
}
```

Now, let's create a simple page using Sentinel

index.php
```php
#include config.php
require_once 'config.php';

try {

    #Assign a variable to Sentinel
    $Sentinel
        #Assign a title variable
        ->assign('title', 'Sentinel Demo page')
        
        #Compile and build template
        ->build('index');

} catch (Sentinel\Exception\Build $e) {

    die($e->getMessage());
}
```

In '/path/to/template' directory, create 'index.Sentinel'
```
<!DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
    </head>
    <body>
        Hello!!!
    </body>
</html>
```

## Working with Sentinel

#### Assign variables
Direct assign
```
$Sentinel->assign('title', 'Sentinel');
$Sentinel->assign('description', 'PHP Template System');
```
Multi-Assign
```
$Sentinel->assign([
    'title' => 'Sentinel',
    'description' => 'PHP Template System'
]);
```

#### Comments
Sentinel can be commented
```
{{!-- This is a Sentinel Comment --}}
```
#### Arrays, Object
(Objects are changed to arrays once assigned to Sentinel).
```php
$Sentinel->assign('info', ['title' => 'Sentinel', 'type' => 'Demo']);
```

Then in Sentinel file we can have something like this
```
Hey, this is {{ info[title] }} and we are working on the {{ info[type] }}
```

Looping through arrays
```php
$Sentinel->assign('lists', ['a', 'b', 'c', 'd']);

$Sentinel->assign('data', ['name' => 'Dammy', 'nick' => 'nex', 'age' => '10', 'lang' => 'PHP']);
```
And in Sentinel
```
{{#each $lists as list}}
    {{ list }} <br>
{{/endeach}}

{{#each $data as key,val}}
    {{ key }}: {{ val }}<br>
{{/endeach}}
```
Result:
```
a
b
c
d

name: Dammy
nick: nex
age: 10
lang: PHP
```
You can also utilize the eachelse if the variable you want to loop through isn't an array or is undefined.

```
{{!-- looping through an undefined variable --}}
{{#each $vars as var}}

var is {{ var }}

{{eachelse}}

No vars assigned

{{/endeach}}
```
```
Result: No vars assigned
```

#### Filters
Sentinel variable can be filtered using PHP functions

PHP
```php
$Sentinel->assign('name', 'dammy');
```
Sentinel
```
{{!-- Use filters without args --}}
{{ name | strtoupper }}

{{!-- With args --}}
{{name | substr(0, 3) }}
```

Result:
```
DAMMY

dam
```

Filters can also be used directly inline with strings
```
{{ "Hello World!" | strtoupper }}
```

Result:
```
HELLO WORLD!
```

#### Includes
Sentinel let's you include Sentinel files in '/path/to/template/includes'
Once Sentinel is correctly configured, the includes directory will be automatically created.

Create 'header.Sentinel' in the includes directory

header.Sentinel
```
This is the header file
```

Let's include the header in the 'index.Sentinel' file created earlier
```
{{#include header}}
```
Multiple files can be included, for example, we create a 'nav.Sentinel' file which contains all navigation links

nav.Sentinel
```
<nav>
    <a href="#">Home</a>
    <a href="#">Download</a>
  </nav>
```

Now let's include the header and nav files in the index

index.Sentinel
```
{{#include header,nav}}
```

#### in-template assign
Sentinel now let you assign variables in itself,
For instance, you will be calling the upper case of a variable multiple times,
You can easily re-assign that as another variable in Sentinel

```php
//assign a title var
$Sentinel->assign('title', 'My title goes here');
```

```
{{!-- Assign the capitalized version of title --}}
{{#assign $upperTitle->( {{ title | strtoupper}} ) }}

{{!-- Then you can call {{ upperTitle }} anywhere else --}}

The capitalized title is {{ upperTitle }}
```

#### Conditions
You can also run conditional statements using Sentinel

```
{{#if $title}}

There is a title, which is {{title}}

{{else}}

No title

{{/endif}}
```

You can also use the elseif statement for a bit more complex condition

Note: Very complex condition should be done directly in php before assigned to Sentinel.

```
{{#if $length < 10 }}

Length is less than 10

{{elseif $length == 10}}

Length is equal to 10

{{else}}

Length is not a number

{{/endif}}
```

#### Direct conditions
This is similar to PHP 7's "??"
If the first variable is undefined or null, it returns an alternate assigned value

eg, We create a header file with title as a variable and we want it add a default title if a custom title isn't assigned we can basically do this
```
{{ ($title) ? {{title}} : Default title }}
```

Or shorter
```
{{ $title ?? Default title }}
```
