<?php

namespace Rvslan\Aimon;

use Exception;
use Illuminate\Support\Str;

class ParseApiResponse
{
    protected $response;

    public function __construct(string $response)
    {
        $this->response = $response;
    }

    protected function smsResponseRegex()
    {
        return "/([-+])(\d{1,3})-?(.*)/";
    }

    public function parseSmsResponse()
    {
        $response = [];
        // Get send sms response regex
        $smsResponseRegex = $this->smsResponseRegex();

        preg_match($smsResponseRegex, $this->response, $data);

        try {
            // Get data
            $statusSign = data_get($data, 1);
            $sent = isset($statusSign) && $statusSign == '+';
            $responseCode = data_get($data, 2);
            $responseMessage = data_get($data, 3);

            $response  = [
                'sent' => $sent,
                'response' => (string) Str::of($responseMessage)->trim(),
                'code' => $responseCode,
            ];
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }

        return $response;
    }
}
