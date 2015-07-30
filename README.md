# CS
> Flexible and customizable package to automatize all related with coding standards.

## WHY?
This package is created to centralize all the checks style of LIN3S projects, in an easy way to install all the tools
and improving the maintainability.

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
        "LIN3S\\CS\\Composer\\Hooks::createDistFile",
        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "LIN3S\\CS\\Composer\\Hooks::addToProject"
    ]
    "post-install-cmd": [
        "LIN3S\\CS\\Composer\\Hooks::createDistFile",
        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "LIN3S\\CS\\Composer\\Hooks::addToProject"
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
