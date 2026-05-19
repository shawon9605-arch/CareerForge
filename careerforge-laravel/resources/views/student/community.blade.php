<?php
/** @var bool $loggedIn */
/** @var object|null $user */
/** @var \Illuminate\Support\Collection<int, object> $posts */
/** @var array<int, array<int, object>> $commentsByPost */
/** @var array<string, array{name: string, imageSrc: string}> $authorsByEmail */
?>

<link rel="stylesheet" href="{{ asset('assets/style.css') }}">

<div class="dashboard community-page">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🔥 CareerForge</h2>
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('student.profile') }}">Profile</a>
        <a href="{{ route('student.jobs') }}">Jobs</a>
        <a href="{{ route('student.community') }}">Community</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>💬 Community</h1>

        @if(!$loggedIn)
            <div class="card notice">
                <p class="notice-text">You are not logged in. Please <a class="link-accent" href="{{ route('student.login') }}">login</a> to post and comment.</p>
            </div>
        @endif

        @if($errors->any())
            <div class="card notice">
                <p class="notice-text" style="margin-bottom:10px;">Please fix the following:</p>
                <ul class="error-list">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="community-layout">
            <div class="community-left">

                <!-- CREATE POST -->
                <div class="card">
                    <form method="POST" action="{{ route('student.post.store') }}">
                        @csrf
                        <textarea name="content" placeholder="Share your thoughts..." @if(!$loggedIn) disabled @endif>{{ old('content') }}</textarea>
                        <button type="submit" @if(!$loggedIn) disabled @endif>Post</button>
                    </form>
                </div>

                <!-- POSTS -->
                <div class="community-feed">
                    @forelse($posts as $post)
                        <?php
                            $postEmailRaw = (string)($post->email ?? '');
                            $postEmailKey = strtolower(trim($postEmailRaw));
                            $postAuthor = $postEmailKey !== '' ? ($authorsByEmail[$postEmailKey] ?? null) : null;
                            $postAuthorName = $postAuthor && !empty($postAuthor['name'])
                                ? $postAuthor['name']
                                : ($postEmailRaw !== '' ? trim($postEmailRaw) : 'Anonymous');
                            $postAuthorAvatar = $postAuthor && !empty($postAuthor['imageSrc'])
                                ? $postAuthor['imageSrc']
                                : asset('assets/user.png');
                            $postComments = $commentsByPost[(int)$post->id] ?? [];
                            $postTime = !empty($post->created_at)
                                ? \Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans()
                                : '';

                            $userEmailKey = $user ? strtolower(trim((string)($user->email ?? ''))) : '';
                            $isMine = $loggedIn && $userEmailKey !== '' && ($userEmailKey === $postEmailKey);

                            $editingId = (int) request()->query('edit', 0);
                            $isEditing = $isMine && ($editingId === (int) $post->id);
                        ?>

                        <div class="card post-card">
                            <div class="post-header">
                                <div class="post-author">
                                    <img class="avatar" src="{{ $postAuthorAvatar }}" alt="avatar">
                                    <div class="post-author-text">
                                        <h4 class="post-author-name">{{ $postAuthorName }}</h4>
                                        <span class="post-submeta">{{ $postTime }}</span>
                                    </div>
                                </div>

                                <div class="post-actions">
                                    <span class="post-meta">#{{ (int)$post->id }}</span>

                                    @if($isMine)
                                        <a class="post-action-link" href="{{ route('student.community', ['edit' => (int)$post->id]) }}">Edit</a>

                                        <form method="POST" action="{{ route('student.post.delete', ['postId' => (int)$post->id]) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="post-action-btn" onclick="return confirm('Delete this post?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            @if($isEditing)
                                <form method="POST" action="{{ route('student.post.update', ['postId' => (int)$post->id]) }}" class="post-edit-form">
                                    @csrf
                                    <textarea name="content">{{ old('content', (string)($post->content ?? '')) }}</textarea>
                                    <div class="post-edit-actions">
                                        <button type="submit">Save</button>
                                        <a class="post-action-link" href="{{ route('student.community') }}">Cancel</a>
                                    </div>
                                </form>
                            @else
                                <p class="post-content">{{ (string)($post->content ?? '') }}</p>
                            @endif

                            <div class="comments">
                                @if(empty($postComments))
                                    <p class="muted" style="margin:14px 0 0 0;">No comments yet.</p>
                                @else
                                    @foreach($postComments as $c)
                                        <?php
                                            $cEmailRaw = (string)($c->email ?? '');
                                            $cEmailKey = strtolower(trim($cEmailRaw));
                                            $cAuthor = $cEmailKey !== '' ? ($authorsByEmail[$cEmailKey] ?? null) : null;
                                            $cName = $cAuthor && !empty($cAuthor['name']) ? $cAuthor['name'] : ($cEmailRaw !== '' ? trim($cEmailRaw) : 'Anonymous');
                                            $cAvatar = $cAuthor && !empty($cAuthor['imageSrc']) ? $cAuthor['imageSrc'] : asset('assets/user.png');
                                            $cTime = !empty($c->created_at)
                                                ? \Illuminate\Support\Carbon::parse($c->created_at)->diffForHumans()
                                                : '';
                                        ?>
                                        <div class="comment-item">
                                            <img class="avatar avatar-sm" src="{{ $cAvatar }}" alt="avatar">
                                            <div class="comment-body">
                                                <div class="comment-meta">
                                                    <strong>{{ $cName }}</strong>
                                                    @if($cTime !== '')
                                                        <span class="dot">•</span>
                                                        <span class="comment-time">{{ $cTime }}</span>
                                                    @endif
                                                </div>
                                                <div class="comment-text">{{ (string)($c->comment ?? '') }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <form method="POST" action="{{ route('student.comment.store') }}" class="comment-form">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ (int)$post->id }}">
                                <input type="text" name="comment" placeholder="Write a comment..." @if(!$loggedIn || $isEditing) disabled @endif>
                                <button type="submit" @if(!$loggedIn || $isEditing) disabled @endif>Comment</button>
                            </form>
                        </div>
                    @empty
                        <div class="card">
                            <p style="margin:0;">No posts yet. Be the first to share something.</p>
                        </div>
                    @endforelse
                </div>

            </div>

            <!-- RIGHT PANEL (MENTORS) -->
            <div class="right-panel">

                @if($loggedIn && $user)
                    <?php
                        $meAvatar = asset('assets/user.png');
                        $meRawImage = (string) ($user->image ?? '');
                        if ($meRawImage !== '') {
                            if (str_starts_with($meRawImage, 'uploads/')) {
                                $meAvatar = asset($meRawImage);
                            } else {
                                $meAvatar = $meRawImage;
                            }
                        }
                    ?>

                    <div class="card community-me">
                        <div class="community-me-row">
                            <img class="avatar" src="{{ $meAvatar }}" alt="avatar">
                            <div class="community-me-text">
                                <div class="community-me-name">{{ (string)($user->name ?? 'Student') }}</div>
                                <div class="community-me-email">{{ (string)($user->email ?? '') }}</div>
                            </div>
                        </div>
                    </div>
                @endif

        <h3>👨‍🏫 Mentors</h3>

        <div class="mentor-card">
            <p><strong>John Doe</strong></p>
            <p>Frontend Developer</p>
            <button>Connect</button>
        </div>

        <div class="mentor-card">
            <p><strong>Jane Smith</strong></p>
            <p>Backend Engineer</p>
            <button>Connect</button>
        </div>

            </div>

        </div>

    </div>

</div>
