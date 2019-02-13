<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 14:58
 */

namespace WebAppId\Country\Services\Params;

class AddCountryParam
{
    private $id;
    private $code;
    private $name;
    private $continent;
    private $wikipedia_link;
    private $keywords;
    
    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    
    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return string|null
     */
    public function getContinent(): ?string
    {
        return $this->continent;
    }
    
    /**
     * @param string $continent
     */
    public function setContinent(string $continent): void
    {
        $this->continent = $continent;
    }
    
    /**
     * @return string|null
     */
    public function getWikipediaLink(): ?string
    {
        return $this->wikipedia_link;
    }
    
    /**
     * @param string $wikipedia_link
     */
    public function setWikipediaLink(string $wikipedia_link): void
    {
        $this->wikipedia_link = $wikipedia_link;
    }
    
    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }
    
    /**
     * @param string $keywords
     */
    public function setKeywords(string $keywords): void
    {
        $this->keywords = $keywords;
    }
}