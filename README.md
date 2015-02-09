# SunshinePHP 2015 -  Unit Testing PHP Applications

Slides, code examples, and reference materials for my Unit Testing talk at SunshinePHP 2015.

## Requirements

PHP 5.4+ and [Composer](https://getcomposer.org/)

## Instructions

### Initial setup
```
$ git clone git@github.com:michaelmoussa/ssp2015-unit-testing.git
$ cd ./ssp2015-unit-testing
$ composer install --dev
```

### Running tests
```
$ cd /path/to/ssp2015-unit-testing
$ ./vendor/bin/phpunit
```

### Viewing Code Coverage

After running the tests and generating coverage, open `build/code-coverage/index.html` in your browser.

## Jumping Around

The different example sections have been tagged for easy reference. To list them, run:

`$ git tag -l`

Then `git checkout <tag-name>` to see the code relevant to that particular milestone.

**Important Note:** You should run `composer install --dev` after every checkout in case the tag you're looking at
also included an update to its Composer dependencies.

## Links

* **Slides:** [SSP2015-UnitTesting.pdf](SSP2015-UnitTesting.pdf?raw=true)
* **joind.in:** http://joind.in/13437
* **Screencast:** http://youtu.be/EL6vwvYr-D8
