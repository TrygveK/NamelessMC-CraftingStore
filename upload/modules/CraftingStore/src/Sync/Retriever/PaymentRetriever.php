<?php

class PaymentRetriever
{
    public function retrieve(string $token): array
    {
        try {
            $client = HttpClient::get('https://api.craftingstore.net/v7/payments', [
                'headers' => [
                    'token' => $token,
                    'User-Agent' => 'NamelessMC-CraftingStore'
                ]
            ]);

            if ($client->hasError()) {
                Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Payments API error: ' . $client->getError());
                return [];
            }

            return $client->json() ?? [];
        } catch (Exception $e) {
            Log::getInstance()->log(Log::Action('craftingstore/api_error'), 'Payments API exception: ' . $e->getMessage());
            return [];
        }
    }
}
