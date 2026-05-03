<?php

class CategoryRetriever
{
    public function retrieve(string $token): array
    {
        try {
            $client = HttpClient::get('https://api.craftingstore.net/v7/categories', [
                'headers' => [
                    'token' => $token,
                    'User-Agent' => 'NamelessMC-CraftingStore'
                ]
            ]);

            if ($client->hasError()) {
                Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Categories API error: ' . $client->getError());
                return [];
            }

            return $client->json() ?? [];
        } catch (Exception $e) {
            Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Categories API exception: ' . $e->getMessage());
            return [];
        }
    }
}
