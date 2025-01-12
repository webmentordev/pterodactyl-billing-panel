<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    public $name, $avatar_url, $review_url, $reviewed_at, $stars, $platforms =
    ['Google', 'TrustPilot'], $platform, $content;

    #[Layout('layouts.livewire.admin')]
    public function render()
    {
        return view('livewire.admin.reviews', [
            'reviews' => Review::latest()->paginate(200)
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'max:255'],
            'avatar_url' => ['nullable', 'url'],
            'review_url' => ['required', 'url'],
            'reviewed_at' => ['required', 'max:255'],
            'platform' => ['required', 'max:255'],
            'stars' => ['required', 'numeric', 'min:1', 'max:5'],
            'content' => ['required']
        ]);
        Review::create([
            'name' => $this->name,
            'avatar_url' => $this->avatar_url,
            'review_url' => $this->review_url,
            'reviewed_at' => $this->reviewed_at,
            'platform' => $this->platform,
            'stars' => $this->stars,
            'content' => $this->content
        ]);
        return session()->flash('saved', 'Review has been created!');
    }


    public function delete(Review $review)
    {
        $review->delete();
        return session()->flash('success', 'Review has been deleted!');
    }
}
