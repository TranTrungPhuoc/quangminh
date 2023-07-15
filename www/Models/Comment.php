<?php
namespace App\Models;
use App\Core\Sql;

class Comment extends Sql {

    protected Int $id = 0;
    protected String $title;
    protected String $content;
    protected String $reply;
    protected String $status;
    protected Int $userid;
    protected Int $postid;

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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = trim($content);
    }

    /**
     * @return String
     */
    public function getReply(): string
    {
        return $this->reply;
    }

    /**
     * @param String $reply
     */
    public function setReply(string $reply): void
    {
        $this->reply = trim($reply);
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
     * @return Int
     */
    public function getPostId(): int
    {
        return $this->postid;
    }

    /**
     * @param Int $postid
     */
    public function setPostId(int $postid): void
    {
        $this->postid = $postid;
    }
}