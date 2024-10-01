<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateAssessmentPoint extends Model
{
    use HasFactory;
    protected $table = 'template_assessment_points';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'point',
                            'detail_point',
                            'pdca',
                            'score_max',
                            'category',
                            'stage'
                        ];
}
