class Task {

-Переход задания в другой статус;
-Вывод списка доступных действий пользователя;

  Зависимые процессы:
-Завершение задания(Сменить статус задания на «Завершено»)
-Публикация нового задания
-Старт задания(Сменить статус задания: «На исполнении»)
-Отказ от задания(Отказ меняет статус задания на «Провалено».)
-Отмена задания(Статус задания меняется на «Отменено»)
-Завершение задания(Сохранить новый отклик, в котором текст комментария и значение оценки)
}

class User {
обрабатывает данные пользователя, назначает роли

  Зависимые процессы:
-Старт задания(Назначить автора отклика исполнителем этого задания)
-Регистрация нового аккаунта(Обрабатывает данные из формы)
-Аутентификация на сайте(Залогинить пользователя)
}

class Response {
создает/отменяет отклики работников на задачи

  Зависимые процессы:
-Добавление отклика(Добавить отклик в таблицу откликов с привязкой к заданию)
}

Review: формирует отзывы заказчиков, рейтинг

City: добавляет, выводит, отображает новое местоположение
