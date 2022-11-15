<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertParfumRequest;
use App\Models\Data\Parfum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParfumController extends Controller
{
    public function insert(InsertParfumRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Parfum::create($merged);

        return redirect()->intended(route('menu-parfum'));
    }

    public function show($id)
    {
        $parfum = Parfum::find($id);
        return [
            'status' => 200,
            $parfum,
        ];
    }

    public function update(InsertParfumRequest $request, $id)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Parfum::find($id)->update($merged);

        return redirect()->intended(route('menu-parfum'));
    }

    public function delete($id)
    {
        Parfum::destroy($id);

        return redirect()->intended(route('menu-parfum'));
    }
}
