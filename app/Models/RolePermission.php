<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class Role_Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where('role_permissions.Status', '=', 1);
    }

    public function Permission()
    {
        return $this->belongsTo(Permission::class,'Permission_Id');
    }
}
