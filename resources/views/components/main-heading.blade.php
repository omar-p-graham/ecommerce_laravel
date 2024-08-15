<div class="mb-4 section-heading">
    <h1 {{$attributes->merge(["class" => "text-2xl font-semibold capitalize text-darkest lg:text-3xl dark:text-lightest"])}}>
        {{$slot}}
    </h1>
    <div class="flex mx-auto mt-2">
        <span class="inline-block w-40 h-1 rounded-full bg-brand"></span>
        <span class="inline-block w-3 h-1 mx-1 rounded-full bg-brand"></span>
        <span class="inline-block w-1 h-1 rounded-full bg-brand"></span>
    </div>
</div>