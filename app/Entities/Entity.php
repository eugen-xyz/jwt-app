<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * class Entity
 * @package App\Entities
 */
abstract class Entity
{
    use Timestamps;

    /**
     *
     * The unique ID of this global variable within the database.
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */
    protected $id;

    /**
     * @param string|null $str
     * @return string|null
     */
    protected function castEmptyToNull(?string $str): ?string
    {
        if (empty($str)) {
            return null;
        }

        return $str;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
