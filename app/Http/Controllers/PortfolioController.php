<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Comment;
use App\Models\Setting;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil projects dari DB (hanya yang aktif, urut sort_order)
        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->get()
            ->map(fn($p) => [
                'id'               => $p->id,
                'title'            => $p->title,
                'description'      => $p->description,
                'long_description' => $p->long_description,
                'thumbnail'        => $p->thumbnail ? asset('storage/' . $p->thumbnail) : null,
                'tags'             => $p->tags ?? [],
                'tech_stack'       => $p->tech_stack ?? [],
                'features'         => $p->features ?? [],
                'type'             => $p->type,
                'role'             => $p->role,
                'duration'         => $p->duration,
                'year'             => $p->year,
                'demo_url'         => $p->demo_url,
                'github_url'       => $p->github_url,
                'is_featured'      => $p->is_featured,
            ]);

        // Komentar yang approved, terbaru di atas
        $comments = Comment::where('is_approved', true)
            ->orderByDesc('created_at')
            ->take(30)
            ->get()
            ->map(fn($c) => [
                'id'     => $c->id,
                'name'   => $c->name,
                'msg'    => $c->message,
                'date'   => $c->created_at->format('M d, Y'),
                'avatar' => $c->avatar_url ? asset('storage/' . $c->avatar_url) : null,
            ]);

        // Settings dari DB (nama, bio, foto, sosmed, dll)
        $settings = Setting::pluck('value', 'key');

        return Inertia::render('Home', [
            'projects' => $projects,
            'comments' => $comments,
            'settings' => $settings,
        ]);
    }
}
