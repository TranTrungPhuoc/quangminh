<?php
namespace App\Models;
use App\Core\Sql;

class Menu extends Sql {

    protected Int $id = 0;
    protected String $title;
    protected String $link;
    protected String $status;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = ucwords(strtolower(trim($title)));
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
     * @return int
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**EVENT_MAIN
     * @param int $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}