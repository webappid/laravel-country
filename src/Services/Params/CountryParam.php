<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 14:58
 */

namespace WebAppId\Country\Services\Params;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CountryParam
 * @package WebAppId\Country\Services\Params
 */
class CountryParam
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $currency_id;
    /**
     * @var string
     */
    private $continent;
    /**
     * @var string
     */
    private $wikipedia_link;
    /**
     * @var string
     */
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
    
    /**
     * @return int
     */
    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }
    
    /**
     * @param int $currency_id
     */
    public function setCurrencyId(int $currency_id): void
    {
        $this->currency_id = $currency_id;
    }
}