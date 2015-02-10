[![Build Status](https://travis-ci.org/cordoval/hangman-tdd.svg?branch=master)](https://travis-ci.org/cordoval/hangman-tdd)
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

How it looks:

<img src="https://cloud.githubusercontent.com/assets/328359/6115373/2bfc8dcc-b073-11e4-82ac-f3a802b5037b.png" alt="demo"  width="400px"/>

From Exodus 9:14-16 (ESV):

 > For this time I will send all my plagues on you yourself, and on your servants and your people,
 > so that you may know that there is none like me in all the earth. For by now I could have put
 > out my hand and struck you and your people with pestilence, and you would have been cut off from
 > the earth. But for this purpose I have raised you up, to show you my power, so that my name may
 > be proclaimed in all the earth.
