<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;

class VaultController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleClient([ 'base_uri' => config('services.vault.url') ]);
        // $this->client->setDefaultOption('headers/X-Vault-Token', config('services.vault.token'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->client->request('GET', "secret/metadata?list=true", [ 'headers' => ['X-Vault-Token' => config('services.vault.token') ]]);

        $list = json_decode((string) $response->getBody());

        $keys = $list->data->keys;

        return view('index', compact('keys'));
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

        $alias = $request->input('alias');
        $key = $request->input('key');
        $value = $request->input('value');

        $response = $client->request('POST', "$vaultURL/data/$alias", [
            'json' => ['data' => [$key => $value]]
        ]);

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

        $response = $client->request('GET', "$vaultURL/$secret");

        $kv = (json_decode((string) $response->getBody())->data->data);

        dd($kv);

        return view('show', compact('kv'));
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
