<?php
require_once 'classes/Task.php';

const CLIENT_ID = 1;
const EXECUTOR_ID = 2;

const STATUS = "new";
const ACTION = "cancel";

$strategy = new Task(CLIENT_ID, EXECUTOR_ID, STATUS);
echo 'Статус "' . $strategy->getNextStatus(ACTION) . '",
в который перейдёт класс после выполнения действия "'. ACTION .'"';
echo "<br>","<br>";
echo "Доступные действия для указанного пользователя";
echo "<br>";
var_dump($strategy->getAvailableAction(CLIENT_ID));

echo "<br>","<br>";
echo "метод для возврата «карты» статусов";
echo "<br>";
var_dump(Task::statusMap());
echo "<br>","<br>";
echo "метод для возврата «карты» действий";
echo "<br>";
var_dump(Task::getActionMap());
