<?php

declare(strict_types=1);

namespace Rinvex\Attributes\Models;


use Illuminate\Database\Eloquent\Model;
use Rinvex\Support\Traits\HasSlug;
use Rinvex\Support\Traits\HasTranslations;
use Rinvex\Support\Traits\ValidatingTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Option extends Model
{
//    use ValidatingTrait;
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'attribute_id',
        'value',
        'label',
        'sort_order',
    ];




    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('rinvex.attributes.tables.attribute_options'));
//        $this->setRules([
//            'attribute_id' => 'required|integer|exists:'.config('rinvex.attributes.tables.attributes').',id',
//            'value' => 'required|string|strip_tags|max:150',
//            'label' => 'nullable|string|max:10000',
//            'sort_order' => 'nullable|integer|max:10000',
//        ]);
    }



}
