<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;

class VaultController extends Controller
{
    private $client;

    // public function __construct()
    // {
    //     $this->client = new GuzzleClient([ 'base_uri' => config('services.vault.url') ]);
    //     $this->client->setDefaultOption('headers/X-Vault-Token', config('services.vault.token'));
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkStatus()
    {
        $vaultToken = env("VAULT_TOKEN");
        $vaultURL = env("VAULT_URL");
        $headers = ['X-Vault-Token' => $vaultToken, 'Accept' => 'application/json'];

        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        try {
            $response = $client->get('http://localhost:8200/v1/sys/health');
        } catch (ConnectException $e) {
            return 503;
        }

        $status = $response->getStatusCode();

        $statusPhrase = $response->getReasonPhrase();

        return $status;

    }

    public function getKeys()
    {

        // $response = $this->client->request('GET', "secret/metadata?list=true", [ 'headers' => ['X-Vault-Token' => config('services.vault.token') ]]);
        
        $vaultToken = env("VAULT_TOKEN");
        $vaultURL = env("VAULT_URL");
        $headers = ['X-Vault-Token' => $vaultToken, 'Accept' => 'application/json'];

        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $status = $this->checkStatus();

        try {
            $response = $client->get('http://localhost:8200/v1/secret/metadata?list=true');
        } catch (ClientException | ConnectException $e) {
            return [];
        }

        $list = json_decode((string) $response->getBody());

        $keys = $list->data->keys;

        return $keys;
    }

    public function index()
    {
        $status = $this->checkStatus();
        $keys = $this->getKeys();

        if ($status === 200 || $status === 404) {
            return view('index', compact('keys')); 
        }
        elseif ($status === 503) {
            return view('down', compact('keys')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaultToken = env("VAULT_TOKEN");
        $vaultURL = env("VAULT_URL");
        $headers = ['X-Vault-Token' => $vaultToken, 'Content-Type' => 'application/json'];

        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $status = $this->checkStatus();

        $alias = $request->input('alias');
        $key = $request->input('key');
        $value = $request->input('value');
       
        try {
            $response = $client->request('POST', "$vaultURL/data/$alias", [
            'json' => ['data' => [$key => $value]]
        ]);
        } catch (ClientException | ConnectException $e) {
            return view('unauthenticated');
        }


        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $secret)
    {
        $vaultToken = env("VAULT_TOKEN");
        $vaultURL = env("VAULT_URL");
        $headers = ['X-Vault-Token' => $vaultToken];

        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $response = $client->request('GET', "$vaultURL/data/$secret");

        $kv = (json_decode((string) $response->getBody())->data->data);

        return view('show', compact('kv', 'secret'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vaultToken = env("VAULT_TOKEN");
        $vaultURL = env("VAULT_URL");
        $headers = ['X-Vault-Token' => $vaultToken];
        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $alias = $request->input('alias');

        $response = $client->request('DELETE', "$vaultURL/metadata/$alias");

        return redirect()->route('home');
    }
}
