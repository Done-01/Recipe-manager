<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["name", "email", "password"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function organisations(): BelongsToMany
    {
        return $this->belongsToMany(Organisation::class, "organisation_users")
            ->using(OrganisationUser::class)
            ->withPivot(["role", "created_by", "updated_by", "deleted_by"])
            ->withTimestamps();
    }

    /**
     * Get the currently active organisation for the user.
     */
    protected $currentOrgCache = null;

    public function currentOrganisation()
    {
        if ($this->currentOrgCache) {
            return $this->currentOrgCache;
        }

        return $this->currentOrgCache = $this->organisations()
            ->where("organisations.id", session("active_organisation"))
            ->first();
    }
}
