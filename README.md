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
        "pre-update-cmd": "LIN3S\\CheckStyle\\Composer\\Hooks::addToProject",
        "pre-install-cmd": "LIN3S\\CheckStyle\\Composer\\Hooks::addToProject"
    },
    "require": {
        "lin3s/check-style": "dev-master"
    }


WIP
---

This is the .checkStyle.yml file:

    project:
        name: Bizkarra
        version: 0.1
    
    phpmd:
        path: src/themes/bizkarra
        rules:
            - controversial
            - unusedcode
            # - codesize
            # - naming
    
    phpFormatter:
        path: src/themes/bizkarra


The idea is to create a command that works like Stof's parameters loader and create dynamically the above file. 
