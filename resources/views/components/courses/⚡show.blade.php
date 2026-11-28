<?php

use App\Models\Course;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    #[Computed]
    public function lessons()
    {
        return $this->course->lessons()->orderBy('position')->get();
    }

    #[Computed]
    public function isEnrolled(): bool
    {
        return auth()->user()->enrolledCourses()->whereKey($this->course->id)->exists();
    }

    public function enroll()
    {
        auth()->user()->enrolledCourses()->syncWithoutDetaching([$this->course->id]);
    }
};
?>

<div class="mx-auto max-w-3xl p-6">
    <a href="{{ route('courses.index') }}" class="text-sm underline"><- All courses</a>

    <h1 class="mt-4 text-2xl font-bold">{{ $course->title }}</h1>
    <p class="mb-4">{{ $course->description }}</p>

    @if ($this->isEnrolled)
        <p class="mb-6 font-semibold">You are enrolled in this course.</p>
    @else
        <button wire:click="enroll" class="mb-6 rounded bg-black px-4 py-2 text-white">
            Enroll
        </button>
    @endif

    <h2 class="mb-2 text-xl font-semibold">Lessons</h2>

    @foreach ($this->lessons as $lesson)
        <div wire:key="lesson-{{ $lesson->id }}" class="mb-2 rounded border p-3">
            {{ $lesson->position }}. {{ $lesson->title }}
        </div>
    @endforeach
</div>