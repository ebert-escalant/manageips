<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

	protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing=true;
    public $timestamps=false;

	public function office() {
		return $this->belongsTo(Office::class, 'office_id', 'id');
	}

	public function devices() {
		return $this->hasMany(Device::class, 'staff_id', 'id');
	}
}
