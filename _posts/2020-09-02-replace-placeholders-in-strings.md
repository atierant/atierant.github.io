---
layout: post
title: "Replace placeholders in strings. PHP"
date: 2020-09-02
---

    $replaced = strtr("Hi @name. The weather is @weather.", ["@name" => "Arnaud", "@weather" => "cloudy"]);
    var_dump(replaced);

