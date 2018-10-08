<?php

namespace Pluma\Support\Token\Traits;

use Illuminate\Database\Eloquent\Builder;

trait TokenizableTrait
{
    /**
     * The column name of the api token.
     *
     * @var string
     */
    protected $apiTokenColumnName = 'api_token';

    /**
     * Call the tokenize method statically.
     *
     * @param string  $seed
     * @param integer  $length
     * @return  string
     */
    public static function tokenize(string $seed, int $length = 60) : string
    {
        return (new static)->generateApiToken($seed, $length);
    }

    /**
     * Call the tokenize method.
     *
     * @param string  $seed
     * @param integer  $length
     */
    public function setTokenizeAttribute(string $seed, int $length = 60) : void
    {
        $this->{$this->apiTokenColumnName} = $this->generateApiToken($seed, $length);
    }

    /**
     * Alias for the api token column name.
     *
     * @return string
     */
    public function getTokenAttribute() : string
    {
        return $this->{$this->apiTokenColumnName} ?? '';
    }

    /**
     * Generate a unique API key.
     *
     * @param string  $seed
     * @param integer $length
     * @return string
     */
    protected function generateApiToken(string $seed, int $length = 60) : string
    {
        do {
            $salt = base64_encode(
                random_bytes(32) . sha1(time() . mt_rand() . $seed)
            );
            $key = substr($salt, 0, $length);
        } while ($this->where($this->apiTokenColumnName, $key)->exists());

        return $key;
    }
}
