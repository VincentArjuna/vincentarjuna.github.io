<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisItemRequest;
use App\Models\Data\JenisItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisItemController extends Controller
{

    public function find(Request $request)
    {
        $jenis_item = [];
        if ($request->tipe_transaksi == "bucket") {
            $jenis_item = JenisItem::where('status_bucket', 1)
                ->where('nama', 'like', '%' . $request->key . '%')
                ->orWhereHas('kategori', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->key . '%');
                })
                ->take(5)->get();
        } else if ($request->tipe_transaksi == "premium") {
            $jenis_item = JenisItem::where('status_premium', 1)
                ->where('nama', 'like', '%' . $request->key . '%')
                ->orWhereHas('kategori', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->key . '%');
                })
                ->take(5)->get();
        }

        return [
            'status' => 200,
            $jenis_item
        ];
    }

    public function insert(InsertJenisItemRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        JenisItem::create($merged);

        return redirect()->intended(route('menu-jenis-item'));
    }

    public function show($id)
    {
        $jenis_item = JenisItem::find($id);
        return [
            'status' => 200,
            $jenis_item,
        ];
    }

    public function update(InsertJenisItemRequest $request, $id)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        JenisItem::find($id)->update($merged);

        return redirect()->intended(route('menu-jenis-item'));
    }

    public function delete($id)
    {
        JenisItem::destroy($id);

        return redirect()->intended(route('menu-jenis-item'));
    }
}
