<?php
/**
 * Less class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 2.0.0
 */

/**
 * LESS component for compiling LESS files either client- or server-side.
 */
class Less extends CApplicationComponent
{
	// Compilation modes.
	const MODE_CLIENT = 'client';
	const MODE_SERVER = 'server';

	// Compiler classes.
	const COMPILER_CLIENT = 'LessClientCompiler';
	const COMPILER_SERVER = 'LessServerCompiler';

	/**
	 * @var string the compilation mode. Valid values are "client" and "server".
	 */
	public $mode = 'client';
	/**
	 * @var array options that should be passed to the compiler.
	 */
	public $options = array();
	/**
	 * @var array a list of files to compile (lessPath => cssPath).
	 */
	public $files = array();

	private $_compiler;

	/**
	 * Initializes the component.
	 */
	public function init()
	{
		Yii::setPathOfAlias('less', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');
		Yii::import('less.components.*');
	}

	/**
	 * Compiles the registered LESS files.
	 */
	public function compile()
	{
		if (!in_array($this->mode, array(self::MODE_CLIENT, self::MODE_SERVER)))
			throw new CException('Failed to compile LESS. Mode must be either "client" or "server".');

		$config = $this->options;
		$config['class'] = $this->mode === self::MODE_SERVER ? self::COMPILER_SERVER : self::COMPILER_CLIENT;
		$config['files'] = $this->files;

		$this->_compiler = Yii::createComponent($config);
		$this->_compiler->run();
	}

	/**
	 * Returns the extension version number.
	 * @return string the version
	 */
	public function getVersion()
	{
		return '2.0.0';
	}
}
