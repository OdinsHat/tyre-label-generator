# Tyre Label Generator

### Background

* In the EU tyre labelling went into effect from 1st November 2012.
* A number of sites use varying methods to generate these labels dynamically.
* This class was originally developed by me as an extension of a site I built
  that used the [Yii Framework](http://www.yiiframework.com).
* I abstracted it out of my extended CHtml class into its own class.

## Example Output

![Example Tyre Label](https://raw.githubusercontent.com/OdinsHat/tyre-label-generator/master/tyre-label-ex.png)

_The above was generated (then screenshot) using the genHtmlLabel method of the class_

## Usage

There are multiple methods implemented in the class and you can use whichever suits yur needs most.

### 1. HTML Generated Image
This method uses a set of identically sized images and overlays them to create
the required full label type using **inline** CSS to ensure they align on top
of each other. This isn't the recommended way but is by far the easiest to get
going.

E.g.

```php
$label = new TyreLabel('F', 'E', 71, 2);
echo $label->genHtmlLabel();
```

The outputted HTML would look something like this:

```html
<div style="position:relative">
    <img src="/images/label/bg.png" alt="Label Background" style="position:relative; z-index:0;" />
    <img src="/images/label/fuel_f.png" alt="Fuel" style="position:absolute;z-index:1" />
    <img src="/images/label/wet_e.png" alt="Wet Grip" style="position:absolute;z-index:1" />
    <img src="/images/label/db_71.png" alt="Noise Db" style="position:absolute;z-index:1" />
    <img src="/images/label/sw_2.png" alt="Wet Grip" style="position:absolute;z-index:1" />
</div>
```

### 2. HTML/CSS Generated Image

This will require you to include the provided CSS file ```tyre-label.css```
somewhere in your page or add its styles to your own.

```php
$label = new TyreLabel('F', 'E', 71, 2);
echo $label->genCssLabel();
```

```html
<div class="tyre-label-container">
    <img src="/images/label/bg.png" alt="Label Background" class="tyre-label-base" />
    <img src="/images/label/fuel_f.png" alt="Fuel" class="tyre-label-overlay" />
    <img src="/images/label/wet_e.png" alt="Wet Grip" class="tyre-label-overlay" />
    <img src="/images/label/db_71.png" alt="Noise Db" class="tyre-label-overlay" />
    <img src="/images/label/sw_2.png" alt="Wet Grip" class="tyre-label-overlay" />
</div>
```

