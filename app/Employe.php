<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model {

    /**
     * Table for model
     *
     * @var string
     */
    public $table = 'employees';

    /**
     * Fields that can be filled
     *
     * @var array
     */
    public $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'company_id'
    ];

    /**
     * Get all company
     */
    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}