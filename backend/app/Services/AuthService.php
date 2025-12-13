<?php

  namespace App\Services;

  use App\Models\User;
  use Illuminate\Support\Facades\Hash;

  class AuthService
  {
    /**
    * Registrar novo usuário
    */
    public function register(array $data): User
    {
      return User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => Hash::make($data['password']),        
      ]);
    }

    /**
    * Validar login
    */
    public function validateLogin(array $data): ?User
    {
      $user = User::where('email', $data['email'])->first();      

      if (!$user) {
        return null;
      }

      if (!Hash::check($data['password'], $user->password)) {
        return null;
      }
      
      return $user;
    }
  }