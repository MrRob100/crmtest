<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

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
