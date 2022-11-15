<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPelangganRequest;
use App\Models\Data\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function insert(InsertPelangganRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::create($merged);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        return [
            'status' => 200,
            $pelanggan,
        ];
    }

    public function update(InsertPelangganRequest $request, $id)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::find($id)->update($merged);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);

        return redirect()->intended(route('menu-parfum'));
    }
}
