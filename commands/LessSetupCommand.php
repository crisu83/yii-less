<?php

/**
 * Class file
 * @author    Tobias Munk <schmunk@usrbin.de>
 * @link      http://www.phundament.com/
 * @copyright Copyright &copy; 2005-2011 diemeisterei GmbH
 * @license   http://www.phundament.com/license/
 */

/**
 * LESS compiler update and install command
 * Sets permissions for files and folders from less component config.
 * @author  Tobias Munk <schmunk@usrbin.de>
 * @package commands
 */

class LessSetupCommand extends CConsoleCommand
{

    public function getHelp()
    {
        echo <<<EOS
Sets permissions for files and folders from less component config.
EOS;
    }

    /**
     * Creates data folders
     *
     * @param type $args
     */
    public function run($args)
    {
        $component = Yii::app()->getComponent('less');

        if (!$component) {
            echo "\nWarning: LESS compiler component not found...\n";
            return;
        }
        if (!$component->files) {
            echo "\nNotice: LESS compiler property 'files' is empty...\n";
            return;
        }

        echo "\nChecking output folder(s) and permissions for LESS compiler...\n";
        foreach ($component->files AS $file) {
            $file = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $file;
            $dir  = realpath(dirname($file));
            if (is_dir($dir)) {
                $file = realpath($file);
                @chmod($dir, 0777);
                @chmod($file, 0777);
                echo "\nUpdated permissions in '{$dir}'.\n";
            }
            else {
                if (!empty($dir)) {
                    @mkdir($dir, 0777);
                    @chmod($dir, 0777);
                    echo "\nAdded output folder '{$dir}'.\n";
                }
                else {
                    echo "\nError while updating directory for '{$dir}'...\n";
                }
            }
        }

    }

}

?>