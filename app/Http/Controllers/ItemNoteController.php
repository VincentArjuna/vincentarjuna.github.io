<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemNoteRequest;
use App\Http\Traits\UploadTrait;
use App\Models\Transaksi\ItemNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemNoteController extends Controller
{
    use UploadTrait;

    public function list($item_transaksi_id)
    {
        $item_notes = ItemNote::where('item_transaksi_id', $item_transaksi_id)->latest()->get();
        return [
            'status' => 200,
            $item_notes
        ];
    }

    public function show($id)
    {
        $item_notes = ItemNote::find($id);
        return [
            'status' => 200,
            $item_notes
        ];
    }

    public function insert(InsertItemNoteRequest $request)
    {
        $path = $this->upload($request, 'item_notes');
        $merged = $request->safe()->merge([
            'modified_by' => Auth::id(),
            'image_path' => url($path),
        ])->toArray();
        $item_notes = ItemNote::create($merged);
        return [
            'status' => 200,
            $item_notes
        ];
    }
}
