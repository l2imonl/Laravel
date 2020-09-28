<?php

namespace App\Traits;

use App\Models\MyToken;
use App\NewMyToken;
use Illuminate\Support\Str;

trait HasMyTokens{

    /**
     * The access token the user is using for the current request.
     *
     * @var MyToken
     */
    protected $myAccessToken;

    /**
     * Get the access tokens that belong to model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function myTokens()
    {
        return $this->morphMany(MyToken::class, 'tokenable');
    }

    /**
     * Create a new personal access token for the user.
     *
     * @param string $name
     * @return NewMyToken
     */
    public function createMyToken(string $name): NewMyToken
    {
        $token = $this->myTokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
        ]);

        return new NewMyToken($token, $plainTextToken);
    }

    /**
     * Get the current access token for the user.
     */
    public function currentMyToken()
    {
        return $this->myAccessToken;
    }

    /**
     * Set the current access token for the user.
     */
    public function setMyToken($accessToken)
    {
        $this->myAccessToken = $accessToken;

        return $this;
    }

}
