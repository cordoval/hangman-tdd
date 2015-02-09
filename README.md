[![Build Status](https://travis-ci.org/cordoval/tdd-hangman.png?branch=master)](https://travis-ci.org/cordoval/tdd-hangman)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cordoval/hangman-tdd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cordoval/hangman-tdd/?branch=master)

Hangman TDD exercise

```bash
HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo chmod +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
export DATABASE_NAME=qandidate
export DATABASE_USER=root
export DATABASE_PASSWORD=test
composer install
php app/console util:sql
```
