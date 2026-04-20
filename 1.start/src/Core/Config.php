<?php
namespace App\Core;
class Config
{
    /**
     * @var array<string, string> $values
     */
    private static array $values = [];
    private static ?self $instance = null;

    public static function
    getValue(
        string $key
    ): string {
        self::init();
        return self::$values[$key] ?? "";
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        self::$values['db_host'] = 'localhost';
        self::$values['db_name'] = 'code_review1';
        self::$values['db_user'] = 'kushal';
        self::$values['db_pass'] = 'pkrb';
    }

    private
    function __clone(): void
    {
    }

    private
    function __wakeup(): void
    {
    }
}