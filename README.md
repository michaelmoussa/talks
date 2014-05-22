# SoFloPHP - Unit Testing

Slides, code examples, and reference materials for my SoFloPHP user group talk on Unit Testing in PHP.

## Requirements

PHP 5.4+ and [Composer](https://getcomposer.org/)

## Instructions

### Initial setup
```
$ git clone git@github.com:michaelmoussa/soflophp-unit-testing.git
$ cd ./soflophp-unit-testing
$ composer install --dev
```

### Running tests
```
$ cd /path/to/soflophp-unit-testing/test
$ ../vendor/bin/phpunit .
```

### Running tests with code coverage
```
$ cd /path/to/soflophp-unit-testing/test
$ ../vendor/bin/phpunit --coverage-html=./coverage-html .
```

After generating coverage, open the `index.html` file in your browser.

## Jumping Around

Various presentation milestones have been tagged for easy reference. To list them, run:

`$ git tag -l -n`

Then `git checkout <tag-name>` to see the code relevant to that particular milestone.

**Important Note:** You should run `composer install --dev` after every checkout in case the tag you're looking at
also included an update to `composer.json`.

## Links

* **Slides - Boca Talk:** http://goo.gl/wVdH2M
* **Slides - Miami Talk:** http://goo.gl/xxzUOA
* **joind.in:** http://joind.in/11347
* **Screencast:** https://www.youtube.com/watch?v=NuqkWdekeqE [53:42]
