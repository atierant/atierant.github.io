---
title: "Compare two string and ignore (but not replace) accents. PHP"
description: One does not simply compare two strings...
publishedAt: "2019-11-05"
lastModified: ~
tableOfContent: 2
image: "/public/build/images/logo/php.png"
category: "development"
authors: ["atierant"]
tags: [PHP]
lang: "en"
---

## Convert accents to their non-accented counterpart and then compare strings.

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

## Outputs

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
