<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $table = 'companies';

    use SoftDeletes;


    /**
     * @var array
     */
    protected $fillable = [
      'name',
      'email',
      'logo',
      'website'
    ];

    protected $primaryKey = 'name';
    protected $keyType = 'string';

    public function employees()
    {
      return $this->hasMany(Employee::class);
    }
}
