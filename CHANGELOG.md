# CHANGELOG

This changelog references the relevant changes done between versions.

To get the diff for a specific change, go to https://github.com/LIN3S/CS/commit/XXX where XXX is the change hash 
To get the diff between two versions, go to https://github.com/LIN3S/CS/compare/v0.6.0...v0.7.0

* 0.7.4
    * Made library compatible with the last requirements around **Symfony Process**.
    * Fixed bug with `.eslintrc.js` and `.stylelintrc.js` files when there are disabled in the `parameters.yml`.
* 0.7.3
    * Made library compatible with Symfony 4.
* 0.7.2
    * Fixed dependencies.
* 0.7.1
    * Removed the `TwigCs` dependency from requirement because it's not compatible with Symfony v4.
    * Made the library compatible with Symfony 4.0.
* 0.7.0
    * Added TwigCS to lint the Twig files.
    * Added installation steps when the ESLint or Stylelint are not installed in the machine.
    * Added JsonParserErrorException to make more human readable the `.eslintrc.js` and `.stylelintrc.js` parser errors.
    * [BC break] Removed output params and made more strict CS Application.
* 0.6.4
    * Fixed `.eslintrc.js` bug related with the invalid json format.
* 0.6.3
    * Fixed `.eslintrc.js` bug related with the invalid json format.
* 0.6.2
    * Fixed rule about "selector-pseudo-element-colon-notation". Now pseudo elements must be with double colon.
    * Improved Readme's prerequisites section.
    * Fixed bug related with the ESLint v4.0 configuration file.
* 0.6.1
    * Disabled `arrow-body-style` rule by default.
* 0.6.0
    * [BC break] Removed scss-lint in favour of Stylelint.
* 0.5.0
    * [BC break] Changed the `.eslint.yml` to `.eslintrc.js` to satisfy the ESLint CS.
    * [BC break] Renamed `scss-lint.yml` according Scss-lint standards.
    * Added support for spec files in the PHP-CS-Fixer.
    * [BC break] Now, PHP-CS-Fixer can execute in standalone way.
    * [BC break] Updated PHP minimum stability to v7.1.
    * [BC break] Moved all the project to the according folder structure.
    * Upgraded the PHPCsFixer to v2.
