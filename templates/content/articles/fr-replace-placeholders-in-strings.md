---
title: "Remplacer des placeholders dans des chaines. PHP"
publishedAt: "2020-09-02"
description: Remplacer des placeholders dans des chaines.
tags: [PHP]
image: "/public/build/images/articles/search_and_replace.jpg"
category: "development"
authors: [atierant]
lang: "fr"
---

## Remplacement à l'aide de placeholders en php

```php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\Context;

$replaced = strtr("Hi @name. The weather is @weather.", ["@name" => "Arnaud", "@weather" => "cloudy"]);

var_dump(replaced);

```


