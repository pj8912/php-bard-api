<?php

namespace Pj8912\PhpBardApi;

class Bard {
    private $proxies;
    private $timeout;
    private $session;
    private $conversation_id;
    private $response_id;
    private $choice_id;
    private $reqid;
    private $SNlM0e;

    public function __construct($timeout = 6, $proxies = null, $session = null) {
        $this->proxies = $proxies;
        $this->timeout = $timeout;
        $headers = [
            "Host: bard.google.com",
            "X-Same-Domain: 1",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36",
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
            "Origin: https://bard.google.com",
            "Referer: https://bard.google.com/",
        ];
        $this->reqid = (int) rand(pow(10, 3-1), pow(10, 3)-1);
        $this->conversation_id = "";
        $this->response_id = "";
        $this->choice_id = "";

        if ($session === null) {
            $this->session = curl_init();
            curl_setopt($this->session, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($this->session, CURLOPT_COOKIE, "__Secure-1PSID=" . $_ENV["_BARD_API_KEY"]);
            curl_setopt($this->session, CURLOPT_RETURNTRANSFER, true);
        } else {
            $this->session = $session;
        }

        $this->SNlM0e = $this->_get_snim0e();
    }

    private function _get_snim0e() {
        curl_setopt($this->session, CURLOPT_URL, "https://bard.google.com/");
        curl_setopt($this->session, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->session, CURLOPT_PROXY, $this->proxies);
        curl_setopt($this->session, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        curl_setopt($this->session, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->session, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->session, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($this->session);
        if (curl_getinfo($this->session, CURLINFO_HTTP_CODE) !== 200) {
            throw new \Exception("Response Status: " . curl_getinfo($this->session, CURLINFO_HTTP_CODE));
        }
        preg_match('/"SNlM0e":"(.*?)"/', $resp, $matches);
        return $matches[1];
    }

    public function get_answer($input_text) {
        $params = [
            "bl" => "boq_assistant-bard-web-server_20230419.00_p1",
            "_reqid" => (string) $this->reqid,
            "rt" => "c",
        ];
        $input_text_struct = [
            [$input_text],
            null,
            [$this->conversation_id, $this->response_id, $this->choice_id],
        ];
        $data = [
            "f.req" => json_encode([null, json_encode($input_text_struct)]),
            "at" => $this->SNlM0e,
        ];
        curl_setopt($this->session, CURLOPT_URL, "https://bard.google.com/_/BardChatUi/data/assistant.lamda.BardFrontendService/StreamGenerate?" . http_build_query($params));
        curl_setopt($this->session, CURLOPT_POST, true);
        curl_setopt($this->session, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->session, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->session, CURLOPT_PROXY, $this->proxies);
        curl_setopt($this->session, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        curl_setopt($this->session, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->session, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->session, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($this->session);
        $resp_dict = json_decode(explode("\n", $resp)[3], true)[0][2];
        if ($resp_dict === null) {
            return ["content" => "Response Error: " . $resp . "."];
        }
        $parsed_answer = json_decode($resp_dict, true);
        $bard_answer = [
            "content" => $parsed_answer[0][0],
            "conversation_id" => $parsed_answer[1][0],
            "response_id" => $parsed_answer[1][1],
            "factualityQueries" => $parsed_answer[3],
            "textQuery" => $parsed_answer[2][0] ?? "",
            "choices" => array_map(function ($i) {
                return ["id" => $i[0], "content" => $i[1]];
            }, $parsed_answer[4]),
        ];
        $this->conversation_id = $bard_answer["conversation_id"];
        $this->response_id = $bard_answer["response_id"];
        $this->choice_id = $bard_answer["choices"][0]["id"];
        $this->reqid += 100000;

        return $bard_answer;
    }
}
