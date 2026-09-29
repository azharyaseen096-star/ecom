<?php

namespace App\Services;

use App\Models\Setting;

class QrCodeService
{
    /**
     * Generate Western Union Pay payload
     */
    public static function getWesternUnionPayload(float|int $amount = 0, string $orderRef = '', string $receiverName = '', string $country = '', string $city = ''): string
    {
        $receiverName = $receiverName ?: Setting::get('wu_receiver_name', 'TINYCHAMPS GLOBAL LTD');
        $country = $country ?: Setting::get('wu_country', 'United States');
        $city = $city ?: Setting::get('wu_city', 'New York');
        $agentCode = Setting::get('wu_agent_code', 'WU-GLOBAL-7789');

        $payload = "WESTERN UNION GLOBAL MONEY TRANSFER\n";
        $payload .= "Receiver Name: {$receiverName}\n";
        $payload .= "Payout Country: {$country}\n";
        $payload .= "Payout City: {$city}\n";
        $payload .= "Agent ID / Code: {$agentCode}\n";
        
        if ($amount > 0) {
            $payload .= "Transfer Amount: $" . number_format($amount, 2) . " USD\n";
        }
        if (!empty($orderRef)) {
            $payload .= "Order / Reference: {$orderRef}\n";
        }
        $payload .= "Instructions: Send money via Western Union App/Agent and enter MTCN code on website.";

        return $payload;
    }

    /**
     * Generate SVG or URL for dynamic QR Code
     */
    public static function generateQrUrl(string $data, int $size = 250): string
    {
        $encodedData = urlencode($data);
        return "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&margin=10&data={$encodedData}";
    }

    /**
     * Generate Western Union dynamic QR code details
     */
    public static function generateWesternUnionQrUrl(float|int $amount = 0, string $orderRef = '', int $size = 250): array
    {
        $receiverName = Setting::get('wu_receiver_name', 'TINYCHAMPS GLOBAL LTD');
        $country = Setting::get('wu_country', 'United States');
        $city = Setting::get('wu_city', 'New York');
        $agentCode = Setting::get('wu_agent_code', 'WU-GLOBAL-7789');
        $phone = Setting::get('wu_phone', '+1 (555) 349-2810');

        $payload = self::getWesternUnionPayload($amount, $orderRef, $receiverName, $country, $city);

        return [
            'type' => 'westernunion',
            'amount' => $amount,
            'formatted_amount' => $amount > 0 ? '$' . number_format($amount, 2) : 'Open Amount',
            'receiver_name' => $receiverName,
            'country' => $country,
            'city' => $city,
            'agent_code' => $agentCode,
            'phone' => $phone,
            'order_ref' => $orderRef,
            'payload' => $payload,
            'qr_image_url' => self::generateQrUrl($payload, $size),
            'deep_link' => "https://www.westernunion.com/us/en/send-money/app/start",
        ];
    }

    /**
     * Generate Bank Transfer QR
     */
    public static function generateBankQrUrl(float|int $amount = 0, string $orderRef = '', int $size = 250): array
    {
        $bankName = Setting::get('bank_name', 'JPMorgan Chase / Global Bank');
        $accountTitle = Setting::get('bank_title', 'TinyChamps KidsWear International');
        $iban = Setting::get('bank_iban', 'US89CHAS00000012345678');
        $swift = Setting::get('bank_swift', 'CHASUS33XXX');

        $payload = "GLOBAL BANK WIRE / SWIFT TRANSFER\nBank: {$bankName}\nTitle: {$accountTitle}\nIBAN/Account: {$iban}\nSWIFT/BIC: {$swift}";
        if ($amount > 0) {
            $payload .= "\nAmount: $" . number_format($amount, 2) . " USD";
        }
        if (!empty($orderRef)) {
            $payload .= "\nReference: {$orderRef}";
        }

        return [
            'type' => 'bank',
            'amount' => $amount,
            'formatted_amount' => $amount > 0 ? '$' . number_format($amount, 2) : 'Open Amount',
            'bank_name' => $bankName,
            'account_title' => $accountTitle,
            'iban' => $iban,
            'swift' => $swift,
            'order_ref' => $orderRef,
            'payload' => $payload,
            'qr_image_url' => self::generateQrUrl($payload, $size),
        ];
    }
}
