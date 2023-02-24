---
title: "Manage Many Keys with SSH Config"
publishedAt: "2019-11-25"
description: One does not simply manage multiple SSH Keys...
tags: [Git, SSH]
image: "/public/build/images/articles/ssh.jpg"
category: "development"
tableOfContent: 5
---

## Manage Many Keys with SSH Config

### ED25519 SSH keys
Following best practices, you should always favor ED25519 SSH keys, since they are more secure and have better performance over the other types.
ED25519 SSH keys were introduced in OpenSSH 6.5, so any modern OS should include the option to create them.

### Manage a new SSH key pair

#### Generate a new ED25519 SSH key pair

[source](https://gitlab.com/help/ssh/README.md)
````bash
$ ssh-keygen -t ed25519 -C "email@example.com"
````

#### Adding an SSH key to your account

##### WSL / GNU/Linux (requires the xclip package)

````bash
$ xclip -sel clip < ~/.ssh/id_ed25519.pub
````

##### Git Bash on Windows

````bash
$ cat ~/.ssh/id_ed25519.pub | clip
````

##### Paste it on SSH Keys in VCS Manager

#### Manage config file for multiple keys

Open a terminal and use the following commands
(replacing other_id_rsa with your private SSH key):

````bash
$ eval $(ssh-agent -s)
$ ssh-add ~/.ssh/other_id_rsa
````

To retain these settings, you'll need to save them to a configuration file.
For OpenSSH clients this is configured in the `~/.ssh/config` file. In this
file you can set up configurations for multiple hosts, like GitLab.com, your
own GitLab instance, GitHub, Bitbucket, etc.

Below are two example host configurations using their own SSH key:

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


