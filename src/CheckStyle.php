<?php

/*
 * This file is part of the Check Style package.
 *
 * Copyright (c) 2015 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\CheckStyle;

use LIN3S\CheckStyle\Checker\Composer;
use LIN3S\CheckStyle\Checker\PhpFormatter;
use LIN3S\CheckStyle\Checker\Phpmd;
use LIN3S\CheckStyle\Exception\CheckFailException;
use LIN3S\CheckStyle\Git\Git;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class CheckStyle extends Application
{
    /**
     * The input.
     *
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    private $input;

    /**
     * The name of application.
     *
     * @var string
     */
    private $name;

    /**
     * The output.
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    /**
     * Array which contains the different parameters defined inside the .checkStyle.yml
     *
     * @var array
     */
    protected $parameters;

    /**
     * Constructor.
     *
     * @param string|null $name          The name
     * @param string|null $version       The version
     * @param string|null $rootDirectory The root directory
     */
    public function __construct($name = null, $version = null, $rootDirectory = null)
    {
        if (null === $this->name = $name) {
            $this->name = 'LIN3S Check Style';
        }
        if (null === $version) {
            $version = '0.0.1';
        }
        parent::__construct($name, $version);

        $rootDirectory = $rootDirectory ?: realpath(__DIR__ . '/../../../../');
        $this->parameters = Yaml::parse(file_get_contents($rootDirectory . '/.checkStyle.yml'))['parameters'];
        $this->parameters['root_directory'] = $rootDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $output->writeln(sprintf('<fg=white;options=bold;bg=red>%s</fg=white;options=bold;bg=red>', $this->name));
        $output->writeln('<info>Fetching files...</info>');
        $files = Git::committedFiles();

        $output->writeln('<info>Check composer</info>');
        Composer::check($files);

        $output->writeln('<info>Checking uses and license headers with PHP-formatter</info>');
        PHPFormatter::check([], $this->parameters);

        $output->writeln('<info>Checking code mess with PHPMD</info>');
        $phpmdResult = Phpmd::check($files, $this->parameters);
        if (count($phpmdResult) > 0) {
            foreach ($phpmdResult as $error) {
                $output->writeln($error->output());
            }
            throw new CheckFailException('PHPMD');
        }

        Git::addFiles($files, $this->parameters['root_directory']);
        $output->writeln('<info>Nice commit man!</info>');
    }
}
