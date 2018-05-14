<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * Fields that can be filled
     *
     * @var array
     */
    public $fillable = [
      'name',
      'logo',
      'website',
      'email'
    ];

    /**
     * Get all employees for company
     */
    public function employees() {
        return $this->hasMany(Employe::class, 'company_id');
    }

}
