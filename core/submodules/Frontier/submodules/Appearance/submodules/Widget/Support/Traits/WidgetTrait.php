<?php

namespace Widget\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait WidgetTrait
{
	/**
	 * Check if viewable by the user.
	 *
	 * @return boolean
	 */
	public function isViewable()
	{
		if (user() && user()->hasRole($this->roles()->pluck('code', 'name')->toArray())) {
			return true;
		}

		return false;
	}
}
