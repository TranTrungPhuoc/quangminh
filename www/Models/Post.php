<?php
namespace App\Models;
use App\Core\Sql;

class Post extends Sql {

    protected Int $id = 0;
    protected String $title;
    protected String $slug;
    protected String $description;
    protected String $content;
    protected Int $categoryid = 0;
    protected String $status;
    protected Int $userid;
    // Seo tags
    protected String $canonical;
    protected String $metatitle;
    protected String $metadescription;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
     * @return Int
     */
    public function getCategoryid(): int
    {
        return $this->categoryid;
    }

    /**
     * @param Int $categoryid
     */
    public function setCategoryid(int $categoryid): void
    {
        $this->categoryid = $categoryid;
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

    /**
     * @return string
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**EVENT_MAIN
     * @param int $canonical
     */
    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * @return string
     */
    public function getMetaTitle(): string
    {
        return $this->metatitle;
    }

    /**EVENT_MAIN
     * @param int $metatitle
     */
    public function setMetaTitle(string $metatitle): void
    {
        $this->metatitle = $metatitle;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metadescription;
    }

    /**EVENT_MAIN
     * @param int $metadescription
     */
    public function setMetaDescription(string $metadescription): void
    {
        $this->metadescription = $metadescription;
    }
}