# BLOG

## Aprendendo Symfony 4

### Projeto criado com o comando:
```bash
$ composer create-project symfony/skeleton blog
```

### Rodar aplicação:
```bash
$ php -S localhost:3000 -t public
```
ou 
```bash
$ php bin/console server:run
```

### Cria nova entidade e seu respectivo repositório:
```bash
$ php bin/console make:entity
```

### Cria arquivo de migração:
```bash
$ php bin/console make:migration
```

### Roda a migração:
```bash
$ php bin/console doctrine:migrations:migrate
```

### Cria um formulário
```bash
$ php bin/console make:form
```

### Cria um controller
```bash
$ php bin/console make:controller
```

### Exibe o sql que seria executado no banco para refletir o que tem nas entidades, se rodasse o migration
```bash
$php bin\console doctrine:schema:update --dump-sql
```

