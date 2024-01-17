<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

	protected $table = 'devices';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing=true;
    public $timestamps=false;

	public function staff() {
		return $this->belongsTo(Staff::class, 'staff_id', 'id');
	}

	public function office() {
		return $this->belongsTo(Office::class, 'office_id', 'id');
	}

	public function network() {
		return $this->belongsTo(Network::class, 'network_id', 'id');
	}

	public function user() {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
