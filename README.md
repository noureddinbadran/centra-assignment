<p align="center"><a href="https://studocu.com" target="_blank"><img src="https://d20ohkaloyme4g.cloudfront.net/img/facebook/default-studocu.png" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Centra assignment

This is a simple, read-only, Kanban-board for Github issues. 

# Quick Installation
### Requirements
Composer, PHP 8.1

Download or clone the repository.

```sh
git clone https://github.com/noureddinbadran/centra-assignment.git
```

Change directory
```sh
cd centra-assignment
```

### Copy environment variables
Initialize the env file
```sh
cp .env.example .env
```
Set the following parameters depending on your own account 
```dotenv
GH_CLIENT_ID="YOUR_GITHUB_CLIENT_ID"
GH_CLIENT_SECRET="YOUR_GITHUB_CLIENT_SECRET"
GH_REPOSITORIES="REPOISTORY_NAMES_SEPARATED_BY_|"
GH_ACCOUNT="YOUR_GITHUB_ACCOUNT"

```

Install all laravel dependencies using composer
```sh
composer install
```
This would take a couple of seconds to complete, hang in there

### Laravel sail (Docker)
Let's run the project on our container, the purpose of this step is to setup the app project, production and test database environment conatinerize on a virtual machine for scalabilty.

However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily:

Linux or Mac
```sh
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
Windows
add alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

```sh
C:\Users\<username>\AppData\Local\GitHub\PortableGit_\etc\profile.d\aliases.sh
```

RUN SAIL IN BACKGROUND
```sh
sail up -d
```
This would take a couple minute to install docker images for the first time only, hang in there.


Clear laravel configuration cache
```sh
sail artisan config:cache
```


Go to http://127.0.0.1:8000/ 