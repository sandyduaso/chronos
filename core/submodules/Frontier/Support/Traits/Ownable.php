<?php

namespace Frontier\Support\Traits;

use Closure;
use Pluma\Models\Ownership;
use Pluma\Models\User;

/**
 * Attachable to any Model
 * Trait to use for using Polymorphic Relationship
 *
 */
trait Ownable
{
	protected $class = 'Pluma\Models\Ownership';
	protected $morphable = 'ownable';

	public function ownerships()
	{
		// return $this->belongsTo('\Pluma\Models\User');
		return $this->morphMany( $this->class, $this->morphable );
	}

	public function getOwnerAttribute()
	{
		return null !== $this->ownerships()->first() ? $this->ownerships()->first()->user : false;
	}

	public function getTrashedownerAttribute()
	{
		return $this->ownerships()->onlyTrashed()->first()->user;
	}
}
