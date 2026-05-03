<?php

class RequestValidator
{
    public function validate(array $data): bool
    {
        return !empty($data['title']);
    }
}