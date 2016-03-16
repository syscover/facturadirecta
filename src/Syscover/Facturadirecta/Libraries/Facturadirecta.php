<?php namespace Syscover\Facturadirecta\Libraries;

class Facturadirecta
{
    public static function getClients($params = [])
    {
        $url = 'https://' . config('facturadirecta.accountName') . '.facturadirecta.com/api/clients.xml';

        // set params in url
        $i = 0;
        foreach($params as $key => $value)
        {
            if($i === 0)
                $url .= '?';
            else
                $url .= '&';

            $url .= $key . '=' .  $value;
            $i++;
        }

        $curlParams = [
            'url'               => $url,
            'httpAuth'          => config('facturadirecta.api') . ':x',
            'followLocation'    => false,
            'returnTransfer'    => true,
            'timeout'           => 30,
        ];

        $response = Remote::send($curlParams);

        $doc = new \DomDocument();
        $doc->loadXML($response);

        $response = json_decode(json_encode((array) simplexml_load_string($response, null, LIBXML_NOCDATA)), true);

        // change index @attributes by attributes
        $response['attributes'] = $response['@attributes'];
        unset($response['@attributes']);

        if($response['attributes']['total'] === "1")
            $response['client'] = [$response['client']];

        return $response;
    }

    public static function getClient($id)
    {
        $url = 'https://' . config('facturadirecta.accountName') . '.facturadirecta.com/api/clients/' . $id . '.xml';

        $curlParams = [
            'url'               => $url,
            'httpAuth'          => config('facturadirecta.api') . ':x',
            'followLocation'    => false,
            'returnTransfer'    => true,
            'timeout'           => 30,
        ];

        $response = Remote::send($curlParams);

        $doc = new \DomDocument();

        try
        {
            $doc->loadXML($response);
        }
        catch(\Exception $e)
        {
            // error de carga
        }

        $response = json_decode(json_encode((array) simplexml_load_string($response, null, LIBXML_NOCDATA)), true);

        return $response;
    }
}