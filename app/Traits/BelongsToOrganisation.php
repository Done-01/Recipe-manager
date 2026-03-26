<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Organisation;

trait BelongsToOrganisation
{
    protected static function bootBelongsToOrganisation()
    {
        // 1. Automatically add 'where organisation_id = X' to all SELECTs
        static::addGlobalScope('organisation', function (Builder $builder) {
            if (session()->has('active_organisation')) {
                $builder->where('organisation_id', session('active_organisation'));
            }
        });

        // 2. Automatically set 'organisation_id' on new records
        static::creating(function ($model) {
            if (session()->has('active_organisation')) {
                $model->organisation_id = session('active_organisation');
            }
        });
    }
}
