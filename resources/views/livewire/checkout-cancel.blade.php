<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="flex items-center font-poppins">
      <div class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto mt-10 border rounded-md bg-lightest dark:bg-dark md:py-10 md:px-10">
        <div>
          <h1 class="px-4 text-3xl font-semibold tracking-wide text-center text-red-500 dark:text-gray-300 ">
            Payment Failed! Order Cancelled!
          </h1>
          <div class="">{{$session_id}}</div>
          <div class="my-5 text-center">
            <x-secondary-link-button href="/my-cart">Back To Cart</x-secondary-link-button>
          </div>
        </div>
      </div>
    </section>
  </div>