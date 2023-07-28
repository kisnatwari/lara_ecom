@extends('customer.index')

@section('children')
    <div class="min-h-screen">
        <div class="flex flex-col items-center justify-center h-full">
            <div class="text-center bg-white dark:bg-slate-800 shadow-lg p-5 border-l-4 border-green-500">
                <i class="fa fa-check-circle text-6xl mb-3 text-green-400"></i>
                <p class="text-3xl font-bold mb-4">Your products have been ordered successfully.</p>
                <p class="text-lg mb-8">You'll be e-mailed for more details about your product status.</p>
                <a href="/">
                    <button class="bg-indigo-600 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">Continue
                        Shopping</button>
                </a>
            </div>
        </div>
    </div>
@endsection
