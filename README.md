# LIN3S CS
> The coding standards in the LIN3S way.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/854eee6e-101f-40ca-a3be-fb41b01abcc9/mini.png)](https://insight.sensiolabs.com/projects/854eee6e-101f-40ca-a3be-fb41b01abcc9)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/CS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/CS/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/cs/downloads)](https://packagist.org/packages/lin3s/cs)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/cs/v/stable.svg)](https://packagist.org/packages/lin3s/cs)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/cs/v/unstable.svg)](https://packagist.org/packages/lin3s/cs)

## WHY?
This package is created to centralize all the checks style of LIN3S projects, in an easy way to install all the tools
and improving the maintainability. It is a flexible and customizable solution to automatize all related with coding
standards. This library is focused to PHP, Javascript and Sass projects.

## Prerequisites
[LIN3S][1]'s CS is a PHP console application so, it requires [PHP][2] itself. Apart of it, this project has the
following requirements:

1. [Composer][3]: `curl -sS https://getcomposer.org/installer | php`
2. [Ruby][4]
  * [Scss-lint][5]: `gem install scss-lint`
3. [Node.js][6]
  * [Eslint][7]: `npm install -g eslint`


## Getting started
The recommended and the most suitable way to install is through [Composer][3]. Be sure that the tool is installed in
your system and execute the following command:
```
$ composer require lin3s/cs
```
Then you have to update the `composer.json` with the following code:
```
"scripts": {
    "post-update-cmd": [
        "LIN3S\\CS\\Composer\\Hooks::buildDistFile",
        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "LIN3S\\CS\\Composer\\Hooks::addHooks",
        "LIN3S\\CS\\Composer\\Hooks::symlinkEditorConfig"
    ]
    "post-install-cmd": [
        "LIN3S\\CS\\Composer\\Hooks::buildDistFile",
        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "LIN3S\\CS\\Composer\\Hooks::addHooks",
        "LIN3S\\CS\\Composer\\Hooks::symlinkEditorConfig"
    ]
},
"extra": {
    "incenteev-parameters": {
        "file": ".lin3s_cs.yml",
        "dist-file": ".lin3s_cs.yml.dist"
    }
}
```

> REMEMBER: The `.lin3s_cs.yml` file is generated dynamically with Composer. The best practices recommend that only
track the `.dist` file ignoring the `.lin3s_cs.yml` inside `.gitignore`

## Licensing Options
[![License](https://poser.pugx.org/lin3s/cs/license.svg)](https://github.com/LIN3S/CS/blob/master/LICENSE)

[1]: http://lin3s.com
[2]: http://php.net/
[3]: https://getcomposer.org/
[4]: https://www.ruby-lang.org/en/downloads/
[5]: https://github.com/brigade/scss-lint
[6]: https://nodejs.org/download/
[7]: http://eslint.org/
