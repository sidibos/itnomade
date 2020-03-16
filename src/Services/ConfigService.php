<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: sidibos
 * Date: 15/03/2020
 * Time: 23:53
 */
namespace App\Services;

use App\Entity\Config;
use Doctrine\ORM\EntityManagerInterface;
use App\Contracts\ConfigServiceInterface;

class ConfigService implements ConfigServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(string $name): ?string
    {
        $content = $this->entityManager->getRepository(Config::class)->findOneBy(['name' => $name]);

        return $content ? $content->getValue() : null;
    }
}