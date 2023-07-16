<?php
namespace App\Models;
use App\Core\Sql;

class Token extends Sql {

    protected Int $id = 0;
    protected String $token;
    protected String $expirationTime;
    protected String $status='TRUE';
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
    public function setUserid(int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
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
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken(string $token): void
    {
        $this->token = ucwords(strtolower(trim($token)));
    }

    /**
     * @return String
     */
    public function getExpirationTime(): string
    {
        return $this->expirationTime;
    }

    /**
     * @param String $expirationTime
     */
    public function setExpirationTime(string $expirationTime): void
    {
        $this->expirationTime = strtoupper(trim($expirationTime));
    }

    /**
     * @return string
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