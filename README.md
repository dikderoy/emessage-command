# yii-pophpconvertor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html)
[![Total Downloads][ico-downloads]][link-downloads]

This is a fork of the EMessageCommand for Yii 1.x

This command:
- searches for messages to be translated in the specified source files and compiles them into PHP arrays as message source;
- converts messages from `.php` files to gettext `.po` files and vice;
- finds duplicates between all `.php` files;
- shows the translation statistics.

## Install

Via Composer

``` bash
$ composer require dikderoy/yii-pophpconvertor
```

Add the following items for commandMap to your `console.php` config file:

	'commandMap' => array(
		'emessage' => array(
			'class' => '\EMessageCommand',
		),
	),

## Usage

Usage instructions and examples are available
on [official extension page at yiiframework.com](http://www.yiiframework.com/extension/pophpcommand/)

### Actions

#### duplicates
Finds the duplicates between all .php files. The search can be case
insensitive. Run it after a `message` execution, as it searches into the
first language.

	duplicates [--caseSensitive=true] [--config=protected/messages/config.php]

#### message
Searches for messages to be translated in the specified source files

	message [--config=protected/messages/config.php]

#### po
Converts messages from gettext .po files to .php files.

	po [--config=protected/messages/config.php]

#### php
Converts messages from .php files to gettext .po files.

	php [--config=protected/messages/config.php]

#### statistics 
Shows the translation statistics.

	statistics [--config=protected/messages/config.php]

### Configuration File

You can specify the path of the configuration file with `--config=` argument,
default is `protected/messages/config.php`.

The file must be a valid PHP script which returns an array of name-value pairs.

Each name-value pair represents a configuration option. The following options must be specified:

|parameter|description|required|default|
|---------|-----------|--------|-------|
| `sourcePath` | string, root directory of all source files | yes | none | 
| `messagePath` | string, root directory containing message translations. | yes | none |
| `languages` | array, list of language codes that the extracted messages should be translated to. | yes | none |
| `autoMerge` | boolean, overwrite the .php files with the new extracted messages. | no | `false` |
| `launchpad` | boolean, if the .po files must be stored as `protected/messages/launchpad/template/lang.po` or in the same directory of the converted .php file. | no | `false` |
| `skipUnused` | boolean, do not mark unused string with `@@` and skip them | no | `false` |
| `fileTypes` | array, a list of file extensions (e.g. `php`, `xml`) Only the files whose extension name can be found in this list will be processed. If empty, all files will be processed. | yes | none | 
| `exclude` | array, a list of directory and file exclusions. Each exclusion can be either a name or a path. If a file or directory name or path matches the exclusion, it will not be copied. For example, an exclusion of `.svn` will exclude all files and directories whose name is `.svn`. And an exclusion of `/a/b` will exclude file or directory `sourcePath/a/b` | no | `array()` |
| `translator` | the name of the function for translating messages. This is used as a mark to find messages to be translated. | no | `Yii::t` | 

Example (if located at default path `protected/messages/config.php`):

```php
<?php

return array(
	'sourcePath'  => dirname(__DIR__),
	'messagePath' => __DIR__,
	'languages'   => array('da', 'de', 'eo', 'fr', 'it', 'nl', 'pl'),
	'autoMerge'   => true,
	'launchpad'   => true,
	'skipUnused'  => true,
	'fileTypes'   => array('php'),
	'exclude'     => array(
		'.svn',
		'.bzr',
		'/messages',
		'/protected/vendor/'
	),
);
```

## Change log

###### June 21, 2016
- Repackaged for Composer
###### June 4, 2012
- Add check action to check the plural forms.
- Add removeEmptyFiles action to delete the untranslated files.
- Corrections by Motin.

###### January 4, 2012
- Add the caseSensitive option to the duplicates action.
###### December 14, 2011
- Patch on sorting the string by Attila N.
###### November 10, 2010
- Third release with more options, among them : creation of the .po files in a launchpad directory.
###### May 12, 2010
- Second release (renamed to EMessage) with 2 more commands: message and statistics
###### May 23, 2009
- Initial release.

## Contributing

Fork and Pull-Request

## Credits

- [Olivier Maury aka Eliovir](https://github.com/eliovir),
- [Fredrik Wollsén aka Motin](https://github.com/motin),
- [Roman Bulgakov aka dikderoy](https://github.com/dikderoy)

## License

- GNU-GPLv2 License. Please see [License](http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html) for more information.
- GNU-LGPLv3 License for parts. Please see [Licence](http://www.gnu.org/licenses/lgpl-3.0-standalone.html) for more information.

[ico-version]: https://img.shields.io/packagist/v/dikderoy/yii-pophpconvertor.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/dikderoy/yii-pophpconvertor.svg?maxAge=2592000?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dikderoy/yii-pophpconvertor.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/dikderoy/yii-pophpconvertor
[link-downloads]: https://packagist.org/packages/dikderoy/yii-pophpconvertor