<?php

namespace Catalogue\Support\Traits;

use Catalogue\Models\Catalogue;

trait BelongsToCatalogue
{
    /**
     * Get the catalogue record associated with the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
