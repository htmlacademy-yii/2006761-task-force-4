<?php

require_once 'classes/Task.php';

const CLIENT_ID = 1;
const EXECUTOR_ID = 2;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);

function myAssertHandler($file, $line, $code, $desc = null)
{
    echo "Неудачная проверка утверждения в $file:$line: $code";
    if ($desc) {
        echo ": $desc";
    }
    echo "<br>";
}
assert_options(ASSERT_CALLBACK, 'myAssertHandler');

$strategy1 = new Task(CLIENT_ID, EXECUTOR_ID);

assert($strategy1->getNextStatus(Task::ACTION_START) === Task::STATUS_AT_WORK);
assert($strategy1->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELLED);
assert($strategy1->getNextStatus(Task::ACTION_RESPOND) === Task::STATUS_NEW);
assert($strategy1->getNextStatus(Task::ACTION_COMPLETE) === Task::STATUS_COMPLETED);
assert($strategy1->getNextStatus(Task::ACTION_REFUSE) === Task::STATUS_FAILED);

$strategy2 = new Task(CLIENT_ID, EXECUTOR_ID);

assert($strategy2->getAvailableAction(CLIENT_ID) === [Task::ACTION_START, Task::ACTION_CANCEL]);
assert($strategy2->getAvailableAction(EXECUTOR_ID) === [Task::ACTION_RESPOND]);

$strategy3 = new Task(CLIENT_ID, EXECUTOR_ID, Task::STATUS_AT_WORK);

assert($strategy3->getAvailableAction(CLIENT_ID) === [Task::ACTION_COMPLETE]);
assert($strategy3->getAvailableAction(EXECUTOR_ID) === [Task::ACTION_REFUSE]);

echo "метод для возврата «карты» действий";
echo "<br>";
var_dump(Task::getActionMap());
echo "<br>","<br>";
echo "метод для возврата «карты» статусов";
echo "<br>";
var_dump(Task::statusMap());
