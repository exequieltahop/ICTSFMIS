<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Expense extends Model
{
    protected $fillable = [
        'amount',
        'description',
        'category',
        'event',
        'reciept',
        'date'
    ];

    // get all expenses data
    public static function getAllData()
    {
        try {
            $data = self::orderBy('date', 'desc')->paginate(15);
            $data->getCollection()->transform(function ($item) {
                $item->enc_id = Crypt::encrypt($item->id);
                return $item;
            });
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
