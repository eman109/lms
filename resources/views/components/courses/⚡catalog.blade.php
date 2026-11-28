<?php

use App\Models\Course;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public string $search = '';

    #[Computed]
    public function courses()
    {
        return Course::query()
            ->where('published', true)
            ->where('title', 'like', '%' . $this->search . '%')
            ->withCount('lessons')
            ->orderBy('title')
            ->get();
    }
};

?>

<div class="mx-auto max-w-3xl p-6">
    <input
        type="text"
        wire:model.live.debounce.300ms="search"
        placeholder="Search courses..."
        class="mb-6 w-full rounded border px-3 py-2"
    >


    @forelse ($this->courses as $course)
        <div wire:key="course-{{ $course->id }}" class="mb-4 rounded border p-4">
            <h3 class="text-lg font-semibold">{{ $course->title }}</h3>
            <p>{{ $course->description }}</p>
            <small>{{ $course->lessons_count }} lessons</small>
        </div>
    @empty
        <p>No courses found.</p>
    @endforelse
</div>
