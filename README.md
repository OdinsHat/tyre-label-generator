# Tyre Label Generator

[![Build Status](https://travis-ci.org/OdinsHat/tyre-label-generator.svg?branch=master)](https://travis-ci.org/OdinsHat/tyre-label-generator) [![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause) [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)

# Important

As of May 2021 the EU tyre label format is changing. This is known and development **will** be progressing as fast as possible to implement the changes. Please feel free to submit any PRs or make any suggesstions using the issues facility of Github.

Many thanks for your patience. For the time being you can view details of the changes that are coming in the [following link](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=CELEX:32020R0740) (scroll down to annex 1). You will also find the English documentation in the docs directory where I will also be placing all other EU languages documentation at a later date.

### Background

In the EU tyre labelling went into effect from 1st November 2012. This is a PHP library capable of generating images and HTML/CSS stacked images of EU tyre labels. EU tyre lavbel design hasn't changed since 2012 so this library is still valid as of 2020.

## Example Output

![Example Tyre Label](https://raw.githubusercontent.com/OdinsHat/tyre-label-generator/master/images/tyre-label-ex.png)

_The above was generated (then screenshot) using the genHtmlLabel method of the class_

## Installation

The easiest way is to simply use composer to require the package:

```composer require odinshat/tyre-label-generator```

However, you can choose one of 2 versions dependent on your requirements. 

* The PHP7+ version which is [version 2.0+](https://github.com/OdinsHat/tyre-label-generator/tree/v2.0.0) 
* The PHP5.4-compatible version whose [latest working version was v1.2](https://github.com/OdinsHat/tyre-label-generator/tree/v1.2)

## Testing

Version 2.0+ which is the PHP7 version of the library comes with a full suite of tests which you can run using PHPUnit:

```
git clone git@github.com:OdinsHat/tyre-label-generator.git
cd tyre-label-generator
phpunit tests/
```

You can also run the composer scripts `analyze` and `fix` with the first being the Psalm (PHP-Stan on steroids) 
and the second being PHPCSFixer.

## Usage

There are multiple methods implemented in the class and you can use whichever suits yur needs most.

### 1. HTML Generated Image
This method uses a set of identically sized images and overlays them to create
the required full label type using **inline** CSS to ensure they align on top
of each other. This isn't the recommended way but is by far the easiest to get
going.

E.g.

```php
$tyre = new Tyre('F', 'E', 71, 2);
$label = new Label($tyre);
echo $label->genHtmlLabel();
```

The outputted HTML would look something like this:

```html
<div style="position:relative">
    <img src="/images/label/bg.png" alt="EU tyre Label" style="position:relative; z-index:0;" />
    <img src="/images/label/fuel_f.png" style="position:absolute;z-index:1" />
    <img src="/images/label/wet_e.png" style="position:absolute;z-index:1" />
    <img src="/images/label/db_71.png" style="position:absolute;z-index:1" />
    <img src="/images/label/sw_2.png" style="position:absolute;z-index:1" />
</div>
```

### 2. HTML/CSS Generated Image

This will require you to include the provided CSS file ```tyre-label.css```
somewhere in your page or add its styles to your own.

```php
$tyre = new Tyre('F', 'E', 71, 2);
$label = new Label($tyre, 300, '/imgs');
echo $label->genCssLabel();
```

```html
<div class="tyre-label-container">
    <img src="/images/label/bg.png" alt="EU Tyre Label" class="tyre-label-base" />
    <img src="/images/label/fuel_f.png" class="tyre-label-overlay" />
    <img src="/images/label/wet_e.png" class="tyre-label-overlay" />
    <img src="/images/label/db_71.png" class="tyre-label-overlay" />
    <img src="/images/label/sw_2.png" class="tyre-label-overlay" />
</div>
```

### 3. PNG Generated Image

```php
$tyre = new Tyre('F', 'E', 71, 2,280,"images/");
$label = new Label($tyre, 250); 
$image = $label->genPngLabel();
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
die();
```
