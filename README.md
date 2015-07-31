# LIN3S CS
> The coding standards in the LIN3S way.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/CS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/CS/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/cs/downloads)](https://packagist.org/packages/lin3s/cs)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/cs/v/stable.svg)](https://packagist.org/packages/lin3s/cs)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/cs/v/unstable.svg)](https://packagist.org/packages/lin3s/cs)

## WHY?
This package is created to centralize all the checks style of LIN3S projects, in an easy way to install all the tools
and improving the maintainability. It is a flexible and customizable solution to automatize all related with coding
standards. This library is focused to PHP, Javascript and Sass projects.

## Installation
The recommended and the most suitable way to install is through Composer. Be sure that the tool is installed in your
system and execute the following command:
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
