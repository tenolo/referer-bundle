![tenolo](https://tenolo.de/themes/486/img/tenolo_werbeagentur_bochum.png)

[![PHP Version](https://img.shields.io/packagist/php-v/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![Latest Stable Version](https://img.shields.io/packagist/v/tenolo/referer-bundle.svg?label=stable)](https://packagist.org/packages/tenolo/referer-bundle)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/tenolo/referer-bundle.svg?label=unstable)](https://packagist.org/packages/tenolo/referer-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![Total Downloads](https://img.shields.io/packagist/dm/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![License](https://img.shields.io/packagist/l/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)

Referer Bundle
=======================

This bundle helps you to set, store and get custom referer in your twig templates.

Install instructions
--------------------------------

Installing this bundle can be done through these simple steps:

Add the bundle to your project through composer:
```bash
composer require tenolo/referer-bundle
```

If you use an older version of Symfony without Flex you have to add the bundle manually into your Kernel:
```php
<?php

// application/ApplicationKernel.php
public function registerBundles()
{
	// ...
	$bundles = array(
	    // ...
            new Tenolo\Bundle\RefererBundle\TenoloRefererBundle(),
	);
    // ...

    return $bundles;
}
```

Store current URI as referer
--------------------------------

To store the current URI as referer for later use is really simple.  
Just add the `referer_query` filter after the `path` function.

```twig
<a href="{{ path('some_route_name', { param_one: value_one })|referer_query }}">
    Link
</a>
```

When the user clicks on this link, the current URI is saved for later use.

Route to saved referer
--------------------------------

Call the `referer_uri` function to get the referrer URI. 
When the user clicks on the link, it is redirected to the saved referrer and the saved referrer is deleted from memory.
 
```twig
{% if referer_has() %}
    <a href="{{ referer_uri() }}">Zurück</a>
{% endif %}
```
