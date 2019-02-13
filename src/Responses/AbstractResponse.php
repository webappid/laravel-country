<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 15:00
 */

namespace WebAppId\Country\Responses;


class AbstractResponse
{
    private $status;
    private $message;
    
    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }
    
    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
    
    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
    
    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    
    
}