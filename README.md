# demo_symfony

semplice progetto realizzato con Symfony 3

### Installing

* clonare il progetto con Git oppore scaricare il file compresso con il progetto.

```bash
$ git clone https://github.com/gemini1981/demo_symfony myProject
$ cd myProject/
```

* eseguire composeer --no-interaction

```bash
$ composer install
```

* eseguire il comando

```bash
$ php bin/console assets:install
```

* importare il database di esempio

```bash
$ mysql -u <username> -p < symfony.sql
```

* configurare i parametri per la connessione al database nel file:

../myProject/app/config/parameters.yml


* eseguire il server interno

```bash
$ cd symfony_demo/
$ php bin/console server:run
```

* digitare sulla barra degli indirizzi del browser

http://localhost:8000
