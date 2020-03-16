<?php
/**
 * Created by PhpStorm.
 * User: sidibos
 * Date: 15/03/2020
 * Time: 23:55
 */
namespace App\Contracts;

interface ConfigServiceInterface
{
    public function get(string $name): ?string;
}