<?php

use TaskForce\BusinessLogic\Task;

require_once 'vendor/autoload.php';

const CLIENT_ID = 1;
const EXECUTOR_ID = 2;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);

function my_assert_handler($file, $line, $code, $desc = null)
{
    echo "Неудачная проверка утверждения в $file:$line: $code";
    if ($desc) {
        echo ": $desc";
    }
    echo "\n";
}
assert_options(ASSERT_CALLBACK, 'my_assert_handler');

echo 'Совпадает ли "статус" после конкретного "действия"';
echo "<br>";
$strategy1 = new Task(CLIENT_ID, EXECUTOR_ID);

var_dump(assert($strategy1->getNextStatus(Task::ACTION_START) === Task::STATUS_AT_WORK));
var_dump(assert($strategy1->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELLED));
var_dump(assert($strategy1->getNextStatus(Task::ACTION_RESPOND) === Task::STATUS_NEW));
var_dump(assert($strategy1->getNextStatus(Task::ACTION_COMPLETE) === Task::STATUS_COMPLETED));
var_dump(assert($strategy1->getNextStatus(Task::ACTION_REFUSE) === Task::STATUS_FAILED));
echo "<br>","<br>";

$strategy2 = new Task(CLIENT_ID, EXECUTOR_ID);
echo 'Текущий пользователь - "Заказчик"; статус задания "Новый"';echo "<br>";
var_dump(assert($strategy2->getAvailableAction(CLIENT_ID) === [Task::ACTION_START, Task::ACTION_CANCEL]));
echo "<br>";
echo 'Текущий пользователь - "Исполнитель"; статус задания "Новый"';echo "<br>";
var_dump(assert($strategy2->getAvailableAction(EXECUTOR_ID) === [Task::ACTION_RESPOND]));
echo "<br>","<br>";

$strategy3 = new Task(CLIENT_ID, EXECUTOR_ID, Task::STATUS_AT_WORK);
echo 'Текущий пользователь - "Заказчик"; статус задания "В работе"';echo "<br>";
var_dump(assert($strategy3->getAvailableAction(CLIENT_ID) === [Task::ACTION_COMPLETE]));
echo "<br>";
echo 'Текущий пользователь - "Исполнитель"; статус задания "В работе"';echo "<br>";
var_dump(assert($strategy3->getAvailableAction(EXECUTOR_ID) === [Task::ACTION_REFUSE]));
echo "<br>","<br>";

echo "метод для возврата «карты» действий";
echo "<br>";
var_dump(Task::getActionMap());
echo "<br>","<br>";
echo "метод для возврата «карты» статусов";
echo "<br>";
var_dump(Task::statusMap());
