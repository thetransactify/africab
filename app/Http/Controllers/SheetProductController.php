<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Log;
class SheetProductController extends Controller
{
    //
  #auth vivek
  #update excel sheet
  public function updateFromSheet(Request $request)
    {
        // secret check
        $secret = $request->header('X-Sheet-Secret');
        if (!$secret || $secret !== env('SHEET_SECRET')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
       Log::info('Sheet API Request', $request->all());
        $items = $request->input('items') ?? [$request->only(['product_code','price'])];
        foreach ($items as $data) {
            if (empty($data['product_code'])) continue;
             ProductPrice::where('code', $data['product_code'])
                      ->update([
                     'product_cost' => $data['price'] ?? null,
                     ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
