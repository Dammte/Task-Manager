<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Enviar el correo de restablecimiento de contraseña
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? response()->json(['message' => '¡El enlace de restablecimiento de contraseña ha sido enviado por correo electrónico!'])
                    : response()->json(['error' => '¡No se pudo enviar el enlace de restablecimiento de contraseña!'], 422);
    }


    protected function broker()
    {
        return Password::broker();
    }
}
