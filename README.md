# yii-pophpconvertor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html)
[![Total Downloads][ico-downloads]][link-downloads]

This is a fork of the EMessageCommand for Yii 1.x

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

Usage instructions and examples are available on http://www.yiiframework.com/extension/pophpcommand/

## Change log

#### June 21, 2016
Repackaged for Composer
#### June 4, 2012
Add check action to check the plural forms.
Add removeEmptyFiles action to delete the untranslated files.
Corrections by Motin.
#### January 4, 2012
Add the caseSensitive option to the duplicates action.
#### December 14, 2011
Patch on sorting the string by Attila N.
#### November 10, 2010
Third release with more options, among them : creation of the .po files in a launchpad directory.
#### May 12, 2010
Second release (renamed to EMessage) with 2 more commands: message and statistics
#### May 23, 2009
Initial release.

## Contributing

Fork and Pull-Request

## Credits

- Olivier Maury aka Eliovir,
- [Fredrik Wollsén aka Motin](https://github.com/motin),
- [Roman Bulgakov aka dikderoy](https://github.com/dikderoy)

## License

GNU-GPLv2 License. Please see [License](http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html) for more information.
GNU-LGPLv3 License for parts. Please see [Licence](http://www.gnu.org/licenses/lgpl-3.0-standalone.html) for more information.

[ico-version]: https://img.shields.io/packagist/v/dikderoy/yii-pophpconvertor.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/dikderoy/yii-pophpconvertor.svg?maxAge=2592000?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dikderoy/yii-pophpconvertor.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/dikderoy/yii-pophpconvertor
[link-downloads]: https://packagist.org/packages/dikderoy/yii-pophpconvertor