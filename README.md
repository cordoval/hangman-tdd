[![Build Status](https://travis-ci.org/cordoval/tdd-hangman.png?branch=master)](https://travis-ci.org/cordoval/tdd-hangman)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/cordoval/tdd-hangman/badges/quality-score.png?s=127d28d94969ef366d3bc78808cc89b8eeba51e2)](https://scrutinizer-ci.com/g/cordoval/tdd-hangman/)

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
