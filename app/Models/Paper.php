<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    protected $table = 'papers';
    protected $fillable = [
        'innovation_title',
        'inovasi_lokasi',
        'step_1',
        'step_2',
        'step_3',
        'step_4',
        'step_5',
        'step_6',
        'step_7',
        'step_8',
        'full_paper',
        'financial',
        'potential_benefit',
        'file_review',
        'non_financial',
        'team_id',
        'abstract',
        'problem',
        // 'problem_impact',
        'main_cause',
        'solution',
        // 'outcome',
        // 'performance',
        'innovation_photo',
        'proof_idea',
        'status_inovasi',
        'potensi_replikasi'

    ];

    public function updateAndHistory(array $datas = [], $activity = null)
    {
        // $step = $data[$stage];
        // foreach($data as $da => $d){
        //     dd($this->asdasad);
        // }
        // dd($this);
        // // Lakukan pembaruan
        // $this->update();

        if ($activity == null) {
            $flag_create_or_update = '0';
            $keys = array_keys($datas);
            foreach ($datas as $key_data => $data) {
                if (empty($this->$key_data))
                    $flag_create_or_update = 1;
                elseif (!$flag_create_or_update)
                    $flag_create_or_update = 0;

                $this->$key_data = $data;
            }

            if ($flag_create_or_update)
                $status = 'created';
            else
                $status = 'updated';

            $activity = $status;
            foreach ($keys as $key) {
                $activity .= " " . $key;
            }
        } else {
            $status = explode(" ", $activity)[0];
        }

        $this->update();

        History::create([
            'team_id'  => $this->team_id,
            'activity' => $activity,
            'status'   => $status
        ]);
    }

    public function setFinancialAttribute($value)
    {
        if ($value != "")
            $this->attributes['financial'] = intval(str_replace('.', '', $value));
        else
            $this->attributes['financial'] = null;
    }

    public function setPotentialBenefitAttribute($value)
    {
        if ($value != "")
            $this->attributes['potential_benefit'] = intval(str_replace('.', '', $value));
        else
            $this->attributes['potential_benefit'] = null;
    }


    // Define the mutator for "potensi_replikasi" attribute
    // public function setPotensiReplikasiAttribute($value)
    // {
    //     // Jika value bukan string kosong, tetapkan nilai ke atribut "potensi_replikasi"
    //     // Jika value kosong, tetapkan nilai null
    //     $this->attributes['potensi_replikasi'] = ($value !== '') ? $value : null;
    // }


    public function getFinancialFormattedAttribute()
    {
        $value = $this->attributes['financial'];
        if ($value !== null) {
            $nilai = floatval(preg_replace('/[^\d]/', '', $value));

            if (!is_nan($nilai)) {
                $formattedNumber = number_format($nilai, 0, ',', '.');
                return $formattedNumber;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function getPotentialBenefitFormattedAttribute()
    {
        $value = $this->attributes['potential_benefit'];
        if ($value !== null) {
            $nilai = floatval(preg_replace('/[^\d]/', '', $value));

            if (!is_nan($nilai)) {
                $formattedNumber = number_format($nilai, 0, ',', '.');
                return $formattedNumber;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    // Define the accessor for "potensi_replikasi" attribute
    // public function getPotensiReplikasiFormattedAttribute()
    // {
    //     // Ambil nilai dari atribut "potensi_replikasi"
    //     $value = $this->attributes['potensi_replikasi'];

    //     // Cek jika nilai tidak null
    //     if ($value !== null) {
    //         // Ubah nilai menjadi string sesuai kebutuhan
    //         // Misalnya, jika nilainya adalah "bisa" atau "tidak"
    //         // Anda dapat mengembalikan string "Ya" atau "Tidak"
    //         // Sesuaikan dengan preferensi atau kebutuhan Anda
    //         if ($value === 'bisa') {
    //             return 'Ya';
    //         } elseif ($value === 'tidak') {
    //             return 'Tidak';
    //         } else {
    //             return $value;
    //         }
    //     } else {
    //         return '';
    //     }
    // }



    public function documentSupport()
    {
        return $this->hasMany(DocumentSupport::class);
    }

    public function team() //baru
    {
        return $this->belongsTo(Team::class);
    }
}
