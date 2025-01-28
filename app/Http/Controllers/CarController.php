<?php

namespace App\Http\Controllers;

use App\Http\Resources\Car\CarCollection;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CarController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $started_at = Carbon::parse($request->started_at);
            $ended_at = Carbon::parse($request->ended_at);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if ($started_at < Carbon::now()) {
            throw new \Exception('Start time must be in the future');
        }

        if ($started_at >= $ended_at) {
            throw new \Exception('The start date cannot be before or equal the end date');
        }

        if ($ended_at->diffInMinutes($started_at) > 30) {
            throw new \Exception('The end date cannot be less than 30 minutes');
        }

        $employee = $request->user();

        $categories = $employee->position->categories->pluck('id')->toArray();

        $builder = QueryBuilder::for(Car::class);

        $builder->with([
            'driver',
            'category',
            'reservations' => function ($query) {
                $query->future();
            }
        ])->whereIn('category_id', $categories)
            ->whereDoesntHave(
            'reservations',
            fn($query) => $query->where(
                fn($query) => $query->where('started_at', '<=', $ended_at)->where('ended_at', '>=', $started_at)
            )
            ->orWhere(
                fn($query) => $query->where('ended_at', '>=', $started_at)->where('started_at', '<=', $ended_at)
            )
        );

        $builder->allowedSorts(['id', 'model', 'category_id', 'driver_id']);
        $builder->allowedFilters([
            AllowedFilter::exact('id'),
            'model',
            AllowedFilter::exact('category_id'),
        ]);

        return CarCollection::make($builder->get())->additional(['success' => true]);
    }
}
