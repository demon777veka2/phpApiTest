# Проект phpApiTest<br>
Программа позволяет авторизированному пользователю получать информацию о отдела, о себе и изменять информацию о себе. Сотрудник может получить информацию с кем он работает, найти пользователя, который работает в его отделе. Также сотрудник имеет такие же права как и пользователь.

## Запуск<br>
Для запуска проекта:
1. создать и подключить базу данных
2. выполнить миграцию в терминале вашей рабочей среды командой: php artisan migrate
3. запустить сервер командой в терминале: php artisan serve
4. Для проверки работы api запросов используйте приложение Postman.

## Api URL<br>
### Авторизация и регистрация<br>
Авторизация(post):
    /api/auth/login<br>
 Поля: email,password
  
Регистрация(post):
     /api/auth/registrations<br>
Поля: name, email, type, github, city, phone, birthday, post_id

Подтверждение восстановления пароля(post):
     /api/auth/restore<br>
Поле: email

Подтверждение восстановления пароля(post):
     /api/auth/restore/confirm<br>
Поле: password

### Для пользователя<br>
Список отделов(get):
    /api/department<br>
 
Посмотреть свою информацию(get):
    /api/user<br>
 
Изменить свою информацию(post):
    /api/user<br>
 Поля: name, email, type, github, city, phone, birthday, post_id
    
### Для Сотрудник<br>
Поиск информации по имени(get):
   /api/workers<br>
Поле: query

Поиск информации о людях по отделу ID(get):
   /api/workers<br>
Поле: department_id

Поиск информации о людях по должности(get):
   /api/workers<br>
Поле: position_id

Поиск информации о людях по id пользователя(get):
   /api/workers/{id}<br>

Список отделов c должностями(get):
    /api/department<br>
    
### Для Админа<br>   
Админ панель(get):
   /admin
    
    
   
   
   
   
   
   
   
   

