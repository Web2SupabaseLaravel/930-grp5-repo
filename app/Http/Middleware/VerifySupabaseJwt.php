<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerifySupabaseJwt
{
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized (No Bearer token)'], 401);
        }

        $jwt = substr($authHeader, 7);

        
        $projectId = env('SUPABASE_PROJECT_ID');
        $jwksUrl = "https://$projectId.supabase.co/auth/v1/keys";

        $response = Http::get($jwksUrl);
        if (!$response->ok()) {
            return response()->json(['error' => 'Unable to fetch Supabase public keys'], 500);
        }

        $keys = $response->json()['keys'];


        $tokenHeader = json_decode(base64_decode(explode('.', $jwt)[0]), true);
        $kid = $tokenHeader['kid'] ?? null;

        $keyData = collect($keys)->firstWhere('kid', $kid);
        if (!$keyData) {
            return response()->json(['error' => 'Invalid key ID'], 401);
        }

        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            chunk_split($keyData['x5c'][0], 64, "\n") .
            "-----END PUBLIC KEY-----";

        try {
            $decoded = JWT::decode($jwt, new Key($publicKey, 'RS256'));

            $request->attributes->set('supabase_user', $decoded);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
