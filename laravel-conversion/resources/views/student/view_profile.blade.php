<?php
/** @var object $user */
/** @var array<int, string> $skills */
?>

<h1>{{ $user->name ?? '' }}</h1>
<p>Email: {{ $user->email ?? '' }}</p>
<p>GPA: {{ $user->gpa ?? '' }}</p>

<h3>Skills</h3>
@foreach($skills as $s)
    <span>{{ trim($s) }}</span>
@endforeach
