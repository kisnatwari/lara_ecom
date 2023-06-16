@props(['label' => null, 'id', 'error' => null, 'type' => "text", 'autoComplete' => 'false', 'required' => false, 'placeholder' => null, 'accept' => '*', 'class' => null])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{!! $label !!}</label>
    <div class="mt-1">
        <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}" @if($type === 'file') accept="{{ $accept }}" @endif @if($required) required @endif autocomplete="{{ $autoComplete }}" placeholder="{{ $placeholder }}" class="appearance-none block w-full px-3 py-2 border {{ $error ? 'border-red-500' : 'border-gray-300 dark:border-gray-700' }} rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200 {{ $class }}" />
    </div>
</div>