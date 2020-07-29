<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    protected $table = 'employees';

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
      'first_name',
      'last_name',
      'company',
      'email',
      'phone'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
