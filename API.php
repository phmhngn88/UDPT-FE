<?php

class API
{
    function CallAPI($method, $url, $data)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                break;
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Optional Authentication:
        $header   = array();
        $header[] = 'authorization:' . $_SESSION["Token"];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);


        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result);
    }
}

class PagingRes
{
    function __construct()
    {
        $this->data = array();
        $this->total = 0;
        $this->page = 1;
    }
}
