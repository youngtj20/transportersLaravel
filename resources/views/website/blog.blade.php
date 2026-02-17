@extends('website.layout')

@section('title', 'Blog - Transporters for Tinubu 2027')
@section('description', 'Read the latest news, updates, and insights from the Transporters for Tinubu 2027 movement and transportation sector developments.')
@section('keywords', 'blog, news, updates, transportation news, tinubu blog, nigeria politics')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Latest News & Updates</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Stay informed with the latest developments, insights, and stories from our movement and the transportation sector
        </p>
    </div>
</div>

<!-- Blog Filter -->
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <div class="flex flex-wrap gap-2 justify-center">
                <a href="{{ route('blog') }}" class="px-4 py-2 {{ request()->routeIs('blog') && !request()->input('category') ? 'bg-green-600 text-white' : 'bg-white text-gray-700' }} rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-newspaper mr-2"></i>All Posts
                </a>
                <a href="{{ route('blog') }}?category=announcement" class="px-4 py-2 {{ request()->input('category') == 'announcement' ? 'bg-green-600 text-white' : 'bg-white text-gray-700' }} rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-bullhorn mr-2"></i>Announcements
                </a>
                <a href="{{ route('blog') }}?category=updates" class="px-4 py-2 {{ request()->input('category') == 'updates' ? 'bg-green-600 text-white' : 'bg-white text-gray-700' }} rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-chart-line mr-2"></i>Industry News
                </a>
                <a href="{{ route('blog') }}?category=community" class="px-4 py-2 {{ request()->input('category') == 'community' || request()->input('category') == 'events' ? 'bg-green-600 text-white' : 'bg-white text-gray-700' }} rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-users mr-2"></i>Community
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Blog Posts -->
            <div class="lg:col-span-2">
                <!-- Featured Post -->
                @if($posts->first())
                    <div class="mb-12">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="h-64 bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-newspaper text-6xl mb-4"></i>
                                    <p class="text-xl font-bold">Featured Article</p>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    @if($posts->first()->category)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                            <i class="fas fa-star mr-1"></i>{{ ucfirst($posts->first()->category) }}
                                        </span>
                                    @endif
                                    <span class="ml-4 text-gray-500 text-sm">
                                        <i class="fas fa-calendar mr-1"></i>{{ $posts->first()->created_at->format('M d, Y') }}
                                    </span>
                                    @if($posts->first()->author)
                                        <span class="ml-4 text-gray-500 text-sm">
                                            <i class="fas fa-user mr-1"></i>{{ $posts->first()->author->name }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $posts->first()->title }}</h2>
                                <p class="text-gray-700 mb-6">
                                    {{ $posts->first()->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($posts->first()->content), 150) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        @if($posts->first()->tags && count($posts->first()->tags) > 0)
                                            <span class="text-gray-600 text-sm">
                                                <i class="fas fa-tags mr-1"></i>{{ implode(', ', $posts->first()->tags) }}
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('blog.show', $posts->first()->slug) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                        Read Full Article
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Recent Posts -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Recent Articles</h2>
                    
                    @forelse($posts->skip(1) as $post)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 hover:shadow-xl transition-shadow duration-300">
                            <div class="md:flex">
                                <div class="md:w-1/3">
                                    @if($post->featured_image)
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="h-48 md:h-full w-full object-cover">
                                    @else
                                        <div class="h-48 md:h-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                                            <i class="fas {{ $post->category == 'announcement' ? 'fa-bullhorn' : ($post->category == 'news' ? 'fa-newspaper' : 'fa-file-alt') }} text-white text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="md:w-2/3 p-6">
                                    <div class="flex items-center mb-3">
                                        @if($post->category)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                                <i class="fas {{ $post->category == 'announcement' ? 'fa-bullhorn' : ($post->category == 'news' ? 'fa-newspaper' : 'fa-chart-line') }} mr-1"></i>{{ ucfirst($post->category) }}
                                            </span>
                                        @endif
                                        <span class="ml-3 text-gray-500 text-sm">
                                            <i class="fas fa-calendar mr-1"></i>{{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $post->title }}</h3>
                                    <p class="text-gray-700 mb-4">
                                        {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            @if($post->author)
                                                <span class="text-gray-600 text-sm">
                                                    <i class="fas fa-user mr-1"></i>By {{ $post->author->name }}
                                                </span>
                                            @endif
                                            <span class="text-gray-600 text-sm">
                                                <i class="fas fa-clock mr-1"></i>{{ floor(str_word_count(strip_tags($post->content)) / 200) + 1 }} min read
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <!-- Like Buttons -->
                                            <div class="flex items-center space-x-2">
                                                <button onclick="toggleLike({{ $post->id }}, 'like', this)" 
                                                        class="flex items-center text-gray-500 hover:text-blue-600">
                                                    <i class="fas fa-thumbs-up"></i>
                                                    <span class="ml-1" id="like-count-{{ $post->id }}">{{ $post->like_counts['likes'] ?? 0 }}</span>
                                                </button>
                                                <button onclick="toggleLike({{ $post->id }}, 'dislike', this)" 
                                                        class="flex items-center text-gray-500 hover:text-red-600">
                                                    <i class="fas fa-thumbs-down"></i>
                                                    <span class="ml-1" id="dislike-count-{{ $post->id }}">{{ $post->like_counts['dislikes'] ?? 0 }}</span>
                                                </button>
                                            </div>
                                            
                                            <!-- Social Sharing Buttons -->
                                            <div class="flex space-x-2">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                                                   target="_blank" 
                                                   title="Share on Facebook"
                                                   class="text-gray-500 hover:text-blue-600">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                                                   target="_blank" 
                                                   title="Share on Twitter"
                                                   class="text-gray-500 hover:text-blue-400">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}" 
                                                   target="_blank" 
                                                   title="Share on LinkedIn"
                                                   class="text-gray-500 hover:text-blue-700">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                                <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode('Check out this article: ' . route('blog.show', $post->slug)) }}" 
                                                   title="Share via Email"
                                                   class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            </div>
                                            
                                            <a href="{{ route('blog.show', $post->slug) }}" class="text-green-600 hover:text-green-800 font-medium">
                                                Read More
                                                <i class="fas fa-arrow-right ml-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class="fas fa-newspaper text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">No articles yet</h3>
                            <p class="text-gray-500">Check back later for new posts from our team.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="text-center">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Search -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Search Articles</h3>
                    <form action="{{ route('blog') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search blog posts..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ request()->get('search') }}">
                            <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-green-600">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                    <div class="space-y-3">
                        @php
                            $categories = $posts->pluck('category')->unique()->filter();
                            $categoryCounts = [];
                            foreach($categories as $cat) {
                                $categoryCounts[$cat] = \App\Models\Post::where('category', $cat)->where('published', true)->count();
                            }
                        @endphp
                        
                        <a href="{{ route('blog') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition duration-300 {{ !request()->input('category') ? 'bg-gray-100' : '' }}">
                            <span class="text-gray-700">All Posts</span>
                            <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">{{ \App\Models\Post::where('published', true)->count() }}</span>
                        </a>
                        
                        @foreach($categoryCounts as $category => $count)
                            <a href="{{ route('blog') }}?category={{ $category }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition duration-300 {{ request()->input('category') == $category ? 'bg-gray-100' : '' }}">
                                <span class="text-gray-700">{{ ucfirst($category) }}</span>
                                <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">{{ $count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Articles</h3>
                    <div class="space-y-4">
                        @foreach(\App\Models\Post::where('published', true)->with('author')->orderBy('created_at', 'desc')->take(3)->get() as $recentPost)
                            <div class="flex items-start">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-blue-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas {{ $recentPost->category == 'announcement' ? 'fa-bullhorn' : ($recentPost->category == 'news' ? 'fa-newspaper' : 'fa-file-alt') }} text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm mb-1">
                                        <a href="{{ route('blog.show', $recentPost->slug) }}" class="hover:text-green-600">{{ \Illuminate\Support\Str::limit($recentPost->title, 40) }}</a>
                                    </h4>
                                    <p class="text-gray-600 text-xs">{{ $recentPost->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Stay Informed</h3>
                    <p class="mb-6">Subscribe to our newsletter for the latest updates and insights.</p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Your email address" class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                        <button class="w-full bg-white text-blue-600 hover:bg-gray-100 font-bold py-3 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-paper-plane mr-2"></i>Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Like/Dislike JavaScript -->
<script>
    function toggleLike(postId, type, buttonElement) {
        // Prevent multiple clicks during processing
        if (buttonElement.classList.contains('processing')) {
            return;
        }
        
        // Add processing class to prevent multiple clicks
        buttonElement.classList.add('processing');
        
        fetch(`/api/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ type: type })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update counts
                document.getElementById(`like-count-${postId}`).textContent = data.counts.likes;
                document.getElementById(`dislike-count-${postId}`).textContent = data.counts.dislikes;
                
                // Update button states based on action
                const likeBtn = document.querySelector(`button[onclick*="${postId}"][onclick*="'like'"]`);
                const dislikeBtn = document.querySelector(`button[onclick*="${postId}"][onclick*="'dislike'"]`);
                
                if (data.action === 'removed') {
                    // If action was removed, reset button styles
                    if (type === 'like') {
                        likeBtn.classList.remove('text-blue-600');
                        likeBtn.classList.add('text-gray-500');
                    } else {
                        dislikeBtn.classList.remove('text-red-600');
                        dislikeBtn.classList.add('text-gray-500');
                    }
                } else {
                    // If action was added/changed, update button styles
                    if (type === 'like') {
                        likeBtn.classList.remove('text-gray-500');
                        likeBtn.classList.add('text-blue-600');
                        // Reset dislike button if it was active
                        dislikeBtn.classList.remove('text-red-600');
                        dislikeBtn.classList.add('text-gray-500');
                    } else {
                        dislikeBtn.classList.remove('text-gray-500');
                        dislikeBtn.classList.add('text-red-600');
                        // Reset like button if it was active
                        likeBtn.classList.remove('text-blue-600');
                        likeBtn.classList.add('text-gray-500');
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the post rating.');
        })
        .finally(() => {
            // Remove processing class
            buttonElement.classList.remove('processing');
        });
    }
    
    // Initialize button states based on stored interactions
    document.addEventListener('DOMContentLoaded', function() {
        // We could initialize button states here if needed
    });
</script>
@endsection