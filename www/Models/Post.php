<?php
namespace App\Models;
use App\Core\Sql;

class Post extends Sql {

    protected Int $id = 0;
    protected String $name;
    protected String $slug;
    protected String $image;
    protected String $parents;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param String $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = strtoupper(trim($slug));
    }

    /**
     * @return String
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage(string $image): void
    {
        $this->image = strtoupper(trim($image));
    }

    /**
     * @return String
     */
    public function getParents(): string
    {
        return $this->parents;
    }

    /**
     * @param String $parents
     */
    public function setParents(string $parents): void
    {
        $this->parents = strtoupper(trim($parents));
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