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

* Checks if [Composer][3] json has changes, the lock must be commited too.
* Fixes the PHP code with fully customizable [PHP-CS-Fixer][8].
* Shorts the use statements and added a proper header inside PHP files with [PHP-Formatter][9].
* Checks mess detections with [PHPMD][10].
* Checks the Sass best practices with [Scss-lint][5].
* Checks the code quality of Javascript files with [ESLint][7].

> This library is very focused to use as pre-commit hook so, this is the reason of [Git][11] PHP class exists. The
checkers only check the files that they are going to commit, except PHP-CS-Fixer and PHP-Formatter. Apart of the
checking, they fix PHP files so, the command affects to all the files that accomplish the requirements.


## Prerequisites
[LIN3S][1]'s CS is a PHP console application so, it requires [PHP][2] itself. Apart of it, this library has the
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
dynamically generated `.scss_lint.yml`, `.eslint.yml` and `.editorconfig` files, it should be ignored.

## Use ESLint in a React.js environment
In LIN3S are building a lot of projects with React.js so, keeping in mind the simplicity of the configuration process
the following lin3s are our requirements to standardize the JS code inside this environment.

But first, you need to install the following dependencies globally:
```bash
$ npm install -g babel-eslint
$ npm install -g eslint-plugin-class-property
$ npm install -g eslint-plugin-react
```

```yml
# .lin3s_cs.yml

parameters:

    (...)

    eslint_rules:
        plugins:
            - react
            - class-property
        ecmaFeatures:
            modules: true
        env:
            es6: true
            browser: true
        parser: babel-eslint
        parserOptions:
            sourceType: module
            ecmaFeatures:
                classes: true
                experimentalObjectRestSpread: true
                jsx: true
                templateStrings: true
        rules:
            react/display-name: 0
            react/forbid-prop-types: 0
            react/jsx-boolean-value: 0
            react/jsx-closing-bracket-location: 0
            react/jsx-curly-spacing: 0
            react/jsx-indent-props: 0
            react/jsx-max-props-per-line: 0
            react/jsx-no-duplicate-props: 2
            react/jsx-no-literals: 0
            react/jsx-no-undef: 2
            jsx-quotes: 2
            react/jsx-sort-props: 2
            react/jsx-uses-react: 2
            react/jsx-uses-vars: 2
            react/no-danger: 2
            react/no-did-mount-set-state: 2
            react/no-did-update-set-state: 2
            react/no-direct-mutation-state: 2
            react/no-set-state: 0
            react/no-unknown-property: 2
            react/prop-types: 0
            react/react-in-jsx-scope: 0
            react/require-extension: 0
            react/self-closing-comp: 0
            react/sort-comp: 0
            react/sort-prop-types: 2
            react/wrap-multilines: 0
```

## Licensing Options
[![License](https://poser.pugx.org/lin3s/cs/license.svg)](https://github.com/LIN3S/CS/blob/master/LICENSE)

[1]: http://lin3s.com
[2]: http://php.net/
[3]: https://getcomposer.org/
[4]: https://www.ruby-lang.org/en/downloads/
[5]: https://github.com/brigade/scss-lint
[6]: https://nodejs.org/download/
[7]: http://eslint.org/
[8]: http://cs.sensiolabs.org/
[9]: https://github.com/mmoreram/php-formatter
[10]: http://phpmd.org/
[11]: https://github.com/LIN3S/CS/blob/master/src/Git/Git.php
