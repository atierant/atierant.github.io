---
title: "Comparer deux chaines en ignorant les accents. PHP"
description: Pas si simple de comparer deux chaînes accentuées...
publishedAt: "2019-11-05"
lastModified: ~
tableOfContent: 2
image: "/public/build/images/logo/php.png"
category: "development"
authors: ["atierant"]
tags: [PHP]
lang: "fr"
---

## Convertir les accents en leurs homologues non accentués, puis comparer les chaînes.

````php
$removeAccents = function (string $string) {
    return strtolower(
        trim(
            preg_replace(
                '~[^0-9a-z]+~i',
                '-',
                preg_replace(
                    '~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i',
                    '$1',
                    htmlentities($string, ENT_QUOTES, 'UTF-8')
                )
            ),
            ' '
        )
    );
};
$sentences = [
    'depot',
    'Dépôt',
    'Depôt',
    'Dépot',
    'Depot',
    'credit',
    'Dépôt et créDit',
    'Depôt et credit',
    'Depot et~   CRÉDIT',
];
var_dump(array_map(
    function ($sentence) use ($removeAccents) {
        return $removeAccents($sentence);
    },
    $sentences
));
````

## Résultat

~~~bash
array(9) {
  [0] =>
  string(5) "depot"
  [1] =>
  string(5) "depot"
  [2] =>
  string(5) "depot"
  [3] =>
  string(5) "depot"
  [4] =>
  string(5) "depot"
  [5] =>
  string(6) "credit"
  [6] =>
  string(15) "depot-et-credit"
  [7] =>
  string(15) "depot-et-credit"
  [8] =>
  string(15) "depot-et-credit"
}
~~~
