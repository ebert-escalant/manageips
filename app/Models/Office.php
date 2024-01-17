<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

	protected $table = 'offices';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing=true;
    public $timestamps=false;

	public function staffs() {
		return $this->hasMany(Staff::class, 'office_id', 'id');
	}

	public function devices() {
		return $this->hasMany(Staff::class, 'office_id', 'id');
	}
}
