<?php


namespace App\Http\Modules;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

//фильтр для постов
class PostFilter
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $query): Builder
    {
        if ($this->request->has('name')) {
            $query->where('name', 'like', '%' . $this->request->input('name') . '%');
        }
        if ($this->request->has('max_price')) {
            $query->where('price', '<=', $this->request->input('max_price'));
        }
        if ($this->request->has('min_price')) {
            $query->where('price', '>=', $this->request->input('min_price'));
        }

        if ($this->request->has('in_stock')) {
            $query->where('stock', '>', 0);
        }
        if ($this->request->filled('sort_by')) {
            $query->orderBy($this->request->input('sort_by'), $this->request->input('sort_order', 'asc'));
        }
        if ($this->request->has('categories')) {
            $query->with('categories');
        }
        if ($this->request->has('comment')) {
            $query->with('comment');
        }
        if ($this->request->has('image')) {
            $query->with('image');
        }

        return $query;
    }
}
