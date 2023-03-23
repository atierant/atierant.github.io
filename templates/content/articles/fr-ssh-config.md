---
title: "Gérer de nombreuses clés avec SSH Config"
publishedAt: "2019-11-25"
description: Gérer de nombreuses clés avec SSH Config
tags: [Git, SSH]
image: "/public/build/images/articles/ssh.jpg"
category: "development"
tableOfContent: 5
lang: "fr"
---

## Gérer de nombreuses clés avec SSH Config

### Clés SSH ED25519

En suivant les bonnes pratiques, vous devriez toujours privilégier les clés SSH ED25519, 
elles sont plus sécurisées et ont de meilleures performances par rapport aux autres types. 
Les clés SSH ED25519 ont été introduites dans OpenSSH 6.5, 
donc tout système d'exploitation moderne devrait inclure l'option de les créer.

### Gérer une nouvelle paire de clés SSH

#### Générer une nouvelle paire de clés SSH ED25519

[source](https://gitlab.com/help/ssh/README.md)
````bash
$ ssh-keygen -t ed25519 -C "email@example.com"
````

#### Ajouter une clé SSH à votre compte

##### WSL / GNU/Linux (nécessite le package xclip)

````bash
$ xclip -sel clip < ~/.ssh/id_ed25519.pub
````

##### Git Bash on Windows

````bash
$ cat ~/.ssh/id_ed25519.pub | clip
````

##### Collez-le dans l'espace de gestion des clés SSH de votre gestionnaire de versions

#### Gérer le fichier de configuration pour plusieurs clés

Ouvrez un terminal et utilisez les commandes suivantes
(en remplaçant other_id_rsa par votre clé SSH privée) :

````bash
$ eval $(ssh-agent -s)
$ ssh-add ~/.ssh/other_id_rsa
````

Pour conserver ces paramètres, vous devez les enregistrer dans un fichier de configuration.
Pour les clients OpenSSH, ceci est configuré dans le fichier `~/.ssh/config`. Dans ce
fichier, vous pouvez configurer des configurations pour plusieurs hôtes, comme GitLab.com, votre
propre instance GitLab, GitHub, Bitbucket, etc.

Vous trouverez ci-dessous deux exemples de configurations d'hôte utilisant leur propre clé SSH :

````bash
# GitLab.com
Host gitlab.com
  Preferredauthentications publickey
  IdentityFile ~/.ssh/gitlab_com_rsa

Host gitlab.company.com
  HostName gitlab.company.com
  User git
  Preferredauthentications publickey
  IdentityFile ~/.ssh/id_ed25519
````

## @see

- [ssh Fichier de configuration du client (/etc/ssh/ssh_config et ~/.ssh/config)](http://www.octetmalin.net/linux/tutoriels/ssh-fichier-etc-ssh_config-configuration-machine-client.php)
- [Manage Many Keys with SSH Config and KeePass](https://blog.wizardsoftheweb.pro/ssh-config-with-keeagent/)
- [How To Configure Custom Connection Options for your SSH Client](https://www.digitalocean.com/community/tutorials/how-to-configure-custom-connection-options-for-your-ssh-client)


