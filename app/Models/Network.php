<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

	protected $table = 'networks';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing=true;
    public $timestamps=false;

	public function devices() {
		return $this->hasMany(Device::class, 'network_id', 'id');
	}
}
