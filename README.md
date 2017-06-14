# LIN3S CS
> The coding standards in the LIN3S way.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/854eee6e-101f-40ca-a3be-fb41b01abcc9/mini.png)](https://insight.sensiolabs.com/projects/854eee6e-101f-40ca-a3be-fb41b01abcc9)
[![Build Status](https://travis-ci.org/LIN3S/CS.svg?branch=master)](https://travis-ci.org/LIN3S/CS)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/CS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/CS/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/cs/downloads)](https://packagist.org/packages/lin3s/cs)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/cs/v/stable.svg)](https://packagist.org/packages/lin3s/cs)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/cs/v/unstable.svg)](https://packagist.org/packages/lin3s/cs)

## WHY?
This package is created to centralize all the checks style of LIN3S projects, in an easy way to install all the tools
and improving the maintainability. It is a flexible and customizable solution to automatize all related with coding
standards. This library is focused to PHP, Javascript and Sass projects.

* Checks if [Composer][3] json has changes, the lock must be committed too.
* Fixes the PHP code with fully customizable [PHP-CS-Fixer][8].
* Checks mess detections with [PHPMD][10].
* Checks the Sass best practices with [Stylelint][5].
* Checks the code quality of Javascript files with [ESLint][7].

> This library is very focused to use as pre-commit hook so, this is the reason of [Git][11] PHP class exists. The
checkers only check the files that they are going to commit, except PHP-CS-Fixer and PHP-Formatter. Apart of the
checking, they fix PHP files so, the command affects to all the files that accomplish the requirements.


## Prerequisites
[LIN3S][1]'s CS is a PHP console application so, it requires [PHP][2] itself. Apart of it, this library has the
following requirements:

1. [Composer][3]
```bash
$ curl -sS https://getcomposer.org/installer | php
```
2. [Node.js][6]
 * [Stylelint][5]
 * [Eslint][7]
```bash
$ npm install -g stylelint
```
```bash
$ npm install -g eslint     # >= v4.0.0
$ npm install -g eslint-plugin-class-property eslint-plugin-react eslint-plugin-babel babel-eslint
```

## Getting started
The recommended and the most suitable way to install is through [Composer][3]. Be sure that the tool is installed in
your system and execute the following command:
```
$ composer require lin3s/cs --dev
```
Then you have to update the `composer.json` with the following code:
```
"scripts": {
    "lin3scs-scripts": [
        "LIN3S\\CS\\Composer\\Hooks::buildDistFile",
        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "LIN3S\\CS\\Composer\\Hooks::addHooks",
        "LIN3S\\CS\\Composer\\Hooks::addFiles"
    ]
},
"extra": {
    "incenteev-parameters": {
        "file": ".lin3s_cs.yml",
        "dist-file": ".lin3s_cs.yml.dist"
    },
    "scripts-dev": {
        "post-install-cmd": [
            "@lin3scs-scripts"
        ],
        "post-update-cmd": [
            "@lin3scs-scripts"
        ]
    }
}
```

> REMEMBER: The `.lin3s_cs.yml` file is generated dynamically with Composer. The best practices recommend that only
track the `.dist` file ignoring the `.lin3s_cs.yml` inside `.gitignore`. In the same way, we recommend that, also,
dynamically generated `.scss-lint.yml`, `.eslint.yml` and `.editorconfig` files, it should be ignored.

## Use ESLint in a React.js environment
In LIN3S are building a lot of projects with React.js so, keeping in mind the simplicity of the configuration process
the following lin3s are our requirements to standardize the JS code inside this environment.

```yml
# .lin3s_cs.yml

parameters:

    # ...

    eslint_rules:
        plugins:
            # ...
            - react
        rules:
            react/display-name: off
            react/forbid-prop-types: off
            react/jsx-boolean-value: off
            react/jsx-closing-bracket-location: off
            react/jsx-curly-spacing: off
            react/jsx-indent-props: off
            react/jsx-max-props-per-line: off
            react/jsx-no-duplicate-props: error
            react/jsx-no-literals: off
            react/jsx-no-undef: error
            jsx-quotes: error
            react/jsx-sort-props: error
            react/jsx-uses-react: error
            react/jsx-uses-vars: error
            react/no-danger: error
            react/no-did-mount-set-state: error
            react/no-did-update-set-state: error
            react/no-direct-mutation-state: error
            react/no-set-state: off
            react/no-unknown-property: error
            react/prop-types: off
            react/react-in-jsx-scope: off
            react/require-extension: off
            react/self-closing-comp: off
            react/sort-comp: off
            react/sort-prop-types: error
            react/wrap-multilines: off
```

## Licensing Options
[![License](https://poser.pugx.org/lin3s/cs/license.svg)](https://github.com/LIN3S/CS/blob/master/LICENSE)

[1]: http://lin3s.com
[2]: http://php.net/
[3]: https://getcomposer.org/
[5]: https://stylelint.io/
[6]: https://nodejs.org/download/
[7]: http://eslint.org/
[8]: http://cs.sensiolabs.org/
[10]: http://phpmd.org/
[11]: https://github.com/LIN3S/CS/blob/master/src/Git/Git.php
