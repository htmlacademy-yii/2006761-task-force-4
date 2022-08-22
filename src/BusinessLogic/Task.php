<?php

namespace TaskForce\BusinessLogic;

class Task
{
    public const STATUS_NEW = 'new';
    public const STATUS_AT_WORK = 'at_work';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';

    public const ACTION_START = 'start';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_RESPOND = 'respond';
    public const ACTION_COMPLETE = 'complete';
    public const ACTION_REFUSE = 'refuse';

    public const ACTION_TO_STATUS_MAP = [
        self::ACTION_START => self::STATUS_AT_WORK,
        self::ACTION_CANCEL => self::STATUS_CANCELLED,
        self::ACTION_RESPOND => self::STATUS_NEW,
        self::ACTION_COMPLETE => self::STATUS_COMPLETED,
        self::ACTION_REFUSE => self::STATUS_FAILED
    ];

    private int $clientId;
    private int $executorId;
    private string $status;

    public function __construct (int $clientId, int $executorId, string $status = self::STATUS_NEW) {
        $this->clientId = $clientId;
        $this->executorId = $executorId;
        $this->status = $status;
    }

    //Определяет список из всех доступных действий
    public static function getActionMap(): array {
        return [
            self::ACTION_START => 'стартовать задание',
            self::ACTION_COMPLETE => 'завершить задание',
            self::ACTION_REFUSE => 'отказаться от задания',
            self::ACTION_CANCEL => 'отменить задание',
            self::ACTION_RESPOND => 'откликнуться'
        ];
    }

    //Определяет список из всех доступных статусов
    public static function statusMap(): array {
        return [
            self::STATUS_NEW => 'новое задание',
            self::STATUS_CANCELLED => 'задание отменено',
            self::STATUS_COMPLETED => 'задание завершено',
            self::STATUS_FAILED => 'задание провалено',
            self::STATUS_AT_WORK => 'задание в работе'
        ];
    }

    //Возвращает имя статуса, в который перейдёт задание после выполнения конкретного действия
    public function getNextStatus(string $action): string
    {
        return array_key_exists(
            $action,
            self::ACTION_TO_STATUS_MAP
        ) ? self::ACTION_TO_STATUS_MAP[$action] : throw new Exception("Unknown action $action");
    }

    //Определяет список доступных действий пользователя, у которого уже есть статус
    public function getAvailableAction(int $currentUserId): array
    {
        if ($currentUserId === $this->clientId) {
            if ($this->status === self::STATUS_NEW) {
                return [self::ACTION_START, self::ACTION_CANCEL];
            }
            if ($this->status === self::STATUS_AT_WORK) {
                return [self::ACTION_COMPLETE];
            }
        }
        if ($currentUserId === $this->executorId) {
            if ($this->status === self::STATUS_NEW) {
                return [self::ACTION_RESPOND];
            }
            if ($this->status === self::STATUS_AT_WORK) {
                return [self::ACTION_REFUSE];
            }
        }

        return [];
    }
}
