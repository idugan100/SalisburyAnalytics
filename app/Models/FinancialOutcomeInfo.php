<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialOutcomeInfo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'financial_outcomes';

    public function year_one_unemployment(): float
    {
        return round( 100 * $this->unemployed_count_year_1/($this->unemployed_count_year_1+$this->employed_count_year_1),1);
    }

    public function year_four_unemployment(): float
    {
        return round( 100 * $this->unemployed_count_year_4/($this->unemployed_count_year_4+$this->employed_count_year_4),1);
    }

}
