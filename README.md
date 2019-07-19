[![tenolo](https://content.tenolo.com/tenolo.png)](https://tenolo.de)

[![PHP Version](https://img.shields.io/packagist/php-v/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![Latest Stable Version](https://img.shields.io/packagist/v/tenolo/referer-bundle.svg?label=stable)](https://packagist.org/packages/tenolo/referer-bundle)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/tenolo/referer-bundle.svg?label=unstable)](https://packagist.org/packages/tenolo/referer-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![Total Downloads](https://img.shields.io/packagist/dm/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)
[![License](https://img.shields.io/packagist/l/tenolo/referer-bundle.svg)](https://packagist.org/packages/tenolo/referer-bundle)

# Referer Bundle

Helpful in Twig Templates. Allows you to set a static referer that can be set across multiple page views using the session to get back to a specific page using a Twig function. This can be used to generate a "Back" button.

## Install instructions

First you need to add `tenolo/referer-bundle` to `composer.json`:

Let Composer do it for you.

``` bash
$ composer require tenolo/referer-bundle
```

or do it manually

``` json
{
   "require": {
        "tenolo/referer-bundle": "~1.0"
    }
}
```

Please note that `dev-master` latest development version. 
Of course you can also use an explicit version number, e.g., `1.0.*`.

## Usage

#### To go back to the last page

```twig
{# check for a static referer #}
{% if referer_has() %}
    <a href="{{ referer_uri() }}">Go back</a>
{% endif %}
```

If no static referer was set, the referer from the header of the request is used.


#### To set a static referer.

```twig
<a href="{{ path('route_name_of_next_page', { param: value })|referer_query }}">Next Page</a>
```

The link is manipulated so that the library remembers the current page. If the Twig function "referer_uri" is called on one of the later pages, a link is generated that links back to the current page.