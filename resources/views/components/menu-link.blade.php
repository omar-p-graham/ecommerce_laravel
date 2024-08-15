@props(["href"=>"/"])

@php
  $requestLink = ($href=='/') ? '/' : Str::replace('/','',$href);
  $conditionalClass = request()->is($requestLink) ? 'text-brand font-bold underline' : 'text-darkest dark:text-lightest'
@endphp

<a href="{{$href}}" {{$attributes->merge(["class" => "my-2 transition-colors duration-300 transform hover:text-brand dark:hover:text-brand md:mx-4 md:my-0 $conditionalClass"])}} wire:navigate>{{$slot}}</a>