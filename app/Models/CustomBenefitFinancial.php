<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBenefitFinancial extends Model
{
    use HasFactory;
    protected $table = 'custom_benefit_financials';
    protected $fillable = [
        'name_benefit',
        'company_code',
    ];
}
