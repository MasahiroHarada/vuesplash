<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;

trait AuthTest
{
    /**
     * @var User
     */
    private $user;

    /**
     * ユーザー登録
     */
    private function createUser()
    {
        $data = $this->userData();

        $this->user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * ダミーデータ
     * @return array
     */
    private function userData(): array
    {
        return [
            'name' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
        ];
    }

    /**
     * 認証情報
     * @return array
     */
    private function credentials(): array
    {
        return array_filter($this->userData(), function ($key) {
            return $key === 'email' || $key === 'password';
        }, ARRAY_FILTER_USE_KEY);
    }
}
