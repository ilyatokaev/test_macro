### Инструкция по установке:

0) На момент установки на машине уже должен быть установлен Docker
1) Скачать проект (например в виде zip-архива) и распаковать его в 
какой то папке
2) Из корня проекта (там, где лежит docker-compose.yml) в терминале 
запустить команду 

docker-compose up -d

3) Создать в корне проекта папку input_files и положить в нее файлы для импорта
estate.xlsx и estate_update.xlsx
4) Так же находясь в корне проекта в терминале нужно выполнить 
composer install

Если composer на компьютере не установлен, то следует подключиться 
к запущенному контейнеру командой
docker exec -it project_app bash

и уже из терминала \того контейнера выполнить команду
composer install


5) Хост для работы следует использовать localhost:8876
6) Начать рекомендуется с инициализации структуры таблиц БД с помощью
ендпоинта /initdb из любого http-клиента (например, из браузера или postman)
7) Остальные эндпоинты описаны ниже

### Используемые ендпоинты:

/initdb - первоначальное создание таблиц

/etl/extract/excel/seed - Первоначальная загрузка данных из excel-файла

/etl/extract/excel/update - Обновление данных данными из excel-файла

/agencies - Получить список агентств

/contacts - Получить список контактов

/contacts/filter - Поиск контактов по фильтру. В соответствии с ТЗ, 
реализован поиск по агентству. Ожидается GET-параметр agency_id

/managers - Список менеджеров

/managers/filter - Поиск менеджеров по фильтру. Ожидается 
GET-параметр agency_id

/estate - Список объявлений

/estate/filter - Поиск объявлений по фильтру. Тут ожидается либо одиночный параметр
GET-agency_id (т.к. он не является аттрибутом сущности Объявление 
и его применение в сочетании с другими атрибутами нужно отдельно обсуждать),
либо можно использовать пару параметров contact_id и manager_id, вместе или 
по отдельности 


### Комментарии по проекту:
- Доступ к БД из приложения оставил рутовый, т.к. тестовая среда
- Параметры подключения к БД устанавливаются в файле <b><i>app.ini</i></b> в корне проекта
- Для первоначального создания таблиц необходимо использовать ендпоинт
  <b><i>/initdb</i></b>
- Имена входящих импортируемых xlsx-файлов сделал фиксированными в коде,
  для удобства тестирования, но заложил возможность передавать имя файла в
  параметре запроса. Файла по умолчанию берутся из папки input_files
- роутер может работать со всеми типами запросов, но для удобства тестирования
  пока реализовал все роуты в виде GET, сохранением REST-дизайна

- поздно заметил, что один менеджер может работать через 
разные агентства. В итоге спроектировано без учета этого. 
По хорошему надо было делать дополнительную таблицу для организации
связи многие-ко-многим
- Обновления успел сделать только для контактов 
(у него можно менять имя, т.к. идентификация сделана по номеру телефона)
- Первоначальную идентификацию контактов реализовал 
по номеру телефона (чтобы избежать тесок и однофамильцев). 
Причем так же не сразу заметил, что у одного 
контакта может быть несколько телефонов. В принципе, можно было 
распарсить, и сложить телефоны в отдельную таблицу со связью 
с контактом один ко многим. Но тогда нужен какой то другой
уникальный идентификатор контакта
- Телефонные номера регулярками не очищал от нецифровых символов,
но в реальном проекте вероятно был бы смысл
- результаты запросов, на данный момент, возвращаются в json-формате
- Изначально планировал сделать защиту от изменения порядка колонок
в импортируемых excel-файлах, сделал в коде под это соответствующую 
подготовку и оставил на потом. В итоге не уложился по времени и 
не реализовал эту защиту.