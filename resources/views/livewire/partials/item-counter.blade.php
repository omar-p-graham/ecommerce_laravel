<!-- Input Number -->
<div class="px-3 py-2 font-bold border rounded-lg border-dark bg-mid dark:bg-dark">
    <div class="flex items-center justify-between w-full gap-x-5">
      <div class="grow">
        <span class="block text-xs">
          Select quantity
        </span>
        <input class="w-full p-0 bg-transparent border-0 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="{{$quantity}}" readonly>
      </div>
      <div class="flex justify-end items-center gap-x-1.5">
        <button type="button" class="inline-flex items-center justify-center text-sm font-medium border rounded-full shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Decrease" wire:click="decrementQuantity">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
        </button>
        <button type="button" class="inline-flex items-center justify-center text-sm font-medium border rounded-full shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Increase" wire:click="incrementQuantity">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
  <!-- End Input Number -->