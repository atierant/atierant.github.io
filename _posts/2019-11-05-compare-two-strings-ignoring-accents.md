---
layout: post
title: "Compare two string and ignore (but not replace) accents. PHP"
date: 2019-11-05
---

    $removeAccents = function ($string) {
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

