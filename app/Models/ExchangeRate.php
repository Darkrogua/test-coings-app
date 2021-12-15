<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'currency_id','buy_price','sell_price','office_id','begins_at'
    ];

    public $timestamps = true;


    public function currency() {
        return $this->belongsTo('App\Models\Currency');
    }

    public function getCurrencyAttribute() {
        return $this->currency()->id;
    }
}
