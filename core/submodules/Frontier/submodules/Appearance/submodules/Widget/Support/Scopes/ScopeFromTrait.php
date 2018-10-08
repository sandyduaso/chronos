<?php

namespace Widget\Support\Scopes;

trait ScopeFromTrait
{
	/**
	 * Get the resources from the specified location.
	 *
	 * @param  string $location
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function scopeFrom($location)
	{
		return false;
	}
}
