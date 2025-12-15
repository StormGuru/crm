# Mini-CRM

Мини CRM для сбора и обработки заявок.



ФУНКЦИОНАЛЬНОСТЬ

 ВИДЖЕТ:

- страница `/widget`
- Форма обратой связи с AJAX-отправкой
- Поддержка файлов (через spatie/laravel-medialibrary)
- Валидация всех полей
- Ограничение: не более 1 заявки в сутки с одного email или телефона
- Подходит для встраивания через `<iframe>`

 АДМИНИСТРАТИВНАЯ ЧАСТЬ:

- Авторизация пользователей
- Роли: **admin**, **manager**
- Просмотр списка заявок
- Фильтрация по -статусу, дате, емейл клиента, телефону

- Просмотр страницы одной заявки
- Смена статуса заявки

### API

- REST API с  API Resources
- Защита роутов через Sanctum и permissions

---

## Технологии, которые использовались

- PHP 8.4
- Laravel 12
- SQLite
- Laravel Breeze
- spatie/laravel-permission
- spatie/laravel-medialibrary
- Tailwind CSS - на странице виджета
- AJAX (Fetch API)

---

## Установка и запуск

### 1. Клонировать проект

git clone <адрес репозитория>


2. Установить зависимости
composer install, npm install, npm run build


3. Настроить окружение
env.example - .env
php artisan key:generate

4. Запустить миграции и сидеры
php artisan migrate --seed

5. Запустить сервер
php artisan serve


Открыть по адресу:

http://127.0.0.1:8000


Тестовые пользователи

После выполнения сидеров будут следующие аккаунты:

Роль	Email	             Пароль

Admin	admin@example.com
	                     password

Manager	manager@example.com
	                     password

Встраивание виджета:

Пример встраивания
<iframe
  src="http://127.0.0.1:8000/widget"
  width="400"
  height="600"
  style="border:none;"
></iframe>

API:

Создание заявки:
POST /api/tickets


Поля:

name, email, phone , subject, text, файлы(до 10мб);




Статистика заявок
GET /api/tickets/statistics


Доступ:

Только авторизованные пользователи

Роли: admin, manager



Роли и доступы:

ГОСТИ:

Доступ только к /widget и POST /api/tickets


ADMIN/ MANAGER

Доступ к админке

Работа с заявками

Просмотр статистики


ОГРАНИЧЕНИЯ:

Не более одной заявки в сутки с одного email или номера телефона

Ограничение размера файлов — 10 МБ


АРХИТЕКТУРНЫЕ РЕШЕНИЯ:

Контроллеры содержат минимальную логику

Вся бизнес-логика вынесена в сервисы

Валидация выполнена через FormRequest

Работа с ролями реализована через spatie/laravel-permission

Работа с файлами — через spatie/laravel-medialibrary

Статусы заявок реализованы через Enum


