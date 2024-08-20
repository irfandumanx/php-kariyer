<?php

function view($fileName, $data = []): void
{
    array_walk($data, function(&$value) {
        if (is_string($value))
            $value = htmlspecialchars($value, encoding: 'UTF-8');
    });
    extract($data);
    require "Views/$fileName.php";
}

function cast($destination, $arr)
{
    if (is_string($destination)) {
        $destination = new $destination();
    }
    $destinationReflection = new ReflectionObject($destination);
    foreach ($arr as $key => $value) {
        if ($destinationReflection->hasProperty($key)) {
            $propDest = $destinationReflection->getProperty($key);
            $propDest->setAccessible(true);
            $propDest->setValue($destination,$value);
        }
    }
    return $destination;
}

function logm($message)
{
    Logger::log(LogLevel::INFO, print_r($message, true));
}

function toPascalCase($string): array|string|null
{
    return preg_replace_callback(
        '/(?:^|_)([a-z])/',
        function ($matches) {
            return strtoupper($matches[1]);
        },
        $string
    );
}

function redirect($url, $statusCode = 302): void
{
    header("Location: $url", response_code: $statusCode);
}


function echoGreen(string $str): void
{ echo "\033[32m$str\033[0m\n"; }

function echoRed(string $str): void
{ echo "\033[31m$str\033[0m\n"; }

function echoNormal(string $str): void
{ echo "$str\n"; }

function reverse_status($task)
{
    echo "STATUS: " . $task->jobHandle() . " - " . $task->taskNumerator() .
        "/" . $task->taskDenominator() . "\n";
}

function reverse_complete($task)
{
    echo "COMPLETE: " . $task->jobHandle() . ", " . $task->data() . "\n";
}

function reverse_fn($job)
{
    echo "Received job: " . $job->handle() . "\n";

    $workload = $job->workload();
    $workload_size = $job->workloadSize();

    echo "Workload: $workload ($workload_size)\n";

    # This status loop is not needed, just showing how it works
    for ($x= 0; $x < $workload_size; $x++)
    {
        echo "Sending status: " . ($x + 1) . "/$workload_size complete\n";
        $job->sendStatus($x+1, $workload_size);
        $job->sendData(substr($workload, $x, 1));
        sleep(1);
    }

    $result= strrev($workload);
    echo "Result: $result\n";

    # Return what we want to send back to the client.
    return $result;
}