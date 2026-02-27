@extends('website.layout')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Blog Header -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center space-x-2 text-white text-sm mb-6">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span>/</span>
                <a href="{{ route('blog') }}" class="hover:underline">Blog</a>
                <span>/</span>
                <span class="text-green-200">{{ $post->title }}</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $post->title }}</h1>
            <div class="flex flex-wrap items-center justify-center text-green-100 space-x-4">
                <div class="flex items-center">
                    <i class="far fa-calendar mr-2"></i>
                    {{ $post->created_at->format('F d, Y') }}
                </div>
                @if($post->author)
                    <div class="flex items-center">
                        <i class="far fa-user mr-2"></i>
                        {{ $post->author->name }}
                    </div>
                @endif
                @if($post->category)
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $post->category }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if($post->featured_image)
                <div class="h-96 overflow-hidden">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="p-8">
                <!-- Post Content -->
                <div class="prose prose-lg max-w-none">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && count($post->tags) > 0)
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Like and Share Buttons -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Like Buttons -->
                        <div class="flex items-center space-x-4">
                            <h3 class="text-lg font-semibold text-gray-900">Like this post:</h3>
                            <div class="flex items-center space-x-2">
                                <button id="likeBtn" class="flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                                    <i class="fas fa-thumbs-up mr-2"></i>
                                    <span id="likeCount">{{ $post->like_counts['likes'] ?? 0 }}</span>
                                </button>
                                <button id="dislikeBtn" class="flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-red-600 hover:text-white transition-colors">
                                    <i class="fas fa-thumbs-down mr-2"></i>
                                    <span id="dislikeCount">{{ $post->like_counts['dislikes'] ?? 0 }}</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Share this post</h3>
                            <x-social-share 
                                :url="url()->current()" 
                                :title="$post->title" 
                                :description="$post->excerpt ?? $post->content" 
                                :image="$post->featured_image ?? null" 
                                type="post" />
                        </div>
                    </div>
                </div>
                
                <!-- Like/Dislike JavaScript -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const postId = {{ $post->id }};
                        const likeBtn = document.getElementById('likeBtn');
                        const dislikeBtn = document.getElementById('dislikeBtn');
                        const likeCountEl = document.getElementById('likeCount');
                        const dislikeCountEl = document.getElementById('dislikeCount');
                        
                        // Get current user's interaction status from localStorage
                        const currentUserInteraction = JSON.parse(localStorage.getItem(`post_${postId}_interaction`) || '{}');
                        if (currentUserInteraction.type === 'like') {
                            likeBtn.classList.remove('bg-gray-200', 'text-gray-800');
                            likeBtn.classList.add('bg-blue-600', 'text-white');
                        } else if (currentUserInteraction.type === 'dislike') {
                            dislikeBtn.classList.remove('bg-gray-200', 'text-gray-800');
                            dislikeBtn.classList.add('bg-red-600', 'text-white');
                        }
                        
                        // Like button event
                        likeBtn.addEventListener('click', function() {
                            fetch(`/api/posts/${postId}/like`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: JSON.stringify({ type: 'like' })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update counts
                                    likeCountEl.textContent = data.counts.likes;
                                    dislikeCountEl.textContent = data.counts.dislikes;
                                    
                                    // Update button states
                                    likeBtn.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-blue-600');
                                    likeBtn.classList.add('bg-blue-600', 'text-white');
                                    dislikeBtn.classList.remove('bg-red-600', 'text-white');
                                    dislikeBtn.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-red-600');
                                    
                                    // Store user's interaction in localStorage
                                    localStorage.setItem(`post_${postId}_interaction`, JSON.stringify({
                                        type: data.type,
                                        timestamp: new Date().toISOString()
                                    }));
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while liking the post.');
                            });
                        });
                        
                        // Dislike button event
                        dislikeBtn.addEventListener('click', function() {
                            fetch(`/api/posts/${postId}/like`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: JSON.stringify({ type: 'dislike' })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update counts
                                    likeCountEl.textContent = data.counts.likes;
                                    dislikeCountEl.textContent = data.counts.dislikes;
                                    
                                    // Update button states
                                    dislikeBtn.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-red-600');
                                    dislikeBtn.classList.add('bg-red-600', 'text-white');
                                    likeBtn.classList.remove('bg-blue-600', 'text-white');
                                    likeBtn.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-blue-600');
                                    
                                    // Store user's interaction in localStorage
                                    localStorage.setItem(`post_${postId}_interaction`, JSON.stringify({
                                        type: data.type,
                                        timestamp: new Date().toISOString()
                                    }));
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while disliking the post.');
                            });
                        });
                    });
                </script>
            </div>
        </div>

        <!-- Back to Blog -->
        <div class="mt-8 text-center">
            <a href="{{ route('blog') }}" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blog
            </a>
        </div>
    </div>
</div>
@endsection