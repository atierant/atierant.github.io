---
title: "Replace placeholders in strings. PHP"
publishedAt: "2020-09-02"
description: One does not simply cleanly replace a string in php...
tags: [PHP]
image: "/public/build/images/articles/search_and_replace.jpg"
category: "development"
authors: [atierant]
---

## Remplacement à l'aide de placeholders en php

```php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\Context;

$replaced = strtr("Hi @name. The weather is @weather.", ["@name" => "Arnaud", "@weather" => "cloudy"]);

var_dump(replaced);

```


