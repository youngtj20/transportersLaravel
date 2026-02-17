@extends('website.layout')

@section('title', 'Contact Us - Transporters for Tinubu 2027')
@section('description', 'Get in touch with the Transporters for Tinubu 2027 team. Contact information, office locations, and inquiry forms.')
@section('keywords', 'contact, get in touch, contact us, tinubu contact, nigeria transportation')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Get In Touch</h1>
        <p class="text-xl max-w-3xl mx-auto">
            We'd love to hear from you. Reach out to our team for inquiries, partnerships, or to join our movement
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <!-- Office Locations -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Office Locations</h3>
                    
                    <div class="space-y-6">
                        <!-- Abuja Office -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-building text-green-600"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Headquarters</h4>
                                <p class="text-gray-600 mb-2">
                                    Plot 123, Diplomatic Zone<br>
                                    Abuja, Nigeria
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-phone mr-2"></i>
                                    <span>+234 800 TRANSPORT</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lagos Office -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-city text-blue-600"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Lagos Office</h4>
                                <p class="text-gray-600 mb-2">
                                    456 Victoria Island<br>
                                    Lagos, Nigeria
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-phone mr-2"></i>
                                    <span>+234 800 LAGOS</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kano Office -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-warehouse text-purple-600"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Kano Office</h4>
                                <p class="text-gray-600 mb-2">
                                    789 Aminu Kano Way<br>
                                    Kano, Nigeria
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-phone mr-2"></i>
                                    <span>+234 800 KANO</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Methods -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Other Ways to Reach Us</h3>
                    
                    <div class="space-y-4">
                        <a href="mailto:info@transportersfortinubu.ng" class="flex items-center p-4 rounded-lg hover:bg-gray-50 transition duration-300">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Email Us</p>
                                <p class="text-gray-600 text-sm">info@transportersfortinubu.ng</p>
                            </div>
                        </a>
                        
                        <a href="tel:+234800TRANSPORT" class="flex items-center p-4 rounded-lg hover:bg-gray-50 transition duration-300">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-phone-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Call Us</p>
                                <p class="text-gray-600 text-sm">+234 800 TRANSPORT</p>
                            </div>
                        </a>
                        
                        <div class="flex items-center p-4 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Office Hours</p>
                                <p class="text-gray-600 text-sm">Mon-Fri: 8:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-pink-600 rounded-full flex items-center justify-center text-white hover:bg-pink-700 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center text-white hover:bg-blue-800 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <select id="subject" 
                                        name="subject" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="membership">Membership Application</option>
                                    <option value="event">Event Information</option>
                                    <option value="support">Support Request</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Your Message <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="6" 
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                      placeholder="Please share your inquiry, feedback, or request..."></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg text-lg transition duration-300 flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- FAQ Section -->
                <div class="mt-12 bg-gray-50 rounded-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
                    
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-6">
                            <h3 class="font-bold text-gray-900 mb-2">How can I join the movement?</h3>
                            <p class="text-gray-700">You can join by filling out our membership application form or contacting our membership team directly. We welcome all transportation professionals and supporters of our cause.</p>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6">
                            <h3 class="font-bold text-gray-900 mb-2">What services do you provide?</h3>
                            <p class="text-gray-700">We provide transportation services for political events, voter mobilization, community outreach programs, and logistics support for democratic processes across Nigeria.</p>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6">
                            <h3 class="font-bold text-gray-900 mb-2">How can businesses partner with you?</h3>
                            <p class="text-gray-700">We welcome partnerships with businesses that share our vision for democratic participation and transportation development. Contact our partnerships team for more information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Find Us Across Nigeria</h2>
            <p class="text-xl text-gray-300">Our network spans all 36 states and the Federal Capital Territory</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-8 text-center">
            <div class="h-96 bg-gradient-to-br from-green-600 to-blue-600 rounded-lg flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-map-marked-alt text-6xl mb-4"></i>
                    <p class="text-2xl font-bold mb-2">Nigeria Map</p>
                    <p class="text-lg">Interactive map showing our offices and network coverage</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection