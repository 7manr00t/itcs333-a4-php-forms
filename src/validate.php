<?php
declare(strict_types=1);

//  Required: the field must not be empty 
function validate_required(string $v): bool
{
    if (empty(trim($v))) {
        return false;
    }
    return true;
}

//  Email: check the format with a regular expression (preg_match)
// Pattern = something @ something . at least 2 letters  
function validate_email(string $v): bool
{
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (preg_match($pattern, $v)) {
        return true;
    }
    return false;
}

// Length: number of characters must be between min and max
function validate_length(string $v, int $min, int $max): bool
{
    $length = mb_strlen($v);
    if ($length < $min || $length > $max) {
        return false;
    }
    return true;
}

