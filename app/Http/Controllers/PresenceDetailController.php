<?php

namespace App\Http\Controllers;

use App\Models\PresenceDetail;
use Illuminate\Http\Request;

class PresenceDetailController extends Controller
{
    public function destroy($id)
    {
        $presenceDetail = PresenceDetail::findOrFail($id);
        $presenceDetail->delete();

        return redirect()->back();
    }
}
