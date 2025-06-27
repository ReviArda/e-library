<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Borrow;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalBooks = Book::count();
        $totalBorrows = Borrow::count();
        $activeBorrows = Borrow::whereNull('returned_at')->count();
        $favoriteBooks = $user ? $user->favoriteBooks()->count() : 0;

        // Statistik peminjaman per bulan (6 bulan terakhir)
        $months = collect(range(0, 5))->map(function($i) {
            return now()->subMonths($i)->format('Y-m');
        })->reverse();
        $borrowCounts = $months->map(function($month) {
            return [
                'label' => \Carbon\Carbon::createFromFormat('Y-m', $month)->translatedFormat('F Y'),
                'count' => \App\Models\Borrow::whereYear('borrowed_at', substr($month,0,4))
                    ->whereMonth('borrowed_at', substr($month,5,2))
                    ->count(),
            ];
        });
        $borrowChartLabels = $borrowCounts->pluck('label');
        $borrowChartData = $borrowCounts->pluck('count');

        // Greeting
        $greetingName = $user ? $user->name : '';

        // Top 3 buku terfavorit
        $topFavoriteBooks = \App\Models\Book::withCount('favorites')
            ->orderByDesc('favorites_count')
            ->take(3)
            ->get();

        // Top 5 buku terbaru
        $latestBooks = \App\Models\Book::orderByDesc('created_at')->take(5)->get();

        // Aktivitas terakhir user (peminjaman & pengembalian)
        $recentActivities = [];
        if ($user) {
            $borrows = \App\Models\Borrow::with('book')
                ->where('user_id', $user->id)
                ->orderByDesc('borrowed_at')
                ->take(5)
                ->get();
            foreach ($borrows as $borrow) {
                $recentActivities[] = [
                    'type' => $borrow->returned_at ? 'returned' : 'borrowed',
                    'book' => $borrow->book,
                    'date' => $borrow->returned_at ?? $borrow->borrowed_at,
                ];
            }
        }

        return view('dashboard', compact(
            'totalBooks', 'favoriteBooks', 'activeBorrows', 'totalBorrows',
            'borrowChartLabels', 'borrowChartData',
            'greetingName', 'topFavoriteBooks', 'latestBooks', 'recentActivities'
        ));
    }
} 