<?php
namespace App\Models;
use App\Core\Sql;

class Category extends Sql {

    protected Int $id = 0;
    protected String $title;
    protected String $slug;
    protected String $status;
    protected String $sort;
    protected Int $userid;

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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param String $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = trim($slug);
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

    /**
     * @return int
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**EVENT_MAIN
     * @param int $status
     */
    public function setSort(string $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return Int
     */
    public function getUserId(): int
    {
        return $this->userid;
    }

    /**
     * @param Int $userId
     */
    public function setUserId(int $userid): void
    {
        $this->userid = $userid;
    }
}