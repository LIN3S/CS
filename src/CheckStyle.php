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
use LIN3S\CheckStyle\Checker\Phpmd;
use LIN3S\CheckStyle\Exception\CheckFailException;
use LIN3S\CheckStyle\Fetcher\GitFetcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;

class CheckStyle extends Application
{
    const PHP_FILES_IN_SRC = '/^src\/(.*)(\.php)$/';

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
     * The project root path directory.
     *
     * @var string
     */
    protected $rootDirectory;

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
        $this->rootDirectory = null === $rootDirectory ? realpath(__DIR__ . '/../../../../') : $rootDirectory;
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
        $files = GitFetcher::committedFiles();

        $output->writeln('<info>Check composer</info>');
        Composer::check($files);

        $output->writeln('<info>Checking code mess with PHPMD</info>');
        if (count(Phpmd::check($files, $this->rootDirectory)) > 0) {
            throw new CheckFailException('PHPMD');
        }

        $output->writeln('<info>Good job dude!</info>');
    }
}
