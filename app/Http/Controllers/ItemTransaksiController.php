<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemTransaksiRequest;
use App\Models\Data\JenisItem;
use App\Models\Transaksi\ItemTransaksi;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTransaksiController extends Controller
{
    public function addItemToTransaksi(Request $request)
    {
        $request['modified_by'] = Auth::id();
        $role = User::getRole(Auth::id());
        $jenis_item = JenisItem::find($request['jenis_item_id']);
        $request['bobot_bucket'] = $jenis_item->bobot_bucket;
        $request['harga_premium'] = $jenis_item->harga_premium;
        $request['status_proses'] = $role;
        $item_transaksi = ItemTransaksi::create($request->toArray());

        $transaksi = Transaksi::detail()->find($request['transaksi_id'])->recalculate();
        $transaksi->modified_by = Auth::id();
        $transaksi->save();
        return  [
            'status' => 200,
            $transaksi,
        ];
    }

    public function insert(InsertItemTransaksiRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        ItemTransaksi::create($merged);

        return redirect()->intended(route(''));
    }

    public function show($id)
    {
        $item_transaksi = ItemTransaksi::find($id);
        return [
            'status' => 200,
            $item_transaksi,
        ];
    }

    public function update(InsertItemTransaksiRequest $request, $id)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        ItemTransaksi::find($id)->update($merged);

        return redirect()->intended(route(''));
    }

    public function delete($id)
    {
        ItemTransaksi::destroy($id);

        return redirect()->intended(route(''));
    }
}
