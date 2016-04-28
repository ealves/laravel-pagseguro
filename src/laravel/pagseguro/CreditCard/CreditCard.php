<?php

namespace laravel\pagseguro\CreditCard;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Document\DocumentCollection;
use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * CreditCard Object
 *
 * @category   CreditCard
 * @package    Laravel\PagSeguro\CreditCard
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>, Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2015-01-11
 *
 * @copyright  Laravel\PagSeguro
 */
class CreditCard implements CreditCardInterface
{

    /**
     * Hash
     * @var string
     */
    protected $token;

    /**
     * Name (Nome)
     * @var string
     */
    protected $name;

    /**
     * Phone Number (Telefone)
     * @var PhoneInterface
     */
    protected $phone;

    /**
     * Documents (Lista de Documentos: CPF)
     * @var DocumentCollection
     */
    protected $documents;

    /**
     * Born Date (Data de nascimento)
     * @var string
     */
    protected $bornDate;

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get Name (Nome)
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Phone (Telefone)
     * @return PhoneInterface
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get Documents (Lista de Documentos)
     * @return DocumentCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Get Born Date (Data de Nascimento)
     * @return string
     */
    public function getBornDate()
    {
        return $this->bornDate;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set Name
     * @param string $name
     * @return AddressInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set Phone (Telefone)
     * @param PhoneInterface|array $phone
     * @return AddressInterface
     */
    public function setPhone($phone)
    {
        if (!is_null($phone)) {
            $this->phone = Phone::factory($phone);
        } else {
            $this->phone = null;
        }
        return $this;
    }

    /**
     * Set Documents (Lista de Documentos)
     * @param DocumentCollection|array $documents
     * @return AddressInterface
     */
    public function setDocuments($documents)
    {
        if (is_array($documents)) {
            $documents = DocumentCollection::factory($documents);
        }
        $this->documents = $documents;
        return $this;
    }

    /**
     * Set Born Date (Data de nascimento)
     * @param string $bornDate
     * @return AddressInterface
     */
    public function setBornDate($bornDate)
    {
        $this->bornDate = $bornDate;
        return $this;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
