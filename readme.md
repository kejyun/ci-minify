# CodeIgniter Minify v1.0.1

## Installation

> This is built using CI2 packages and you must be using CI2.

1. Upload the `Minify folder` to your `libraries` folder.
2. Upload the `config/minify.php` to your `config` folder.
3. Setting `config/minify.php`

```php
// output path where the compiled files will be stored
$config['assets_dir'] = 'assets/';  

// where to look for css files 
$config['css_dir'] = 'assets/css';

// where to look for js files 
$config['js_dir'] = 'assets/js';
?>
```


## Usage

Below is an overview of different usages:

### Minify and deploy JS file

```php
$this->load->driver('minify');

$files = array('a.js' , 'b.js');
$this->minify->addfile($files);
$script = $this->minify->deploy('app.js');

// <script type="text/javascript" src="http://example.com/assets/app.js?t=1407564151"></script>
echo $script;
```

### Minify and deploy CSS file

```php
$this->load->driver('minify');

$files = array('a.css' , 'b.css');
$this->minify->addfile($files);
$script = $this->minify->deploy('app.css');

// <link href="http://example.com/assets/app.css?t=1407564180" rel="stylesheet" type="text/css">
echo $script;
```

### Minify JS file
```php
$this->load->driver('minify');
$file = 'test/js/test1.js';
echo $this->minify->js->min($file);
```

### Minify CSS file
```php
$this->load->driver('minify');
$file = 'test/css/test1.css';
echo $this->minify->css->min($file);
```

### Minify String
```php
$this->load->driver('minify');
$content = 'body{ padding:0; margin: 0}';
echo $this->minify->css->min($content);
```

### Minify and combine an array of files. Useful if you need files to be in a certain order.
```php
$this->load->driver('minify');
$files = array('test/css/test2.css', 'test/css/test1.css');
echo $this->minify->combine_files($files, [optionalParams]);
```

### Minify and save a physical file
```php
$this->load->driver('minify');
$file = 'test/css/test1.css';
$contents = $this->minify->css->min($file);
$this->minify->save_file($contents, 'test/css/all.css');
```

### Minify an entire directory. The second param is an array of ignored files.
```php
$this->load->driver('minify');
echo $this->minify->combine_directory('test/css/, array('all.css'), [optionalParams]);
```

Optional Params
<pre>
combine_files($files, [type], [compact], [css_charset]);
combine_directory($directory, [ignore], [type], [compact], [css_charset]);
</pre>
Common:
<pre>
[type]: string ('css' or 'js')
[compact] : bool (TRUE, FALSE). TRUE Compact/compress output, FALSE doesn't compress output (only aggregation)
[css_charset] : string (default 'utf-8'). If CSS you can force a starting single charset declaration (when aggregate files)
               due to the charset pre-removal (for stantdars compliance and Webkit bugfix prevention)
               set to null or leave empty if JS.
</pre>
Combine dir:
<pre>
[ignore] : array with files to ignore
</pre>

## Credits
fsencinas - (https://github.com/fsencinas)
JS-Min - (https://github.com/rgrove/jsmin-php)
