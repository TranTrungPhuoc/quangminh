<?php
namespace App\Models;
use App\Core\Sql;

class Menu extends Sql {

    protected Int $id = 0;
    protected String $name;
    protected String $link;
    protected String $location;
    protected String $topic;
    protected Int $status = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = ucwords(strtolower(trim($name)));
    }

    /**
     * @return String
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param String $link
     */
    public function setLink(string $link): void
    {
        $this->link = strtoupper(trim($link));
    }

    /**
     * @return String
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param String $location
     */
    public function setLocation(string $location): void
    {
        $this->location = strtoupper(trim($location));
    }

    /**
     * @return String
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @param String $topic
     */
    public function setTopic(string $topic): void
    {
        $this->topic = strtolower(trim($topic));
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}