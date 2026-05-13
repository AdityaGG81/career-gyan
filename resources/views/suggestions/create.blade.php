@extends('layouts.app')

@section('title', 'Suggestion Box - CareerGyan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                Suggestion Box
            </h1>
            <p class="mt-4 text-xl text-gray-500">
                Help us improve CareerGyan. Share your thoughts, ideas, or feedback.
            </p>
        </div>

        <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-2xl p-8 sm:p-10 border border-blue-100">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('suggestion.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Honeypot -->
                <div class="hidden">
                    <label for="website">Leave this field blank if you are human:</label>
                    <input type="text" name="website" id="website" value="{{ old('website') }}">
                </div>

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-xl bg-gray-50/50 transition duration-150 ease-in-out" placeholder="Name">
                        </div>
                    </div>
                    
                    <div>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-xl bg-gray-50/50 transition duration-150 ease-in-out" placeholder="Email">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">I am a...</label>
                    <div class="mt-1">
                        <select id="role" name="role" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-xl bg-gray-50/50 transition duration-150 ease-in-out">
                            <option value="Student" {{ old('role') == 'Student' ? 'selected' : '' }}>Student</option>
                            <option value="Expert" {{ old('role') == 'Expert' ? 'selected' : '' }}>Expert / Professional</option>
                            <option value="Parent" {{ old('role') == 'Parent' ? 'selected' : '' }}>Parent</option>
                            <option value="Other" {{ old('role') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Suggestion or Feedback <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <textarea id="message" name="message" rows="5" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-xl bg-gray-50/50 transition duration-150 ease-in-out" placeholder="How can we improve?">{{ old('message') }}</textarea>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full inline-flex justify-center items-center py-3.5 px-6 border border-transparent shadow-lg text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02]">
                        Send Suggestion
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
