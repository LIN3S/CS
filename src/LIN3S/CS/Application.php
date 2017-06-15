<?php

/*
 * This file is part of the CS library.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\CS;

use LIN3S\CS\Checker\Composer;
use LIN3S\CS\Checker\EsLint;
use LIN3S\CS\Checker\PhpCsFixer;
use LIN3S\CS\Checker\Phpmd;
use LIN3S\CS\Checker\Stylelint;
use LIN3S\CS\Exception\CheckFailException;
use LIN3S\CS\Git\Git;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Application extends BaseApplication
{
    private const APP_NAME = 'LIN3S CS';
    private const APP_VERSION = '0.7.x-dev';

    private $name;
    private $parameters;

    public function __construct()
    {
        parent::__construct(self::APP_NAME, self::APP_VERSION);

        $rootDirectory = realpath(__DIR__ . '/../../../../../../');
        $this->parameters = Yaml::parse(file_get_contents($rootDirectory . '/.lin3s_cs.yml'))['parameters'];
        $this->parameters['root_directory'] = $rootDirectory;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<fg=white;options=bold;bg=red>%s</fg=white;options=bold;bg=red>', $this->name));
        $output->writeln('<info>Fetching files...</info>');
        $files = Git::committedFiles();

        $output->writeln('<info>Check composer</info>');
        Composer::check($files);

        if (in_array('phpcsfixer', $this->parameters['enabled'], true)) {
            $output->writeln('<info>Fixing PHP code style with PHP-CS-Fixer</info>');
            PhpCsFixer::check($files, $this->parameters);
        }

        if (in_array('phpmd', $this->parameters['enabled'], true)) {
            $output->writeln('<info>Checking code mess with PHPMD</info>');
            $phpmdResult = Phpmd::check($files, $this->parameters);
            if (count($phpmdResult) > 0) {
                foreach ($phpmdResult as $error) {
                    $output->writeln($error->output());
                }
                throw new CheckFailException('PHPMD');
            }
        }

        if (in_array('stylelint', $this->parameters['enabled'], true)) {
            $output->writeln('<info>Checking scss files with Stylelint</info>');
            $stylelintResult = Stylelint::check($files, $this->parameters);
            if (count($stylelintResult) > 0) {
                foreach ($stylelintResult as $error) {
                    $output->writeln($error->output());
                }
                throw new CheckFailException('Stylelint', 'Please, execute "npm update -g stylelint');
            }
        }

        if (in_array('eslint', $this->parameters['enabled'], true)) {
            $output->writeln('<info>Checking js files with ESLint</info>');
            $esLintResult = EsLint::check($files, $this->parameters);
            if (count($esLintResult) > 0) {
                foreach ($esLintResult as $error) {
                    $output->writeln($error->output());
                }
                throw new CheckFailException(
                    'ESLint',
                    'Please, execute "npm update -g eslint eslint-plugin-class-property ' .
                    'eslint-plugin-react eslint-plugin-babel babel-eslint"'
                );
            }
        }

        Git::addFiles($files, $this->parameters['root_directory']);
        $output->writeln('<info>Nice commit man!</info>');
    }

    public function parameters()
    {
        return $this->parameters;
    }
}
