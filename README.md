# Hello World

1. Initialize project 
```
$ composer create-project symfony/skeleton otus_project "5.4.*"
```

2. Install symfony cli 
```
$ echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | sudo tee /etc/apt/sources.list.d/symfony-cli.list
$ sudo apt update
$ sudo apt install symfony-cli
```

3. Lunch server 
```
$ symfony serve (START SERVER)
$ symfony stop  (STOP SERVER)
```

4. Install Docker
```
$ sudo apt-get remove docker docker-engine docker.io
$ sudo apt-get update
$ sudo apt install docker.io
$ sudo snap install docker
$ docker --version
$ sudo docker run hello-world
$ sudo docker images
$ sudo docker ps -a
$ sudo docker ps

Lunch  owner project via docker
$ sudo docker-compose up -d
```


5. Configure server nginx via Docker 
```
$ docker-compose up -d
```

6. Install Doctrine ORM
```
$ composer require doctrine/orm
```


7. Install friendsofsymfony/rest-bundle
```
$ composer require friendsofsymfony/rest-bundle
$ composer remove friendsofsymfony/rest-bundle
```

8. Recommend installations
- Code Style
```
- PSR-12 (principes coding)
- Symfony2
  Yoda conditions не стоит использовать!
- Инструменты
    -- squizlabs/php_codesniffer
    -- prettier (npm)
    -- PHPStorm plugin PHP inspections (EA Extended)
    -- psalm
```

- PHP types
```
- strict_types
- Типизация везде, где она возможна. Исключения:
   - Return type hint базовых классов в интерфейсах (неактуально для PHP 7.4+)
   - В прокси-методах, которые вызывают методы библиотек без типизации
- Не использовать mixed без необходимости
```

- PHP Doc
```
- Комментарии нужны
- Отделяем комментарии от аннотаций пустой строкой
- Комментарии по параметрам с указанным тайпхинтом:
   - Если это не array, то можно не добавлять в комментарий
   - Для array добавлять, если это обычный неассоциативный массив
     объектов одного типа.
     @array<string,string> function hello(array $ids) {}
   - Расширенная типизация с использованием psalm
      @psalm-template T
      @psalm-param array<Timestampable&HasId>
```

- Организация файлов
```
- Разбиение кода на бандлы
- Стандартные каталоги:
  - API - клиенты для работы с другими сервисами
  

DTO (Data Transformer Object)
DAO (Data Access Object)
```

- FRONTEND
```
Bundle для работы с webpack
$ composer require symfony/webpack-encore-bundle
$ yarn install

Для работы с sass нужно установить загрузчик
$ yarn add sass-loader@^10.0.0 node-sass@^6.0.0 --dev

Сборка для dev-окружения
$ yarn encore dev

Сборка для dev-окружения + автоматическая пересборка при изменении ассетов
$ yarn encore dev --watch

Сборка для production-окружения
$ yarn encore production

Установить плагины 
$ yarn add bootstrap --dev

В css-файл добавляем
@import "~bootstrap/scss/bootstrap";
```

Install twig bundle
```
$ composer require symfony/twig-bundle
```

```
$ composer require symfony/webpack-encore-bundle

Если работаем с Докер файлом то необходимо добавить следующую строчку
```

Install Doctrine ORM
```
$ composer require doctrine/orm
$ composer require doctrine/doctrine-bundle
$ composer require doctrine/doctrine-migrations-bundle

$ bin/console doctrine:database:create
$ bin/console doctrine:migrations:migrate
```


