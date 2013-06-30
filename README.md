yii-less
========

Less is an extension for the [Yii PHP framework](http://www.yiiframework.com) that allows developers to compile [LESS](http://wwwcss.org) files into CSS using the native JavaScript compiler.
LESS can be compiled both client-side using less.js and server-side using lessc. 
Less comes with two compilers, a client compiler that uses less.js and a server compiler that uses lessc.

### Requirements

* [Node.js](http://nodejs.org/download/) and [less](http://lesscss.org/#usage) to use the server-side compiler

### Credits

Thanks to my friend Sam Stenvall (negge) for providing me with his version of the server-side compiler.

## Usage

### Setup

Download the latest version, unzip the extension under ***protected/extensions/less*** and add the desired component (client or server) to your application configuration. 
Below you can find example configurations for both compilers.

Once the component is loaded all specified LESS files will be compiled (as long 
as they have changed or forceCompile is enabled) which makes it a good 
candidate for pre-loading. It is up to you to register 
the generated CSS files in your layout.

#### Client-side

```php
return array(
  'components'=>array(
    .....
    'less'=>array(
      'class'=>'ext.less.components.LessClientCompiler',
      'files'=>array(
        'less/styles.less'=>'css/styles.css',
      ),
    ),
  ),
);
```

#### Server-side

In order to compile your LESS server-side you need to download and install [Node.js](http://nodejs.org/download/). 
When you have installed Node.js use npm (Node Packaged Modules) to install the less module.

```php
return array(
  'components'=>array(
    'less'=>array(
      'class'=>'ext.less.components.LessServerCompiler',
      'files'=>array(
        'less/styles.less'=>'css/styles.css',
      ),
      'nodePath'=>'path/to/node.exe',
      'compilerPath'=>'path/to/lessc',
    ),
  ),
);
```

### Configuration

Below you can find a list of the available configurations (with default values) for each compiler.

#### Client-side

```php
'less'=>array(
  'class'=>'ext.less.components.LessClientCompiler',
  'files'=>array( // files to compile (relative from your base path)
    'less/styles.less'=>'css/styles.css',
  ),
  'env'=>'production', // compiler environment, either production or development
  'async'=>false, // load imports asynchronous?
  'fileAsync'=>false, // load imports asynchronous when in a page under a file protocol
  'poll'=>1000, // when in watch mode, time in ms between polls
  'dumpLineNumbers'=>'mediaQuery', // enables debugging, set to comments, mediaQuery or all
  'watch'=>true, // enable watch mode?
),
```

#### Server-side

```php
'less'=>array(
  'class'=>'ext.less.components.LessServerCompiler',
  'files'=>array( // files to compile (relative from your base path)
    'less/styles.less'=>'css/styles.css',
  ),
  'basePath'=>'path/to/webroot', // base path, defaults to webroot
  'nodePath'=>'path/to/node.exe', // absolute path to nodejs executable
  'compilerPath'=>'path/to/lessc', // absolute path to lessc
  'strictImports'=>false, // force evaluation of imports?
  'compression'=>false, // enable compression, either whitespace or yui
  'optimizationLevel'=>false, // parser optimization level, set to 0, 1 or 2
  'forceCompile'=>false, // compile files on each request?
),
```
