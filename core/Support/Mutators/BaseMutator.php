<?php

namespace Pluma\Support\Mutators;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait BaseMutator
{
    /**
     * The limit to generate excerpts.
     *
     * @var integer
     */
    protected $excerptLength = 30;

    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date|string
     */
    public function getCreatedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(); //date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->created_at));
    }

    /**
     * Get the pretty date of the updated_at column.
     *
     * @return Date|string
     */
    public function getModifiedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->updated_at))->diffForHumans(); // date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->updated_at));
    }

    /**
     * Get the pretty date of the deleted_at column.
     *
     * @return Date|string
     */
    public function getRemovedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->deleted_at))->diffForHumans(); // date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->deleted_at));
    }

    /**
     * Mutate the body or description to excerpt.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        $blurb = $this->body ? $this->body : $this->description;
        $blurb = preg_replace("/<img[^>]+\>/i", "(image) ", $blurb);

        return strip_tags(Str::words($blurb, settings('excerpt_length', $this->excerptLength)));
    }

    public function scopeExplode($key)
    {
        $words = [];

        foreach ($this->{$key} as $value) {
            $words[] = $value;
        }

        return explode(" / ", $words);
    }
}
