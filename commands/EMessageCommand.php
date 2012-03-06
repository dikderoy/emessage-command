<?php
/**
 * PoPHPCommand class file.
 *
 * @author Olivier M <eliovir@nospam.gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2009 Eliovir
 * @license http://www.yiiframework.com/license/
 */

/**
 * PoPHPCommand converts translated messages from PHP message source files
 * to gettext PO files, and vice.
 *
 * @author Olivier M <eliovir@nospam.gmail.com>
 * @version $Id: $
 * @package system.cli.commands
 * @since 1.0.x
 */
class PoPHPCommand extends CConsoleCommand
{
	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args) {
		if (!isset($args[0]))
			$this->usageError('the conversion target is not specified.');
		if ($args[0] != 'po' && $args[0] != 'php')
			$this->usageError('the conversion target must be "po" or "php".');
		if (!isset($args[1]))
			$this->usageError('the configuration file is not specified.');
		if (!is_file($args[1]))
			$this->usageError("the configuration file {$args[1]} does not exist.");

		$config=require_once($args[1]);
		extract($config);

		if (!isset($messagePath, $languages))
			$this->usageError('The configuration file must specify "messagePath" and "languages".');
		if (!is_dir($messagePath))
			$this->usageError("The message path $messagePath is not a valid directory.");
		if (empty($languages))
			$this->usageError("Languages cannot be empty.");

		$options=array('fileTypes'=>array($args[0]));
		$gettext = new CGettextPoFile;

		$poheader = '# translation of %1$s to %2$s
# Copyright (C) %3$s
# This file is distributed under the same license as the %1$s package.
#
# XXXX <XXXX@nospam.gmail.com>, %3$s.
msgid ""
msgstr ""
"Project-Id-Version: %1$s\n"
"Report-Msgid-Bugs-To: \n"
"POT-Creation-Date: %4$s\n"
"PO-Revision-Date: %4$s\n"
"Last-Translator: \n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"Language-Team: %2$s <translation-team-%2$s@lists.sourceforge.net>\n"
"X-Generator: Yii\n"
"Plural-Forms: nplurals=2; plural=n != 1;\n"

';
		$phpheader=<<<EOD
<?php
/**
 * Message translations.
 *
 * This file is automatically generated by 'yiic message' command.
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 * Messages that no longer need translation will have their translations
 * enclosed between a pair of '@@' marks.
 *
 * NOTE, this file must be saved in UTF-8 encoding.
 *
 * @version \$Id: \$
 */
return 
EOD;
		$year = date('Y');
		$date = date('Y-m-d');

		foreach ($languages as $language) {
			$dir=$messagePath.DIRECTORY_SEPARATOR.$language;
			$origfiles=CFileHelper::findFiles(realpath($dir), $options);
			foreach ($origfiles as $file) {
				if ($args[0] == 'php') {
					$destfile = str_replace('.php', '.po', $file);
					$messages=include($file);
					$gettext->save($destfile, $messages);
					$header = sprintf($poheader, basename($file), $language, $year, $date);
					$polines = file_get_contents($destfile);
					file_put_contents($destfile, $header . $polines);
				} else {
					$destfile = str_replace('.po', '.php', $file);
					//include($file);
					$array = $this->load($file, '');
					$array = str_replace("\r", '', var_export($array, true));
					file_put_contents($destfile, $phpheader . $array . ';');
				}
				echo "$file=>" . ($args[0] == 'php' ? 'po' : 'php') . "\n";
			}
		}
	}
	/**
	 * Loads messages from a PO file.
	 * @param string file path
	 * @return array message translations (source message=>translated message)
	 */
	protected function load($file) {
		$pattern='/msgid\s+"(.*?(?<!\\\\))"'
			. '\s+msgstr\s+"(.*?(?<!\\\\))"/';
		$content=file_get_contents($file);
		$n=preg_match_all($pattern, $content, $matches);
		$messages=array();
		for ($i=0;$i<$n;++$i) {
			$id = $this->decode($matches[1][$i]);
			$message = $this->decode($matches[2][$i]);
			if ($id == '') {
				continue;
			}
	        	$messages[$id]=$message;
	        }
		return $messages;
	}

	/**
	 * Decodes special characters in a message.
	 * @param string message to be decoded
	 * @return string the decoded message
	 */
	protected function decode($string) {
		return str_replace(array('\\"', "\\n", '\\t', '\\r'), array('"', "\n", "\t", "\r"), $string);
	}

	/**
	 * Provides the command description.
	 * @return string the command description.
	 */
	public function getHelp() {
		return <<<EOD
USAGE
	yiic po2php <po|php> <config-file>

DESCRIPTION
	This command converts messages from .php files to gettext .po files,
	and vice.

PARAMETERS
 * <po|php>: required, the filetype to generate: from .po to .php or from
	.php to .po.
 * config-file: required, the path of the configuration file. The file
	must be a valid PHP script which returns an array of name-value pairs.
	Each name-value pair represents a configuration option. The following
	options must be specified:
	- messagePath: string, root directory containing message translations.
	- languages: array, list of language codes that the extracted messages
	 should be translated to. For example, array('zh_cn', 'en_au').

EOD;
	}
}
?>