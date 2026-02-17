@extends('website.layout')

@section('title', 'About Us - Transporters for Tinubu 2027')
@section('description', 'Learn about Transporters for Tinubu 2027 movement, our history, leadership, and commitment to supporting Bola Ahmed Tinubu\'s 2027 presidential campaign.')
@section('keywords', 'about transporters, tinubu movement, nigeria politics, campaign history, leadership team')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">About Our Movement</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Building bridges across Nigeria through strategic transportation and political engagement
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Our Story -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 mb-6">
                            Transporters for Tinubu 2027 was established in 2011 as a grassroots organization 
                            of professional transporters, drivers, and logistics experts who recognized the 
                            critical role that transportation plays in Nigeria's democratic process.
                        </p>
                        <p class="text-gray-700 mb-6">
                            What started as a small group of concerned citizens in Lagos has grown into 
                            Nigeria's largest political transportation network, with active chapters in all 
                            36 states and the Federal Capital Territory. Our movement represents taxi drivers, 
                            truck operators, bus companies, motorcycle riders, and other transportation professionals 
                            who believe in the power of organized political engagement.
                        </p>
                        <p class="text-gray-700">
                            Over the past 15 years, we have successfully coordinated transportation for 
                            political rallies, voting logistics, community outreach programs, and civic 
                            engagement initiatives. Our members have become trusted advocates for democratic 
                            participation across Nigeria.
                        </p>
                    </div>
                </div>

                <!-- Our Impact -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Impact</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-green-50 p-6 rounded-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-vote-yea text-green-600 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Voter Mobilization</h3>
                            </div>
                            <p class="text-gray-700">
                                Facilitated transportation for over 2 million voters during the 2019 and 2023 elections
                            </p>
                        </div>
                        
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-handshake text-blue-600 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Community Engagement</h3>
                            </div>
                            <p class="text-gray-700">
                                Organized 500+ community meetings and political awareness campaigns
                            </p>
                        </div>
                        
                        <div class="bg-yellow-50 p-6 rounded-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-truck-moving text-yellow-600 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Logistics Support</h3>
                            </div>
                            <p class="text-gray-700">
                                Coordinated transportation for 200+ political events and campaigns
                            </p>
                        </div>
                        
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-network-wired text-purple-600 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Network Coverage</h3>
                            </div>
                            <p class="text-gray-700">
                                Active presence in all 36 states with 10,000+ registered transporters
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Our Values -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Core Values</h2>
                    <div class="space-y-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Integrity</h3>
                                <p class="text-gray-700">
                                    We maintain the highest standards of honesty and transparency in all our operations
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Community First</h3>
                                <p class="text-gray-700">
                                    Our community's needs and development always come before individual interests
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-handshake text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Collaboration</h3>
                                <p class="text-gray-700">
                                    We believe in working together with all stakeholders for Nigeria's progress
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-balance-scale text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Democratic Values</h3>
                                <p class="text-gray-700">
                                    We uphold and promote democratic principles, rule of law, and good governance
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Facts</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Founded:</span>
                            <span class="font-semibold">2011</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">States:</span>
                            <span class="font-semibold">36 + FCT</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Members:</span>
                            <span class="font-semibold">10,000+</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Events:</span>
                            <span class="font-semibold">200+</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Voters Reached:</span>
                            <span class="font-semibold">2M+</span>
                        </div>
                    </div>
                </div>

                <!-- Leadership -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Our Leadership</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-full w-12 h-12 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">Chief Coordinator</p>
                                <p class="text-sm text-gray-600">National Level</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-full w-12 h-12 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">State Coordinators</p>
                                <p class="text-sm text-gray-600">All 36 States</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-full w-12 h-12 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">Local Chairmen</p>
                                <p class="text-sm text-gray-600">774 LGAs</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact CTA -->
                <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Want to Learn More?</h3>
                    <p class="mb-6">Contact our team for more information about our movement and activities.</p>
                    <a href="{{ url('/contact') }}" class="block text-center bg-white text-green-600 hover:bg-gray-100 font-bold py-3 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-phone mr-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection