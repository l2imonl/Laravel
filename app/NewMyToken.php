<?php
namespace App;

use App\Models\MyToken;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class NewMyToken implements Arrayable, Jsonable{

    /**
     * The access token instance.
     * @var MyToken
     */
    public $myAccessToken;

    /**
     * The plain text version of the token.
     *
     * @var string
     */
    public $plainTextToken;

    /**
     * Create a new access token result.
     * @param MyToken $accessToken
     * @param string $plainTextToken
     */
    public function __construct(MyToken $accessToken, string $plainTextToken)
    {
        $this->myAccessToken = $accessToken;
        $this->plainTextToken = $plainTextToken;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'accessToken' => $this->myAccessToken,
            'plainTextToken' => $this->plainTextToken,
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

}
