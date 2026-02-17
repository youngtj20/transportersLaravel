@extends('website.layout')

@section('title', 'Events - Transporters for Tinubu 2027')
@section('description', 'Stay updated with our upcoming events, rallies, and community gatherings supporting the Transporters for Tinubu 2027 movement.')
@section('keywords', 'events, rallies, community gatherings, tinubu events, nigeria politics')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Upcoming Events</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Join us at these important events as we support progressive leadership and strengthen Nigeria's democratic process
        </p>
    </div>
</div>

<!-- Events Filter -->
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition duration-300">
                    <i class="fas fa-calendar-day mr-2"></i>All Events
                </button>
                <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-map-marker-alt mr-2"></i>Upcoming
                </button>
                <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition duration-300 border">
                    <i class="fas fa-history mr-2"></i>Past Events
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Events List -->
            <div class="lg:col-span-2">
                <!-- Upcoming Events -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Upcoming Events</h2>
                    
                    <!-- Event 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 hover:shadow-xl transition-shadow duration-300">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <div class="h-48 md:h-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <div class="text-4xl font-bold">15</div>
                                        <div class="text-lg">MAR</div>
                                        <div class="text-sm">2026</div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-calendar-check mr-1"></i>Upcoming
                                    </span>
                                    <span class="ml-3 text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Abuja
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Tinubu 2027 Launch Event</h3>
                                <p class="text-gray-700 mb-4">
                                    Official launch of the 2027 presidential campaign with keynote speeches from party leaders, cultural displays, and community engagement activities.
                                </p>
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>10:00 AM - 4:00 PM</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends mr-2 text-gray-500"></i>
                                    <span class="text-gray-600">Expected attendees: 5,000+</span>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                        View Details
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 hover:shadow-xl transition-shadow duration-300">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <div class="h-48 md:h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <div class="text-4xl font-bold">22</div>
                                        <div class="text-lg">MAR</div>
                                        <div class="text-sm">2026</div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-calendar-check mr-1"></i>Upcoming
                                    </span>
                                    <span class="ml-3 text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Lagos
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">State Coordinators Meeting</h3>
                                <p class="text-gray-700 mb-4">
                                    Quarterly coordination meeting with state representatives to discuss campaign strategies, resource allocation, and operational planning for the coming months.
                                </p>
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>2:00 PM - 6:00 PM</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends mr-2 text-gray-500"></i>
                                    <span class="text-gray-600">Expected attendees: 200+</span>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                        View Details
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 hover:shadow-xl transition-shadow duration-300">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <div class="h-48 md:h-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <div class="text-4xl font-bold">29</div>
                                        <div class="text-lg">MAR</div>
                                        <div class="text-sm">2026</div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        <i class="fas fa-calendar-check mr-1"></i>Upcoming
                                    </span>
                                    <span class="ml-3 text-gray-500 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Kano
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Youth Engagement Forum</h3>
                                <p class="text-gray-700 mb-4">
                                    Special forum to engage young transporters and discuss youth participation in politics, democratic processes, and leadership development opportunities.
                                </p>
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 3:00 PM</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends mr-2 text-gray-500"></i>
                                    <span class="text-gray-600">Expected attendees: 1,000+</span>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                        View Details
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Past Events -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Past Events</h2>
                        <a href="#" class="text-green-600 hover:text-green-800 font-medium">
                            View All Past Events
                            <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Past Event 1 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-calendar-check text-gray-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Voter Education Campaign</h3>
                                    <p class="text-gray-600">February 2026 • Abuja</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                Completed
                            </span>
                        </div>
                        <p class="text-gray-700">
                            Successful voter education campaign that reached over 10,000 citizens with information about the electoral process and civic responsibilities.
                        </p>
                    </div>
                    
                    <!-- Past Event 2 -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-users text-gray-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Annual General Meeting</h3>
                                    <p class="text-gray-600">January 2026 • Lagos</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                Completed
                            </span>
                        </div>
                        <p class="text-gray-700">
                            Annual gathering of transporters and stakeholders to review achievements, discuss challenges, and plan for the upcoming year's activities.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Event Calendar -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Event Calendar</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-center mb-4">
                            <div class="text-lg font-bold text-gray-900">March 2026</div>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center">
                            <div class="text-xs text-gray-500 font-medium">S</div>
                            <div class="text-xs text-gray-500 font-medium">M</div>
                            <div class="text-xs text-gray-500 font-medium">T</div>
                            <div class="text-xs text-gray-500 font-medium">W</div>
                            <div class="text-xs text-gray-500 font-medium">T</div>
                            <div class="text-xs text-gray-500 font-medium">F</div>
                            <div class="text-xs text-gray-500 font-medium">S</div>
                            
                            <!-- Calendar days -->
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">1</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">2</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">3</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">4</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">5</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">6</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">7</div>
                            
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">8</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">9</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">10</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">11</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">12</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">13</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-400">14</div>
                            
                            <div class="h-8 flex items-center justify-center text-sm font-bold text-green-600 bg-green-50 rounded-full">15</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">16</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">17</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">18</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">19</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">20</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">21</div>
                            
                            <div class="h-8 flex items-center justify-center text-sm font-bold text-green-600 bg-green-50 rounded-full">22</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">23</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">24</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">25</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">26</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">27</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">28</div>
                            
                            <div class="h-8 flex items-center justify-center text-sm font-bold text-green-600 bg-green-50 rounded-full">29</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">30</div>
                            <div class="h-8 flex items-center justify-center text-sm text-gray-700">31</div>
                        </div>
                    </div>
                </div>

                <!-- Event Categories -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Event Categories</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Political Rallies</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Community Events</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">8</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Training Sessions</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">5</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Meetings</span>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">15</span>
                        </div>
                    </div>
                </div>

                <!-- Subscribe -->
                <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Stay Updated</h3>
                    <p class="mb-6">Subscribe to receive notifications about upcoming events and important announcements.</p>
                    <a href="{{ url('/contact') }}" class="block text-center bg-white text-purple-600 hover:bg-gray-100 font-bold py-3 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-bell mr-2"></i>Subscribe Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection