Behat's popup extension
=======================

[![Build Status](https://travis-ci.org/irs/behat-popup-extension.png?branch=master)](https://travis-ci.org/irs/behat-popup-extension)

The extension adds following step definitions to feature context that allows to test popups: 

```
Given /^(?:|I )press ok on alert$/
Given /^(?:|I )press ok on confirmation$/
Given /^(?:|I )press ok on input popup$/
Given /^(?:|I ) press cancel on confirmation$/
Given /^(?:|I ) press cancel on input popup$/
Given /^(?:|I ) type "([^"]*)" into input popup$/
Given /^the alert message should contain "([^"]*)"$/
Given /^the confirmation message should contain "([^"]*)"$/
Given /^the prompt message should contain "([^"]*)"$/
Given /^the alert message should not contain "([^"]*)"$/
Given /^the confirmation message should not contain "([^"]*)"$/
Given /^the prompt message should not contain "([^"]*)"$/
```

Installation
------------

The simplest way to install the extension it's to add following code to your `composer.json:`

```javascript
{
    "require": {
        "irs/behat-popup-extension": "dev-master"
    }
}

```

After that do `composer install` and add following lines to `behat.yml` to enable extension:

```yaml
default:
  extensions:
    Irs\BehatPopupExtension\Extension: ~
```

Now you can use `Irs\BehatPopupExtension\PopupContext` trait in the feature context.
