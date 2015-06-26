# twig-lare

## How to install twig-lare?

There are just two steps needed to install twig-lare:

1. Add twig-lare to your composer.json:

	```json
	{
        "require": {
            "lare_team/twig_lare": ">=1.0.0",
        }
    }
	```

2. Add Twig_Lare_Extension to the Twig-Engine:

    ```php
    $twig->addExtension(new Twig_Lare_Extension());
	```

## How do i use twig-lare?

Instead of using the `{% extends %}` tag use `{% lare_extends %}`.

```twig
{% lare_extends "::__base.html" 'Previous.Namespace' "::__lare.html"  %}
{% block page %}
...
{% endblock page %}

or

{% lare_extends "::__base.html" 'Lare' %}
{% block page %}
...
{% endblock page %}
```
- The first argument is the template, which is extended if the request is not a Lare request, or the namespace does not match.
- The second argument is the namespace which should be tested against, to decide which template should be extended.
- The third argument is the template, which is extended if the namespace matches. (optional, default is "::__lare.html")

## What do you need for twig-lare?

1. [PHP](http://php.net) >= 5.3.3
2. [twig](https://github.com/twigphp/Twig)
3. [lare.js](https://github.com/lare-team/lare.js)

## Projects using twig-lare

1. [lare.io](https://github.com/iekadou/lare-io)

If you are using twig-lare, please contact me, and tell me in which projects you are using it. Thank you!

Happy speeding up your twig project!

For further information read [twig-lare on iekadou.com](http://www.iekadou.com/programming/twig-lare)
