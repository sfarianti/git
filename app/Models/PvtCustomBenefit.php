<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvtCustomBenefit extends Model
{
    use HasFactory;
    protected $table = 'pvt_custom_benefits';
    protected $fillable = [
        'custom_benefit_financial_id',
        'paper_id',
        'value'
    ];

    public function setValueAttribute($value)
    {
        if($value != "")
            $this->attributes['value'] = intval(str_replace('.', '', $value));
        else
            $this->attributes['value'] = null;
    }

    public function getValueFormattedAttribute()
    {
        $value = $this->attributes['value'];
        if($value !== null){
            $nilai = floatval(preg_replace('/[^\d]/', '', $value));

            if (!is_nan($nilai)) {
                $formattedNumber = number_format($nilai, 0, ',', '.');
                return $formattedNumber;
            } else {
                return '';
            }
        }else{
            return '';
        }
    }
}
