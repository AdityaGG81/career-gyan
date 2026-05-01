@extends('layouts.app')

@section('title', 'Admin - Suggestions')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-bold text-gray-900">Platform Suggestions</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all feedback and suggestions submitted by users.</p>
            </div>
        </div>
        
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-xl bg-white">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($suggestions as $suggestion)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="font-medium text-gray-900">{{ $suggestion->name ?: 'Anonymous' }}</div>
                                        <div class="text-gray-500">{{ $suggestion->email ?: 'No email provided' }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($suggestion->role == 'Student') bg-blue-100 text-blue-800
                                            @elseif($suggestion->role == 'Expert') bg-green-100 text-green-800
                                            @elseif($suggestion->role == 'Parent') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800 @endif
                                        ">
                                            {{ $suggestion->role }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500 max-w-xl">
                                        <div class="whitespace-pre-wrap">{{ $suggestion->message }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $suggestion->created_at->format('M d, Y h:i A') }}
                                        <div class="text-xs text-gray-400">{{ $suggestion->created_at->diffForHumans() }}</div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-sm text-gray-500">
                                        No suggestions found yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
