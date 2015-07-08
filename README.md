LIN3S CHECK STYLE
==========
> Package that contains all the check styles for LIN3S projects

WHY?
----
This package is created to centralize all the checks style of LIN3S projects, in an easy way to install all the tools
and improving the maintainability.

Installation
------------
The recommended way to install CheckStyle is through Composer. Now, this package does not exist in Packagist so,
to install them, you should copy the code below in your `composer.json` and execute `composer update`:

    "repositories": [
        {
            "type": "vcs",
            "url": "git@gitlab.novisline.es:lin3s/check-style.git"
        }
    ],
    "scripts": {
        "post-update-cmd": [
            "LIN3S\\CheckStyle\\Composer\\Hooks::createDistFile",
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "LIN3S\\CheckStyle\\Composer\\Hooks::addToProject"
        ]
        "post-install-cmd": [
            "LIN3S\\CheckStyle\\Composer\\Hooks::createDistFile",
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "LIN3S\\CheckStyle\\Composer\\Hooks::addToProject"
        ]
    },
    "require": {
        "lin3s/check-style": "dev-master"
    },
    "extra": {
        "incenteev-parameters": {
            "file": ".checkStyle.yml",
            "dist-file": ".checkStyle.yml.dist"
        }
    }

Remember
--------
The `.checkStyle.yml` file is generated dynamically with Composer. The best practices recommend that only track the
`.dist` file ignoring the `.checkStyle.yml` inside `.gitignore`
