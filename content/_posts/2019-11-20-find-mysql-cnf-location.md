---
layout: post
title: "Find the MySQL my.cnf location"
date: 2019-11-20
subtitle: Not so simply to Find the MySQL my.cnf location....
tags: [professional, mysql]
share-img: "/assets/img/logo/mysql.png"
---

## Locate the my.cnf configuration file.

{% highlight bash %}
$ mysqladmin --help
{% endhighlight %}

~~~
Default options are read from the following files in the given order:
/etc/my.cnf
/etc/mysql/my.cnf
/usr/etc/my.cnf
~/.my.cnf
~~~
