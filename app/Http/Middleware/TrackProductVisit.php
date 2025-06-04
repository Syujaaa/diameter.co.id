<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\produk;

class TrackProductVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $productId = $request->route('id_barang');
        $sessionId = Session::getId();


        $session = DB::table('sessions')->where('id', $sessionId)->first();
        $data = unserialize(base64_decode($session->payload));


        if (!isset($data['visited_products'])) {
            $data['visited_products'] = [];
        }


        if (!in_array($productId, $data['visited_products'])) {

            $data['visited_products'][] = $productId;


            produk::where('id_produk', $productId)->increment('total_kunjungan');


            DB::table('sessions')->where('id', $sessionId)->update([
                'payload' => base64_encode(serialize($data))
            ]);
        }


        return $next($request);
    }
}

