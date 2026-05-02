<?php

class InformationRetriever
{
    public function retrieve(string $token): ?array
    {
        try {
            $client = HttpClient::get('https://api.craftingstore.net/v7/information', [
                'headers' => [
                    'token' => $token,
                    'User-Agent' => 'NamelessMC-CraftingStore'
                ]
            ]);

            if ($client->hasError()) {
                Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Information API error: ' . $client->getError());
                return null;
            }

            return $client->json();
        } catch (Exception $e) {
            Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Information API exception: ' . $e->getMessage());
            return null;
        }
    }
}
