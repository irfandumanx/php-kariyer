<?php

class Logger
{
    public static function log(LogLevel $level, string $message): void
    {
        $logMessage = date('d/m/Y H:i:s') . " - $level->name - $message\n";
        if(!file_exists($level->path())) {
            fopen($level->path(), "a+");
            chmod($level->path(), fileperms($level->path()) | 128 + 16 + 2);
        }
        file_put_contents($level->path(), $logMessage, FILE_APPEND);
    }
}

enum LogLevel
{
    case INFO;
    case WARNING;
    case ERROR;

    public function path(): string
    {
        $baseLoc = "Logs/";
        return match($this)
        {
            LogLevel::INFO => $baseLoc.'info.log',
            LogLevel::WARNING => $baseLoc.'warning.log',
            LogLevel::ERROR => $baseLoc.'error.log',
        };
    }
}
