<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<x-main-heading>Checkout</x-main-heading>
	<form wire:submit.prevent="submitOrder" class="grid grid-cols-12 gap-4">
		<div class="col-span-12 md:col-span-12 lg:col-span-8">
			<!-- Card -->
			<div class="p-4 shadow bg-lightest rounded-xl sm:p-7 dark:bg-dark">
				<!-- Shipping Address -->
				<div class="mb-6">
					<h2 class="mb-2 text-xl font-bold underline">Shipping Address</h2>
					<div class="grid gap-4 md:grid-cols-2">
						<div>
							<label class="block mb-1" for="first_name">First Name</label>
							<input class="w-full px-3 py-2 bg-transparent border rounded-lg" id="first_name" wire:model="first_name" type="text">
							</input>
							@error('first_name')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
						<div>
							<label class="block mb-1" for="last_name">Last Name</label>
							<input class="w-full px-3 py-2 bg-transparent border rounded-lg" wire:model="last_name" id="last_name" type="text">
							</input>
							@error('last_name')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
					</div>
					<div class="mt-4">
						<label class="block mb-1" for="phone">Phone</label>
						<input class="w-full px-3 py-2 bg-transparent border rounded-lg" id="phone" wire:model="phone" type="text">
						</input>
						@error('phone')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="mt-4">
						<label class="block mb-1" for="address">Address</label>
						<input class="w-full px-3 py-2 bg-transparent border rounded-lg" id="street_address" wire:model="street_address" type="text">
						</input>
						@error('street_address')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="mt-4">
						<label class="block mb-1" for="city">City</label>
						<input class="w-full px-3 py-2 bg-transparent border rounded-lg" id="city" wire:model="city" type="text">
						</input>
						@error('city')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="grid gap-4 mt-4 md:grid-cols-2">
						<div>
							<label class="block mb-1" for="state">State</label>
							<select class="w-full px-3 py-2 border rounded-lg bg-lightest dark:bg-dark" id="state" wire:model="state">
								<option value="">Select State</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
							@error('state')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
						<div>
							<label class="block mb-1" for="zip_code">ZIP Code</label>
							<input class="w-full px-3 py-2 bg-transparent border rounded-lg" id="zip_code" wire:model="zip_code" type="text">
							</input>
							@error('zip_code')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
					</div>
				</div>
			</div>
			<!-- End Card -->
		</div>
		<div class="col-span-12 md:col-span-12 lg:col-span-4">
			<div class="p-6 rounded-lg shadow-md bg-lightest dark:bg-dark">
				<h2 class="mb-4 text-lg font-semibold">Summary</h2>
				<div class="flex justify-between mb-2">
					<span>Subtotal</span>
					<span>{{Number::currency($orderSummary['cost'])}}</span>
				</div>
				@if ($orderSummary['total_discount']>0)
				  <div class="flex justify-between mb-2">
					<span>Discount</span>
					<span>-{{Number::currency($orderSummary['total_discount'])}}</span>
				  </div> 
				@endif
				<div class="flex justify-between mb-2">
					<span>Shipping</span>
					<span>Free</span>
				</div>
				<hr class="my-2">
				<div class="flex justify-between mb-2">
					<span class="font-semibold">Total</span>
					<span class="font-semibold">{{Number::currency($orderSummary['grandTotal'])}}</span>
				</div>
				@if ($items)
					<div class="w-full py-3 mt-5">
						<x-primary-button type="submit" class="block w-full text-center">
							<span wire:loading.remove wire:target="submitOrder">Place Order</span>
							<span wire:loading wire:target="submitOrder" class="flex items-center justify-center">
								<svg class='w-4 h-4 mr-1 stroke-darkest animate-spin' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
									<g clip-path='url(#clip0_9023_61563_1)'>
									  <path d='M14.6437 2.05426C11.9803 1.2966 9.01686 1.64245 6.50315 3.25548C1.85499 6.23817 0.504864 12.4242 3.48756 17.0724C6.47025 21.7205 12.6563 23.0706 17.3044 20.088C20.4971 18.0393 22.1338 14.4793 21.8792 10.9444' stroke='stroke-current' stroke-width='1.4' stroke-linecap='round' class='my-path'></path>
									</g>
									<defs>
									  <clipPath id='clip0_9023_61563_1'>
										<rect width='24' height='24' fill='white'></rect>
									  </clipPath>
									</defs>
								</svg>
								Processing...
							</span>
						</x-primary-button>
					</div>
				@endif
			</div>
			<div class="p-4 mt-4 shadow bg-lightest rounded-xl sm:p-7 dark:bg-dark">
				<h2 class="mb-4 text-lg font-semibold">Cart</h2>
				<ul class="divide-y divide-mid" role="list">
					@foreach ($items as $item)
						<li class="py-3 sm:py-4">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<img alt="{{$item['name']}}" class="w-12 h-12 rounded-full" src="{{url('storage',$item['image'])}}">
									</img>
								</div>
								<div class="grid flex-1 min-w-0 ms-4">
									<div class="text-sm font-medium truncate">
										{{$item['name']}}
									</div>
									<div class="flex justify-between text-sm">
										<div>X{{$item['quantity']}}</div>
										<div class="flex">
											<span class="mr-1">{{Number::currency($item['total_amount']-$item['total_discount'])}}</span>
											@if($item['total_discount']>0)
												<span class="text-red-500 line-through">{{Number::currency($item['total_amount'])}}</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</form>
</div>