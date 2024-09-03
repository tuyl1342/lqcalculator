<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LQResult extends Model
{
    use HasFactory;
    protected $table = 'lq_results';
    protected $fillable = [
        'sektor',
        'lq_2019',
        'lq_2020',
        'lq_2021',
        'lq_2022',
        'lq_2023'
    ];
}
