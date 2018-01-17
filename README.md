# demo_symfony

semplice progetto realizzato con Symfony 3

### Installing

* clonare il progetto con Git oppure scaricare il file compresso con il progetto.

```bash
$ git clone https://github.com/gemini1981/demo_symfony myProject
$ cd myProject/
```

* eseguire composer --no-interaction

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

**NOTE:** è possibile modificare i parametri per la connessione al database tramite il file di configurazione

```bash
../myProject/app/config/parameters.yml
```

* eseguire il server interno

```bash
$ php bin/console server:run
```

* digitare sulla barra degli indirizzi del browser

http://localhost:8000
