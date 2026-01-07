<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Busca o usuário pelo e-mail
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Se já existe, apenas atualiza o google_id
                $user->update(['google_id' => $googleUser->id]);
            } else {
                // Se não existe, cria um novo com senha aleatória
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                ]);
            }

            //  Gera o Token do Sanctum (Seguindo o padrão do seu AuthController)
            $token = $user->createToken('auth_token')->plainTextToken;

            //  Redireciona para o  frontend  passando o token na URL
            // O Vue deve capturar esse token e salvar no localStorage
            $frontendUrl = env('FRONT_END_URL', 'http://localhost:5174');
            return redirect()->away($frontendUrl . "/auth/callback?token={$token}");

        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao autenticar: ' . $e->getMessage()], 401);
        }
    }
}
