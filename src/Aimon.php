<?php

namespace Rvslan\Aimon;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Rvslan\Aimon\Models\SmsLog;

class Aimon
{
    const BASE_URL = 'https://secure.apisms.it/http/';

    public static function sendSms(array $params, $userId = false)
    {
        $client = new Client();
        $method = 'send_sms';

        $to = data_get($params, 'to', null);
        $from = data_get($params, 'from', null);
        $text = data_get($params, 'text', null);

        // Encoding sms body
        $smsText = html_entity_decode(htmlentities($text, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'ISO-8859-1');

        try {
            $result = $client->post(self::BASE_URL . $method, [
                'form_params' => [
                    "sender" => base64_encode($from),
                    "body" => base64_encode($smsText),
                    "destination" => $to,
                    'authlogin' => config('aimon.auth.login') . '@aimon.it',
                    'authpasswd' => config('aimon.auth.password'),
                    'id_api' => config('aimon.auth.api_id'),
                ],
            ]);

            $response = new ParseApiResponse($result->getBody()->getContents());
            $smsResponse = $response->parseSmsResponse();

            if (isset($smsResponse['error'])) {
                Log::error("Error during parsing sms - {$smsResponse['error']}");
                return false;
            }

            if (config('aimon.database.enabled') && $userId) {
                SmsLog::create([
                    'sended' => data_get($smsResponse, 'sended'),
                    'code' => data_get($smsResponse, 'code'),
                    'message' => data_get($smsResponse, 'message'),
                    'user_id' => $userId,
                ]);
            }

            return true;
        } catch (GuzzleException $e) {
            Log::error("Error during calling method {$method} - {$e->getMessage()}");
            return false;
        }
    }
}
