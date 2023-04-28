<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Oauth2;
use Illuminate\Http\Request;

class GoogleController extends Controller
{


    public function getClient() {

        $appName = "My Ebag";
        $config = [
            "web" => [
                "client_id" => "6344921916-pvcdln86psogo9q3epk8cqhdba6746ke.apps.googleusercontent.com",
                "project_id" => "my-ebag",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "redirect_uri" => "https://myebag.shop",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_secret" => "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"
            ]
        ];

        try {
            $client = new Client();

            $client->setApplicationName($appName);
            $client->setAuthConfig($config);
            $client->setAccessType('offline');
            $client->setApprovalPrompt('force');
            $client->setRedirectUri("http://localhost:8080");

            $client->setScopes([
                Oauth2::USERINFO_PROFILE,
                Oauth2::USERINFO_EMAIL,
                Oauth2::OPENID,
            ]);

            $client->setIncludeGrantedScopes(true);

            return $client;
        } catch (\Throwable $th) {
            return null;
        }
    }


    public function getAuthUrl() {
        try {
            $client = $this->getClient();

            $authUrl = $client->createAuthUrl();

            return response()->json([
                'code' => 'SUCCESS',
                'url' => $authUrl,
                'message' => 'Authentication url is ready'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 'SERVER_ERROR',
                'message' => $th->getMessage()
            ]);
        }
    }

}
